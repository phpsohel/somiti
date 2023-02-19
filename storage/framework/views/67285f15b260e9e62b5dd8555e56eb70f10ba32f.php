 <?php $__env->startSection('content'); ?>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?>

        </div>
    <?php endif; ?>
    <?php if(session()->has('create_message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo session()->get('create_message'); ?></div>
    <?php endif; ?>
    <?php if(session()->has('edit_message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('edit_message')); ?></div>
    <?php endif; ?>
    <?php if(session()->has('import_message')): ?>
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo session()->get('import_message'); ?></div>
    <?php endif; ?>
    <?php if(session()->has('not_permitted')): ?>
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
    <?php endif; ?>
    <section>
        <div class="card">

            <div class="card-header">
                <h4 class="card-title mb-2"> Daily Deposit Details</h4>

                <div class="card-tools">
                    <a class="btn btn-dark btn-sm" href="<?php echo e(route('dailydeposit.index')); ?>"><i class="fa fa-undo px-2"></i>
                        Back</a> &nbsp;
                    <a class="btn btn-success btn-sm text-white pull-right" data-toggle="modal"
                        data-target="#addDepositDetailModal"><i class="fa fa-plus px-2"></i> Add new member </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="customer-table" class="table table-bordered table-sm text-center">
                        <thead>
                            <tr class="">
                                <th class="text-center text-success" colspan="13">
                                    <div class="">Daily Deposit List : <?php echo e($item->months . ' , ' . $item->years); ?>

                                    </div>
                                    <div class=""><?php echo e($item->deposite_date ?? ''); ?></div>

                                </th>
                            </tr>
                            <tr class="text-capitalize">
                                <th>SL</th>
                                <th>Action</th>
                                <th>Status</th>
                                <th>Member Name</th>

                                <th>Paid By</th>
                                <th>Transaction ID</th>
                                <th>Bank Name</th>
                                <th>Branch Name</th>
                                <th>Cheque Number</th>

                                <th>Payment Date</th>
                                <th class="text-right">Daily fee</th>
                                <th class="text-right">Daily Fine</th>
                                <th class="text-right">Grand Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                $total_daily_fee = 0;
                                $total_daily_fine = 0;
                                $grandtotal = 0;
                            ?>
                            <?php $__currentLoopData = $depositdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $depositdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $total_daily_fee += $depositdetail->daily_fee;
                                    $total_daily_fine += $depositdetail->daily_fine;
                                    $grandtotal += ($depositdetail->daily_fee ?? 0) + ($depositdetail->daily_fine ?? 0);
                                ?>

                                <tr>
                                    <td><?php echo e(++$i); ?></td>
                                    <td>
                                        <?php if($depositdetail->payment_status == 1): ?>
                                            <a class="btn btn-primary btn-sm text-white w-100" data-toggle="modal"
                                                data-target="#loanDeposite_<?php echo e($depositdetail->id); ?>">
                                                <i class="fa fa-bath"></i> <?php echo e(trans('Fee Collection')); ?>

                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('dailymoneyreceiptSingle', $depositdetail->id)); ?>" target="_blank"
                                                class="btn btn-info btn-sm w-100"><i class="fa fa-money px-2"></i>
                                                Money Receipt
                                            </a>
                                            
                                            <?php if(!empty(auth()->user()->role_id == 1)): ?>
                                                <a href="<?php echo e(route('daily_money_receipt_edit', $depositdetail->id)); ?>"
                                                    class="btn btn-secondary btn-sm mt-2 w-100">
                                                    <i class="fa fa-edit px-2"> Edit</i>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($depositdetail->payment_status == 1): ?>
                                            <p class="text-danger">Due</p>
                                        <?php elseif($depositdetail->payment_status == 2): ?>
                                            <p class="text-success">Paid</p>
                                        <?php elseif($depositdetail->payment_status == 3): ?>
                                            <p class="text-danger">Cancelled</p>
                                        <?php else: ?>
                                            <p class="text-danger">In-Active</p>
                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo e($depositdetail->member->name ?? ''); ?>

                                        (<?php echo e($depositdetail->member->member_code ?? ''); ?>)
                                    </td>
                                    
                                    <td>
                                        <?php if($depositdetail->payment_type == 1): ?>
                                            <p>Cash</p>
                                        <?php elseif($depositdetail->payment_type == 2): ?>
                                            <p>Bank</p>
                                        <?php elseif($depositdetail->payment_type == 3): ?>
                                            <p>Bkash- <?php echo e($depositdetail->phone_number ?? '-'); ?></p>
                                        <?php elseif($depositdetail->payment_type == 4): ?>
                                            <p>Rocket - (<?php echo e($depositdetail->phone_number ?? '-'); ?>)</p>
                                        <?php elseif($depositdetail->payment_type == 5): ?>
                                            <p>Nogot (<?php echo e($depositdetail->phone_number ?? '-'); ?>)</p>
                                        <?php elseif($depositdetail->payment_type == 6): ?>
                                            <p>others</p>
                                        <?php else: ?>
                                            <p>-</p>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($depositdetail->transition_id ?? '-'); ?></td>

                                    <td><?php echo e($depositdetail->bank_name ?? '-'); ?></td>
                                    <td><?php echo e($depositdetail->branch_name ?? '-'); ?></td>
                                    <td><?php echo e($depositdetail->check_no ?? '-'); ?></td>

                                    <td><?php echo e($depositdetail->payment_date ?? '-'); ?></td>
                                    <td class="text-right"><?php echo e($depositdetail->daily_fee ?? ''); ?></td>
                                    <td class="text-right"><?php echo e($depositdetail->daily_fine ?? 0); ?></td>
                                    <td class="text-right">
                                        <?php echo e(number_format(($depositdetail->daily_fee ?? 0) + ($depositdetail->daily_fine ?? 0), 2)); ?>

                                    </td>


                                </tr>
                                <?php echo $__env->make('dailydeposit.deposit_collection_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr class="">
                                <th class="text-right" colspan="10">Total</th>
                                <th class="text-right"><?php echo e(number_format($total_daily_fee ?? 0, 2)); ?></th>
                                <th class="text-right"><?php echo e(number_format($total_daily_fine ?? 0, 2)); ?></th>
                                <th class="text-right"><?php echo e(number_format($grandtotal ?? 0, 2)); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


    </section>


    <div class="modal fade" id="addDepositDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="">Add General Member Deposit Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?php echo e(route('singlecustomerdailydepositstore')); ?>" class="" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" id="deposit_month" name="deposit_month" value="<?php echo e($item->months); ?>">
                            <input type="hidden" id="deposit_year" name="deposit_year" value="<?php echo e($item->years); ?>">
                            <input type="hidden" id="deposite_date" name="deposite_date"
                                value="<?php echo e($item->deposite_date); ?>">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('General Members')); ?> <sup class="text-danger">*</sup></strong>
                                    </label>
                                    <select required class="form-control getmember_value" id="customer-group-id"
                                        name="member_id">
                                        <option>Select</option>
                                        <?php $__currentLoopData = $generalMemberLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($data->id); ?>"
                                                data-fee="<?php echo e($data->daily_deposit_fee); ?>" class="generalMembers">
                                                <?php echo e($data->name . ' (' . $data->member_code . ')'); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('Deposit Amount')); ?> <sup class="text-danger">*</sup></strong>
                                    </label>
                                    <input type="text" class="form-control" id="monthlyDepositFee" name="daily_fee"
                                        value="" readonly>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var paymentType = $('.payment_type').find('option:selected').val();
            $('.payment_type_value').val(paymentType);
            $('.banking').hide();
            $('.mobile_banking').hide();

            $('.payment_type').on('change', function() {
                var paymentType = $(this).find('option:selected').val();

                $('.payment_type_value').val(paymentType);

                if (paymentType == 1) {
                    $('.banking').hide();
                    $('.mobile_banking').hide();
                } else if (paymentType == 2) {
                    $('.banking').show();
                    $('.mobile_banking').hide();
                } else {
                    $('.banking').hide();
                    $('.mobile_banking').show();
                }
            });
        });
    </script>

    <script>
        $("ul#deposit").siblings('a').attr('aria-expanded', 'true');
        $("ul#deposit").addClass("show");
        $("ul#deposit #daily-deposit-list-menu").addClass("active");

        // grand_total
        // $(document).on('keyup', '.daily_fine', function() {
        //     var daily_fine = $('.daily_fine').val();
        //     var daily_fee = $('.daily_fee').val();
        //     if (!daily_fine) daily_fine = 0;
        //     var total = (parseFloat(daily_fee) + parseFloat(daily_fine));
        //     $('.grand_total').val(total);

        // })

        $(document).ready(function() {
            /* ...... */
            $('.getmember_value').on('change', function() {

                var depositFee = $(this).find('option:selected').data('fee');
                $("#monthlyDepositFee").val(depositFee);
                // alert(depositFee);

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\somiti\resources\views/dailydeposit/deposit_details.blade.php ENDPATH**/ ?>