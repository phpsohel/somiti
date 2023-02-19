 <?php $__env->startSection('content'); ?>
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
                    
                </div>
                <?php echo Form::open(['route' => 'report.yearlyContributionReportSearch', 'method' => 'post']); ?>

                <div class="row ml-4">
                    <div class="col-lg-2 ml-2">
                        <div class="form-group row">
                            <label><strong><?php echo e(trans('Start Date')); ?></strong> &nbsp;</label>
                            <div class="d-tc">
                                <div class="input-group">
                                    <input type="date" name="start_date" class="form-control"
                                        value="<?php echo e($start_date ?? ''); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ml-2 ">
                        <div class="form-group row">
                            <label><strong><?php echo e(trans('End Date')); ?></strong> &nbsp;</label>
                            <div class="d-tc">
                                <div class="input-group">
                                    <input type="date" name="end_date" class="form-control"
                                        value="<?php echo e($end_date ?? ''); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ml-2">
                        <div class="form-group">
                            <label><strong><?php echo e(trans('Payment Status')); ?></strong></label>
                            <div>
                                <select name="payment_status" class="form-control">
                                    <option value="">All Status</option>

                                    <option value="1" <?php echo e($payment_status == 1 ? 'Selected' : ''); ?>>Due</option>
                                    <option value="2" <?php echo e($payment_status == 2 ? 'Selected' : ''); ?>>Paid</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ml-2">
                        <div class="form-group row">
                            <label><strong><?php echo e(trans('Select Member')); ?></strong> &nbsp;</label>
                            <div class="d-tc">

                                <select name="customer_id" class="form-control" data-live-search="true">
                                    <option value="">Select All Member</option>
                                    <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($member->id); ?>"
                                            <?php echo e($member->id == $customer_id ? 'Selected' : ''); ?>>
                                            <?php echo e($member->member_code ?? ''); ?>( <?php echo e($member->name ?? ''); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mt-4">
                        <div class="form-group d-flex mt-2">
                            <button class="btn btn-primary btn-sm" type="submit"><?php echo e(trans('Show')); ?></button>
                            <a id="click_print" class="btn btn-info ml-2 text-white btn-sm"><i class="dripicons-print"></i>
                                Print</a>
                            
                            <button class="btn btn-success btn-sm ml-2 text-white"
                                onclick="exportTableToCSV('yearlyReport.csv')">
                                Export To CSV
                            </button>
                        </div>
                    </div>
                </div>

                <?php echo Form::close(); ?>

            </div>
        </div>
        <div class="container" id="table_print">
            <div class="card">
                <div class="card-header mt-2">
                    <h3 class="text-center "><?php echo e(trans('Yearly Contribution Summary')); ?></h3>
                    
                </div>
                <div class="card-body">
                    
                    <div class="container">
                        <div class="row d-flex text-center">
                            <div class="col-12 mb-4">
                                <?php if(!empty($setting->site_logo)): ?>
                                    <img alt="Brand" src="<?php echo e(asset('public/logo')); ?>/<?php echo e($setting->site_logo); ?>"
                                        width="100" height="70">
                                <?php else: ?>
                                    <img alt="Brand" src="<?php echo e(asset('public/logo/somity.jpg')); ?>" width="80"
                                        height="50">
                                <?php endif; ?>

                                <h3><?php echo e($setting->site_title ?? ''); ?></h3>
                                <div> <?php echo e($setting->address ?? ''); ?> </div>
                                <div>Phone: <?php echo e($setting->phone ?? ''); ?></div>
                                <div>Email: <?php echo e($setting->email ?? ''); ?></div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="text-center table table-bordered table-sm table-striped text-nowrap">
                            <thead>

                                <tr>
                                    <th><?php echo e(trans('Joining Date')); ?></th>
                                    <th><?php echo e(trans('ID')); ?></th>
                                    <th><?php echo e(trans('Name Of Member')); ?></th>
                                    <th><?php echo e(trans('Mobile')); ?></th>
                                    <th><?php echo e(trans('Amount')); ?></th>
                                    <th><?php echo e(trans('Deposit Yearly')); ?></th>
                                    <th><?php echo e(trans('Yearly Count')); ?></th>
                                    <th class="due_amount"><?php echo e(trans('Due/Advance Yearly')); ?></th>
                                    <th><?php echo e(trans('Due Amount')); ?></th>
                                </tr>
                            </thead>
                            <?php
                                $totalCustomer = 0;
                                $totalAmount = 0;
                                $totalDeposit = 0;
                                $totalGivenCount = 0;
                                $totalDue = 0;
                                $totalDueAmount = 0;
                            ?>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $totalCustomer += count([$customer->id]);
                                        $amount = $customer->yearlydeposit->totalyearlyamount ?? 0;
                                        
                                        $due = $customer->dueYearlyStatusCount->dueyearlystatuscount ?? 0;
                                        $givenCount = $customer->Statusyearlydepositcount->statuscount ?? 0;
                                        $deposit = $due + $givenCount;
                                        
                                        $dueAmount = $customer->dueyearlydeposit->totalDueyearlyamount ?? 0;
                                        
                                        // column sum
                                        $totalAmount += $amount ?? 0;
                                        $totalDeposit += $deposit ?? 0;
                                        $totalGivenCount += $givenCount ?? 0;
                                        $totalDue += $due ?? 0;
                                        $totalDueAmount += $dueAmount ?? 0;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo e(\Carbon\Carbon::parse($customer->created_at)->format('Y-m-d')); ?></td>
                                        <td><?php echo e($customer->id); ?></td>
                                        <td><?php echo e($customer->name); ?> (<?php echo e($customer->member_code); ?>)</td>

                                        <td><?php echo e($customer->phone_number); ?></td>
                                        
                                        <td class="due_amount">
                                            <?php echo e(!empty($amount) ? number_format($amount) : 0); ?>

                                        </td>
                                        <td class=" text-danger">
                                            <?php echo e($givenCount); ?>

                                        </td>

                                        <td><?php echo e($deposit); ?></td>
                                        <?php if($due == 0): ?>
                                            <td class=" text-danger "><?php echo e($due); ?></td>
                                        <?php else: ?>
                                            <td class=" text-danger ">-<?php echo e($due); ?></td>
                                        <?php endif; ?>
                                        <td class="due_amount">
                                            <?php echo e(!empty($dueAmount) ? number_format($dueAmount) : 0); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-dager  font-weight-bold">No data available</p>
                                <?php endif; ?>


                            </tbody>
                            <tr>
                                <th colspan="2">Total member count: <?php echo e($totalCustomer); ?></th>
                                <th colspan="2" class="text-right">Total:</th>
                                <th colspan="1"><?php echo e(number_format($totalAmount, 2)); ?></th>
                                <th colspan="1" class="text-danger"><?php echo e($totalGivenCount); ?> </th>
                                <th colspan="1"><?php echo e($totalDeposit); ?></th>
                                <th colspan="1" class="text-danger">-<?php echo e($totalDue); ?></th>
                                <th colspan="1"><?php echo e(number_format($totalDueAmount)); ?></th>
                            </tr>
                        </table>
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
    </section>

    <script type="text/javascript">
        $("ul#report").siblings('a').attr('aria-expanded', 'true');
        $("ul#report").addClass("show");
        $("ul#report #yearly-deposit-report-menu").addClass("active");


        $('.selectpicker').selectpicker('refresh');
    </script>
    <script src="<?php echo e(asset('public/js/PrintJs.js')); ?>" type="text/javascript"></script>


    <script type="text/javascript">
        $('#click_print').click(function() {
            // $('#reportlogo').css('display', 'block');
            $('#table_print').printThis();
        })
    </script>
    
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\somiti\resources\views/report/yearly_contribution_report.blade.php ENDPATH**/ ?>