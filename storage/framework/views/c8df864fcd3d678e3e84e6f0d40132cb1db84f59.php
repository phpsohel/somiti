<div class="modal fade" id="addDepositDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="">Add General Member Deposit Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="<?php echo e(route('singleMemberYearlyDepositStore')); ?>" class="" method="POST">
            <?php echo csrf_field(); ?>
               
            <div class="modal-body">
                <div class="row">


                    <input type="hidden" id="deposit_year" name="years" value="<?php echo e($item->years); ?>">
                    <input type="hidden" id="deposite_date" name="deposite_date" value="<?php echo e(date('Y-m-d')); ?>">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(trans('General Members')); ?> <sup class="text-danger">*</sup></strong> </label>
                            <select required class="form-control getmember_value" id="customer-group-id" name="member_id" >
                                <option>Select</option>
                                <?php $__currentLoopData = $generalMemberLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>" data-fee="<?php echo e($data->yearly_deposit_fee); ?>" class="generalMembers"><?php echo e($data->name." (".$data->member_code.")"); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(trans('Deposit Amount')); ?> <sup class="text-danger">*</sup></strong> </label>
                            <input type="text" class="form-control" id="monthlyDepositFee" name="yearly_fee" value="" readonly>
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
</div><?php /**PATH C:\xampp\htdocs\somiti\resources\views/yearlydeposit/yearly_add_deposit_new_member.blade.php ENDPATH**/ ?>