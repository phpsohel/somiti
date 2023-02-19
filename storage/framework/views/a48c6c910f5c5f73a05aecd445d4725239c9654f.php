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
        @import  url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
        }

        .signature .container {
            position: relative;
            margin-top: 60px;
        }

        th,
        td {
            font-size: 13px;
        }
    </style>

</head>

<body>
    <button id="table_print" style="float:right;" class="btn btn-secondary btn-sm mr-2 mt-2">Print</button>
    <div id="printBody">
        
        <style>
            @media  print {
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
            
            <div class="text-center w-100">
                <?php if(!empty($general_setting->site_logo)): ?>
                    <img alt="Brand" src="<?php echo e(asset('public/logo')); ?>/<?php echo e($general_setting->site_logo); ?>"
                        width="80" height="50">
                <?php endif; ?>
                <h5><?php echo e($general_setting->site_title); ?></h5>
                <div> <?php echo e($general_setting->address ?? ''); ?> </div>
                <div>Phone: <?php echo e($general_setting->phone ?? ''); ?></div>
                <div>Email: <?php echo e($general_setting->email ?? ''); ?></div>
                <h6 class="mt-4 mb-4"><b>Members Daily Payment Details</b></h6>
            </div>
            <table>
                <tr>
                    <table class="table table-bordered table-responsive text-center">
                        <thead>
                            <tr>
                                <th colspan="11">
                                    <?php echo e(\Carbon\Carbon::parse($item->deposite_date)->format('l')); ?> ,
                                    <?php echo e($item->months ?? ''); ?> , <?php echo e($item->years ?? ''); ?></th>
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

                                <th>daily Fee</th>
                                <th>daily Fine</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total = 0;
                            ?>
                            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $total += $detail->grand_total;
                                ?>

                                <tr>
                                    <td><?php echo e($detail->member->name ?? ''); ?></td>
                                    <td>
                                        <div><?php echo e($detail->payment_date ?? '-'); ?></div>
                                    </td>
                                    <td>

                                        <?php if($detail->payment_status == 1): ?>
                                            Due
                                        <?php elseif($detail->payment_status == 2): ?>
                                            Paid
                                        <?php elseif($detail->payment_status == 3): ?>
                                            Cancelled
                                        <?php else: ?>
                                            In-Active
                                        <?php endif; ?>
                                        </b>
                                    </td>

                                    
                                    <td>
                                        <?php if($detail->payment_type == 1): ?>
                                            <p>Cash</p>
                                        <?php elseif($detail->payment_type == 2): ?>
                                            <p>Bank</p>
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
                                    <td><?php echo e($detail->bank_name ?? '-'); ?></td>
                                    <td><?php echo e($detail->branch_name ?? '-'); ?></td>
                                    <td><?php echo e($detail->check_no ?? '-'); ?></td>
                                    

                                    <td><?php echo e($detail->daily_fee ?? ''); ?></td>
                                    <td><?php echo e($detail->daily_fine ?? ''); ?></td>
                                    <td><?php echo e($detail->grand_total ?? ''); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td colspan="10" style="text-align:right;">
                                    Total
                                </td>
                                <td class="text-right">
                                    <?php echo e(number_format((float) ($total ?? 0), 2, '.', '')); ?>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="11" style="text-align:center; text-transform:capitalize;">
                                    <b>Total Amount In Words: </b> <?php echo e(numberToWord($total ?? 0)); ?> Taka
                                    Only
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </tr>
            </table>

            
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
                src="<?php echo e(asset('public/images/logo.png')); ?>" style="height:20px;width:150px;float:right;">
        </div>
    </div>

    
    <script type="text/javascript">
        $('#table_print').click(function() {
            $('#printBody').printThis();
        })
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\somiti\resources\views/dailydeposit/money_receipt_details.blade.php ENDPATH**/ ?>