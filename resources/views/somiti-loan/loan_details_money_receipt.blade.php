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
    </style>

</head>

<body>
    <button id="table_print" style="float:right;" class="btn btn-secondary btn-sm mr-2 mt-2">Print</button>
    <div id="printBody">
        {{-- printing style --}}
        <style>
            @media print {
                .signature .container {
                    position: fixed;
                    bottom: 0;
                }

                .signature .container .row {
                    margin-bottom: 40px;
                }
            }
        </style>

        <div class="container">
            {{-- style="border:2px solid red;" --}}
            <div class="text-center w-100">


                @if (!empty($general_setting->site_logo))
                    <img alt="Brand" src="{{ asset('public/logo') }}/{{ $general_setting->site_logo }}"
                        width="80" height="50">
                @endif
                <h5>{{ $general_setting->site_title }}</h5>
                <div> {{ $general_setting->address ?? '' }} </div>
                <div>Phone: {{ $general_setting->phone ?? '' }}</div>
                <div class="mb-2">Email: {{ $general_setting->email ?? '' }}</div>
                <div class=""> <strong>{{ $item->member->name ?? '' }} (
                        {{ $item->member->member_code ?? '' }})</strong></div>
                <div class="">Loan Code -{{ $item->loan_code ?? '' }}</div>
                <div class="">Loan Release Date -{{ $item->loan_release_date ?? '' }}</div>

                <h6 class="mt-4 mb-4"><b>Members Loan Details</b></h6>
            </div>
            <table>
                <tr>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Payment Date</th>
                                <th>Payment Status</th>
                                <th>Month</th>
                                <th>{{ trans('Principal Amount') }}</th>
                                <th>{{ trans('Interest Rate %') }}</th>
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
                                    <td colspan="">
                                        <div class="">{{ $detail->payment_date ?? 0 }}</div>
                                    </td>
                                    <td class="">

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
                                    </td>

                                    <td class="text-left" style="text-align: left">
                                        {{ \Carbon\Carbon::parse($detail->payment_start_date)->format('F') }}
                                    </td>
                                    <td class="text-right">{{ $detail->principal_amount ?? '' }}</td>
                                    <td class="text-center">{{ $detail->loan_interest ?? '' }}</td>
                                    <td class="text-right">{{ $detail->loan_interest_amount ?? '' }}</td>
                                    <td class="text-right">{{ $detail->loan_fine_amount ?? '0.00' }}</td>
                                    <td class="text-right">{{ $detail->grand_total ?? '' }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="3" style="padding-left: 40px; text-align:right;">
                                    Total
                                </th>
                                <th class="text-right">
                                    {{ number_format((float) ($principal_total ?? 0), 2, '.', '') }}</th>
                                <th class=""></th>
                                <th class="text-right">
                                    {{ number_format((float) ($interest_total ?? 0), 2, '.', '') }}</th>

                                <th class="text-right">
                                    {{ number_format((float) ($fine_total ?? 0), 2, '.', '') }}</th>
                                <th class="text-right">
                                    {{ number_format((float) ($grand_total ?? 0), 2, '.', '') }}</th>
                            </tr>
                            <tr>
                                <td colspan="8" style="text-align: center;">
                                    <b>Total Amount In Words: </b> {{ numberToWord($grand_total ?? 0) }}
                                    BDT Only
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </tr>
            </table>

            {{-- signature  style="border:2px solid red;" --}}
            <div class="signature">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="line" style="width:120px;margin:auto;border-bottom: 1px solid black;">
                            </div>
                            <br>
                            <p style="margin-left: 5px;">Accounts Officer</p>
                        </div>
                        <div class="col-4">
                            <div class="line" style=" width:120px;margin:auto;border-bottom: 1px solid black;">
                            </div>
                            <br>
                            <p style="margin-left: 5px;">Submitted By</p>
                        </div>
                        <div class="col-4">
                            <div class="line" style=" width:120px;margin:auto;border-bottom: 1px solid black;">
                            </div>
                            <br>
                            <p style="margin-left: 15px;"> Officer</p>
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
                margin-top: 10px;
            }
        </style>
        <div class="footer">
            <span style="margin-left:10px;">© Developed By Acquaint Technologies</span> <img
                src="{{ asset('public/images/logo.png') }}" style="height:20px;width:150px;float:right;">
        </div>
    </div>

    {{-- print js --}}
    <script type="text/javascript">
        $('#table_print').click(function() {
            $('#printBody').printThis();
        })
    </script>
</body>



    <script type="text/javascript">
        $('#table_print').click(function() {
            $('#printBody').printThis({});
        })
    </script>
</body>

</html>
