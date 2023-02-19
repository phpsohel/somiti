<div class="modal fade" id="loanDeposite_{{ $depositdetail->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="">
                    {{ ($depositdetail->member->name ?? '') . ' (' . ($depositdetail->member->member_code ?? '') . ')' }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dailydepositPayment') }}" class="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" name="deposit_details_id" value="{{ $depositdetail->id }}">
                        <input type="hidden" name="deposit_id" value="{{ $depositdetail->daily_deposit_id }}">
                        <div class="col-md-6 form-group">
                            <label>Payment Date <sup class="text-danger">*</sup></label>
                            <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" class="form-control"
                                required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label> Daily Fee <sup class="text-danger">*</sup></label>
                            <input type="number" step="any" name="daily_fee"
                                value="{{ old('daily_fee', $depositdetail->daily_fee) }}" class="form-control daily_fee"
                                required readonly>

                        </div>
                        {{-- payment type --}}
                        <div class="col-md-6 form-group">
                            <label> Payment type<sup class="text-danger">*</sup></label>
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
                            <input type="number" name="daily_fine" class="form-control daily_fine" value="">
                        </div>
                        {{-- for check --}}
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
                        {{-- for bkash & other --}}
                        <div class="col-md-6 form-group mobile_banking">
                            <label>Phone Number</label>
                            <input type="number" name="phone_number" class="form-control" value="">
                        </div>
                        <div class="col-md-6 form-group mobile_banking">
                            <label>Transaction ID</label>
                            <input type="text" name="transition_id" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    @if ($depositdetail->payment_status == 1)
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
