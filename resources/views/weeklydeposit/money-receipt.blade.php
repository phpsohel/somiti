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
    <button id="table_print" class="float-right btn btn-secondary btn-sm">Print</button>
    <div id="printBody">

        <div class="container">
            <div style="padding: 5px;">
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

                            </td>
                        </tr>

                        <tr style="font-size: 20px; text-align:center">
                            @if ($detail->payment_type == 1)
                                <th colspan="5">Weekly Money Receipt</th>
                            @elseif ($detail->payment_type == 2)
                                <th colspan="8">Weekly Money Receipt</th>
                            @else
                                <th colspan="5">Weekly Money Receipt</th>
                            @endif
                        </tr>


                    </tbody>
                </table>
                <table cellpadding="3" cellspacing="0" border="0"
                    style="width:100%; border-collapse: collapse; font-size:14px;">
                    <thead>
                        <tr>
                            <td colspan="8" style="width: 75%;">
                                <h6 style="margin:0%"><b>Member Name :</b> {{ $detail->member->name ?? '' }}
                                    ({{ $detail->member->member_code ?? '' }} )</h6>
                                    <div class="text-left float-right">
                                        <h5 class=""><b>Receipt No #</b> </h5>
                                        <h5 class=""><b>{{ $detail->deposite_code ?? '' }}</b></h5>
                                    </div>
                                <p style="margin-top: 0px; margin-bottom: 0px"><b>Address:</b>
                                    &nbsp;&nbsp;&nbsp;{{ $detail->member->address ?? '' }}
                                </p>
                                <b>Phone Number:</b>&nbsp;&nbsp;&nbsp;{{ $detail->member->phone_number ?? '' }}
                                <br><b>Email:</b>&nbsp;&nbsp;&nbsp;{{ $detail->member->email ?? '' }}
                                <br class="">
                                <b class=""> Payment Status : &nbsp;&nbsp;&nbsp;
                                    @if ($detail->payment_status == 1)
                                        Due
                                    @elseif ($detail->payment_status == 2)
                                        Paid
                                    @elseif ($detail->payment_status == 3)
                                        Cancelled
                                    @else
                                        In-Active
                                    @endif
                                </b><br>
                                {{-- payment type --}}
                                <b>Payment Type:
                                    @if ($detail->payment_type == 1)
                                        Cash
                                    @elseif ($detail->payment_type == 2)
                                        Cheque
                                    @elseif ($detail->payment_type == 3)
                                        Bkash-{{ $detail->phone_number ?? '-' }}
                                    @elseif ($detail->payment_type == 4)
                                        Rocket-{{ $detail->phone_number ?? '-' }}
                                    @elseif ($detail->payment_type == 5)
                                        Nogot-{{ $detail->phone_number ?? '-' }}
                                    @else
                                        others
                                    @endif
                                </b>

                            </td>
                            {{-- <td colspan="4" valign="middle" style="border-right:none;text-align:left;">

                            </td> --}}
                        </tr>
                    </thead>
                    <tbody style="text-align: left;">
                    </tbody>
                </table>
                <br>
                <table style="width:100%; border-collapse: collapse; text-align:center;">
                    <tbody>
                        <tr>
                            <td valign="top">
                                <table cellpadding="3" cellspacing="0" border="1"
                                    style="width:100%; border-collapse: collapse; font-size:18px;">
                                    <thead>

                                        <tr style="text-transform: capitalize">
                                            <th>Date</th>
                                            <th>Paid by</th>
                                            <th>Transaction id</th>
                                            @if ($detail->payment_type == 2)
                                                <th>Bank Name</th>
                                                <th>Branch Name</th>
                                                <th>Cheque Number</th>
                                            @endif
                                            <th>weekly Fee</th>
                                            <th>weekly Fine</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center">
                                            <td colspan="">
                                                <div class="">
                                                    {{ \Carbon\Carbon::parse($detail->deposite_date)->format('l') }} ,
                                                    {{ $detail->month ?? 0 }} , {{ $detail->years ?? 0 }}</div>
                                            </td>
                                            <td>
                                                @if ($detail->payment_type == 1)
                                                    <p>Cash</p>
                                                @elseif ($detail->payment_type == 2)
                                                    <p>Cheque</p>
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
                                            @if ($detail->payment_type == 2)
                                                <td>{{ $detail->bank_name ?? '-' }}</td>
                                                <td>{{ $detail->branch_name ?? '-' }}</td>
                                                <td>{{ $detail->check_no ?? '-' }}</td>
                                            @endif
                                            <td>{{ $detail->weekly_fee ?? '' }}</td>
                                            <td>{{ $detail->weekly_fine ?? '' }}</td>
                                            <td>{{ $detail->grand_total ?? '' }}</td>
                                        </tr>

                                        <tr>
                                            @if ($detail->payment_type == 1)
                                                <td colspan="6" style="text-align:center; padding-left: 40px;">
                                                    <b>Total Amount In Words: </b>
                                                    {{ numberToWord($detail->grand_total ?? 0) }} Taka Only
                                                </td>
                                            @elseif ($detail->payment_type == 2)
                                                <td colspan="9" style="text-align:center; padding-left: 40px;">
                                                    <b>Total Amount In Words:
                                                    </b>{{ numberToWord($detail->grand_total ?? 0) }} Taka Only
                                                </td>
                                            @else
                                                <td colspan="6" style="text-align:center; padding-left: 40px;">
                                                    <b>Total Amount In Words: </b>
                                                    {{ numberToWord($detail->grand_total ?? 0) }} Taka Only
                                                </td>
                                            @endif

                                        </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div style="position: fixed;width: 100%; font-size: 14px;  margin-top: 40px;">
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
                /* position: fixed; */
                margin-top: 100px;
                left: 0;
                bottom: 0;
                width: 100%;
            }
        </style>
        <div class="clearfix">
            <div class="footer">
                <span style="margin-left:10px;">© Developed By Acquaint Technologies</span> <img
                    src="{{ asset('public/images/logo.png') }}" style="height:20px;width:150px;float:right;">
            </div>
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
