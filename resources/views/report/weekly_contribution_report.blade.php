@extends('layout.main') @section('content')
    <style>
        .due_amount {
            text-align: center;
        }

        span.filter-option.pull-left {
            color: #000 !important;
        }
    </style>
    <section class="forms">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header mt-2">
                    {{-- <h3 class="text-center">{{ trans('Daily Deposit Report') }}</h3> --}}
                </div>
                {!! Form::open(['route' => 'report.weeklyContributionReportSearch', 'method' => 'post']) !!}
                <div class="row ml-4">
                    <div class="col-lg-2 ml-2">
                        <div class="form-group row">
                            <label class=""><strong>{{ trans('Start Date') }}</strong> &nbsp;</label>
                            <div class="d-tc">
                                <div class="input-group">
                                    <input type="date" name="start_date" class="form-control"
                                        value="{{ $start_date ?? '' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ml-2 ">
                        <div class="form-group row">
                            <label class=""><strong>{{ trans('End Date') }}</strong> &nbsp;</label>
                            <div class="d-tc">
                                <div class="input-group">
                                    <input type="date" name="end_date" class="form-control"
                                        value="{{ $end_date ?? '' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ml-2">
                        <div class="form-group">
                            <label class=""><strong>{{ trans('Payment Status') }}</strong></label>
                            <div class="">
                                <select name="payment_status" class="form-control">
                                    <option value="">All Status</option>

                                    <option value="1" {{ $payment_status == 1 ? 'Selected' : '' }}>Due</option>
                                    <option value="2" {{ $payment_status == 2 ? 'Selected' : '' }}>Paid</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ml-2">
                        <div class="form-group row">
                            <label class=""><strong>{{ trans('Select Member') }}</strong> &nbsp;</label>
                            <div class="d-tc">

                                <select name="customer_id" class="form-control" data-live-search="true">
                                    <option value="">Select All Member</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}"
                                            {{ $member->id == $customer_id ? 'Selected' : '' }}>
                                            {{ $member->member_code ?? '' }}( {{ $member->name ?? '' }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mt-4">
                        <div class="form-group d-flex mt-2">
                            <button class="btn btn-primary btn-sm" type="submit">{{ trans('Show') }}</button>
                            <a id="click_print" class="btn btn-info ml-2 text-white btn-sm"><i class="dripicons-print"></i>
                                Print</a>
                            {{-- excel --}}
                            <button class="btn btn-success btn-sm ml-2 text-white"
                                onclick="exportTableToCSV('weeklyContributionReport.csv')">
                                Export To CSV
                            </button>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <div class="container" id="table_print">
            <div class="card">
                <div class="card-header mt-2">
                    <h3 class="text-center ">{{ trans('Weekly Contribution Summary') }}</h3>
                    {{-- <a id="click_print" class="btn btn-info btn-sm pull-right text-white"><i class="dripicons-print"></i>
                        Print</a> --}}
                </div>
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
                        <table class="text-center table table-bordered table-sm table-striped text-nowrap">
                            <thead>

                                <tr>
                                    <th>{{ trans('Joining Date') }}</th>
                                    <th>{{ trans('ID') }}</th>
                                    <th>{{ trans('Name Of Member') }}</th>
                                    <th>{{ trans('Mobile') }}</th>
                                    <th>{{ trans('Amount') }}</th>
                                    <th class="">{{ trans('Deposit Weekly') }}</th>
                                    <th>{{ trans('Weekly Count') }}</th>
                                    <th class="due_amount">{{ trans('Due/Advance Weekly') }}</th>
                                    <th class="">{{ trans('Due Amount') }}</th>
                                </tr>
                            </thead>
                            @php
                                $totalCustomer = 0;
                                $totalAmount = 0;
                                $totalDeposit = 0;
                                $totalGivenCount = 0;
                                $totalDue = 0;
                                $totalDueAmount = 0;
                            @endphp
                            <tbody>
                                @forelse ($customers as $customer)
                                    @php
                                        $totalCustomer += count([$customer->id]);
                                        $amount = $customer->weeklyDeposit->totalweeklyamount ?? 0;
                                        
                                        $due = $customer->dueweeklyDepositCount->dueweklyStatusCount ?? 0;
                                        $givenCount = $customer->givenWeeklydepositcount->givenStatusCount ?? 0;
                                        $deposit = $due + $givenCount;
                                        
                                        $dueAmount = $customer->dueweeklyDepositAmount->dueweeklyamount ?? 0;
                                        
                                        // column sum
                                        $totalAmount += $amount ?? 0;
                                        $totalDeposit += $deposit ?? 0;
                                        $totalGivenCount += $givenCount ?? 0;
                                        $totalDue += $due ?? 0;
                                        $totalDueAmount += $dueAmount ?? 0;
                                    @endphp
                                    <tr>
                                        <td class="">
                                            {{ \Carbon\Carbon::parse($customer->created_at)->format('Y-m-d') }}</td>
                                        <td class="">{{ $customer->id }}</td>
                                        <td class="">{{ $customer->name }} ({{ $customer->member_code }})</td>

                                        <td class="">{{ $customer->phone_number }}</td>
                                        {{-- amount --}}
                                        <td class="due_amount">
                                            {{ !empty($amount) ? number_format($amount) : 0 }}
                                        </td>
                                        <td class=" text-danger">
                                            {{ $givenCount }}
                                        </td>

                                        <td class="">{{ $deposit }}</td>
                                        @if ($due == 0)
                                            <td class=" text-danger ">{{ $due }}</td>
                                        @else
                                            <td class=" text-danger ">-{{ $due }}</td>
                                        @endif
                                        <td class="due_amount">
                                            {{ !empty($dueAmount) ? number_format($dueAmount) : 0 }}
                                        </td>
                                    </tr>
                                @empty
                                    <p class="text-dager  font-weight-bold">No data available</p>
                                @endforelse


                            </tbody>
                            <tr class="">
                                <th colspan="2">Total member count: {{ $totalCustomer }}</th>
                                <th colspan="2" class="text-right">Total:</th>
                                <th colspan="1">{{ number_format($totalAmount, 2) }}</th>
                                <th colspan="1" class="text-danger">{{ $totalGivenCount }} </th>
                                <th colspan="1">{{ $totalDeposit }}</th>
                                <th colspan="1" class="text-danger">-{{ $totalDue }}</th>
                                <th colspan="1">{{ number_format($totalDueAmount) }}</th>
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

    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#table_print').printThis();
        });
        $("ul#report").siblings('a').attr('aria-expanded', 'true');
        $("ul#report").addClass("show");
        $("ul#report #weekly-deposit-report-menu").addClass("active");


        $('.selectpicker').selectpicker('refresh');
    </script>
    <script src="{{ asset('public/js/PrintJs.js') }}" type="text/javascript"></script>

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
@endsection
