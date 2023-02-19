@extends('layout.main') @section('content')
    <style>
        /* option color */
        span.filter-option.pull-left {
            color: #000 !important;
        }
    </style>
    <section class="forms">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header mt-2">
                    <h3 class="text-center">{{ trans('Member Wise Loan Report') }}</h3>
                </div>
                {!! Form::open(['route' => 'report.memberwiseloandetailsearch', 'method' => 'post']) !!}
                <div class="row ml-4">
                    <div class="col-lg-2 col-md-2">
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
                    <div class="col-lg-2 col-md-2 ">
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class=""><strong>{{ trans('Loan Status') }}</strong></label>
                            <div class="">
                                <select name="payment_status" class="form-control">
                                    <option value="">All Status</option>

                                    <option value="1" {{ $payment_status == 1 ? 'Selected' : '' }}>Due</option>
                                    <option value="2" {{ $payment_status == 2 ? 'Selected' : '' }}>Paid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class=""><strong>{{ trans('Select Member') }}</strong> &nbsp;</label>
                            <div class="">
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
                    <div class="col-md-4 mt-4">
                        <div class=" d-flex mt-2 pull-right">
                            <button class="btn btn-primary btn-sm" type="submit">{{ trans('Show') }}</button>
                            <a id="click_print" class="btn btn-info ml-2 text-white btn-sm"><i class="dripicons-print"></i>
                                Print</a>
                            {{-- excel --}}
                            <button class="btn btn-success btn-sm ml-2 text-white"
                                onclick="exportTableToCSV('MemberWiseLoanReport.csv')">
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
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center mb-4">
                                @if (!empty($setting->site_logo))
                                    <img alt="Brand" src="{{ asset('public/logo') }}/{{ $setting->site_logo }}"
                                        width="100" height="70">
                                @else
                                    <img alt="Brand" src="{{ asset('public/logo/somity.jpg') }}" width="80"
                                        height="50">
                                @endif

                                <h3 class="">{{ $setting->site_title ?? '' }}</h3>
                                <div> {{ $setting->address ?? '' }} </div>
                                <div>Phone: {{ $setting->phone ?? '' }}</div>
                                <div>Email: {{ $setting->email ?? '' }}</div>
                                <div class="">Member Wise Loan Report</div>
                                <div class="">{{ $start_date ?? '' }} To {{ $end_date ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-sm table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>{{ trans('file.Date') }}</th>
                                    <th>{{ trans('file.Status') }}</th>
                                    <th>{{ trans('Received From') }}</th>
                                    <th>{{ trans('Principal Amount') }}</th>
                                    <th>{{ trans('Loan Interest Amount') }}</th>
                                    <th>{{ trans('Grand Amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $principal_total = 0;
                                    $interest_total = 0;
                                    $grand_total = 0;
                                @endphp
                                @foreach ($loandetails as $key => $loandetail)
                                    @php
                                        $principal_total += $loandetail->principal_amount ?? 0;
                                        $interest_total += $loandetail->loan_interest_amount ?? 0;
                                        $grand_total += $loandetail->grand_total ?? 0;
                                    @endphp
                                    <tr>
                                        <td class="">{{ $loandetail->payment_start_date ?? '' }}</td>
                                        <td class="">
                                            @if ($loandetail->payment_status == 1)
                                                <p class="text-danger">Due</p>
                                            @else
                                                <p class="text-success">Paid</p>
                                            @endif
                                        </td>
                                        <td class="">{{ $loandetail->member->name ?? '' }}
                                            ({{ $loandetail->member->member_code ?? '' }})
                                        </td>
                                        <td class="">{{ $loandetail->principal_amount ?? 0 }}</td>
                                        <td class="">{{ $loandetail->loan_interest_amount ?? 0 }}</td>
                                        <td class="">{{ $loandetail->grand_total ?? 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                <th colspan="3">Total:</th>
                                <th>{{ number_format($principal_total ?? 0, 2) }}</th>
                                <th>{{ number_format($interest_total ?? 0, 2) }}</th>
                                <th>{{ number_format($grand_total ?? 0, 2) }}</th>

                            </tr>

                        </table>
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
        $("ul#report #menber-loan-report-menu").addClass("active");


        $('.selectpicker').selectpicker('refresh');
    </script>
    <script src="{{ asset('public/js/PrintJs.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#table_print').printThis();
        })
    </script>
@endsection
