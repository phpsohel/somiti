@extends('layout.main') @section('content')
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{ trans('Add Member') }}</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small
                                    class="text-danger">{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                            </p>
                            {!! Form::open(['route' => 'memberinfo.store', 'method' => 'post', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('Member Type') }} <sup class="text-danger">*</sup></strong> </label>
                                        <select required class="form-control selectpicker" id="customer-group-id"
                                            name="member_type">
                                            <option value="1">General Member</option>
                                            <option value="2">Borrow Member</option>

                                        </select>
                                    </div>
                                </div>
                                {{-- Member Code --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('Member Code') }}</strong> </label>
                                        <input type="hidden" id="get_member_code" value="{{ $code }}" disabled>
                                        <input type="text" id="member_code" name="member_code" value="" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.name') }} <sup class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                                            required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">{{ trans('Daily Deposit Fee') }} <sup
                                                class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="daily_deposit_fee" name="daily_deposit_fee"
                                            value="{{ $somiti_setting->daily_fee ?? '' }}" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">{{ trans('Weekly Deposit Fee') }} <sup
                                                class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="weekly_deposit_fee" name="weekly_deposit_fee"
                                            value="{{ $somiti_setting->weekly_fee ?? '' }}" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">{{ trans('Monthly Deposit Fee') }} <sup
                                                class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="monthly_deposit_fee" name="monthly_deposit_fee"
                                            value="{{ $somiti_setting->monthly_fee ?? '' }}" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">{{ trans('Yearly Deposit Fee') }} <sup
                                                class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="yearly_deposit_fee" name="yearly_deposit_fee"
                                            value="{{ $somiti_setting->yearly_fee ?? '' }}" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold"> Daily Deposit Status</label>
                                        <select name="daily_status" class="form-control">
                                            <option value="2">In-Active</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold"> Weekly Deposit Status</label>
                                        <select name="weekly_status" class="form-control">
                                            <option value="2">In-Active</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold"> Monthly Deposit Status</label>
                                        <select name="monthly_status" class="form-control">
                                            <option value="2">In-Active</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold"> Yearly Deposit Status</label>
                                        <select name="yearly_status" class="form-control">
                                            <option value="2">In-Active</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">{{ trans('Meeting Deposit Fee') }} <sup
                                                class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="meeting_deposit_fee" name="meeting_fee"
                                            value="{{ $somiti_setting->meeting_fee ?? '' }}" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('Registration Fee') }} <sup class="text-danger">*</sup></strong>
                                        </label>
                                        <input type="text" id="joining_fee" name="joining_fee"
                                            value="{{ $somiti_setting->registration_fee ?? '' }}" required
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Phone Number') }} <sup class="text-danger">*</sup></label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                            required class="form-control">
                                        @if ($errors->has('phone_number'))
                                            <span>
                                                <strong class="text-danger">{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Emergency Contact <sup class="text-danger">*</sup></label>
                                        <input type="text" name="emergency_number"
                                            value="{{ old('emergency_number') }}" required class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('Reference') }} <sup class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="" name="reference"
                                            value="{{ old('reference') }}" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('Permanent Address') }} <sup class="text-danger">*</sup></label>
                                        <input type="text" name="permanent_address" required class="form-control"
                                            value="{{ old('permanent_address') }}">
                                        @if ($errors->has('permanent_address'))
                                            <span>
                                                <strong class="text-danger">{{ $errors->first('permanent_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('Present Address') }} <sup class="text-danger">*</sup></label>
                                        <input type="text" name="address" required class="form-control"
                                            value="{{ old('address') }}">
                                        @if ($errors->has('address'))
                                            <span>
                                                <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Email') }}</label>
                                        <input type="email" name="email" placeholder="" value="{{ old('email') }}"
                                            class="form-control">
                                            @if ($errors->has('email'))
                                            <span>
                                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" value="{{ old('dob') }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Father's Name</label>
                                        <input type="text" name="father_name" value="{{ old('father_name') }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mother's Name</label>
                                        <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Others</option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $religious = ['Islam', 'Hinduism', 'Buddhism', 'Christianity', 'Jainism', 'Judaism', 'Sikhism', 'Others'];
                                @endphp

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Religion</label>
                                        <select name="religion" class="form-control">
                                            @foreach ($religious as $religiou)
                                                <option value="{{ $religiou ?? '' }}">{{ $religiou ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Marital Status</label>
                                        <select name="marital_status" class="form-control">
                                            <option value="1">Married</option>
                                            <option value="2">Unmarried</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>National ID No</label>
                                        <input type="text" name="national_id" value="{{ old('national_id') }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Passport Number</label>
                                        <input type="text" name="passport_no" value="{{ old('passport_no') }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Passport Issue Date</label>
                                        <input type="date" name="passport_issue_date"
                                            value="{{ old('passport_issue_date') }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Company Name') }}</label>
                                        <input type="text" name="company_name" value="{{ old('company_name') }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Tax Number') }}</label>
                                        <input type="text" name="tax_no" value="{{ old('tax_no') }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Country') }}</label>
                                        <input type="text" name="country" value="Bangladesh" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <input type="text" name="nationality" value="Bangladeshi"
                                            class="form-control">
                                    </div>
                                </div>
                                {{-- image --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('Member Picture') }}</label>
                                        <input type="file" name="image" id="image"
                                            onchange="previewImage(event)" class="form-control">
                                    </div>
                                </div>
                                <div id="preview"></div>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('memberinfo.index') }}" class="btn btn-success btn-sm"><i
                                        class="fa fa-undo px-2"></i> Back</a>

                                <input type="submit" value="{{ trans('file.submit') }}"
                                    class="btn btn-primary btn-sm pull-right">
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- member code generating --}}
    <script>
        var get_member_code = $('#get_member_code').val();
        $('#member_code').val('G' + get_member_code);

        $('#customer-group-id').on('change', function() {
            var member_type = $(this).val();
            var get_member_code = $('#get_member_code').val();

            if (member_type == 1) {
                $('#member_code').val('G' + get_member_code);
            } else {
                $('#member_code').val('B' + get_member_code);
            }
        });
    </script>

    {{-- image-preview --}}
    <script>
        function previewImage(event) {

            // console.log(event);
            var image = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById('preview');

            var newImage = document.createElement('img');
            preview.innerHTML = "";

            newImage.src = image;
            newImage.width = "150";
            newImage.height = "80";

            preview.appendChild(newImage);
        }
    </script>

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
    </script>
@endsection
