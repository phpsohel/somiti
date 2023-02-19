@extends('layout.main') @section('content')
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
    @endif
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4> Update Loan For Member</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small
                                    class="text-danger">{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                            </p>


                            <form action="{{ route('somiti-loan.update', $somitiloan->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $somitiloan->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans('Member Type') }} <sup class="text-danger">*</sup></strong>
                                            </label>
                                            <select required class="form-control getmember_value" id="customer-group-id"
                                                name="getmember_value">
                                                <option value="1">General Member</option>
                                                <option value="2">Borrow Member</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group all_member_list">
                                            <label class="d-block"> Member <span class="text-danger">*</span></label>
                                            <select class="form-control " name="member_id" required title="Select Member">

                                                <option value="{{ $somitiloan->member_id }}" selected>
                                                    {{ $somitiloan->member->name ?? '' }}
                                                    ({{ $somitiloan->member->member_code ?? '' }})</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Loan Code <sup class="text-danger">*</sup></label>
                                        <input type="text" step="any" name="loan_code"
                                            value="{{ $somitiloan->loan_code ?? '' }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Disbursed By <sup class="text-danger">*</sup></label>
                                        <select name="disburse" id="" class="form-control" required>
                                            <option value="1" {{ $somitiloan->disburse == 1 ? 'Selected' : '' }}>Cash
                                            </option>
                                            <option value="2"{{ $somitiloan->disburse == 2 ? 'Selected' : '' }}>Cheque
                                            </option>
                                        </select>

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Loan Release Date <sup class="text-danger">*</sup></label>
                                        <input type="date" step="any" name="loan_release_date"
                                            value="{{ old('loan_release_date', $somitiloan->loan_release_date) }}"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label> Principal Amount <sup class="text-danger">*</sup></label>
                                        <input type="number" step="any" name="principal_amount"
                                            value="{{ old('principal_amount', $somitiloan->principal_amount) }}"
                                            class="form-control principal_amount" required>

                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Loan Interest Type <sup class="text-danger">*</sup></label>
                                        <select class="form-control selectpicker" name="loan_interest_type"
                                            id="loan_interest_type">
                                            <option selected value="1"
                                                {{ $somitiloan->loan_interest_type == 1 ? 'Selected' : '' }}>Flat</option>
                                            <option value="2"
                                                {{ $somitiloan->loan_interest_type == 2 ? 'Selected' : '' }}>
                                                Interest Only</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Loan Interest % <sup class="text-danger">*</sup></label>
                                        <input type="text" step="any" name="loan_interest"
                                            value="{{ old('loan_interest', $somitiloan->loan_interest) }}"
                                            class="form-control loan_interest" required>

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Loan Duration Type <sup class="text-danger">*</sup></label>
                                        <select class="form-control selectpicker" name="loan_duration_type" required>
                                            <option value="1"
                                                {{ $somitiloan->loan_duration_type == 1 ? 'Selected' : '' }}>
                                                Days</option>
                                            <option value="2"
                                                {{ $somitiloan->loan_duration_type == 2 ? 'Selected' : '' }}>
                                                Week </option>
                                            <option value="3"
                                                {{ $somitiloan->loan_duration_type == 3 ? 'Selected' : '' }}>
                                                Month </option>
                                            <option value="4"
                                                {{ $somitiloan->loan_duration_type == 4 ? 'Selected' : '' }}>
                                                Year </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Loan Interest Amount <sup class="text-danger">*</sup></label>
                                        <input type="text" step="any" name="loan_interest_amount"
                                            value="{{ old('loan_interest_amount', $somitiloan->loan_interest_amount) }}"
                                            readonly class="form-control loan_interest_amount" required>

                                    </div>


                                    <div class="col-md-6 form-group">
                                        <label>Loan Duration <sup class="text-danger">*</sup></label>
                                        <input type="number" name="loan_duration"
                                            value="{{ old('loan_duration', $somitiloan->loan_duration) }}"
                                            class="form-control" required>

                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Grand Total <sup class="text-danger">*</sup></label>
                                        <input type="number" name="grand_total" class="form-control grand_total"
                                            value="{{ old('grand_total', $somitiloan->grand_total) }}" required readonly>

                                    </div>

                                </div>
                                <div class="form-group">
                                    <a href="{{ route('somiti-loan.index') }}" class="btn btn-success btn-sm"> <i
                                            class="fa fa-undo px-2"></i> Back</a>
                                    <button type="submit"
                                        class="btn btn-primary btn-sm pull-right">{{ trans('file.submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $("ul#people").siblings('a').attr('aria-expanded', 'true');
        $("ul#people").addClass("show");
        $("ul#people #customer-create-menu").addClass("active");

        $(".user-input").hide();

        $('input[name="user"]').on('change', function() {
            if ($(this).is(':checked')) {
                $('.user-input').show(300);
                $('input[name="name"]').prop('required', true);
                $('input[name="password"]').prop('required', true);
            } else {
                $('.user-input').hide(300);
                $('input[name="name"]').prop('required', false);
                $('input[name="password"]').prop('required', false);
            }
        });

        // flat loan
        $(document).ready(function() {
            $('#loan_interest_type').on('change', function() {
                if ($(this).val() == 1) {
                    $('.loan_interest').attr('readonly', true);
                    $('.loan_interest_amount').removeAttr('readonly');
                } else {
                    $('.loan_interest').removeAttr('readonly');
                    $('.loan_interest_amount').attr('readonly', true);
                }
            });
        });


        // calculation
        $(document).on('keyup', '.principal_amount,.loan_interest,.loan_interest_amount', function() {
            var principal_amount = parseFloat($(".principal_amount").val());
            var loan_interest = parseFloat($(".loan_interest").val());
            var loan_interest_amount = parseFloat($(".loan_interest_amount").val());

            if ($("#loan_interest_type").val() == 2) {
                var interest = 0;
                interest = principal_amount * loan_interest / 100;
                if (!interest) interest = 0
                $(".loan_interest_amount").val(interest);
                var grandtotal = 0;
                grandtotal = (principal_amount + parseFloat(interest));
                if (!grandtotal) grandtotal = 0;
                $(".grand_total").val(grandtotal);
            } else {

                console.log(loan_interest_amount, principal_amount)
                var loanInterest = loan_interest_amount * 100 / principal_amount;
                var interest = principal_amount + loan_interest_amount;
                if (!loanInterest) loanInterest = 0;
                $(".loan_interest").val(loanInterest);
                $(".grand_total").val(interest);
            }
        });

        $(document).on('click', '.getmember_value', function() {

            var member_type = $(".getmember_value option:selected").val();
            console.log(member_type);
            $.ajax({
                type: 'get',
                url: "{{ route('getMemberbyAjax') }}",
                dataType: 'HTML',
                data: {
                    member_type: member_type
                },
                'global': false,
                asyn: true,
                success: function(data) {
                    $(".all_member_list").html(data)
                    console.log(data)
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    </script>
@endsection
