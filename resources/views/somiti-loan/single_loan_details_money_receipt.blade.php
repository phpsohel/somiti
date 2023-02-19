<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- jQuery 3 -->
    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="{{ asset('public/vendor/dashboard/assets/plugins/jquery/jquery-migrate-1.0.0.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <!-- Print JS -->

    <script src="{{ asset('public/js/PrintJs.js') }}" type="text/javascript"></script>

    <style type="text/css">
        .line {
            width: 130px;
            height: 765px;
            border-bottom: 1px solid black;
        }

        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body style="margin: 10px;">
    <button id="table_print" class="btn btn-secondary btn-sm float-right">Print</button>
    <div id="printBody">

        <div class="container">
            <div style="padding: 5px;">
                <div>
                    <table cellpadding="3" cellspacing="0" border="0"
                        style="width:100%; border-collapse: collapse; font-size:14px;">
                        <tbody style="">
                            <tr>
                                <td colspan="3" style="border-left:none; text-align:center;">
                                    @if (!empty($general_setting->site_logo))
                                        <img alt="Brand"
                                            src="{{ asset('public/logo') }}/{{ $general_setting->site_logo }}"
                                            width="80" height="50">
                                    @endif
                                    <h2 style="margin:0%">{{ $general_setting->site_title }}</h2>
                                    <div> {{ $general_setting->address ?? '' }} </div>
                                    <div>Phone: {{ $general_setting->phone ?? '' }}</div>
                                    <div>Email: {{ $general_setting->email ?? '' }}</div>
                                    
                                    <div class=""> <strong>{{ $item->member->name ?? '' }} (
                                            {{ $item->member->member_code ?? '' }})</strong></div>
                                    <div class="">Loan Code -{{ $item->loan_code ?? '' }}</div>
                                    <div class="">Loan Release Date -{{ $item->loan_release_date ?? '' }}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%; border-collapse: collapse;text-align:center;">
                        <tbody>
                            <tr>
                                <td valign="top">
                                    <table cellpadding="3" cellspacing="0" border="1"
                                        style="width:100%; border-collapse: collapse; font-size:18px;">

                                        <thead>

                                            <tr>
                                                <th>Payment Date</th>
                                                <th>Payment Status</th>
                                                <th>Month</th>
                                                <th>{{ trans('Principal Amount') }}</th>
                                                <th class="text-center">{{ trans('Interest Rate %') }}</th>
                                                <th>{{ trans('Interest Amount') }}</th>
                                                <th>{{ trans('Fine Amount') }}</th>
                                                <th>{{ trans('Grand Total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $grand_total = 0;
                                                $principal_total = 0;
                                                $interest_total = 0;
                                                $fine_total = 0;
                                            @endphp
                                            @foreach ($loandetails as $detail)
                                                @php
                                                    $grand_total += $detail->grand_total;
                                                    $principal_total += $detail->principal_amount;
                                                    $interest_total += $detail->loan_interest_amount;
                                                    $fine_total += $detail->loan_fine_amount ?? 0;
                                                @endphp

                                                <tr>
                                                    <th colspan="">
                                                        <div class="">{{ $detail->payment_date ?? 0 }}</div>
                                                    </th>
                                                    <th class="">

                                                        @if ($detail->payment_status == 1)
                                                            Due
                                                        @elseif ($detail->payment_status == 2)
                                                            Paid
                                                        @elseif ($detail->payment_status == 3)
                                                            Cancelled
                                                        @else
                                                            In-Active
                                                        @endif
                                                        </b>
                                                    </th>

                                                    <th class="text-left" style="text-align: left">
                                                        {{ \Carbon\Carbon::parse($detail->payment_start_date)->format('F') }}
                                                    </th>
                                                    <th>{{ $detail->principal_amount ?? '' }}</th>
                                                    <th>{{ $detail->loan_interest ?? '' }}</th>
                                                    <th>{{ $detail->loan_interest_amount ?? '' }}
                                                    </th>
                                                    <th>{{ $detail->loan_fine_amount ?? '0.00' }}
                                                    </th>
                                                    <th>{{ $detail->grand_total ?? '' }}</th>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="7" style="padding-left: 40px;text-align:right">
                                                    Total
                                                </td>

                                                <th>
                                                    {{ number_format((float) ($grand_total ?? 0), 2, '.', '') }}</th>
                                            </tr>
                                            <tr>
                                                <td colspan="8" style="padding-left: 40px;">
                                                    <b>Total Amount In Words: </b>
                                                    {{ numberToWord($grand_total ?? 0) }}
                                                    BDT Only
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="position: fixed; bottom: 65px;width: 100%; font-size: 14px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <div style="width: 130px;border-bottom: 1px solid black;"></div>
                                <br>
                                <b class="ml-3">Accounts Officer</b>
                            </div>

                            <div class="col-4">
                                <div style="width: 130px;border-bottom: 1px solid black;"></div>
                                <br>
                                <b class="ml-3">Submitted By</b>
                            </div>

                            <div class="col-4">
                                <div style="width: 130px;border-bottom: 1px solid black;"></div>
                                <br>
                                <b class="ml-5"> Officer</b>
                            </div>
                        </div>
                    </div>
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
                display: flex;
                justify-content: space-between;
                /* border:2px  solid red; */
            }
        </style>
        <div class="footer">
            <span class="ml-2">© Developed By Acquaint Technologies</span> <img
                src="{{ asset('public/images/logo.png') }}" style="height:20px;width:150px;float:right;">
        </div>

    </div>
    <script>
        // $(function () {
        //     $('#printBody').printElement({printMode: 'popup'});
        // });

        // function prints() {
        //     $('#printBody').printElement({printMode: 'popup'});
        // }
    </script>

    <script type="text/javascript">
        $('#table_print').click(function() {
            $('#printBody').printThis({});
        })
    </script>
</body>

</html>
