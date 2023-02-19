@extends('layout.main') @section('content')
    <style>
        .due_amount {
            text-align: right;
        }
    </style>
    <section class="forms">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header mt-2">
                    <h3 class="text-center">{{ trans('All Member Contribution Summary') }}</h3>
                    <div class="pull-right">
                        <a id="click_print" class="btn btn-info btn-sm text-white"><i class="dripicons-print"></i>
                            Print</a>
                        {{-- excel --}}
                        <button class="btn btn-success btn-sm ml-3 text-white"
                            onclick="exportTableToCSV('SummaryReport.csv')">
                            Export To CSV
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <div class="container" id="table_print">
            {{--  style="overflow: hidden; font-size:10px;" --}}
            <style>
                @media print{
                    .card{
                        font-size:10px; border:2px solid white;
                    }
                }
            </style>
            <div class="card">
                <div class="card-body">
                    {{-- site title --}}
                    <div class="container">
                        <div class="row d-flex text-center">
                            <div class="col-12 mb-4">
                                @if (!empty($setting->site_logo))
                                    <img alt="Brand" src="{{ asset('public/logo') }}/{{ $setting->site_logo }}"
                                        width="100" height="70">
                                @else
                                    <img alt="Brand" src="{{ asset('public/logo/somity.jpg') }}" width="80"
                                        height="50">
                                @endif

                                <h3>{{ $setting->site_title ?? '' }}</h3>
                                <div> {{ $setting->address ?? '' }} </div>
                                <div>Phone: {{ $setting->phone ?? '' }}</div>
                                <div>Email: {{ $setting->email ?? '' }}</div>
                                {{-- <div> Daily Contribution</div> --}}
                                {{-- <div> Date: {{ \Carbon\Carbon::now()->format('Y-m-d') }} </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-sm table-striped text-nowrap">
                            <!--------------------------------------------------------------------------------------------------------------------- --->
                            <!-------------------------------  daily and weekly ----------------------------------------------------------------- --->
                            <!--------------------------------------------------------------------------------------------------------------------- --->
                            <tr>
                                <th>{{ trans('SL') }}</th>
                                <th class="text-center mt-2">{{ trans('ID') }}</th>
                                <th class="text-center mt-2">{{ trans('Member Name') }}</th>

                                <th class="text-center mt-2">{{ trans('Daily Contribution') }}</th>
                                <th class="text-center mt-2">{{ trans('Weekly Contribution') }}</th>
                                <th class="text-center mt-2">{{ trans('Total = Daily + Weekly') }}</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr class="">
                                <th class=""></th>
                                <th class=""></th>
                                <th class=""></th>
                                {{-- daily --}}
                                <th>
                                    <table style="width: 100%">
                                        <tr>
                                            <th class="">Contr.</th>
                                            <th class="">Due / Adv(day)</th>
                                            <th class="text-danger">Due Amount</th>
                                        </tr>
                                    </table>
                                </th>
                                {{-- weekly --}}
                                <th>
                                    <table style="width: 100%">
                                        <tr>
                                            <th class="">Contr.</th>
                                            <th class="">Due / Adv(week)</th>
                                            <th class="text-danger">Due Amount</th>
                                        </tr>
                                    </table>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            @php
                                $i = 0;
                                $total_daily_deposit = 0;
                                $total_due_daily_deposit = 0;
                                $total_weekly_deposit = 0;
                                $total_due_weekly_deposit = 0;
                                $TotalDailyWeeklySum = 0;
                            @endphp
                            @foreach ($customers as $customer)
                                @php
                                    $total_daily_deposit += $customer->dailyDeposit->totaldailyamount ?? 0;
                                    $total_due_daily_deposit += $customer->dueDailydeposit->totaldaydueamount ?? 0;
                                    $total_weekly_deposit += $customer->weeklyDeposit->totalweeklyamount ?? 0;
                                    $total_due_weekly_deposit += $customer->dueweeklyDepositAmount->dueweeklyamount ?? 0;
                                    
                                    $TotalDailyWeekly = ($customer->dailyDeposit->totaldailyamount ?? 0) + ($customer->weeklyDeposit->totalweeklyamount ?? 0);
                                    $TotalDailyWeeklySum += $TotalDailyWeekly;
                                @endphp

                                <tr class="">
                                    <td class="">{{ ++$i }}</td>
                                    <td class="">{{ $customer->id }}</td>
                                    <td class="">{{ $customer->name ?? '' }} ({{ $customer->member_code }})</td>
                                    {{-- daily contribution --}}
                                    <td>
                                        <table style="width: 100%;text-align:center;">
                                            <tr>
                                                <td class="" style="width: 33%">
                                                    {{ $customer->dailyDeposit->totaldailyamount ?? '' }}</td>
                                                <td class="" style="width: 33%;">
                                                    {{ $customer->dueDailyDepositCount->dueStatusCount ?? 0 }}</td>
                                                <td class="due_amount" style="width: 33%;color:red;">
                                                    {{ $customer->dueDailydeposit->totaldaydueamount ?? 0 }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    {{-- weekly contribution --}}
                                    <td>
                                        <table style="width: 100%;text-align:center;">
                                            <tr>
                                                <td class="" style="width: 33%">
                                                    {{ $customer->weeklyDeposit->totalweeklyamount ?? '' }}</td>
                                                <td class="" style="width: 33%;">
                                                    {{ $customer->dueweeklyDepositCount->dueweklyStatusCount ?? 0 }}
                                                </td>
                                                <td class="due_amount" style="width: 33%;color:red;">
                                                    {{ $customer->dueweeklyDepositAmount->dueweeklyamount ?? 0 }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    {{-- total = weekly + daily --}}
                                    <td>
                                        <table style="width: 100%;text-align:center;">
                                            <tr>
                                                <td class="" style="width: 33%">
                                                    {{ $TotalDailyWeekly ? number_format($TotalDailyWeekly) : 0 }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="">Total Member = </th>
                                <th colspan="">{{ $i }}</th>
                                <th colspan="">Grand Total = </th>
                                {{-- daily --}}
                                <td>
                                    <table class="text-bold" style="width: 100%">
                                        <tr>
                                            <td class="" style="width: 33%">{{ $total_daily_deposit ?? 0 }}
                                            </td>
                                            <td class="" style="width: 33%"></td>
                                            <td class="text-danger due_amount" style="width: 33%;">
                                                {{ $total_due_daily_deposit ?? 0 }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                {{-- weekly --}}
                                <td>
                                    <table class="text-bold" style="width: 100%">
                                        <tr>
                                            <td class="" style="width: 33%">{{ $total_weekly_deposit ?? 0 }}
                                            </td>
                                            <td class="" style="width: 33%"></td>
                                            <td class="text-danger due_amount" style="width: 33%;">
                                                {{ $total_due_weekly_deposit ?? 0 }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                {{-- array sum grand total --}}
                                <td>
                                    <table class="text-bold" style="width: 100%">
                                        <tr>
                                            <td class="text-center" style="width: 33%">
                                                {{ $TotalDailyWeeklySum ?? 0 }}
                                            </td>

                                        </tr>
                                    </table>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>

                            <!--------------------------------------------------------------------------------------------------------------------- --->
                            <!-------------------------------  Monthly and Yearly ----------------------------------------------------------------- --->
                            <!--------------------------------------------------------------------------------------------------------------------- --->

                            <tr class="">
                                {{--  style="border-left-style:hidden;border-right-style:hidden;" --}}
                                <td class="text-center text-bold" colspan="12" style="border-left-style:hidden;border-right-style:hidden;">Monthly and Yearly
                                    Contribution</td>
                            </tr>
                            <tr>
                                <th>{{ trans('SL') }}</th>
                                <th class="text-center mt-2">{{ trans('ID') }}</th>
                                <th class="text-center mt-2">{{ trans('Member Name') }}</th>

                                <th class="text-center mt-2">{{ trans('Monthly Contribution') }}</th>
                                <th class="text-center">{{ trans('Yearly Contribution') }}</th>
                                <th class="text-center mt-2" style="margin: 0px;">
                                    {{ trans('Total (Monthly + Yearly)') }}</th>
                                <th class="text-center ">{{ trans('Meeting') }}</th>
                                <th class="text-center ">{{ trans('Others') }}</th>
                            </tr>
                            <tr class="">
                                <th class=""></th>
                                <th class=""></th>
                                <th class=""></th>
                                {{-- monthly --}}
                                <th>
                                    <table style="width: 100%">
                                        <tr>
                                            <th class="">Contr.</th>
                                            <th class="">Due / Adv(month)</th>
                                            <th class="text-danger">Due Amount</th>
                                        </tr>
                                    </table>
                                </th>
                                <th>
                                    <table style="width: 100%">
                                        <tr>
                                            <th class="">Contr.</th>
                                            <th class="">YCount</th>
                                            <th class="">Completed(%)</th>
                                            <th class="text-danger">Due Amount</th>
                                        </tr>
                                    </table>
                                </th>
                                <th class=""></th>
                                <th>
                                    <table style="width: 100%">
                                        <tr>
                                            <th class="">Deposit</th>
                                            <th class="text-danger">Due Amount</th>
                                        </tr>
                                    </table>
                                </th>
                                <th>
                                    <table style="width: 100%">
                                        <tr>
                                            <th class="">Late fee</th>
                                            <th class="">Service</th>
                                        </tr>
                                    </table>
                                </th>
                            </tr>
                            @php
                                $i = 0;
                                
                                $total_monthly_deposit = 0;
                                $total_yearly_deposit = 0;
                                $total_monthly_due_deposit = 0;
                                $total_yearly_due_deposit = 0;
                                $total_monthly_and_yearly_deposit = 0;
                                
                                $totalLateFee = 0;
                                $TotalJoiningFee = 0;
                                
                                $arraySumMeetingDeposit = 0;
                                $arraySumDueMeetingDeposit = 0;
                            @endphp
                            @foreach ($customers as $customer)
                                @php
                                    $monthly_deposit_amount = $customer->monthlydeposit->totalmonthmount ?? 0;
                                    $yearly_deposit_amount = $customer->yearlydeposit->totalyearlyamount ?? 0;
                                    $monthly_yearly_deposit_amount = $monthly_deposit_amount + $yearly_deposit_amount;
                                    
                                    $total_monthly_deposit += $monthly_deposit_amount ?? 0;
                                    $total_monthly_due_deposit += $customer->dueMonthlydeposit->totalmonthdueamount ?? 0;
                                    $total_yearly_deposit += $yearly_deposit_amount ?? 0;
                                    $total_yearly_due_deposit += $customer->dueyearlydeposit->totalDueyearlyamount ?? 0;
                                    $total_monthly_and_yearly_deposit += ($monthly_deposit_amount ?? 0) + ($yearly_deposit_amount ?? 0) ?? 0;
                                    
                                    $totalLateFee += ($customer->monthlyLatefeedeposit->monthlyLatefee ?? 0) + ($customer->yearlyLatefee->yearlyLatefeeamount ?? 0) ?? 0;
                                    
                                    //  calculation total number of deposit after join
                                    $joining_date = \Carbon\Carbon::parse($customer->created_at)->format('Y-m-d');
                                    $current_date = date('Y-m-d');
                                    $date1 = new DateTime($joining_date);
                                    $date2 = new DateTime($current_date);
                                    $totalYearlyDeposit = $date1->diff($date2);
                                    // (total - given deposit) * 100
                                    
                                    $TotalJoiningFee += $customer->joining_fee;
                                @endphp

                                <tr class="">
                                    <td class="">{{ ++$i }}</td>
                                    <td class="">{{ $customer->id }}</td>
                                    <td class="">{{ $customer->name ?? '' }} ({{ $customer->member_code }})
                                    </td>

                                    {{-- monthly contribution --}}
                                    <td>
                                        <table style="width: 100%;text-align:center;">
                                            <tr>
                                                <td class="" style="width: 33%">
                                                    {{ $monthly_deposit_amount ?? '' }}</td>
                                                <td class="" style="width: 33%;">
                                                    {{ $customer->dueMonthlydepositcount->duestatuscount ?? 0 }}</td>
                                                <td class="due_amount" style="width: 33%;color:red;">
                                                    {{ $customer->dueMonthlydeposit->totalmonthdueamount ?? 0 }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    {{-- yearly contribution --}}
                                    <td>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td class="" style="width: 25%">
                                                    {{ $yearly_deposit_amount ?? 0 }}</td>
                                                {{-- count total number of deposit after join --}}
                                                <td class="" style="width: 25%">
                                                    {{ $totalYearlyDeposit->y ?? 0 }}
                                                </td>
                                                {{-- completed --}}
                                                @php
                                                    if (!empty($customer->totalDepositCount && $customer->totalCompletedDepositCount)) {
                                                        $total_deposit = $customer->totalDepositCount->countstatus;
                                                        $completed_deposit = $customer->totalCompletedDepositCount->countstatus;
                                                        $total_completed = (int) (($completed_deposit * 100) / $total_deposit);
                                                    } else {
                                                        $total_completed = 0;
                                                    }
                                                    
                                                @endphp
                                                @if ($total_completed >= 50)
                                                    <td class="" style="width: 25%;color:green;">
                                                        {{ $total_completed ?? 0 }} %</td>
                                                @else
                                                    <td class="" style="width: 25%;">
                                                        {{ $total_completed ?? 0 }}
                                                        % </td>
                                                @endif
                                                <td class="due_amount" style="width: 25%;color:red;">
                                                    {{ $customer->dueyearlydeposit->totalDueyearlyamount ?? 0 }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    {{-- monthly + yearly --}}
                                    <td class="text-center">
                                        {{ $monthly_yearly_deposit_amount ? number_format($monthly_yearly_deposit_amount) : 0 }}
                                    </td>
                                    @php
                                        $meetingDeposit = $customer->givenMeetingDeposit->meetingAmountgiven ?? 0;
                                        $dueMeetingDeposit = $customer->dueMeetingDeposit->meetingAmountdue ?? 0;
                                        
                                        $arraySumMeetingDeposit += $meetingDeposit;
                                        $arraySumDueMeetingDeposit += $dueMeetingDeposit;
                                    @endphp
                                    <td>
                                        <table style="width: 100%">
                                            {{-- meeting deposit and due --}}
                                            <tr>
                                                <td class="" style="width: 50%;">
                                                    {{ $meetingDeposit ?? 0 }}
                                                </td>
                                                <td class="due_amount" style="width: 50%;color:red;">
                                                    {{ $dueMeetingDeposit ?? 0 }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    {{-- service --}}
                                    <td>
                                        <table style="width: 100%">
                                            <tr>
                                                <td class="">
                                                    {{ ($customer->monthlyLatefeedeposit->monthlyLatefee ?? 0) + ($customer->yearlyLatefee->yearlyLatefeeamount ?? 0) ?? 0 }}
                                                </td>
                                                <td class="w-25">{{ $customer->joining_fee }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="">Total Member = </th>
                                <th colspan="">{{ $i }}</th>
                                <th colspan="">Grand Total = </th>

                                {{-- monthly --}}
                                <td>
                                    <table class="text-bold" style="width: 100%">
                                        <tr>
                                            <td class="" style="width: 33%">{{ $total_monthly_deposit ?? 0 }}
                                            </td>
                                            <td class="" style="width: 33%"></td>
                                            <td class="text-danger due_amount" style="width: 33%;">
                                                {{ $total_monthly_due_deposit ?? 0 }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                {{-- yearly --}}
                                <td>
                                    <table class="text-bold" style="width: 100%">
                                        <tr>
                                            <td class="" style="width: 25%">{{ $total_yearly_deposit ?? 0 }}
                                            </td>
                                            <td class="" style="width: 25%"></td>
                                            <td class="" style="width: 25%"></td>
                                            <td class=" due_amount" style="width: 25%;color:red;">
                                                {{ $total_yearly_due_deposit ?? 0 }}</td>
                                        </tr>
                                    </table>
                                </td>

                                {{-- total monthly + yearly --}}
                                <th class="text-center">
                                    {{ $total_monthly_and_yearly_deposit ? number_format($total_monthly_and_yearly_deposit) : 0 }}
                                </th>
                                <td>
                                    {{-- Total = deposit and due --}}
                                    <table style="width: 100%">
                                        <tr>
                                            <td class="">
                                                {{ $arraySumMeetingDeposit }}
                                            </td>
                                            <td class="text-danger due_amount">
                                                {{ $arraySumDueMeetingDeposit }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                {{-- total joining fee --}}
                                <td>
                                    <table style="width: 100%">
                                        <tr>
                                            <td class="">
                                                {{ $totalLateFee }}
                                            </td>
                                            <td class="">
                                                {{ $TotalJoiningFee }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            {{-- footer --}}
            <style>
                .footer {
                    position: fixed;
                    left: 0;
                    bottom: 0;
                    width: 100%;
                    margin-top: 10px;
                }
            </style>
            <div class="footer">
                <span style="margin-left:10px;">© Developed By Acquaint Technologies</span> <img
                    src="{{ asset('public/images/logo.png') }}" style="height:20px;width:150px;float:right;">
            </div>
        </div>
    </section>
    {{-- Excel --}}
    <script type="text/javascript">
        function downloadCSV(csv, filename) {
            var csvFile;
            var downloadLink;
            // CSV file
            csvFile = new Blob([csv], {
                type: "text/csv"
            });
            // Download link
            downloadLink = document.createElement("a");
            // File name
            downloadLink.download = filename;
            // Create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);
            // Hide download link
            downloadLink.style.display = "none";
            // Add the link to DOM
            document.body.appendChild(downloadLink);
            // Click download link
            downloadLink.click();
        }

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll("table tr");
            for (var i = 0; i < rows.length; i++) {
                var row = [],
                    cols = rows[i].querySelectorAll("td, th");
                for (var j = 0; j < cols.length; j++)
                    row.push("\"" + cols[j].innerText + "\"");
                csv.push(row.join(","));
            }
            // Download CSV file
            downloadCSV(csv.join("\n"), filename);
        }
    </script>
    <script type="text/javascript">
        $("ul#report").siblings('a').attr('aria-expanded', 'true');
        $("ul#report").addClass("show");
        $("ul#report #deposit-report-menu").addClass("active");


        $('.selectpicker').selectpicker('refresh');
    </script>
    <script src="{{ asset('public/js/PrintJs.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#table_print').printThis();
        })
    </script>
@endsection
