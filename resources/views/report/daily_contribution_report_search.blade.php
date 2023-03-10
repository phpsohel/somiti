@extends('layout.main') @section('content')
    <section class="forms">
        <div class="container-fluid">
            <style>
                span.filter-option.pull-left {
                    color: #000 !important;
                }
            </style>
            <div class="card">
                <div class="card-header mt-2">
                    {{-- <h3 class="text-center">{{ trans('Daily Deposit Report') }}</h3> --}}
                </div>
                {!! Form::open(['route' => 'report.dailydepositreportsearch', 'method' => 'post']) !!}
                <div class="row ml-2">
                    <div class="col-lg-2 ml-2">
                        <div class="form-group row">
                            <label><strong>{{ trans('Start Date') }}</strong> &nbsp;</label>
                            <div class="d-tc">
                                <div class="input-group">
                                    <input type="date" name="start_date" value="{{ $start_date ?? '' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ml-2 ">
                        <div class="form-group row">
                            <label><strong>{{ trans('End Date') }}</strong> &nbsp;</label>
                            <div class="d-tc">
                                <div class="input-group">
                                    <input type="date" name="end_date" value="{{ $end_date ?? '' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ml-2">
                        <div class="form-group">
                            <label><strong>{{ trans('Payment Status') }}</strong></label>
                            <div>
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
                            <label><strong>{{ trans('Select Member') }}</strong> &nbsp;</label>
                            <div class="d-tc">
                                {{-- Member --}}
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
                                onclick="exportTableToCSV('DailyContributionReport.csv')">
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
                        {{-- site title --}}
                        <div class="container">
                            <div class="row d-flex text-center">
                                <div class="col-12">
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
                            <thead>
                                
                                <tr>
                                    <th>{{ trans('file.Date') }}</th>
                                    <th>{{ trans('file.Status') }}</th>
                                    <th>{{ trans('Customer') }}</th>
                                    <th class="text-right">{{ trans('Daily fee') }}</th>
                                    <th class="text-right">{{ trans('Daily fine') }}</th>
                                    <th class="text-right">{{ trans('Grand total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_fee = 0;
                                    $total_fine = 0;
                                    $grand_total = 0;
                                @endphp
                                @foreach ($dailyDetails as $key => $detail)
                                    @php
                                        $total_fee += $detail->daily_fee;
                                        $total_fine += $detail->daily_fine;
                                        $grand_total += $detail->grand_total;
                                    @endphp
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($detail->created_at)->format('Y-m-d') ?? '' }}</td>
                                        <td>
                                            @if ($detail->payment_status == 1)
                                                <p class="text-danger">Due</p>
                                            @else
                                                <p class="text-success">Paid</p>
                                            @endif
                                        </td>
                                        <td>{{ $detail->member->name ?? '' }}
                                            ({{ $detail->member->member_code ?? '' }})
                                        </td>
                                        <td class="text-right">{{ $detail->daily_fee ?? 0 }}</td>
                                        <td class="text-right">{{ $detail->daily_fine ?? 0 }}</td>
                                        <td class="text-right">{{ $detail->grand_total ?? 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                <th class=""></th>
                                <th class=""></th>
                                <th colspan="" class="text-right">Total:</th>
                                <th class="text-right">{{ number_format($total_fee ?? 0, 2) }}</th>
                                <th class="text-right">{{ number_format($total_fine ?? 0, 2) }}</th>
                                <th class="text-right">{{ number_format($grand_total ?? 0, 2) }}</th>

                            </tr>
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
                <span style="margin-left:10px;">?? Developed By Acquaint Technologies</span> <img
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
        $("ul#report #daily-deposit-report-menu").addClass("active");


        $('.selectpicker').selectpicker('refresh');
    </script>
    
    <script src="{{ asset('public/js/PrintJs.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#table_print').printThis();
        })
    </script>
@endsection
