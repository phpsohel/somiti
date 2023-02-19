<div class="modal fade" id="loanDeposite_<?php echo e($depositdetail->id); ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="">
                    <?php echo e(($depositdetail->member->name ?? '') . ' (' . ($depositdetail->member->member_code ?? '') . ')'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('meetingDepositPayment')); ?>" class="" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" name="deposit_details_id" value="<?php echo e($depositdetail->id); ?>">
                        <input type="hidden" name="deposit_id" value="<?php echo e($depositdetail->meeting_deposit_id); ?>">
                        <div class="col-md-6 form-group">
                            <label>Payment Date <sup class="text-danger">*</sup></label>
                            <input type="date" name="payment_date" value="<?php echo e(date('Y-m-d')); ?>" class="form-control"
                                required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label> Meeting Fee <sup class="text-danger">*</sup></label>
                            <input type="number" step="any" name="meeting_fee"
                                value="<?php echo e(old('meeting_fee', $depositdetail->meeting_fee)); ?>"
                                class="form-control daily_fee" required readonly>

                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label> Payment type reer<sup class="text-danger">*</sup></label>
                            <input type="hidden" name="payment_type" class="payment_type_value">
                            <select name="payment_type" class="form-control payment_type" required>
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                                <option value="3">Bkash</option>
                                <option value="4">Rocket</option>
                                <option value="5">Nogot</option>
                                <option value="6">Others</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Fine Amount </label>
                            <input type="number" name="meeting_fine" class="form-control meeting_fine" value="">
                        </div>
                        
                        <div class="col-md-6 form-group banking">
                            <label>Bank Name </label>
                            <input type="text" name="bank_name" class="form-control" value="">
                        </div>
                        <div class="col-md-6 form-group banking">
                            <label>Branch Name </label>
                            <input type="text" name="branch_name" class="form-control" value="">
                        </div>
                        <div class="col-md-6 form-group banking">
                            <label>Cheque No. </label>
                            <input type="text" name="check_no" class="form-control" value="">
                        </div>
                        
                        <div class="col-md-6 form-group mobile_banking">
                            <label>Phone Number</label>
                            <input type="number" name="phone_number" class="form-control" value="">
                        </div>
                        <div class="col-md-6 form-group mobile_banking">
                            <label>Transaction ID</label>
                            <input type="text" name="transition_id" class="form-control">
                        </div>

                        

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <?php if($depositdetail->payment_status == 1): ?>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\somiti\resources\views/meetingDeposit/deposit_collection_modal.blade.php ENDPATH**/ ?>