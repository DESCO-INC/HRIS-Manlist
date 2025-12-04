<body style="font-family: DejaVu Sans, sans-serif;">

    <!-- Header -->
    <table style="border-collapse: collapse; width: 100%;">
        <tr>
            <td style="vertical-align: bottom; font-size: 8px;padding: 0;">
                <p style="color: green; font-weight: bold; font-size: 50px; margin: 0; padding: 0;">
                    DESCO
                </p>
            </td>
            <td style="vertical-align: bottom; font-size: 8px; padding-left: 8px; padding-bottom: 14px;">
                <p style="margin: 0;">
                    Lot 2 Block 3, Interstar St., Laguna International Industrial Park (LIIP), Barangay Mamplasan, City of Biñan, Laguna 4024 <br>
                    Tel. Nos.: (632) 8584 4558 to 61/Fax No.: (632) 8584 4829; Email : desco@desco.ph ; Website: https://www.desco.ph
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="vertical-align: top; padding-top: 0;">
                <p style="font-weight: bold;margin: 0; font-size: 20px;">EMPLOYEE INFORMATION FORM</p>
            </td>
        </tr>
    </table>

    <!-- Main Info Table -->
    <table style="font-family: 'Times New Roman', Times, serif; border-collapse: collapse; margin-top: 10px; width: 100%;">
        
        <!-- Personal Information -->
        <tr>
            <td colspan="2" style="padding-top: 25px; padding-bottom: 10px; font-weight: bold; font-size: 20px;">Personal Information</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Name</td>
            <td>: {{ $manlistEntry->firstname }} {{ strtoupper(substr($manlistEntry->middlename ?? '', 0, 1)) }}. {{ $manlistEntry->lastname }} {{ $manlistEntry->suffix }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Address</td>
            <td>: {{ $manlistEntry->personalInfo->barangay ?? '' }}, {{ $manlistEntry->personalInfo->municipality ?? '' }}, {{ $manlistEntry->personalInfo->province ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Contact No.</td>
            <td>: {{ $manlistEntry->personalInfo->phone_number }}</td>
        </tr>

        <!-- Employment Information -->
        <tr>
            <td colspan="2" style="padding-top: 25px; padding-bottom: 10px; font-weight: bold; font-size: 20px;">Employment Information</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Position</td>
            <td>: {{ $manlistEntry->position ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Department</td>
            <td>: {{ $manlistEntry->department ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Date of Hire</td>
            <td>: {{ $manlistEntry->datehired ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Employment Status</td>
            <td>: {{ $manlistEntry->emp_status ?? '' }}</td>
        </tr>

        <!-- Education -->
        <tr>
            <td colspan="2" style="padding-top: 25px; padding-bottom: 10px; font-weight: bold; font-size: 20px;">Education</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Highest Level of Education Completed</td>
            <td>: {{ $manlistEntry->personalInfo->educational_attainment ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Name of Institution</td>
            <td>: {{ $manlistEntry->personalInfo->school ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Course</td>
            <td>: {{ $manlistEntry->personalInfo->course ?? '' }}</td>
        </tr>
        @if(!empty($manlistEntry->personalInfo->professional_licensure))
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Professional Licensure</td>
            <td>: {{ $manlistEntry->personalInfo->professional_licensure }}</td>
        </tr>
        @endif

        <!-- Emergency Contact -->
        <tr>
            <td colspan="2" style="padding-top: 25px; padding-bottom: 10px; font-weight: bold; font-size: 20px;">Emergency Contact Information</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Full Name</td>
            <td>: {{ $manlistEntry->contactEmergency->contact_person ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Address</td>
            <td>: {{ $manlistEntry->personalInfo->barangay ?? '' }}, {{ $manlistEntry->personalInfo->municipality ?? '' }}, {{ $manlistEntry->personalInfo->province ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Contact Number</td>
            <td>: {{ $manlistEntry->contactEmergency->contact_number ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 20px 2px 0; white-space: nowrap;">Relationship</td>
            <td>: {{ $manlistEntry->contactEmergency->relationship ?? '' }}</td>
        </tr>
    </table>

    <!-- Footer -->
    <footer style="
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        text-align: left;
        font-family: 'Times New Roman', Times, serif;
        font-size: 8px;
        padding: 4px 0;
    ">
        <p style="margin: 0;">HR31-1-1222</p>
    </footer>

</body>
