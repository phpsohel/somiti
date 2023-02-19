@extends('layout.main')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}
        </div>
    @endif
    @if (session()->has('create_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{!! session()->get('create_message') !!}</div>
    @endif
    @if (session()->has('edit_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
    @endif
    @if (session()->has('import_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{!! session()->get('import_message') !!}</div>
    @endif
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-capitalize">
                    Edit and update deposit data
                </h5>
            </div>
            <form action="{{ route('updatemonthlydepositPayment', $details->id) }}" class="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Payment Date <sup class="text-danger">*</sup></label>
                            <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" class="form-control"
                                required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label> monthly Fee <sup class="text-danger">*</sup></label>
                            <input type="number" step="any" name="monthly_fee" value="{{ $details->monthly_fee }}"
                                class="form-control monthly_fee" required readonly>

                        </div>
                        {{-- payment type --}}
                        <div class="col-md-6 form-group">
                            <label> Payment type<sup class="text-danger">*</sup></label>
                            <input type="hidden" name="payment_type" class="payment_type_value"
                                value="{{ $details->payment_type }}">
                            <select name="" class="form-control payment_type" required>
                                <option value="1" {{ $details->payment_type == 1 ? 'Selected' : '' }}>Cash</option>
                                <option value="2" {{ $details->payment_type == 2 ? 'Selected' : '' }}>Bank / Cheque
                                </option>
                                <option value="3" {{ $details->payment_type == 3 ? 'Selected' : '' }}>Bkash</option>
                                <option value="4" {{ $details->payment_type == 4 ? 'Selected' : '' }}>Rocket</option>
                                <option value="5" {{ $details->payment_type == 5 ? 'Selected' : '' }}>Nogot</option>
                                <option value="6" {{ $details->payment_type == 6 ? 'Selected' : '' }}>Others</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Fine Amount </label>
                            <input type="number" name="monthly_fine" class="form-control"
                                value="{{ $details->monthly_fine }}">
                        </div>
                        <div class="col-md-6 form-group banking">
                            <label>Bank Name </label>
                            <input type="text" name="bank_name" class="form-control" value="{{ $details->bank_name }}">
                        </div>

                        <div class="col-md-6 form-group banking">
                            <label>Branch Name </label>
                            <input type="text" name="branch_name" class="form-control"
                                value="{{ $details->branch_name }}">
                        </div>

                        <div class="col-md-6 form-group banking">
                            <label>Cheque No. </label>
                            <input type="text" name="check_no" class="form-control" value="{{ $details->check_no }}">
                        </div>
                        <div class="col-md-6 form-group mobile_banking">
                            <label>Phone Number</label>
                            <input type="number" name="phone_number" class="form-control"
                                value="{{ $details->phone_number }}">
                        </div>
                        <div class="col-md-6 form-group mobile_banking">
                            <label>Transaction ID</label>
                            <input type="text" name="transition_id" class="form-control"  value="{{ $details->transition_id }}">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // $('.banking').hide();
            // $('.mobile_banking').hide();
            var payment_type = $('.payment_type_value').val();
            console.log(payment_type);
            if (payment_type == 1) {
                $('.banking').hide();
                $('.mobile_banking').hide();
            } else if (payment_type == 2) {
                $('.banking').show();
                $('.mobile_banking').hide();
            } else {
                $('.banking').hide();
                $('.mobile_banking').show();
            }

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
@endsection
