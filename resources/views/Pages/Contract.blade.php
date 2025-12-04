<body style="font-family: DejaVu Sans, sans-serif;">

    <table style="border-collapse: collapse;">
        <tr>
            <td style="vertical-align: bottom; font-size: 8px;padding: 0;">
                <p style="color: green; font-weight: bold; font-size: 50px; margin: 0; padding: 0;">
                    DESCO
                </p>
            </td>
            <td style="vertical-align: bottom; font-size: 8px; padding-left: 8px; padding-bottom: 14px;">
                <p style="margin: 0;">
                    Lot 2 Block 3, Interstar St., Laguna International Industrial Park (LIIP), Barangay Mamplasan, City
                    of Biñan, Laguna 4024 <br>
                    Tel. Nos.: (632) 8584 4558 to 61/Fax No.: (632) 8584 4829; Email : desco@desco.ph ; Website:
                    https://www.desco.ph
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="vertical-align: top; padding-top: 0;">
                <p style="font-weight: bold;margin: 0; font-size: 17px;">EMPLOYMENT CONTRACT</p>
            </td>
        </tr>
    </table>

    <p style="font-family: 'Times New Roman', Times, serif;"><b>HRAD-EMPCON-SAM-XXXX-XX-XXXX.XXX</b></p>

    <p style="font-family: 'Times New Roman', Times, serif;">
        {{ date('F d, Y') }}
    </p>

    <p style="font-family: 'Times New Roman', Times, serif;">
        <b>
            {{ $manlistEntry->personalInfo->gender == 'MALE' ? 'MR.' : 'MS.' }}
            {{ $manlistEntry->firstname }}
            {{ $manlistEntry->middlename ? strtoupper(substr($manlistEntry->middlename, 0, 1)) . '.' : '' }}
            {{ $manlistEntry->lastname }}
            {{ $manlistEntry->suffix }}
        </b> <br>
        {{ $manlistEntry->personalInfo->address ?? '' }}
    </p>

    <p style="font-family: 'Times New Roman', Times, serif;">
        Dear {{ $manlistEntry->personalInfo->gender == 'MALE' ? 'MR.' : 'MS.' }} {{ $manlistEntry->lastname }}
        {{ $manlistEntry->suffix }};
    </p>

    <p style="font-family: 'Times New Roman', Times, serif;">
        This is to confirm your employment with <b>DESCO INC.</b>
        as <b>{{ $manlistEntry->position ?? 'N/A' }}</b>
        on a <b>{{ $manlistEntry->emp_status ?? 'N/A' }}</b> status,
        effective <b>{{ date('F d, Y', strtotime($manlistEntry->compensation->date_hired ?? now())) }}</b>.
        Subject to the following terms and conditions:
    </p>
    <br>

    <table style="margin: 0 auto; border-collapse: collapse; width: 80%;">
        {{-- Salary --}}
        <tr>
            <td style="width: 30%; text-align: left;">
                <p style="margin: 0; font-size:10px;"><b>Salary</b></p>
            </td>
            <td style="text-align:center;">
                <p style="margin:0; font-size:10px;"><b>:</b></p>
            </td>
            <td style="text-align:left;">
                <p style="margin:0; font-size:10px;">
                    <b>
                        @if (!empty($manlistEntry->compensation->daily_rate) && $manlistEntry->compensation->daily_rate != 0)
                            PhP{{ number_format($manlistEntry->compensation->daily_rate, 2) }} /Daily
                        @else
                            PhP{{ number_format($manlistEntry->compensation->monthly_rate, 2) }} /Monthly
                        @endif
                    </b>
                </p>
            </td>
        </tr>

        {{-- Dynamic compensation rows --}}
        @php
            $rows = [
                ['Meal Subsidy', 'PhP', $manlistEntry->compensation->meal_subsidy ?? 0, '/day (non-cash)'],
                ['Rice Subsidy', 'PhP', $manlistEntry->compensation->rice_subsidy ?? 0, '/month'],
                ['Meal Allowance', 'PhP', $manlistEntry->compensation->meal_allowance ?? 0, '/month'],
                ['Special Post Allowance', 'PhP', $manlistEntry->compensation->spa_allowance ?? 0, '/month'],
                ['Transportation Assistance', 'PhP', $manlistEntry->compensation->transpo_assistance ?? 0, '/month'],
                ['Clothing Allowance', 'PhP', $manlistEntry->compensation->clothing_allowance ?? 0, '/month'],
                ['Transportation Allowance', 'PhP', $manlistEntry->compensation->transpo_allowance ?? 0, '/day'],
                ['Communication Allowance', 'PhP', $manlistEntry->compensation->communication_allowance ?? 0, '/month'],
                ['Project Allowance', 'PhP', $manlistEntry->compensation->project_allowance ?? 0, '/month'],
                ['Technical Allowance', 'PhP', $manlistEntry->compensation->technical_allowance ?? 0, '/month'],
                ['Positional Allowance', 'PhP', $manlistEntry->compensation->positional_allowance ?? 0, '/month'],
                ['Professional Allowance', 'PhP', $manlistEntry->compensation->professional_allowance ?? 0, '/month'],
                ['Housing Allowance', 'PhP', $manlistEntry->compensation->housing_allowance ?? 0, '/month'],
            ];
        @endphp

        @foreach ($rows as $row)
            @if (!empty($row[2]) && $row[2] != 0)
                <tr>
                    <td>
                        <p style="margin:0; font-size: 10px;"><b>{{ $row[0] }}</b></p>
                    </td>
                    <td style="text-align:center;">
                        <p style="margin:0; font-size: 10px;"><b>:</b></p>
                    </td>
                    <td>
                        <p style="margin:0; font-size: 10px;">
                            <b>{{ $row[1] }}{{ number_format($row[2], 2) }}{{ $row[3] }}</b>
                        </p>
                    </td>
                </tr>
            @endif
        @endforeach

        {{-- Group Term Life Insurance --}}
        <tr>
            <td>
                <p style="margin:0; font-size:10px;"><b>Group Term Life Insurance</b></p>
            </td>
            <td style="text-align:center;">
                <p style="margin:0; font-size:10px;"><b>:</b></p>
            </td>
            <td>
                <p style="margin:0; font-size:10px;">
                    24 months x monthly salary if coverage does not exceed 3.5 Million pesos. If coverage exceed 3.5
                    Million
                    pesos, the employee must undergo medical clearance by insurance company.
                </p>
            </td>
        </tr>

        {{-- Accident Insurance --}}
        <tr>
            <td>
                <p style="margin:0; font-size:10px;"><b>Accident Insurance</b></p>
            </td>
            <td style="text-align:center;">
                <p style="margin:0; font-size:10px;"><b>:</b></p>
            </td>
            <td>
                <p style="margin:0; font-size:10px;">
                    Equivalent to 200% of GL Coverage.
                </p>
            </td>
        </tr>

        {{-- Leave balances --}}
        @if (!empty($manlistEntry->leaveIncentive->vl_balance))
            <tr>
                <td><b>Vacation Leave</b></td>
                <td style="text-align:center;"><b>:</b></td>
                <td>{{ $manlistEntry->leaveIncentive->vl_balance }} days after one(1) year of service from provisionary
                    employment.</td>
            </tr>
        @endif

        @if (!empty($manlistEntry->leaveIncentive->sl_balance))
            <tr>
                <td><b>Sick Leave</b></td>
                <td style="text-align:center;"><b>:</b></td>
                <td>{{ $manlistEntry->leaveIncentive->sl_balance }} days after one(1) year of service from provisionary
                    employment.</td>
            </tr>
        @endif

        @if (!empty($manlistEntry->leaveIncentive->sil_balance))
            <tr>
                <td><b>Service Incentive Leave</b></td>
                <td style="text-align:center;"><b>:</b></td>
                <td>{{ $manlistEntry->leaveIncentive->sil_balance }} days after one(1) year of service from
                    provisionary employment.</td>
            </tr>
        @endif
    </table>

    <br><br>

    <p style="font-family: 'Times New Roman', Times, serif;">
        <b>DESCO INC.</b> reserves the right, during this period to terminate your services without prior notice and
        without liability to the company for failure on your part to meet our company standards, policy and
        procedures. The company will, however, pay all salaries and benefits that you are entitled to at the time of
        your seperation from the service of the company.
        .<br><br>
        All information to which you may gain access through your employment with this company will be held
        strictly confidential.
        <br><br>
        Likewise, you are expected to comply with all of the company's rules and regulations as failure to these may
        result to your seperation from the company.
    </p>

    <footer
        style="position: fixed; bottom: 0; left: 0; width: 100%; text-align: left; font-family: 'Times New Roman', Times, serif; font-size: 8px; padding: 4px 0;">
        <p style="margin: 0;">HR31-1-1222</p>
    </footer>

</body>
