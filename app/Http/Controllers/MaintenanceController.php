<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ClassificationList;
use App\Models\DepartmentList;
use App\Models\EmploymentStatus;
use App\Models\LicensureLists;
use App\Models\ProjectassignedList;
use App\Models\SiteList;

class MaintenanceController extends Controller
{
    // USER MAINTENANCE
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('credential', 'like', "%{$search}%");
            });
        });

        $users = $query->orderByDesc('id')->paginate(10);
        return view('maintenance.index', compact('users', 'search'));
    }

    public function store_user(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'credential' => 'required|string|max:255',
            'password' => 'required|min:5|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'credential' => $validated['credential'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('maintenance.index')->with('success', 'User added successfully.');
    }

    public function delete_user(User $user)
    {
        // prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('maintenance.index')->with('error', 'You cannot delete your own account.');
        }
        $user->delete();
        return redirect()->route('maintenance.index')->with('success', 'User deleted successfully.');
    }

    public function update_user(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'credential' => 'required|string|max:255',
            'password' => 'nullable|min:5|confirmed',
        ]);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->credential = $validated['credential'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();
        return redirect()->route('maintenance.index')->with('success', 'User updated successfully.');
    }

    // OTHER MAINTENANCE

    public function system()
    {
        $classlist = ClassificationList::orderByDesc('id')->paginate(10);
        $deptlist = DepartmentList::orderByDesc('id')->paginate(10);
        $statuslist = EmploymentStatus::orderByDesc('id')->paginate(10);
        $licenselist = LicensureLists::orderByDesc('id')->paginate(10);
        $projectlist = ProjectassignedList::orderByDesc('id')->paginate(10);
        $sitelist = SiteList::orderByDesc('id')->paginate(10);
        return view('maintenance.system', compact('classlist', 'deptlist', 'statuslist', 'licenselist', 'projectlist', 'sitelist'));
    }

    public function store_classList(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classification_lists,name',
            'modal' => 'required|string',
        ]);
        ClassificationList::create([
            'name' => $validated['name'],
        ]);
        return redirect()->route('maintenance.system')->with('success', 'Item added successfully.');
    }

    public function delete_classList(ClassificationList $list)
    {
        $list->delete();
        return redirect()->route('maintenance.system')->with('success', 'Item deleted successfully.');
    }

    public function store_deptList(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:department_list,code',
            'name' => 'required|string|max:255|unique:department_list,name',
            'description' => 'required|string|max:255',
            'modal' => 'required|string',
        ]);
        DepartmentList::create([
            'code' => $validated['code'],
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);
        return redirect()->route('maintenance.system')->with('success', 'Item added successfully.');
    }

    public function delete_deptList(DepartmentList $dept)
    {
        $dept->delete();
        return redirect()->route('maintenance.system')->with('success', 'Item deleted successfully.');
    }

    public function store_statusList(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:employment_statuses,name',
            'modal' => 'required|string',
        ]);
        EmploymentStatus::create([
            'name' => $validated['name'],
        ]);
        return redirect()->route('maintenance.system')->with('success', 'Item added successfully.');
    }

    public function delete_statusList(EmploymentStatus $empstat)
    {
        $empstat->delete();
        return redirect()->route('maintenance.system')->with('success', 'Item deleted successfully.');
    }

    public function store_licenseList(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:licensure_lists,name',
            'modal' => 'required|string',
        ]);
        LicensureLists::create([
            'name' => $validated['name'],
        ]);
        return redirect()->route('maintenance.system')->with('success', 'Item added successfully.');
    }

    public function delete_licenseList(LicensureLists $license)
    {
        $license->delete();
        return redirect()->route('maintenance.system')->with('success', 'Item deleted successfully.');
    }

    public function store_projectList(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:projectassigned_lists,name',
            'modal' => 'required|string',
        ]);
        ProjectassignedList::create([
            'name' => $validated['name'],
        ]);
        return redirect()->route('maintenance.system')->with('success', 'Item added successfully.');
    }

    public function delete_projectList(ProjectassignedList $project)
    {
        $project->delete();
        return redirect()->route('maintenance.system')->with('success', 'Item deleted successfully.');
    }

    public function store_siteList(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:site_lists,name',
            'modal' => 'required|string',
        ]);
        SiteList::create([
            'name' => $validated['name'],
        ]);
        return redirect()->route('maintenance.system')->with('success', 'Item added successfully.');
    }

    public function delete_siteList(SiteList $site)
    {
        $site->delete();
        return redirect()->route('maintenance.system')->with('success', 'Item deleted successfully.');
    }
}
