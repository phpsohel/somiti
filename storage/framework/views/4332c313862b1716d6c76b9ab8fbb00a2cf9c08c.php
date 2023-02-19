 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message')): ?>
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?></div>
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
<?php endif; ?>
<section>
    <div class="card">
       
        <div class="card-body">
            <div class="table-responsive">
     
                <table id="payroll-table" class="table">
                    <thead>
                        <tr class="">
                            <th class="text-center text-success" colspan="9">
                                <div class=""><?php echo e(($item->member->name ?? '').' ('.($item->member->member_code ?? '').')'); ?></div>
                                <strong>Loan Code :<?php echo e($item->loan_code ?? ''); ?></strong>
                               
                                <div class=""><?php echo e($item->loan_release_date ?? ''); ?></div>

                            </th>
                        </tr>
                        <tr>
                            <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                            <th><?php echo e(trans('Status')); ?></th>
                            <th><?php echo e(trans('Month')); ?></th>
                            <th><?php echo e(trans('Payment Date')); ?></th>
                            <th class="text-right"><?php echo e(trans('Principal Amount')); ?></th>
                            <th class="text-center"><?php echo e(trans('Interest Rate %')); ?></th>
                            <th class="text-right"><?php echo e(trans('Interest Amount')); ?></th>
                            <th class="text-right"><?php echo e(trans('Fine Amount')); ?></th>
                            <th class="text-right"><?php echo e(trans('Grand Total')); ?></th>
                       
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $principal_amount = 0;
                            $interest_amount = 0;
                            $fineamount = 0;
                            $groundtotal = 0;
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $loandetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $loandetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                        $principal_amount += $loandetail->principal_amount ?? 0;
                        $interest_amount += $loandetail->loan_interest_amount ?? 0;
                        $fineamount += $loandetail->loan_fine_amount ?? 0;
                        $groundtotal += $loandetail->grand_total ?? 0;
                
                        ?>
                        <tr data-id="">
                            <td>
                                <?php if($loandetail->payment_status == 2): ?>
                                    <a href="<?php echo e(url('somiti-loan/single/'.$loandetail->somiti_laon_id.'/detail/'.$loandetail->id)); ?>" target="_blank" class="btn btn-info btn-sm text-white w-100">Loan Detail</a>
                                <?php else: ?>
                                    <p  class="btn btn-success btn-sm w-100 text-white" data-toggle="modal" data-target="#loanDeposite_<?php echo e($loandetail->id); ?>">
                                        <?php echo e(trans('Loan Deposite')); ?>

                                    </p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($loandetail->payment_status == 1): ?>
                                <span class="text-danger">Due</span>
                                <?php elseif($loandetail->payment_status == 2): ?>
                                <span class="text-success">Paid</span>
                                <?php else: ?>
                                <span class="text-warning">Cancelled</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e(\Carbon\Carbon::parse($loandetail->payment_start_date)->format('F')); ?></td>
                            <td><?php echo e($loandetail->payment_start_date ?? ''); ?></td>
                            <td class="text-right"><?php echo e($loandetail->principal_amount ?? ''); ?></td>
                            <td class="text-center"><?php echo e($loandetail->loan_interest ?? ''); ?></td>
                            <td class="text-right"><?php echo e($loandetail->loan_interest_amount ?? ''); ?></td>
                            <td class="text-right"><?php echo e($loandetail->loan_fine_amount ?? ''); ?></td>
                            <td class="text-right"><?php echo e($loandetail->grand_total ?? ''); ?></td>
                          
                           
                        </tr>
                       <?php echo $__env->make('somiti-loan.loan_deposite_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                           <tr>
                            <td colspan="12" class="text-center text-danger"><h5>No data available in table.</h5></td>
                            
                           </tr> 
                        <?php endif; ?> 
                            
                    </tbody>
                    <tfoot>
                        <tr class="text-success">
                            <th class="" colspan="4">Total</th>
                            <th class="text-right"><?php echo e(number_format((float)($principal_amount ?? 0),2,'.','')); ?></th>
                            <th class="text-right"></th>
                            <th class="text-right"><?php echo e(number_format((float)($interest_amount ?? 0),2,'.','')); ?></th>
                            <th class="text-right"><?php echo e(number_format((float)($fineamount ?? 0),2,'.','')); ?></th>
                            <th class="text-right"><?php echo e(number_format((float)($groundtotal ?? 0),2,'.','')); ?></th>
                           
                        </tr>
                    </tfoot>
              
                </table>
            </div>
         
        </div>

    </div>

    
</section>




<script type="text/javascript">
    $("ul#hrm").siblings('a').attr('aria-expanded', 'true');
    $("ul#hrm").addClass("show");
    $("ul#hrm #payroll-menu").addClass("active");

    $(document).on('keyup', '.loan_fine_amount', function() {

            var loan_fine_amount = $(this).val();
            var total = $('.grand_total').val();
            var loan_interest_amount = $('.loan_interest_amount').val();
            var principal_amount = $('.principal_amount').val();
            if(!loan_fine_amount) loan_fine_amount = 0;
            var grandtotal = (parseFloat(loan_fine_amount) + parseFloat(loan_interest_amount) + parseFloat(principal_amount));
            if(!grandtotal) grandtotal=0;
            $(".grand_total").val(grandtotal);   

    }); 
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\somiti\resources\views/somiti-loan/member_loan_details.blade.php ENDPATH**/ ?>