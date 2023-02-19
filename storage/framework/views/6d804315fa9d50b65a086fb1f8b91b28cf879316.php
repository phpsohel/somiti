<?php $__env->startSection('content'); ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>DEPOSIT STANDARD CHARTERED Bank(GULSHAN Bank)</title>
</head>
<style>
    @media  print {
        * {
            font-size: 12px;
            line-height: 20px;
        }

        td,
        th {
            padding: 5px 0;
        }

        .hidden-print {
            display: none !important;
        }

        @page  {
            margin: 0;
        }

        body {
            margin: 0.5cm;
            margin-bottom: 1.6cm;
        }
    }

</style>
<body>
    <br>
    <div id="data">
        <div class="container">
            <br>
            <div class="row">
                <br>
                <div class="col-md-2" style="text-align: right;">

                    
                </div>
                <div class="col-md-8" style="text-align: left;">

                </div>
                <div class="col-md-2 hidden-print" style="text-align: left;">

                    <a id="click_print" type="button" class="btn btn-default btn-sm ml-3"><i class="dripicons-print"></i> Print</a>


                </div>
                <div class="col-md-6">

                </div>
                <div class="col-md-6" style="text-align: right;">

                </div>
                <div class="col-md-12">

                    <br>
                    <br>
                </div>
                <div class="col-md-12" id="table_print">
                  <div class="card">
                    <div class="card-body">
                        <table class="table ">
                            <thead style=" background-color: #ffffff;">
                                <tr class="">
                                    <th class="text-center" colspan="5"> <br>
                                        <br>
                                        <img src="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" style="height: 60px; width: auto" alt="">
                                        
                                        <p><?php echo e($general_setting->address); ?></p>
                                    </th>
                                </tr>
                                <tr class="">
                                    <th class="text-center" colspan="5">
                                        <img src="<?php echo e(url('public/images/customer',$lims_customer_data->image)); ?>" style="height: 140px; width: 140px" alt="">
                                        <h4 style="margin-top:10px;"><?php echo e($lims_customer_data->name); ?> (<?php echo e($lims_customer_data->member_code); ?>)</h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered">
                                <tr>
                                    <th>Member Code :</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->member_code ?? ''); ?></td>
                                    <th>Reference Name:</th>
                                    <td style="text-align: center;">
                                       <?php echo e($lims_customer_data->reference ?? ''); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>Daily  Fee :</th>
                                    <td style="text-align: center;">
                                       <?php echo e($lims_customer_data->daily_deposit_fee ?? ''); ?>

                                    </td>
    
                                    <th>Daily Status :</th>
                                    <td style="text-align: center;">
                                        <?php if($lims_customer_data->daily_status == 1): ?>
                                        <span class="text-success">Active</span>
                                        <?php else: ?>
                                         <span class="text-danger">In-Active</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
    
                                <tr>
                                    <th>Weekly  Fee :</th>
                                    <td style="text-align: center;">
                                     <?php echo e($lims_customer_data->weekly_deposit_fee ?? ''); ?>

                                    </td>
    
                                    <th>Weekly Status :</th>
                                    <td style="text-align: center;">
                                        <?php if($lims_customer_data->weekly_status == 1): ?>
                                        <span class="text-success">Active</span>
                                        <?php else: ?>
                                        <span class="text-danger">In-Active</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Monthly  Fee :</th>
                                    <td style="text-align: center;">
                                      <?php echo e($lims_customer_data->monthly_deposit_fee ?? ''); ?>

                                    </td>
    
                                    <th>Monthly Status :</th>
                                    <td style="text-align: center;">
                                        <?php if($lims_customer_data->monthly_status == 1): ?>
                                        <span class="text-success">Active</span>
                                        <?php else: ?>
                                        <span class="text-danger">In-Active</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Yearly  Fee :</th>
                                    <td style="text-align: center;">
                                        <?php echo e($lims_customer_data->yearly_deposit_fee ?? ''); ?>

                                    </td>
    
                                    <th>Yearly Status :</th>
                                    <td style="text-align: center;">
                                        <?php if($lims_customer_data->yearly_status == 1): ?>
                                         <span class="text-success">Active</span>
                                        <?php else: ?>
                                        <span class="text-danger">In-Active</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Father's Name:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->father_name ?? ''); ?></td>
                                    <th>Mother's Name:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->mother_name ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <th>Date of Birth:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->dob ?? ''); ?></td>
                                    <th>Gender:</th>
                                    <?php if($lims_customer_data->gender == 1 ): ?>
                                    <td style="text-align: center;">Male</td>
                                    <?php elseif($lims_customer_data->gender == 2): ?>
                                    <td style="text-align: center;">Female</td>
                                    <?php else: ?>
                                    <td style="text-align: center;">Others</td>
                                    <?php endif; ?>
    
                                </tr>
                                <tr>
                                    <th>Religion:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->religion ?? ''); ?></td>
                                    <th>Marital Status:</th>
                                    <?php if($lims_customer_data->marital_status == 1 ): ?>
                                    <td style="text-align: center;">Married</td>
                                    <?php else: ?>
                                    <td style="text-align: center;">Unmarried</td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <th>Nationality:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->nationality); ?></td>
                                    <th>National Id:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->national_id); ?></td>
                                </tr>
                                <tr>
                                    <th>Passport Number:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->passport_no); ?></td>
                                    <th>Passport Issue Date:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->passport_issue_date); ?></td>
                                </tr>
                                <tr>
                                    <th>Company Name:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->company_name); ?></td>
                                    <th>Tax Number:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->tax_no); ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->email); ?></td>
                                    <th>Phone Number:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->phone_number); ?></td>
                                </tr>
                                <tr>
                                    <th>Emergency Contact:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->emergency_number); ?></td>
                                    <th>Address :</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->address); ?></td>
                                </tr>
                                <tr>
                                    <th>City :</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->city); ?></td>
                                    <th>State:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->state); ?></td>
                                </tr>
                                <tr>
                                    <th>Postal Code :</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->postal_code); ?></td>
                                    <th>Country:</th>
                                    <td style="text-align: center;"><?php echo e($lims_customer_data->country); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="<?php echo e(asset('public/js/PrintJs.js')); ?>" type="text/javascript"></script>


    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#table_print').printThis();
        })

    </script>

</body>
</html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\somiti\resources\views/customer/profile.blade.php ENDPATH**/ ?>