<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(config('app.name')); ?></title>

    <!-- jQuery 3 -->
    <script type="text/javascript" src="<?php echo asset('public/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo e(asset('public/vendor/dashboard/assets/plugins/jquery/jquery-migrate-1.0.0.js')); ?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <!-- Print JS -->

    <script src="<?php echo e(asset('public/js/PrintJs.js')); ?>" type="text/javascript"></script>

    <style type="text/css">
        .line {
            width: 130px;
            height: 765px;
            border-bottom: 1px solid black;
        }

        @import  url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>

</head>

<body style="margin: 10px;">
    <button id="table_print" class="float-right btn btn-secondary btn-sm">Print</button>
    <div id="printBody">
        <div class="container">
            <style>
                @media  print {
                    #printBody {
                        height: 50% !important;
                    }
                }
            </style>
            <div style="padding: 5px;">
                <table cellpadding="3" cellspacing="0" border="0"
                    style="width:100%; border-collapse: collapse; font-size:14px;">
                    <tbody style="">
                        <tr>
                            <td colspan="3" style="border-left:none; text-align:center;">
                                <?php if(!empty($general_setting->site_logo)): ?>
                                    <img alt="Brand"
                                        src="<?php echo e(asset('public/logo')); ?>/<?php echo e($general_setting->site_logo); ?>"
                                        width="80" height="50">
                                <?php endif; ?>

                                <h2 style="margin:0%"><?php echo e($general_setting->site_title); ?></h2>
                                <div> <?php echo e($general_setting->address ?? ''); ?> </div>
                                <div>Phone: <?php echo e($general_setting->phone ?? ''); ?></div>
                                <div>Email: <?php echo e($general_setting->email ?? ''); ?></div>

                            </td>
                        </tr>

                        <tr style="font-size: 20px; text-align:center;">
                            <?php if($detail->payment_type == 1): ?>
                                <th colspan="5"> Daily Money Receipt</th>
                            <?php elseif($detail->payment_type == 2): ?>
                                <th colspan="8"> Daily Money Receipt</th>
                            <?php else: ?>
                                <th colspan="6"> Daily Money Receipt</th>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
                <table cellpadding="3" cellspacing="0" border="0"
                    style="width:100%; border-collapse: collapse; font-size:14px; margin-top:10px;">
                    <thead>
                        <tr>
                            <td colspan="8" style="width: 75%;">
                                <h6 style="margin:0%"><b>Member Name :</b> <?php echo e($detail->member->name ?? ''); ?>

                                    (<?php echo e($detail->member->member_code ?? ''); ?> )
                                </h6>
                                <div class="text-left float-right">
                                    <h5 class=""><b>Receipt No #</b> </h5>
                                    <h5 class=""><b><?php echo e($detail->deposite_code ?? ''); ?></b></h5>
                                </div>
                                <p style="margin-top: 0px; margin-bottom: 0px"><b>Address:</b>
                                    &nbsp;&nbsp;&nbsp;<?php echo e($detail->member->address ?? ''); ?>

                                </p>
                                <b>Phone Number:</b>&nbsp;&nbsp;&nbsp;<?php echo e($detail->member->phone_number ?? ''); ?>

                                <br><b>Email:</b>&nbsp;&nbsp;&nbsp;<?php echo e($detail->member->email ?? ''); ?>

                                <br class="">
                                <b class=""> Payment Status : &nbsp;&nbsp;&nbsp;
                                    <?php if($detail->payment_status == 1): ?>
                                        Due
                                    <?php elseif($detail->payment_status == 2): ?>
                                        Paid
                                    <?php elseif($detail->payment_status == 3): ?>
                                        Cancelled
                                    <?php else: ?>
                                        In-Active
                                    <?php endif; ?>
                                </b><br>
                                
                                <b>Payment Type:
                                    <?php if($detail->payment_type == 1): ?>
                                        Cash
                                    <?php elseif($detail->payment_type == 2): ?>
                                        Cheque
                                    <?php elseif($detail->payment_type == 3): ?>
                                        Bkash-<?php echo e($detail->phone_number ?? '-'); ?>

                                    <?php elseif($detail->payment_type == 4): ?>
                                        Rocket-<?php echo e($detail->phone_number ?? '-'); ?>

                                    <?php elseif($detail->payment_type == 5): ?>
                                        Nogot-<?php echo e($detail->phone_number ?? '-'); ?>

                                    <?php else: ?>
                                        others
                                    <?php endif; ?>
                                </b>

                            </td>
                            
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

                                            <?php if($detail->payment_type == 2): ?>
                                                <th>Bank Name</th>
                                                <th>Branch Name</th>
                                                <th>Cheque Number</th>
                                            <?php endif; ?>
                                            <th>Daily Fee</th>
                                            <th>Daily Fine</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center">
                                            <td colspan="">
                                                <div class="">
                                                    <?php echo e(\Carbon\Carbon::parse($detail->deposite_date)->format('l')); ?> ,
                                                    <?php echo e($detail->month ?? 0); ?> , <?php echo e($detail->years ?? 0); ?>

                                                </div>
                                            </td>
                                            <td>
                                                <?php if($detail->payment_type == 1): ?>
                                                    <p>Cash</p>
                                                <?php elseif($detail->payment_type == 2): ?>
                                                    <p>Cheque</p>
                                                <?php elseif($detail->payment_type == 3): ?>
                                                    <p>Bkash-<?php echo e($detail->phone_number ?? '-'); ?></p>
                                                <?php elseif($detail->payment_type == 4): ?>
                                                    <p>Rocket-<?php echo e($detail->phone_number ?? '-'); ?></p>
                                                <?php elseif($detail->payment_type == 5): ?>
                                                    <p>Nogot-<?php echo e($detail->phone_number ?? '-'); ?></p>
                                                <?php else: ?>
                                                    <p>others</p>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($detail->transaction_id ?? '-'); ?></td>
                                            <?php if($detail->payment_type == 2): ?>
                                                <td><?php echo e($detail->bank_name ?? '-'); ?></td>
                                                <td><?php echo e($detail->branch_name ?? '-'); ?></td>
                                                <td><?php echo e($detail->check_no ?? '-'); ?></td>
                                            <?php endif; ?>
                                            <td><?php echo e($detail->daily_fee ?? ''); ?></td>
                                            <td><?php echo e($detail->daily_fine ?? ''); ?></td>
                                            <td><?php echo e($detail->grand_total ?? ''); ?></td>
                                        </tr>

                                        <tr>
                                            <?php if($detail->payment_type == 1): ?>
                                                <td colspan="6" style="text-align:center; padding-left: 40px;">
                                                    <b>Total Amount In Words: </b>
                                                    <?php echo e(numberToWord($detail->grand_total ?? 0)); ?> Taka Only
                                                </td>
                                            <?php elseif($detail->payment_type == 2): ?>
                                                <td colspan="9" style="text-align:center; padding-left: 40px;">
                                                    <b>Total Amount In Words:
                                                    </b><?php echo e(numberToWord($detail->grand_total ?? 0)); ?> Taka Only
                                                </td>
                                            <?php else: ?>
                                                <td colspan="6" style="text-align:center; padding-left: 40px;">
                                                    <b>Total Amount In Words: </b>
                                                    <?php echo e(numberToWord($detail->grand_total ?? 0)); ?> Taka Only
                                                </td>
                                            <?php endif; ?>
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
        
        <style>
            .footer {
                /* position: relative; */
                left: 0;
                bottom: 0;
                width: 100%;
                margin-top: 100px;
            }
        </style>
        <div class="clearfix">
            <div class="footer">
                <span style="margin-left:10px;">© Developed By Acquaint Technologies</span> <img
                    src="<?php echo e(asset('public/images/logo.png')); ?>" style="height:20px;width:150px;float:right;">
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
<?php /**PATH C:\xampp\htdocs\somiti\resources\views/dailydeposit/money-receipt.blade.php ENDPATH**/ ?>