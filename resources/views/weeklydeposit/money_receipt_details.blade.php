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

    {{-- general style --}}
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
        }

        .signature .container {
            position: relative;
            margin-top: 60px;
        }
        th,td{
            font-size: 13px;
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
                <div>Email: {{ $general_setting->email ?? '' }}</div>
                <h6 class="mt-4 mb-4"><b>Members Weekly Payment Details</b></h6>
            </div>
            <table>
                <tr>
                    <table class="table table-bordered table-responsive text-center">
                        <thead>
                            <tr>
                                <th colspan="11">
                                    {{ \Carbon\Carbon::parse($item->deposite_date)->format('l') }} ,
                                    {{ $item->months ?? '' }} , {{ $item->years ?? '' }}</th>
                            </tr>
                            <tr style="text-transform: capitalize">
                                <th>Member Name</th>
                                <th>Payment Date</th>
                                <th>Payment Status</th>

                                <th>Paid By</th>
                                <th>Transaction id</th>
                                <th>Bank name</th>
                                <th>Branch name</th>
                                <th>Cheque number</th>

                                <th>weekly Fee</th>
                                <th>weekly Fine</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($details as $detail)
                                @php
                                    $total += $detail->grand_total;
                                @endphp

                                <tr>
                                    <td>{{ $detail->member->name ?? '' }}</td>
                                    <td>
                                        <div>{{ $detail->payment_date ?? '-' }}</div>
                                    </td>
                                    <td>

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

                                    {{-- payment type --}}
                                    <td>
                                        @if ($detail->payment_type == 1)
                                            <p>Cash</p>
                                        @elseif ($detail->payment_type == 2)
                                            <p>Bank</p>
                                        @elseif ($detail->payment_type == 3)
                                            <p>Bkash-{{ $detail->phone_number ?? '-' }}</p>
                                        @elseif ($detail->payment_type == 4)
                                            <p>Rocket-{{ $detail->phone_number ?? '-' }}</p>
                                        @elseif ($detail->payment_type == 5)
                                            <p>Nogot-{{ $detail->phone_number ?? '-' }}</p>
                                        @else
                                            <p>others</p>
                                        @endif
                                    </td>
                                    <td>{{ $detail->transaction_id ?? '-' }}</td>
                                    <td>{{ $detail->bank_name ?? '-' }}</td>
                                    <td>{{ $detail->branch_name ?? '-' }}</td>
                                    <td>{{ $detail->check_no ?? '-' }}</td>
                                    {{-- end --}}

                                    <td>{{ $detail->weekly_fee ?? '' }}</td>
                                    <td>{{ $detail->weekly_fine ?? '' }}</td>
                                    <td>{{ $detail->grand_total ?? '' }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="10" style="text-align:right;">
                                    Total
                                </td>
                                <td class="text-right">
                                    {{ number_format((float) ($total ?? 0), 2, '.', '') }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="11" style="text-align:center; text-transform:capitalize;">
                                    <b>Total Amount In Words: </b> {{ numberToWord($total ?? 0) }} Taka
                                    Only
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

</html>
