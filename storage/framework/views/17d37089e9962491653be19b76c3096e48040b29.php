 <?php $__env->startSection('content'); ?>
    <style>
        span.filter-option.pull-left {
            color: #000 !important;
        }
    </style>
    <section class="forms">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header mt-2">
                    
                </div>
                <?php echo Form::open(['route' => 'report.weeklyContributionReportSearch', 'method' => 'post']); ?>

                <div class="row ml-2">
                    <div class="col-lg-2 ml-2">
                        <div class="form-group row">
                            <label><strong><?php echo e(trans('Start Date')); ?></strong> &nbsp;</label>
                            <div class="d-tc">
                                <div class="input-group">
                                    <input type="date" name="start_date" class="form-control" value="<?php echo e($start_date ?? ''); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 ml-2 ">
                        <div class="form-group row">
                            <label><strong><?php echo e(trans('End Date')); ?></strong> &nbsp;</label>
                            <div class="d-tc">
                                <div class="input-group">
                                    <input type="date" name="end_date" class="form-control" value="<?php echo e($end_date ?? ''); ?>" />
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
                                onclick="exportTableToCSV('weeklyContributionReport.csv')">
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
                        <table class="table table-bordered table-sm table-striped text-nowrap">
                            <thead>
                                
                                <tr>
                                    <th><?php echo e(trans('file.Date')); ?></th>
                                    <th><?php echo e(trans('file.Status')); ?></th>
                                    <th><?php echo e(trans('Customer')); ?></th>
                                    <th class="text-right"><?php echo e(trans('Weekly fee')); ?></th>
                                    <th class="text-right"><?php echo e(trans('Weekly fine')); ?></th>
                                    <th class="text-right"><?php echo e(trans('Grand total')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total_fee = 0;
                                    $total_fine = 0;
                                    $grand_total = 0;
                                ?>
                                <?php $__currentLoopData = $weeklyDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $total_fee += $detail->weekly_fee;
                                        $total_fine += $detail->weekly_fine;
                                        $grand_total += $detail->grand_total;
                                    ?>
                                    <tr>
                                        <td><?php echo e(\Carbon\Carbon::parse($detail->created_at)->format('Y-m-d') ?? ''); ?></td>
                                        <td>
                                            <?php if($detail->payment_status == 1): ?>
                                                <p class="text-danger">Due</p>
                                            <?php else: ?>
                                                <p class="text-success">Paid</p>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($detail->member->name ?? ''); ?>

                                            (<?php echo e($detail->member->member_code ?? ''); ?>)
                                        </td>
                                        <td class="text-right"><?php echo e($detail->weekly_fee ?? 0); ?></td>
                                        <td class="text-right"><?php echo e($detail->weekly_fine ?? 0); ?></td>
                                        <td class="text-right"><?php echo e($detail->grand_total ?? 0); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tr>
                                <th colspan="3" class="text-right">Total:</th>
                                <th class="text-right"><?php echo e(number_format($total_fee ?? 0, 2)); ?></th>
                                <th class="text-right"><?php echo e(number_format($total_fine ?? 0, 2)); ?></th>
                                <th class="text-right"><?php echo e(number_format($grand_total ?? 0, 2)); ?></th>

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
        $("ul#report #weekly-deposit-report-menu").addClass("active");


        $('.selectpicker').selectpicker('refresh');
    </script>
    <script src="<?php echo e(asset('public/js/PrintJs.js')); ?>" type="text/javascript"></script>


    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#table_print').printThis();
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\somiti\resources\views/report/weekly_contribution_report_search.blade.php ENDPATH**/ ?>