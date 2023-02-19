<div class="modal fade" id="loanDeposite_<?php echo e($loandetail->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id=""><?php echo e(($item->member->name ?? '').' ('.($item->member->member_code ?? '').')'); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo e(route('memberLoanDeposite')); ?>" class="" method="POST">
            <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="row">

                <input type="hidden" name="loan_details_id" value="<?php echo e($loandetail->id); ?>">
                <div class="col-md-6 form-group">
                    <label>Loan Payment Date <sup class="text-danger">*</sup></label>
                    <input type="date" step="any" name="payment_date" value="<?php echo e(old('payment_start_date',$loandetail->payment_start_date)); ?>" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                    <label> Principal Amount <sup class="text-danger">*</sup></label>
                    <input type="number" step="any" name="principal_amount" value="<?php echo e(old('principal_amount',$loandetail->principal_amount)); ?>" class="form-control principal_amount" required readonly>
                
                </div>

                <div class="col-md-6 form-group">
                    <label>Loan Interest % <sup class="text-danger">*</sup></label>
                    <input type="text" step="any" name="loan_interest" value="<?php echo e(old('loan_interest',$loandetail->loan_interest)); ?>" class="form-control loan_interest" required readonly>

                </div>
                <div class="col-md-6 form-group">
                    <label>Loan Interest Amount <sup class="text-danger">*</sup></label>
                    <input type="text" step="any" name="loan_interest_amount" value="<?php echo e(old('loan_interest_amount',$loandetail->loan_interest_amount)); ?>" readonly class="form-control loan_interest_amount" required>

                </div>
             
                <div class="col-md-6 form-group">
                    <label>Fine Amount  </label>
                    <input type="number"  name="loan_fine_amount" class="form-control loan_fine_amount" value="" >

                </div>
            
                <div class="col-md-6 form-group">
                    <label>Grand Total  <sup class="text-danger">*</sup></label>
                    <input type="number"  name="grand_total" class="form-control grand_total" value="<?php echo e(old('grand_total',$loandetail->grand_total)); ?>" required readonly>

                </div>
                


            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          <?php if($loandetail->payment_status == 1): ?>
          <button type="submit" class="btn btn-primary btn-sm">Save</button>
          <?php endif; ?>
        </div>
      </form>
      </div>
    </div>
  </div><?php /**PATH C:\xampp\htdocs\somiti\resources\views/somiti-loan/loan_deposite_modal.blade.php ENDPATH**/ ?>