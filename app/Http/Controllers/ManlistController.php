<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\Manlist;
use App\Models\PersonalInfo;
use App\Models\ContactEmergency;
use App\Models\LeaveIncentive;
use App\Models\Compensation;
use App\Models\DepartmentList;
use App\Models\ClassificationList;
use App\Models\SiteList;
use App\Models\ProjectassignedList;
use App\Models\EmploymentStatus;
use App\Models\LicensureLists;

class ManlistController extends Controller
{
    protected array $locations;

    public function __construct()
    {
        $jsonPath = storage_path('app/ph_locations.json');
        $this->locations = json_decode(file_get_contents($jsonPath), true);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Manlist::when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query
                    ->where('emp_number', 'like', "%{$search}%")
                    ->orWhere('firstname', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%")
                    ->orWhere('emp_status', 'like', "%{$search}%")
                    ->orWhere('datehired', 'like', "%{$search}%");
            });
        });

        $manlists = $query->orderByDesc('id')->paginate(10);
        return view('manlist.index', compact('manlists', 'search'));
    }

    public function create()
    {
        $provinces = collect($this->locations)->flatMap(fn($region) => array_keys($region['province_list']))->unique()->sort()->values();
        return view('manlist.create', [
            'departments' => DepartmentList::pluck('name'),
            'classifications' => ClassificationList::pluck('name'),
            'sitelists' => SiteList::pluck('name'),
            'PAlists' => ProjectassignedList::pluck('name'),
            'Empstatus' => EmploymentStatus::pluck('name'),
            'Licensurelists' => LicensureLists::pluck('name'),
            'provinces' => $provinces,
        ]);
    }

    public function getMunicipalities(Request $request)
    {
        $province = $request->province;

        $municipalities = collect($this->locations)
            ->flatMap(function ($region) use ($province) {
                return $region['province_list'][$province]['municipality_list'] ?? [];
            })
            ->keys()
            ->sort()
            ->values();

        return response()->json($municipalities);
    }

    public function getBarangays(Request $request)
    {
        $municipalityName = $request->municipality;

        $barangays = [];

        foreach ($this->locations as $region) {
            foreach ($region['province_list'] as $province) {
                if (isset($province['municipality_list'][$municipalityName])) {
                    $barangays = $province['municipality_list'][$municipalityName]['barangay_list'] ?? [];
                    break 2; // stop both loops
                }
            }
        }

        sort($barangays);

        return response()->json(array_values($barangays));
    }

    public function store(Request $request)
    {
        // ---------------------------------------------------------
        // 1️⃣ VALIDATE MAIN EMPLOYEE (manlist) FIELDS
        // ---------------------------------------------------------
        $validated = $request->validate([
            'emp_number' => 'required|unique:manlists,emp_number',
            'firstname' => 'required',
            'middlename' => 'nullable',
            'lastname' => 'required',
            'suffix' => 'nullable',
            'position' => 'required',
            'department' => 'required',
            'emp_classification' => 'nullable',
            'emp_status' => 'nullable',
            'datehired' => 'nullable|date',
            'workbase' => 'nullable',
            'temporary_workbase' => 'nullable',
            'project_assigned' => 'nullable',
            'project_hired' => 'nullable|date',
            'contract_expiration' => 'nullable|date',
            'probitionary_date' => 'nullable|date',
            'regularization_date' => 'nullable|date',
        ]);

        DB::beginTransaction();

        try {
            // ---------------------------------------------------------
            // 2️⃣ INSERT MANLIST (MAIN EMPLOYEE)
            // ---------------------------------------------------------
            $manlist = Manlist::create($validated);

            // ---------------------------------------------------------
            // 3️⃣ INSERT PERSONAL INFORMATION
            // ---------------------------------------------------------
            PersonalInfo::create([
                'manlist_id' => $manlist->id,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'civil_status' => $request->civil_status,
                'educational_attainment' => $request->educational_attainment,
                'school' => $request->school,
                'course' => $request->course,
                'professional_licensure' => $request->professional_licensure,
                'phone_number' => $request->phone_number,
                'email_address' => $request->email_address,
                'province' => $request->province,
                'municipality' => $request->municipality,
                'barangay' => $request->barangay,
                'blood_type' => $request->blood_type,
                'address' => $request->address,
                'tin_number' => $request->tin_number,
                'sss_number' => $request->sss_number,
                'philhealth_number' => $request->philhealth_number,
                'pagibig_number' => $request->pagibig_number,
            ]);

            // ---------------------------------------------------------
            // 4️⃣ INSERT CONTACT IN CASE OF EMERGENCY
            // ---------------------------------------------------------
            ContactEmergency::create([
                'manlist_id' => $manlist->id,
                'contact_person' => $request->contact_person,
                'relationship' => $request->relationship,
                'contact_number' => $request->contact_number, // FIXED
            ]);

            // ---------------------------------------------------------
            // 5️⃣ INSERT LEAVE INCENTIVE
            // ---------------------------------------------------------
            LeaveIncentive::create([
                'manlist_id' => $manlist->id,
                'SIL' => $request->SIL ?? 0,
                'SL' => $request->SL ?? 0,
                'VL' => $request->VL ?? 0,
            ]);

            // ---------------------------------------------------------
            // 6️⃣ INSERT COMPENSATION
            // ---------------------------------------------------------
            Compensation::create([
                'manlist_id' => $manlist->id,
                'daily_rate' => $request->daily_rate ?? 0,
                'monthly_rate' => $request->monthly_rate ?? 0,
                'meal_subsidy' => $request->meal_subsidy ?? 0,
                'meal_allowance' => $request->meal_allowance ?? 0,
                'rice_subsidy' => $request->rice_subsidy ?? 0,
                'spa_allowance' => $request->spa_allowance ?? 0,
                'transpo_assistance' => $request->transpo_assistance ?? 0,
                'clothing_allowance' => $request->clothing_allowance ?? 0,
                'transpo_allowance' => $request->transpo_allowance ?? 0,
                'communication_allowance' => $request->communication_allowance ?? 0,
                'project_allowance' => $request->project_allowance ?? 0,
                'technical_allowance' => $request->technical_allowance ?? 0,
                'positional_allowance' => $request->positional_allowance ?? 0,
                'professional_allowance' => $request->professional_allowance ?? 0,
                'housing_allowance' => $request->housing_allowance ?? 0,
            ]);

            DB::commit();

            return redirect()->route('manlist.index')->with('success', 'Employee successfully added!');
        } catch (\Exception $e) {
            DB::rollBack();

            dd($e->getMessage());

            return redirect()
                ->route('manlist.create')
                ->with('error', 'Something went wrong: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $manlistEntry = Manlist::with(['personalInfo', 'contactEmergency', 'leaveIncentive', 'compensation'])->findOrFail($id);

        $provinces = collect($this->locations)->flatMap(fn($region) => array_keys($region['province_list']))->unique()->sort()->values();

        // saved values
        $selectedProvince = $manlistEntry->personalInfo->province ?? '';
        $selectedMunicipality = $manlistEntry->personalInfo->municipality ?? '';
        $selectedBarangay = $manlistEntry->personalInfo->barangay ?? '';

        return view('manlist.edit', [
            'manlistEntry' => $manlistEntry,
            'departments' => DepartmentList::pluck('name'),
            'classifications' => ClassificationList::pluck('name'),
            'sitelists' => SiteList::pluck('name'),
            'PAlists' => ProjectassignedList::pluck('name'),
            'Empstatus' => EmploymentStatus::pluck('name'),
            'Licensurelists' => LicensureLists::pluck('name'),
            'provinces' => $provinces,
            'selectedProvince' => $selectedProvince,
            'selectedMunicipality' => $selectedMunicipality,
            'selectedBarangay' => $selectedBarangay,
        ]);
    }

    public function update(Request $request, $id)
    {
        $manlist = Manlist::with(['personalInfo', 'contactEmergency', 'leaveIncentive', 'compensation'])->findOrFail($id);

        $validated = $request->validate([
            // Employee Details
            'emp_number' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'emp_classification' => 'required|string|max:255',
            'emp_status' => 'required|string|max:255',
            'datehired' => 'required|date',
            'workbase' => 'required|string|max:255',
            'temporary_workbase' => 'required|string|max:255',
            'project_assigned' => 'required|string|max:255',
            'project_hired' => 'nullable|date',
            'contract_expiration' => 'nullable|date',
            'probitionary_date' => 'nullable|date',
            'regularization_date' => 'nullable|date',

            // Personal Info
            'birthdate' => 'required|date',
            'gender' => 'required|string|max:10',
            'civil_status' => 'required|string|max:20',
            'educational_attainment' => 'nullable|string|max:50',
            'school' => 'nullable|string|max:255',
            'course' => 'nullable|string|max:255',
            'professional_licensure' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:50',
            'email_address' => 'nullable|email|max:255',
            'province' => 'nullable|string|max:500',
            'municipality' => 'nullable|string|max:500',
            'barangay' => 'nullable|string|max:500',
            'address' => 'nullable|string|max:500',
            'blood_type' => 'nullable|string|max:5',
            'tin_number' => 'nullable|string|max:50',
            'sss_number' => 'nullable|string|max:50',
            'philhealth_number' => 'nullable|string|max:50',
            'pagibig_number' => 'nullable|string|max:50',

            // Emergency Contact
            'contact_person' => 'nullable|string|max:255',
            'relationship' => 'nullable|string|max:100',
            'contact_number' => 'nullable|string|max:50',

            // Leave Incentives
            'SIL' => 'nullable|numeric',
            'SL' => 'nullable|numeric',
            'VL' => 'nullable|numeric',

            // Compensation
            'daily_rate' => 'nullable|numeric',
            'monthly_rate' => 'nullable|numeric',
            'meal_subsidy' => 'nullable|numeric',
            'meal_allowance' => 'nullable|numeric',
            'rice_subsidy' => 'nullable|numeric',
            'spa_allowance' => 'nullable|numeric',
            'transpo_assistance' => 'nullable|numeric',
            'clothing_allowance' => 'nullable|numeric',
            'transpo_allowance' => 'nullable|numeric',
            'communication_allowance' => 'nullable|numeric',
            'project_allowance' => 'nullable|numeric',
            'technical_allowance' => 'nullable|numeric',
            'positional_allowance' => 'nullable|numeric',
            'professional_allowance' => 'nullable|numeric',
            'housing_allowance' => 'nullable|numeric',
        ]);

        // Update Employee
        $manlist->update([
            'emp_number' => $validated['emp_number'],
            'position' => $validated['position'],
            'department' => $validated['department'],
            'firstname' => $validated['firstname'],
            'middlename' => $validated['middlename'],
            'lastname' => $validated['lastname'],
            'suffix' => $validated['suffix'],
            'emp_classification' => $validated['emp_classification'],
            'emp_status' => $validated['emp_status'],
            'datehired' => $validated['datehired'],
            'workbase' => $validated['workbase'],
            'temporary_workbase' => $validated['temporary_workbase'],
            'project_assigned' => $validated['project_assigned'],
            'project_hired' => $validated['project_hired'],
            'contract_expiration' => $validated['contract_expiration'],
            'probitionary_date' => $validated['probitionary_date'],
            'regularization_date' => $validated['regularization_date'],
        ]);

        // Update Relationships
        $manlist->personalInfo()->update([
            'birthdate' => $validated['birthdate'],
            'gender' => $validated['gender'],
            'civil_status' => $validated['civil_status'],
            'educational_attainment' => $validated['educational_attainment'],
            'school' => $validated['school'],
            'course' => $validated['course'],
            'professional_licensure' => $validated['professional_licensure'],
            'phone_number' => $validated['phone_number'],
            'email_address' => $validated['email_address'],
            'province' => $validated['province'],
            'municipality' => $validated['municipality'],
            'barangay' => $validated['barangay'],
            'address' => $validated['address'],
            'blood_type' => $validated['blood_type'],
            'tin_number' => $validated['tin_number'],
            'sss_number' => $validated['sss_number'],
            'philhealth_number' => $validated['philhealth_number'],
            'pagibig_number' => $validated['pagibig_number'],
        ]);

        $manlist->contactEmergency()->update([
            'contact_person' => $validated['contact_person'],
            'relationship' => $validated['relationship'],
            'contact_number' => $validated['contact_number'],
        ]);

        $manlist->leaveIncentive()->update([
            'SIL' => $validated['SIL'],
            'SL' => $validated['SL'],
            'VL' => $validated['VL'],
        ]);

        $manlist->compensation()->update([
            'daily_rate' => $validated['daily_rate'],
            'monthly_rate' => $validated['monthly_rate'],
            'meal_subsidy' => $validated['meal_subsidy'],
            'meal_allowance' => $validated['meal_allowance'],
            'rice_subsidy' => $validated['rice_subsidy'],
            'spa_allowance' => $validated['spa_allowance'],
            'transpo_assistance' => $validated['transpo_assistance'],
            'clothing_allowance' => $validated['clothing_allowance'],
            'transpo_allowance' => $validated['transpo_allowance'],
            'communication_allowance' => $validated['communication_allowance'],
            'project_allowance' => $validated['project_allowance'],
            'technical_allowance' => $validated['technical_allowance'],
            'positional_allowance' => $validated['positional_allowance'],
            'professional_allowance' => $validated['professional_allowance'],
            'housing_allowance' => $validated['housing_allowance'],
        ]);

        return redirect()->route('manlist.edit', $manlist->id)->with('success', 'Employee information updated successfully!');
    }

    public function generateContract($id)
    {
        $manlistEntry = Manlist::with(['personalInfo', 'contactEmergency', 'leaveIncentive', 'compensation'])->findOrFail($id);

        // Load Blade view into PDF
        $pdf = Pdf::loadView('manlist.contract', compact('manlistEntry'))->setPaper('a4', 'portrait'); // Set A4 size

        // Stream PDF to browser (inline view like a PDF viewer)
        return $pdf->stream('Employment_Contract_' . $manlistEntry->lastname . '.pdf');
    }

    public function generateForm($id)
    {
        $manlistEntry = Manlist::with(['personalInfo', 'contactEmergency', 'leaveIncentive', 'compensation'])->findOrFail($id);

        // Load Blade view into PDF
        $pdf = Pdf::loadView('manlist.form', compact('manlistEntry'))->setPaper('a4', 'portrait'); // Set A4 size

        // Stream PDF to browser (inline view like a PDF viewer)
        return $pdf->stream('Employment_Form_' . $manlistEntry->lastname . '.pdf');
    }

    public function destroy($id)
    {
        try {
            $entry = Manlist::findOrFail($id);
            $entry->delete();
            return redirect()->route('manlist.index')->with('success', 'Entry deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('manlist.index')->with('error', 'Failed to delete entry. Please try again.');
        }
    }

    public function exportExcel()
    {
        $manlists = Manlist::with(['personalInfo', 'contactEmergency', 'leaveIncentive', 'compensation'])->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Headers
        $headers = ['EMP_NUMBER', 'FIRSTNAME', 'MIDDLENAME', 'LASTNAME', 'SUFFIX', 'POSITION', 'DEPARTMENT', 'EMP_CLASSIFICATION', 'EMP_STATUS', 'DATEHIRED', 'WORKBASE', 'TEMPORARY_WORKBASE', 'PROJECT_ASSIGNED', 'PROJECT_HIRED', 'CONTRACT_EXPIRATION', 'PROBITIONARY_DATE', 'REGULARIZATION_DATE', 'BIRTHDATE', 'GENDER', 'CIVIL_STATUS', 'EDUCATIONAL_ATTAINMENT', 'SCHOOL', 'COURSE', 'PROFESSIONAL_LICENSURE', 'PHONE_NUMBER', 'EMAIL_ADDRESS', 'PROVINCE', 'MUNICIPALITY', 'BARANGAY', 'BLOOD_TYPE', 'ADDRESS', 'TIN_NUMBER', 'SSS_NUMBER', 'PHILHEALTH_NUMBER', 'PAGIBIG_NUMBER', 'CONTACT_PERSON', 'RELATIONSHIP', 'CONTACT_NUMBER', 'SIL', 'SL', 'VL', 'DAILY_RATE', 'MONTHLY_RATE', 'MEAL_SUBSIDY', 'MEAL_ALLOWANCE', 'RICE_SUBSIDY', 'SPA_ALLOWANCE', 'TRANSPO_ASSISTANCE', 'CLOTHING_ALLOWANCE', 'TRANSPO_ALLOWANCE', 'COMMUNICATION_ALLOWANCE', 'PROJECT_ALLOWANCE', 'TECHNICAL_ALLOWANCE', 'POSITIONAL_ALLOWANCE', 'PROFESSIONAL_ALLOWANCE', 'HOUSING_ALLOWANCE', 'SEPARATION_DATE', 'SEPARATION_REASON', 'REMARKS'];

        // Initialize data array with headers first
        $data = [$headers];

        // Prepare rows
        foreach ($manlists as $m) {
            $personal = $m->personalInfo ?? null;
            $contact = $m->contactEmergency ?? null;
            $leave = $m->leaveIncentive ?? null;
            $comp = $m->compensation ?? null;

            $data[] = [
                $m->emp_number,
                $m->firstname,
                $m->middlename,
                $m->lastname,
                $m->suffix,
                $m->position,
                $m->department,
                $m->emp_classification,
                $m->emp_status,
                $m->datehired,
                $m->workbase,
                $m->temporary_workbase,
                $m->project_assigned,
                $m->project_hired,
                $m->contract_expiration,
                $m->probitionary_date,
                $m->regularization_date,
                $personal->birthdate ?? '',
                $personal->gender ?? '',
                $personal->civil_status ?? '',
                $personal->educational_attainment ?? '',
                $personal->school ?? '',
                $personal->course ?? '',
                $personal->professional_licensure ?? '',
                $personal->phone_number ?? '',
                $personal->email_address ?? '',
                $personal->province ?? '',
                $personal->municipality ?? '',
                $personal->barangay ?? '',
                $personal->blood_type ?? '',
                $personal->address ?? '',
                $personal->tin_number ?? '',
                $personal->sss_number ?? '',
                $personal->philhealth_number ?? '',
                $personal->pagibig_number ?? '',
                $contact->contact_person ?? '',
                $contact->relationship ?? '',
                $contact->contact_number ?? '',
                $leave->SIL ?? 0,
                $leave->SL ?? 0,
                $leave->VL ?? 0,
                $comp->daily_rate ?? 0,
                $comp->monthly_rate ?? 0,
                $comp->meal_subsidy ?? 0,
                $comp->meal_allowance ?? 0,
                $comp->rice_subsidy ?? 0,
                $comp->spa_allowance ?? 0,
                $comp->transpo_assistance ?? 0,
                $comp->clothing_allowance ?? 0,
                $comp->transpo_allowance ?? 0,
                $comp->communication_allowance ?? 0,
                $comp->project_allowance ?? 0,
                $comp->technical_allowance ?? 0,
                $comp->positional_allowance ?? 0,
                $comp->professional_allowance ?? 0,
                $comp->housing_allowance ?? 0,
                $m->separation_date ?? '',
                $m->separation_reason ?? '',
                $m->remarks ?? '',
            ];
        }

        // Insert all data at once
        $sheet->fromArray($data, null, 'A1');

        // Auto-size columns safely (works beyond column Z)
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'manlist_export_' . date('Y-m-d_H-i-s') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            $rows = Excel::toArray([], $request->file('excel_file'))[0];

            if (count($rows) < 2) {
                return back()->with('error', 'Excel file is empty.');
            }

            // ---------------------------------------------------------
            // Clean Excel headers (trim + uppercase + remove hidden chars)
            // ---------------------------------------------------------
            $fileHeaders = array_map(function ($h) {
                return strtoupper(trim(preg_replace('/[[:^print:]]/', '', $h)));
            }, $rows[0]);

            // ---------------------------------------------------------
            // Required headers (all uppercase)
            // ---------------------------------------------------------
            $requiredHeaders = ['EMP_NUMBER', 'FIRSTNAME', 'MIDDLENAME', 'LASTNAME', 'SUFFIX', 'POSITION', 'DEPARTMENT', 'EMP_CLASSIFICATION', 'EMP_STATUS', 'DATEHIRED', 'WORKBASE', 'TEMPORARY_WORKBASE', 'PROJECT_ASSIGNED', 'PROJECT_HIRED', 'CONTRACT_EXPIRATION', 'PROBITIONARY_DATE', 'REGULARIZATION_DATE', 'BIRTHDATE', 'GENDER', 'CIVIL_STATUS', 'EDUCATIONAL_ATTAINMENT', 'SCHOOL', 'COURSE', 'PROFESSIONAL_LICENSURE', 'PHONE_NUMBER', 'EMAIL_ADDRESS', 'PROVINCE', 'MUNICIPALITY', 'BARANGAY', 'BLOOD_TYPE', 'ADDRESS', 'TIN_NUMBER', 'SSS_NUMBER', 'PHILHEALTH_NUMBER', 'PAGIBIG_NUMBER', 'CONTACT_PERSON', 'RELATIONSHIP', 'CONTACT_NUMBER', 'SIL', 'SL', 'VL', 'DAILY_RATE', 'MONTHLY_RATE', 'MEAL_SUBSIDY', 'MEAL_ALLOWANCE', 'RICE_SUBSIDY', 'SPA_ALLOWANCE', 'TRANSPO_ASSISTANCE', 'CLOTHING_ALLOWANCE', 'TRANSPO_ALLOWANCE', 'COMMUNICATION_ALLOWANCE', 'PROJECT_ALLOWANCE', 'TECHNICAL_ALLOWANCE', 'POSITIONAL_ALLOWANCE', 'PROFESSIONAL_ALLOWANCE', 'HOUSING_ALLOWANCE'];

            foreach ($requiredHeaders as $header) {
                if (!in_array($header, $fileHeaders)) {
                    return back()->with('error', "Missing required column: {$header}");
                }
            }

            DB::beginTransaction();

            $manlistData = [];
            $personalData = [];
            $contactData = [];
            $leaveData = [];
            $compData = [];
            $validRowIndexes = [];

            $upper = fn($v) => is_string($v) ? strtoupper($v) : $v;

            // Helper: convert Excel serial number to date
            $convertDate = function ($value) {
                if (is_numeric($value)) {
                    return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
                }
                return $value;
            };

            // ---------------------------------------------------------
            // Prepare batch data
            // ---------------------------------------------------------
            for ($i = 1; $i < count($rows); $i++) {
                // Convert empty cells or whitespace-only cells to null
                $row = array_combine($fileHeaders, array_map(fn($v) => trim($v) === '' ? null : $v, $rows[$i]));

                if (empty($row['EMP_NUMBER'])) {
                    continue;
                }

                $validRowIndexes[] = $i;

                // ---------------------------------------------------------
                // Manlist data
                // ---------------------------------------------------------
                $manlistData[] = array_map($upper, [
                    'emp_number' => $row['EMP_NUMBER'], // required
                    'firstname' => $row['FIRSTNAME'], // required
                    'middlename' => $row['MIDDLENAME'], // required
                    'lastname' => $row['LASTNAME'], // required
                    'suffix' => $row['SUFFIX'],
                    'position' => $row['POSITION'], // required
                    'department' => $row['DEPARTMENT'], // required
                    'emp_classification' => $row['EMP_CLASSIFICATION'],
                    'emp_status' => $row['EMP_STATUS'],
                    'datehired' => $row['DATEHIRED'] ? $convertDate($row['DATEHIRED']) : null,
                    'workbase' => $row['WORKBASE'],
                    'temporary_workbase' => $row['TEMPORARY_WORKBASE'],
                    'project_assigned' => $row['PROJECT_ASSIGNED'],
                    'project_hired' => $row['PROJECT_HIRED'] ? $convertDate($row['PROJECT_HIRED']) : null,
                    'contract_expiration' => $row['CONTRACT_EXPIRATION'] ? $convertDate($row['CONTRACT_EXPIRATION']) : null,
                    'probitionary_date' => $row['PROBITIONARY_DATE'] ? $convertDate($row['PROBITIONARY_DATE']) : null,
                    'regularization_date' => $row['REGULARIZATION_DATE'] ? $convertDate($row['REGULARIZATION_DATE']) : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // ---------------------------------------------------------
                // Personal info
                // ---------------------------------------------------------
                $personalData[] = array_map($upper, [
                    'birthdate' => $row['BIRTHDATE'] ? $convertDate($row['BIRTHDATE']) : null,
                    'gender' => $row['GENDER'],
                    'civil_status' => $row['CIVIL_STATUS'],
                    'educational_attainment' => $row['EDUCATIONAL_ATTAINMENT'],
                    'school' => $row['SCHOOL'],
                    'course' => $row['COURSE'],
                    'professional_licensure' => $row['PROFESSIONAL_LICENSURE'],
                    'phone_number' => $row['PHONE_NUMBER'],
                    'email_address' => $row['EMAIL_ADDRESS'],
                    'province' => $row['PROVINCE'],
                    'municipality' => $row['MUNICIPALITY'],
                    'barangay' => $row['BARANGAY'],
                    'blood_type' => $row['BLOOD_TYPE'],
                    'address' => $row['ADDRESS'],
                    'tin_number' => $row['TIN_NUMBER'],
                    'sss_number' => $row['SSS_NUMBER'],
                    'philhealth_number' => $row['PHILHEALTH_NUMBER'],
                    'pagibig_number' => $row['PAGIBIG_NUMBER'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // ---------------------------------------------------------
                // Contact
                // ---------------------------------------------------------
                $contactData[] = array_map($upper, [
                    'contact_person' => $row['CONTACT_PERSON'],
                    'relationship' => $row['RELATIONSHIP'],
                    'contact_number' => $row['CONTACT_NUMBER'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // ---------------------------------------------------------
                // Leave
                // ---------------------------------------------------------
                $leaveData[] = [
                    'SIL' => $row['SIL'] ?? 0,
                    'SL' => $row['SL'] ?? 0,
                    'VL' => $row['VL'] ?? 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // ---------------------------------------------------------
                // Compensation
                // ---------------------------------------------------------
                $compData[] = [
                    'daily_rate' => $row['DAILY_RATE'] ?? 0,
                    'monthly_rate' => $row['MONTHLY_RATE'] ?? 0,
                    'meal_subsidy' => $row['MEAL_SUBSIDY'] ?? 0,
                    'meal_allowance' => $row['MEAL_ALLOWANCE'] ?? 0,
                    'rice_subsidy' => $row['RICE_SUBSIDY'] ?? 0,
                    'spa_allowance' => $row['SPA_ALLOWANCE'] ?? 0,
                    'transpo_assistance' => $row['TRANSPO_ASSISTANCE'] ?? 0,
                    'clothing_allowance' => $row['CLOTHING_ALLOWANCE'] ?? 0,
                    'transpo_allowance' => $row['TRANSPO_ALLOWANCE'] ?? 0,
                    'communication_allowance' => $row['COMMUNICATION_ALLOWANCE'] ?? 0,
                    'project_allowance' => $row['PROJECT_ALLOWANCE'] ?? 0,
                    'technical_allowance' => $row['TECHNICAL_ALLOWANCE'] ?? 0,
                    'positional_allowance' => $row['POSITIONAL_ALLOWANCE'] ?? 0,
                    'professional_allowance' => $row['PROFESSIONAL_ALLOWANCE'] ?? 0,
                    'housing_allowance' => $row['HOUSING_ALLOWANCE'] ?? 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // ---------------------------------------------------------
            // Insert Manlist & get IDs
            // ---------------------------------------------------------
            $insertedIds = [];
            foreach (array_chunk($manlistData, 500) as $chunk) {
                DB::table('manlists')->insert($chunk);
                $lastId = DB::getPdo()->lastInsertId();
                for ($j = 0; $j < count($chunk); $j++) {
                    $insertedIds[] = $lastId - count($chunk) + 1 + $j;
                }
            }

            // Assign manlist_id to related tables
            foreach ($validRowIndexes as $index => $rowIndex) {
                $personalData[$index]['manlist_id'] = $insertedIds[$index];
                $contactData[$index]['manlist_id'] = $insertedIds[$index];
                $leaveData[$index]['manlist_id'] = $insertedIds[$index];
                $compData[$index]['manlist_id'] = $insertedIds[$index];
            }

            // ---------------------------------------------------------
            // Batch insert related tables
            // ---------------------------------------------------------
            foreach (array_chunk($personalData, 500) as $chunk) {
                DB::table('personal_infos')->insert($chunk);
            }
            foreach (array_chunk($contactData, 500) as $chunk) {
                DB::table('contact_emergencies')->insert($chunk);
            }
            foreach (array_chunk($leaveData, 500) as $chunk) {
                DB::table('leave_incentives')->insert($chunk);
            }
            foreach (array_chunk($compData, 500) as $chunk) {
                DB::table('compensation')->insert($chunk);
            }

            DB::commit();
            return back()->with('success', 'Excel data imported successfully!');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return back()->with('error', 'Excel data import failed: ' . $e->getMessage());
        }
    }
}
