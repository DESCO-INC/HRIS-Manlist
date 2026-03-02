<x-layout>
    <h1 class="text-xl font-semibold text-white mb-5">Insert New Employee</h1>

    <form action="{{ route('manlist.store') }}" method="POST">
        @csrf
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
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('emp_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div class="sm:cols-span-6 lg:col-span-4">
                    <label for="position" class="block mb-1 font-medium text-green-500">Position *</label>
                    <input type="text" id="position" name="position" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
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
                            <option value="{{ $department }}">{{ $department }}</option>
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
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('firstname')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Middle Name -->
                <div class="sm:cols-span-6 lg:col-span-4">
                    <label for="middlename" class="block mb-1 font-medium text-green-500">Middle Name *</label>
                    <input type="text" id="middlename" name="middlename" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('middlename')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="sm:cols-span-6 lg:col-span-3">
                    <label for="lastname" class="block mb-1 font-medium text-green-500">Last Name *</label>
                    <input type="text" id="lastname" name="lastname" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('lastname')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Suffix -->
                <div class="sm:col-span-6 lg:col-span-1">
                    <label for="suffix" class="block mb-1 font-medium text-green-500">Suffix</label>
                    <select id="suffix" name="suffix"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
               focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">N/A</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
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
                            <option value="{{ $classification }}">{{ $classification }}</option>
                        @endforeach
                    </select>
                    @error('emp_classification')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Employee Status -->
                <div class="sm:cols-span-6 lg:col-span-4">
                    <label for="emp_status" class="block mb-1 font-medium text-green-500">Employment Status *</label>
                    <select id="emp_status" name="emp_status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">Select Status</option>
                        @foreach ($Empstatus as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('emp_status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date Hired -->
                <div class="sm:cols-span-6 lg:col-span-4">
                    <label for="datehired" class="block mb-1 font-medium text-green-500">Date Hired *</label>
                    <input type="date" id="datehired" name="datehired" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md 
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('datehired')
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
                            <option value="{{ $sitelist }}">{{ $sitelist }}</option>
                        @endforeach
                    </select>
                    @error('workbase')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Temporary Workbase -->
                <div class="sm:cols-span-6 lg:col-span-4">
                    <label for="temporary_workbase" class="block mb-1 font-medium text-green-500">Temporary Workbase
                        *</label>
                    <select id="temporary_workbase" name="temporary_workbase" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">Select Workbase</option>
                        @foreach ($sitelists as $sitelist)
                            <option value="{{ $sitelist }}">{{ $sitelist }}</option>
                        @endforeach
                    </select>
                    @error('temporary_workbase')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Project Assigned -->
                <div class="sm:cols-span-6 lg:col-span-4">
                    <label for="project_assigned" class="block mb-1 font-medium text-green-500">Project
                        Assigned</label>
                    <select id="project_assigned" name="project_assigned"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">Select Project Assigned</option>
                        @foreach ($PAlists as $PAlist)
                            <option value="{{ $PAlist }}">{{ $PAlist }}</option>
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
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
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
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
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
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
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
                        focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('regularization_date')
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <!-- Birthdate -->
                <div>
                    <label for="birthdate" class="block mb-1 font-medium text-green-500">Birthdate *</label>
                    <input type="date" id="birthdate" name="birthdate" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('birthdate')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block mb-1 font-medium text-green-500">Gender *</label>
                    <select id="gender" name="gender" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">Select Gender</option>
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                    </select>
                    @error('gender')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Civil Status -->
                <div>
                    <label for="civil_status" class="block mb-1 font-medium text-green-500">Civil Status *</label>
                    <select id="civil_status" name="civil_status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">Select Status</option>
                        <option value="SINGLE">SINGLE</option>
                        <option value="MARRIED">MARRIED</option>
                        <option value="DIVORCED">DIVORCED</option>
                        <option value="SEPARATED">SEPARATED</option>
                        <option value="WIDOWED">WIDOWED</option>
                        <option value="ANNULLED">ANNULLED</option>
                    </select>
                    @error('civil_status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Educational Attainment -->
                <div>
                    <label for="educational_attainment" class="block mb-1 font-medium text-green-500">Educational
                        Attainment</label>
                    <select id="educational_attainment" name="educational_attainment"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">Select Options</option>
                        <option value="ELEMENTARY GRADUATE">ELEMENTARY GRADUATE</option>
                        <option value="HIGH SCHOOL UNDERGRADUATE">HIGH SCHOOL UNDERGRADUATE</option>
                        <option value="HIGH SCHOOL GRADUATE">HIGH SCHOOL GRADUATE</option>
                        <option value="SENIOR HIGH SCHOOL GRADUATE">SENIOR HIGH SCHOOL GRADUATE</option>
                        <option value="VOCATIONAL">VOCATIONAL</option>
                        <option value="COLLEGE UNDERGRADUATE">COLLEGE UNDERGRADUATE</option>
                        <option value="COLLEGE GRADUATE">COLLEGE GRADUATE</option>
                        <option value="POSTGRADUATE">POSTGRADUATE</option>
                        <option value="MASTER'S DEGREE">MASTER'S DEGREE</option>
                        <option value="DOCTORATE/PH.D">DOCTORATE/PH.D</option>
                    </select>
                    @error('educational_attainment')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- School -->
                <div>
                    <label for="school" class="block mb-1 font-medium text-green-500">School</label>
                    <input type="text" id="school" name="school"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('school')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Course -->
                <div>
                    <label for="course" class="block mb-1 font-medium text-green-500">Course</label>
                    <input type="text" id="course" name="course"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('course')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Professional Licensure -->
                <div>
                    <label for="professional_licensure" class="block mb-1 font-medium text-green-500">Professional
                        Licensure</label>
                    <select id="professional_licensure" name="professional_licensure"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">Select Options</option>
                        @foreach ($Licensurelists as $Licensurelist)
                            <option value="{{ $Licensurelist }}">{{ $Licensurelist }}</option>
                        @endforeach
                    </select>
                    @error('professional_licensure')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block mb-1 font-medium text-green-500">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('phone_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email_address" class="block mb-1 font-medium text-green-500">Email Address</label>
                    <input type="email" id="email_address" name="email_address"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('email_address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="province" class="block mb-1 font-medium text-green-500">Province *</label>
                    <select id="province" name="province" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">SELECT PROVINCE</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province }}">{{ $province }}</option>
                        @endforeach
                    </select>
                    @error('province')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
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
                <div>
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
                <div>
                    <label for="address" class="block mb-1 font-medium text-green-500">Full Address</label>
                    <input type="text" id="address" name="address"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Blood Type -->
                <div>
                    <label for="blood_type" class="block mb-1 font-medium text-green-500">Blood Type</label>
                    <select id="blood_type" name="blood_type"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">Select Options</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    @error('blood_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- TIN Number -->
                <div>
                    <label for="tin_number" class="block mb-1 font-medium text-green-500">TIN Number</label>
                    <input type="text" id="tin_number" name="tin_number"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('tin_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SSS Number -->
                <div>
                    <label for="sss_number" class="block mb-1 font-medium text-green-500">SSS Number</label>
                    <input type="text" id="sss_number" name="sss_number"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('sss_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PhilHealth Number -->
                <div>
                    <label for="philhealth_number" class="block mb-1 font-medium text-green-500">PhilHealth
                        Number</label>
                    <input type="text" id="philhealth_number" name="philhealth_number"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('philhealth_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pag-IBIG Number -->
                <div>
                    <label for="pagibig_number" class="block mb-1 font-medium text-green-500">Pag-IBIG Number</label>
                    <input type="text" id="pagibig_number" name="pagibig_number"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
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
                    <label for="contact_person" class="block mb-1 font-medium text-green-500">Contact Person</label>
                    <input type="text" id="contact_person" name="contact_person"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('contact_person')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Relationship -->
                <div>
                    <label for="relationship" class="block mb-1 font-medium text-green-500">Relationship</label>
                    <input type="text" id="relationship" name="relationship"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('relationship')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Number -->
                <div>
                    <label for="contact_number" class="block mb-1 font-medium text-green-500">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
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
                    <input type="number" id="SIL" name="SIL"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('SIL')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SL -->
                <div>
                    <label for="SL" class="block mb-1 font-medium text-green-500">SL Balance</label>
                    <input type="number" id="SL" name="SL"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('SL')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- VL -->
                <div>
                    <label for="VL" class="block mb-1 font-medium text-green-500">VL Balance</label>
                    <input type="number" id="VL" name="VL"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('VL')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        <!-- COMPENSATION CARD -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-3 p-6 space-y-4">

            <div class="flex justify-between items-center mb-4">
                <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded-full">
                    Compensation
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <div>
                    <label for="daily_rate" class="block mb-1 font-medium text-green-500">Daily Rate</label>
                    <input type="number" id="daily_rate" name="daily_rate"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('daily_rate')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="monthly_rate" class="block mb-1 font-medium text-green-500">Monthly Rate</label>
                    <input type="number" id="monthly_rate" name="monthly_rate"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('monthly_rate')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meal_subsidy" class="block mb-1 font-medium text-green-500">Meal Subsidy</label>
                    <input type="number" id="meal_subsidy" name="meal_subsidy"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('meal_subsidy')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meal_allowance" class="block mb-1 font-medium text-green-500">Meal Allowance</label>
                    <input type="number" id="meal_allowance" name="meal_allowance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('meal_allowance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rice_subsidy" class="block mb-1 font-medium text-green-500">Rice Subsidy</label>
                    <input type="number" id="rice_subsidy" name="rice_subsidy"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('rice_subsidy')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="spa_allowance" class="block mb-1 font-medium text-green-500">SPA Allowance</label>
                    <input type="number" id="spa_allowance" name="spa_allowance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('spa_allowance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="transpo_assistance" class="block mb-1 font-medium text-green-500">Transport
                        Assistance</label>
                    <input type="number" id="transpo_assistance" name="transpo_assistance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('transpo_assistance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="clothing_allowance" class="block mb-1 font-medium text-green-500">Clothing
                        Allowance</label>
                    <input type="number" id="clothing_allowance" name="clothing_allowance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('clothing_allowance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="transpo_allowance" class="block mb-1 font-medium text-green-500">Transport
                        Allowance</label>
                    <input type="number" id="transpo_allowance" name="transpo_allowance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('transpo_allowance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="communication_allowance" class="block mb-1 font-medium text-green-500">Communication
                        Allowance</label>
                    <input type="number" id="communication_allowance" name="communication_allowance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('communication_allowance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="project_allowance" class="block mb-1 font-medium text-green-500">Project
                        Allowance</label>
                    <input type="number" id="project_allowance" name="project_allowance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('project_allowance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="technical_allowance" class="block mb-1 font-medium text-green-500">Technical
                        Allowance</label>
                    <input type="number" id="technical_allowance" name="technical_allowance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('technical_allowance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="positional_allowance" class="block mb-1 font-medium text-green-500">Positional
                        Allowance</label>
                    <input type="number" id="positional_allowance" name="positional_allowance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('positional_allowance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="professional_allowance" class="block mb-1 font-medium text-green-500">Professional
                        Allowance</label>
                    <input type="number" id="professional_allowance" name="professional_allowance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('professional_allowance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="housing_allowance" class="block mb-1 font-medium text-green-500">Housing
                        Allowance</label>
                    <input type="number" id="housing_allowance" name="housing_allowance"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md
                focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('housing_allowance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>


        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-3 p-6 flex justify-between items-center">
            <a href="{{ route('manlist.index') }}"
                class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500 transition font-medium">
                Cancel
            </a>

            <button type="submit"
                class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-500 transition font-medium">
                Save Information
            </button>
        </div>
    </form>


    <script>
        const MUNICIPALITIES_URL = "{{ route('locations.municipalities') }}";
        const BARANGAYS_URL = "{{ route('locations.barangays') }}";

        document.getElementById('province').addEventListener('change', function() {
            let province = this.value;
            let municipalitySelect = document.getElementById('municipality');
            let barangaySelect = document.getElementById('barangay');

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

        document.getElementById('municipality').addEventListener('change', function() {
            let municipality = this.value;
            let barangaySelect = document.getElementById('barangay');

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
