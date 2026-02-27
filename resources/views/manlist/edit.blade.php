<x-layout>
    <h1 class="text-xl font-semibold text-white mb-5">View / Manage Employee</h1>

    <!-- Card with Top Right Buttons -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-3">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4">
            <h2 class="text-lg font-medium text-gray-800">Employee Management</h2>
            <!-- Button Row (Right) -->
            <div class="flex gap-2 mt-4 sm:mt-0" id="buttonGroup">
                <button id="editBtn" class="bg-green-500 text-white text-xs px-3 py-2 rounded hover:bg-green-600">
                    Edit
                </button>
                <button id="deleteBtn" class="bg-red-500 text-white text-xs px-3 py-2 rounded hover:bg-red-600">
                    Delete
                </button>

                <a href="{{ route('manlist.form', $manlistEntry->id) }}" id="generateFormBtn"
                    class="bg-blue-500 text-white text-xs px-3 py-2 rounded hover:bg-blue-600 {{ strtoupper(Auth::user()->credential) === 'ADMIN' ? '' : 'hidden' }}"
                    target="_blank">
                    Generate Form
                </a>
                <a href="{{ route('manlist.contract', $manlistEntry->id) }}" id="generateContractBtn"
                    class="bg-blue-500 text-white text-xs px-3 py-2 rounded hover:bg-blue-600 {{ strtoupper(Auth::user()->credential) === 'ADMIN' ? '' : 'hidden' }}"
                    target="_blank">
                    Generate Contract
                </a>

                <!-- Hidden Save/Cancel Buttons -->
                <button id="footerSaveBtn"
                    class="bg-green-500 text-white text-xs px-3 py-2 rounded hover:bg-green-600 hidden">
                    Save
                </button>
                <button id="footerCancelBtn"
                    class="bg-gray-500 text-white text-xs px-3 py-2 rounded hover:bg-gray-600 hidden">
                    Cancel
                </button>
            </div>
        </div>
    </div>


    <form action="{{ route('manlist.update', $manlistEntry->id) }}" method="POST" id="editform">
        @csrf
        @method('PUT')

        <fieldset id="formFieldset" disabled class="opacity-80 pointer-events-none">
            <!-- EMPLOYEE DETAILS CARD -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-3 p-6 space-y-4">

                <div class="flex justify-between items-center mb-4">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded-full">
                        Employee Details
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-5">

                    <!-- Employee Number -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="emp_number" class="block mb-1 font-medium text-green-500">Employee Number *</label>
                        <input type="text" id="emp_number" name="emp_number" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->emp_number }}">
                        @error('emp_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Position -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="position" class="block mb-1 font-medium text-green-500">Position *</label>
                        <input type="text" id="position" name="position" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->position }}">
                        @error('position')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Department -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="department" class="block mb-1 font-medium text-green-500">Department *</label>
                        <select id="department" name="department" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department }}"
                                    {{ $department == $manlistEntry->department ? 'selected' : '' }}>
                                    {{ $department }}
                                </option>
                            @endforeach
                        </select>
                        @error('department')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- First Name -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="firstname" class="block mb-1 font-medium text-green-500">First Name *</label>
                        <input type="text" id="firstname" name="firstname" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->firstname }}">
                        @error('firstname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Middle Name -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="middlename" class="block mb-1 font-medium text-green-500">Middle Name *</label>
                        <input type="text" id="middlename" name="middlename" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->middlename }}">
                        @error('middlename')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="sm:cols-span-6 lg:col-span-3">
                        <label for="lastname" class="block mb-1 font-medium text-green-500">Last Name *</label>
                        <input type="text" id="lastname" name="lastname" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->lastname }}">
                        @error('lastname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Suffix -->
                    <div class="sm:col-span-6 lg:col-span-1">
                        <label for="suffix" class="block mb-1 font-medium text-green-500">Suffix</label>
                        <select id="suffix" name="suffix"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="" {{ $manlistEntry->suffix == '' ? 'selected' : '' }}>N/A</option>
                            <option value="Jr." {{ $manlistEntry->suffix == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                            <option value="Sr." {{ $manlistEntry->suffix == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                            <option value="II" {{ $manlistEntry->suffix == 'II' ? 'selected' : '' }}>II</option>
                            <option value="III" {{ $manlistEntry->suffix == 'III' ? 'selected' : '' }}>III</option>
                            <option value="IV" {{ $manlistEntry->suffix == 'IV' ? 'selected' : '' }}>IV</option>
                        </select>

                        @error('suffix')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Employee Classification -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="emp_classification" class="block mb-1 font-medium text-green-500">Employee
                            Classification *</label>
                        <select id="emp_classification" name="emp_classification" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Classification</option>
                            @foreach ($classifications as $classification)
                                <option value="{{ $classification }}"
                                    {{ $classification == $manlistEntry->emp_classification ? 'selected' : '' }}>
                                    {{ $classification }}
                                </option>
                            @endforeach
                        </select>
                        @error('emp_classification')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Employee Status -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="emp_status" class="block mb-1 font-medium text-green-500">Employment Status
                            *</label>
                        <select id="emp_status" name="emp_status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Status</option>
                            @foreach ($Empstatus as $status)
                                <option value="{{ $status }}"
                                    {{ $status == $manlistEntry->emp_status ? 'selected' : '' }}>{{ $status }}
                                </option>
                            @endforeach
                        </select>
                        @error('emp_status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date Hired -->
                    <div class="sm:cols-span-6 lg:col-span-2">
                        <label for="datehired" class="block mb-1 font-medium text-green-500">Date Hired *</label>
                        <input type="date" id="datehired" name="datehired" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->datehired }}">
                        @error('datehired')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @php
                        $dateHired = $manlistEntry->datehired ? \Carbon\Carbon::parse($manlistEntry->datehired) : null;
                        $tenure = $dateHired ? round($dateHired->floatDiffInYears(\Carbon\Carbon::now()), 2) : 0;
                    @endphp

                    <!-- Tenure -->
                    <div class="sm:col-span-6 lg:col-span-2">
                        <label for="tenure" class="block mb-1 font-medium text-green-500">Tenure</label>
                        <input type="text" id="tenure" name="tenure" readonly
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $tenure }}">
                        @error('tenure')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Workbase -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="workbase" class="block mb-1 font-medium text-green-500">Workbase *</label>
                        <select id="workbase" name="workbase" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Workbase</option>
                            @foreach ($sitelists as $sitelist)
                                <option value="{{ $sitelist }}"
                                    {{ $sitelist == $manlistEntry->workbase ? 'selected' : '' }}>{{ $sitelist }}
                                </option>
                            @endforeach
                        </select>
                        @error('workbase')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Temporary Workbase -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="temporary_workbase" class="block mb-1 font-medium text-green-500">Temporary
                            Workbase *</label>
                        <select id="temporary_workbase" name="temporary_workbase" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Workbase</option>
                            @foreach ($sitelists as $sitelist)
                                <option value="{{ $sitelist }}"
                                    {{ $sitelist == $manlistEntry->temporary_workbase ? 'selected' : '' }}>
                                    {{ $sitelist }}</option>
                            @endforeach
                        </select>
                        @error('temporary_workbase')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Assigned -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="project_assigned" class="block mb-1 font-medium text-green-500">Project Assigned
                        </label>
                        <select id="project_assigned" name="project_assigned"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Project Assigned</option>
                            @foreach ($PAlists as $PAlist)
                                <option value="{{ $PAlist }}"
                                    {{ $PAlist == $manlistEntry->project_assigned ? 'selected' : '' }}>
                                    {{ $PAlist }}</option>
                            @endforeach
                        </select>
                        @error('project_assigned')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Hired -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="project_hired" class="block mb-1 font-medium text-green-500">Project Hired</label>
                        <input type="date" id="project_hired" name="project_hired"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->project_hired }}">
                        @error('project_hired')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contract Expiration -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="contract_expiration" class="block mb-1 font-medium text-green-500">Contract
                            Expiration</label>
                        <input type="date" id="contract_expiration" name="contract_expiration"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->contract_expiration }}">
                        @error('contract_expiration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Probationary Date -->
                    <div class="sm:cols-span-6 lg:col-span-2">
                        <label for="probitionary_date" class="block mb-1 font-medium text-green-500">Probationary
                            Date</label>
                        <input type="date" id="probitionary_date" name="probitionary_date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->probitionary_date }}">
                        @error('probitionary_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Regularization Date -->
                    <div class="sm:cols-span-6 lg:col-span-2">
                        <label for="regularization_date" class="block mb-1 font-medium text-green-500">Regularization
                            Date</label>
                        <input type="date" id="regularization_date" name="regularization_date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->regularization_date }}">
                        @error('regularization_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Seperation Date -->
                    <div class="sm:cols-span-6 lg:col-span-4">
                        <label for="seperation_date" class="block mb-1 font-medium text-green-500">Seperation
                            Date</label>
                        <input type="date" id="seperation_date" name="seperation_date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->seperation_date }}">
                        @error('seperation_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Reason -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="seperation_reason" class="block mb-1 font-medium text-green-500">Seperation
                            Reason</label>
                        <input type="text" id="seperation_reason" name="seperation_reason"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->seperation_reason }}">
                        @error('seperation_reason')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remarks -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="remarks" class="block mb-1 font-medium text-green-500">Remarks</label>
                        <input type="text" id="remarks" name="remarks"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->remarks }}">
                        @error('remarks')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
            <!-- PERSONAL INFORMATION CARD -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-3 p-6 space-y-4">

                <div class="flex justify-between items-center mb-4">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded-full">
                        Personal Information
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-5">

                    <!-- Birthdate -->
                    <div class="sm:col-span-6 lg:col-span-3">
                        <label for="birthdate" class="block mb-1 font-medium text-green-500">Birthdate *</label>
                        <input type="date" id="birthdate" name="birthdate" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->personalInfo->birthdate }}">
                        @error('birthdate')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @php
                        $birthdate = $manlistEntry->personalInfo->birthdate
                            ? \Carbon\Carbon::parse($manlistEntry->personalInfo->birthdate)
                            : null;

                        $age = $birthdate ? $birthdate->age : '';
                    @endphp
                    <!-- Age -->
                    <div class="sm:col-span-6 lg:col-span-1">
                        <label for="age" class="block mb-1 font-medium text-green-500">Age</label>
                        <input type="text" id="age" name="age" readonly
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $age }}">
                        @error('age')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="gender" class="block mb-1 font-medium text-green-500">Gender *</label>
                        <select id="gender" name="gender" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Gender</option>
                            <option value="MALE"
                                {{ $manlistEntry->personalInfo->gender == 'MALE' ? 'selected' : '' }}>
                                MALE</option>
                            <option value="FEMALE"
                                {{ $manlistEntry->personalInfo->gender == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Civil Status -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="civil_status" class="block mb-1 font-medium text-green-500">Civil Status *</label>
                        <select id="civil_status" name="civil_status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Status</option>
                            <option value="SINGLE"
                                {{ $manlistEntry->personalInfo->civil_status == 'SINGLE' ? 'selected' : '' }}>SINGLE
                            </option>
                            <option value="MARRIED"
                                {{ $manlistEntry->personalInfo->civil_status == 'MARRIED' ? 'selected' : '' }}>MARRIED
                            </option>
                            <option value="DIVORCED"
                                {{ $manlistEntry->personalInfo->civil_status == 'DIVORCED' ? 'selected' : '' }}>
                                DIVORCED
                            </option>
                            <option value="SEPARATED"
                                {{ $manlistEntry->personalInfo->civil_status == 'SEPARATED' ? 'selected' : '' }}>
                                SEPARATED
                            </option>
                            <option value="WIDOWED"
                                {{ $manlistEntry->personalInfo->civil_status == 'WIDOWED' ? 'selected' : '' }}>WIDOWED
                            </option>
                            <option value="ANNULLED"
                                {{ $manlistEntry->personalInfo->civil_status == 'ANNULLED' ? 'selected' : '' }}>
                                ANNULLED
                            </option>
                        </select>
                        @error('civil_status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Educational Attainment -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="educational_attainment" class="block mb-1 font-medium text-green-500">Educational
                            Attainment</label>
                        <select id="educational_attainment" name="educational_attainment"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Options</option>
                            <option value="ELEMENTARY GRADUATE"
                                {{ $manlistEntry->personalInfo->educational_attainment == 'ELEMENTARY GRADUATE' ? 'selected' : '' }}>
                                ELEMENTARY GRADUATE</option>
                            <option value="HIGH SCHOOL GRADUATE"
                                {{ $manlistEntry->personalInfo->educational_attainment == 'HIGH SCHOOL GRADUATE' ? 'selected' : '' }}>
                                HIGH SCHOOL GRADUATE</option>
                            <option value="SENIOR HIGH SCHOOL GRADUATE"
                                {{ $manlistEntry->personalInfo->educational_attainment == 'SENIOR HIGH SCHOOL GRADUATE' ? 'selected' : '' }}>
                                SENIOR HIGH SCHOOL GRADUATE</option>
                            <option value="VOCATIONAL"
                                {{ $manlistEntry->personalInfo->educational_attainment == 'VOCATIONAL' ? 'selected' : '' }}>
                                VOCATIONAL</option>
                            <option value="COLLEGE UNDERGRADUATE"
                                {{ $manlistEntry->personalInfo->educational_attainment == 'COLLEGE UNDERGRADUATE' ? 'selected' : '' }}>
                                COLLEGE UNDERGRADUATE</option>
                            <option value="COLLEGE GRADUATE"
                                {{ $manlistEntry->personalInfo->educational_attainment == 'COLLEGE GRADUATE' ? 'selected' : '' }}>
                                COLLEGE GRADUATE</option>
                            <option value="POSTGRADUATE"
                                {{ $manlistEntry->personalInfo->educational_attainment == 'POSTGRADUATE' ? 'selected' : '' }}>
                                POSTGRADUATE</option>
                            <option value="MASTER'S DEGREE"
                                {{ $manlistEntry->personalInfo->educational_attainment == "MASTER'S DEGREE" ? 'selected' : '' }}>
                                MASTER'S DEGREE</option>
                            <option value="DOCTORATE/PH.D"
                                {{ $manlistEntry->personalInfo->educational_attainment == 'DOCTORATE/PH.D' ? 'selected' : '' }}>
                                DOCTORATE/PH.D</option>
                        </select>
                        @error('educational_attainment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- School -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="school" class="block mb-1 font-medium text-green-500">School</label>
                        <input type="text" id="school" name="school"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->personalInfo->school }}">
                        @error('school')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Course -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="course" class="block mb-1 font-medium text-green-500">Course</label>
                        <input type="text" id="course" name="course"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->personalInfo->course }}">
                        @error('course')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Professional Licensure -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="professional_licensure" class="block mb-1 font-medium text-green-500">Professional
                            Licensure</label>
                        <select id="professional_licensure" name="professional_licensure"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Options</option>
                            @foreach ($Licensurelists as $Licensurelist)
                                <option value="{{ $Licensurelist }}"
                                    {{ $Licensurelist == $manlistEntry->personalInfo->professional_licensure ? 'selected' : '' }}>
                                    {{ $Licensurelist }}</option>
                            @endforeach
                        </select>
                        @error('professional_licensure')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="phone_number" class="block mb-1 font-medium text-green-500">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->personalInfo->phone_number }}">
                        @error('phone_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="email_address" class="block mb-1 font-medium text-green-500">Email Address</label>
                        <input type="email" id="email_address" name="email_address"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->personalInfo->email_address }}">
                        @error('email_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="province" class="block mb-1 font-medium text-green-500">Province *</label>
                        <select id="province" name="province" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">SELECT PROVINCE</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province }}"
                                    {{ $province == $selectedProvince ? 'selected' : '' }}>
                                    {{ $province }}
                                </option>
                            @endforeach
                        </select>
                        @error('province')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="municipality" class="block mb-1 font-medium text-green-500">Municipality *</label>
                        <select id="municipality" name="municipality" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">SELECT MUNICIPALITY</option>
                        </select>
                        @error('municipality')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Barangay -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="barangay" class="block mb-1 font-medium text-green-500">Barangay *</label>
                        <select id="barangay" name="barangay" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">SELECT BARANGAY</option>
                        </select>
                        @error('barangay')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address (full width) -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="address" class="block mb-1 font-medium text-green-500">Full Address</label>
                        <input type="text" id="address" name="address"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->personalInfo->address }}">
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Blood Type -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="blood_type" class="block mb-1 font-medium text-green-500">Blood Type</label>
                        <select id="blood_type" name="blood_type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                            <option value="">Select Options</option>
                            <option value="A+"
                                {{ $manlistEntry->personalInfo->blood_type == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-"
                                {{ $manlistEntry->personalInfo->blood_type == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+"
                                {{ $manlistEntry->personalInfo->blood_type == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-"
                                {{ $manlistEntry->personalInfo->blood_type == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+"
                                {{ $manlistEntry->personalInfo->blood_type == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-"
                                {{ $manlistEntry->personalInfo->blood_type == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+"
                                {{ $manlistEntry->personalInfo->blood_type == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-"
                                {{ $manlistEntry->personalInfo->blood_type == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                        @error('blood_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- TIN Number -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="tin_number" class="block mb-1 font-medium text-green-500">TIN Number</label>
                        <input type="text" id="tin_number" name="tin_number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->personalInfo->tin_number }}">
                        @error('tin_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SSS Number -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="sss_number" class="block mb-1 font-medium text-green-500">SSS Number</label>
                        <input type="text" id="sss_number" name="sss_number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->personalInfo->sss_number }}">
                        @error('sss_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PhilHealth Number -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="philhealth_number" class="block mb-1 font-medium text-green-500">PhilHealth
                            Number</label>
                        <input type="text" id="philhealth_number" name="philhealth_number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->personalInfo->philhealth_number }}">
                        @error('philhealth_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pag-IBIG Number -->
                    <div class="sm:col-span-6 lg:col-span-4">
                        <label for="pagibig_number" class="block mb-1 font-medium text-green-500">Pag-IBIG
                            Number</label>
                        <input type="text" id="pagibig_number" name="pagibig_number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->personalInfo->pagibig_number }}">
                        @error('pagibig_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- CONTACT IN CASE OF EMERGENCY CARD -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-3 p-6 space-y-4">

                <div class="flex justify-between items-center mb-4">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded-full">
                        Contact in Case of Emergency
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    <!-- Contact Person -->
                    <div>
                        <label for="contact_person" class="block mb-1 font-medium text-green-500">Contact
                            Person</label>
                        <input type="text" id="contact_person" name="contact_person"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->contactEmergency->contact_person }}">
                        @error('contact_person')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Relationship -->
                    <div>
                        <label for="relationship" class="block mb-1 font-medium text-green-500">Relationship</label>
                        <input type="text" id="relationship" name="relationship"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->contactEmergency->relationship }}">
                        @error('relationship')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label for="contact_number" class="block mb-1 font-medium text-green-500">Contact
                            Number</label>
                        <input type="text" id="contact_number" name="contact_number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->contactEmergency->contact_number }}">
                        @error('contact_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- LEAVE INCENTIVE CARD -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-3 p-6 space-y-4">

                <div class="flex justify-between items-center mb-4">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded-full">
                        Leave Incentive
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    <!-- SIL -->
                    <div>
                        <label for="SIL" class="block mb-1 font-medium text-green-500">SIL Balance</label>
                        <input type="number" id="SIL" name="SIL" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->leaveIncentive->SIL }}">
                        @error('SIL')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SL -->
                    <div>
                        <label for="SL" class="block mb-1 font-medium text-green-500">SL Balance</label>
                        <input type="number" id="SL" name="SL" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->leaveIncentive->SL }}">
                        @error('SL')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- VL -->
                    <div>
                        <label for="VL" class="block mb-1 font-medium text-green-500">VL Balance</label>
                        <input type="number" id="VL" name="VL" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->leaveIncentive->VL }}">
                        @error('VL')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- COMPENSATION CARD -->
            <div
                class="bg-white rounded-lg shadow-sm overflow-hidden mb-3 p-6 space-y-4 {{ strtoupper(Auth::user()->credential) === 'ADMIN' ? '' : 'hidden' }}">
                <div class="flex justify-between items-center mb-4">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded-full">
                        Compensation
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    <div>
                        <label for="daily_rate" class="block mb-1 font-medium text-green-500">Daily Rate</label>
                        <input type="number" id="daily_rate" name="daily_rate" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->daily_rate }}">
                        @error('daily_rate')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="monthly_rate" class="block mb-1 font-medium text-green-500">Monthly Rate</label>
                        <input type="number" id="monthly_rate" name="monthly_rate" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->monthly_rate }}">
                        @error('monthly_rate')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meal_subsidy" class="block mb-1 font-medium text-green-500">Meal Subsidy</label>
                        <input type="number" id="meal_subsidy" name="meal_subsidy" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->meal_subsidy }}">
                        @error('meal_subsidy')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meal_allowance" class="block mb-1 font-medium text-green-500">Meal
                            Allowance</label>
                        <input type="number" id="meal_allowance" name="meal_allowance" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->meal_allowance }}">
                        @error('meal_allowance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rice_subsidy" class="block mb-1 font-medium text-green-500">Rice Subsidy</label>
                        <input type="number" id="rice_subsidy" name="rice_subsidy" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->rice_subsidy }}">
                        @error('rice_subsidy')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="spa_allowance" class="block mb-1 font-medium text-green-500">SPA Allowance</label>
                        <input type="number" id="spa_allowance" name="spa_allowance" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->spa_allowance }}">
                        @error('spa_allowance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="transpo_assistance" class="block mb-1 font-medium text-green-500">Transport
                            Assistance</label>
                        <input type="number" id="transpo_assistance" name="transpo_assistance" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->transpo_assistance }}">
                        @error('transpo_assistance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="clothing_allowance" class="block mb-1 font-medium text-green-500">Clothing
                            Allowance</label>
                        <input type="number" id="clothing_allowance" name="clothing_allowance" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->clothing_allowance }}">
                        @error('clothing_allowance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="transpo_allowance" class="block mb-1 font-medium text-green-500">Transport
                            Allowance</label>
                        <input type="number" id="transpo_allowance" name="transpo_allowance" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->transpo_allowance }}">
                        @error('transpo_allowance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="communication_allowance"
                            class="block mb-1 font-medium text-green-500">Communication
                            Allowance</label>
                        <input type="number" id="communication_allowance" name="communication_allowance"
                            step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->communication_allowance }}">
                        @error('communication_allowance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="project_allowance" class="block mb-1 font-medium text-green-500">Project
                            Allowance</label>
                        <input type="number" id="project_allowance" name="project_allowance" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->project_allowance }}">
                        @error('project_allowance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="technical_allowance" class="block mb-1 font-medium text-green-500">Technical
                            Allowance</label>
                        <input type="number" id="technical_allowance" name="technical_allowance" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->technical_allowance }}">
                        @error('technical_allowance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="positional_allowance" class="block mb-1 font-medium text-green-500">Positional
                            Allowance</label>
                        <input type="number" id="positional_allowance" name="positional_allowance" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->positional_allowance }}">
                        @error('positional_allowance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="professional_allowance" class="block mb-1 font-medium text-green-500">Professional
                            Allowance</label>
                        <input type="number" id="professional_allowance" name="professional_allowance"
                            step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->professional_allowance }}">
                        @error('professional_allowance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="housing_allowance" class="block mb-1 font-medium text-green-500">Housing
                            Allowance</label>
                        <input type="number" id="housing_allowance" name="housing_allowance" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            value="{{ $manlistEntry->compensation->housing_allowance }}">
                        @error('housing_allowance')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div id="formSaveBtn"
                class="bg-white rounded-lg shadow-sm overflow-hidden mb-3 p-6 flex justify-end items-center hidden">

                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-500 transition font-medium">
                    Save Information
                </button>
            </div>
        </fieldset>
    </form>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/30">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800">Confirm Delete</h2>
            <p class="mt-2 text-sm text-gray-600">Are you sure you want to delete this item? This action cannot be
                undone.</p>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition"
                    onclick="document.getElementById('delete-modal').classList.add('hidden')">
                    Cancel
                </button>

                <!-- Form for delete -->
                <form id="deleteForm" action="{{ route('manlist.destroy', $manlistEntry->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- Script -->
    <script>
        // Show modal when main delete button is clicked
        document.getElementById('deleteBtn').addEventListener('click', function() {
            document.getElementById('delete-modal').classList.remove('hidden');
        });
    </script>

    <script>
        const editBtn = document.getElementById('editBtn');
        const footerSaveBtn = document.getElementById('footerSaveBtn');
        const footerCancelBtn = document.getElementById('footerCancelBtn');
        const form = document.querySelector('#editform');
        const formSaveBtn = document.getElementById('formSaveBtn');
        const fieldset = document.getElementById('formFieldset');

        const otherBtns = ['deleteBtn', 'generateFormBtn', 'generateContractBtn'].map(id => document.getElementById(id));

        // Store original values
        fieldset.querySelectorAll('input, select, textarea').forEach(el => {
            el.dataset.originalValue = el.value;
        });

        // ----------------------
        // Edit Button
        // ----------------------
        editBtn.addEventListener('click', () => {
            fieldset.disabled = false;
            fieldset.classList.remove('opacity-80', 'pointer-events-none');

            editBtn.classList.add('hidden');
            otherBtns.forEach(btn => btn.classList.add('hidden'));
            footerSaveBtn.classList.remove('hidden');
            footerCancelBtn.classList.remove('hidden');
            formSaveBtn.classList.remove('hidden'); // inside form hidden button
        });

        // ----------------------
        // Cancel Button
        // ----------------------
        footerCancelBtn.addEventListener('click', () => {
            fieldset.disabled = true;
            fieldset.classList.add('opacity-80', 'pointer-events-none');

            editBtn.classList.remove('hidden');
            @if (strtoupper(Auth::user()->credential) === 'ADMIN')
                otherBtns.forEach(btn => btn.classList.remove('hidden'));
            @endif
            footerSaveBtn.classList.add('hidden');
            footerCancelBtn.classList.add('hidden');
            formSaveBtn.classList.add('hidden');

            // Reset form fields to original values
            fieldset.querySelectorAll('input, select, textarea').forEach(el => {
                el.value = el.dataset.originalValue;
            });
        });

        // ----------------------
        // Save Button (outside) triggers internal submit
        // ----------------------
        footerSaveBtn.addEventListener('click', () => {
            // Trigger the form submit button to respect HTML5 validation
            formSaveBtn.click();
            form.requestSubmit();
            console.log("triggered");
        });


        // ----------------------
        // Optional: Save Button inside form can have same logic or be left native
        // ----------------------
        formSaveBtn.addEventListener('click', () => {
            // You can add extra JS before submit here if needed
            // Otherwise, browser will handle validation automatically
        });
    </script>

    <script>
        const MUNICIPALITIES_URL = "{{ route('locations.municipalities') }}";
        const BARANGAYS_URL = "{{ route('locations.barangays') }}";

        const selectedProvince = "{{ $selectedProvince }}";
        const selectedMunicipality = "{{ $selectedMunicipality }}";
        const selectedBarangay = "{{ $selectedBarangay }}";

        const provinceSelect = document.getElementById('province');
        const municipalitySelect = document.getElementById('municipality');
        const barangaySelect = document.getElementById('barangay');

        // Preload municipality and barangay on page load
        if (selectedProvince) {
            fetch(`${MUNICIPALITIES_URL}?province=${encodeURIComponent(selectedProvince)}`)
                .then(res => res.json())
                .then(data => {
                    municipalitySelect.innerHTML = '<option value="">SELECT MUNICIPALITY</option>';
                    data.forEach(item => {
                        const opt = document.createElement('option');
                        opt.value = item;
                        opt.textContent = item;
                        if (item === selectedMunicipality) opt.selected = true;
                        municipalitySelect.appendChild(opt);
                    });

                    if (selectedMunicipality) {
                        fetch(`${BARANGAYS_URL}?municipality=${encodeURIComponent(selectedMunicipality)}`)
                            .then(res => res.json())
                            .then(data => {
                                barangaySelect.innerHTML = '<option value="">SELECT BARANGAY</option>';
                                data.forEach(item => {
                                    const opt = document.createElement('option');
                                    opt.value = item;
                                    opt.textContent = item;
                                    if (item === selectedBarangay) opt.selected = true;
                                    barangaySelect.appendChild(opt);
                                });
                            });
                    }
                });
        }

        // Event listeners for change
        provinceSelect.addEventListener('change', function() {
            let province = this.value;

            municipalitySelect.innerHTML = '<option value="">SELECT MUNICIPALITY</option>';
            barangaySelect.innerHTML = '<option value="">SELECT BARANGAY</option>';

            if (!province) return;

            fetch(`${MUNICIPALITIES_URL}?province=${encodeURIComponent(province)}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(item => {
                        municipalitySelect.innerHTML += `<option value="${item}">${item}</option>`;
                    });
                });
        });

        municipalitySelect.addEventListener('change', function() {
            let municipality = this.value;
            barangaySelect.innerHTML = '<option value="">SELECT BARANGAY</option>';

            if (!municipality) return;

            fetch(`${BARANGAYS_URL}?municipality=${encodeURIComponent(municipality)}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(item => {
                        barangaySelect.innerHTML += `<option value="${item}">${item}</option>`;
                    });
                });
        });
    </script>

</x-layout>
