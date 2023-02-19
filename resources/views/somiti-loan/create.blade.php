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
                            <h4> Add Loan For Member</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small
                                    class="text-danger">{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                            </p>
                            {!! Form::open(['route' => 'somiti-loan.store', 'method' => 'post', 'files' => true]) !!}
                            <div class="row">
                                @php
                                    $dt = \Carbon\Carbon::now();
                                    $date = Carbon\Carbon::parse($dt)->format('Y-m-d');
                                    // dd($date);
                                @endphp
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('Member Type') }} <sup class="text-danger">*</sup></strong> </label>
                                        <select required class="form-control getmember_value" id="customer-group-id"
                                            name="getmember_value">
                                            <option value="1">General Member</option>
                                            <option value="2">Borrow Member</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 all_member_list">
                                    <div class="form-group">
                                        <label>{{ trans('Member') }} </label>
                                        <span class="text-danger">*</span><br>
                                        <select class="form-control selectpicker" name="member_id" required
                                            data-live-search="true" data-live-search-style="begins" title="Select Member">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Loan Code <sup class="text-danger">*</sup></label>
                                    <input type="text" step="any" name="loan_code" value="{{ $code ?? '' }}"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Disbursed By <sup class="text-danger">*</sup></label>
                                    <select name="disburse" id="" class="form-control" required>
                                        <option value="1">Cash</option>
                                        <option value="2">Cheque</option>
                                    </select>

                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Loan Release Date <sup class="text-danger">*</sup></label>
                                    <input type="date" step="any" name="loan_release_date"
                                        value="{{ date('Y-m-d') }}" class="form-control" required>
                                </div>
                                {{-- Principal Amount --}}
                                <div class="col-md-6 form-group">
                                    <label> Principal Amount <sup class="text-danger">*</sup></label>
                                    <input type="number" step="any" name="principal_amount"
                                        value="{{ old('principal_amount') }}" class="form-control principal_amount"
                                        required>

                                </div>
                                {{-- loan_interest_type --}}
                                <div class="col-md-6 form-group">
                                    <label>Loan Interest Type <sup class="text-danger">*</sup></label>
                                    <select class="form-control selectpicker" id="loan_interest_type"
                                        name="loan_interest_type">
                                        <option value="2">Interest Only</option>
                                        <option value="1">Flat</option>

                                    </select>
                                </div>
                                {{-- loan_interest --}}
                                <div class="col-md-6 form-group" id="loan_interest">
                                    <label>Loan Interest % <sup class="text-danger">*</sup></label>
                                    <input type="text" step="any" name="loan_interest"
                                        value="{{ old('loan_interest') }}" class="form-control loan_interest" required>

                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Loan Duration Type <sup class="text-danger">*</sup></label>
                                    <select class="form-control selectpicker" name="loan_duration_type" required>
                                        <option selected value="1">Days</option>
                                        <option value="2">Week </option>
                                        <option value="3">Month </option>
                                        <option value="4">Year </option>
                                    </select>
                                </div>
                                {{-- loan_interest_amount --}}
                                <div class="col-md-6 form-group">
                                    <label>Loan Interest Amount <sup class="text-danger">*</sup></label>
                                    <input type="text" id="loan_interest_amount" name="loan_interest_amount"
                                        value="{{ old('loan_interest_amount') }}" readonly
                                        class="form-control loan_interest_amount" required>

                                </div>


                                <div class="col-md-6 form-group">
                                    <label>Loan Duration <sup class="text-danger">*</sup></label>
                                    <input type="number" name="loan_duration" value="{{ old('loan_duration') }}"
                                        class="form-control" required>

                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Grand Total <sup class="text-danger">*</sup></label>
                                    <input type="number" name="grand_total" class="form-control grand_total"
                                        value="{{ old('grand_total') }}" required readonly>

                                </div>

                            </div>
                            <div class="form-group">
                                <a href="{{ route('somiti-loan.index') }}" class="btn btn-success btn-sm"> <i
                                        class="fa fa-undo px-2"></i> Back</a>

                                <button type="submit"
                                    class="btn btn-primary btn-sm pull-right">{{ trans('file.submit') }}</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $("ul#loan").siblings('a').attr('aria-expanded', 'true');
        $("ul#loan").addClass("show");
        $("ul#loan #loan-create-menu").addClass("active");

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
                    $('#loan_interest_amount').removeAttr('readonly');
                } else {
                    $('.loan_interest').removeAttr('readonly');
                    $('#loan_interest_amount').attr('readonly', true);
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
            // console.log(member_type);
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
                    // console.log(data)
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    </script>
@endsection
