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
                            <h4>{{ trans('Update Member') }}</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small
                                    class="text-danger">{{ trans('file.The field labels marked with * are required input fields') }}.</small>
                            </p>
                            {!! Form::open(['route' => ['memberinfo.update', $lims_customer_data->id], 'method' => 'put', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" name="customer_group"
                                            value="{{ $lims_customer_data->customer_group_id }}">
                                        <label>{{ trans('Member Type') }} <sup class="text-danger">*</sup></strong> </label>
                                        <select required class="form-control selectpicker" id="customer-group-id"
                                            name="member_type">

                                            <option value="1"
                                                {{ $lims_customer_data->member_type == 1 ? 'Selected' : '' }}>General Member
                                            </option>
                                            <option value="2"
                                                {{ $lims_customer_data->member_type == 2 ? 'Selected' : '' }}>Borrow Member
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Member Code</strong> </label>
                                        <input type="text" name="member_code" id="member_code"
                                            value="{{ $lims_customer_data->member_code }}" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.name') }} *</strong> </label>
                                        <input type="text" name="name" value="{{ $lims_customer_data->name }}"
                                            required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">{{ trans('Daily Deposit Fee') }} <sup
                                                class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="daily_deposit_fee" name="daily_deposit_fee"
                                            value="{{ $lims_customer_data->daily_deposit_fee ?? '' }}" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">{{ trans('Weekly Deposit Fee') }} <sup
                                                class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="weekly_deposit_fee" name="weekly_deposit_fee"
                                            value="{{ $lims_customer_data->weekly_deposit_fee ?? '' }}" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">{{ trans('Monthly Deposit Fee') }} <sup
                                                class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="monthly_deposit_fee" name="monthly_deposit_fee"
                                            value="{{ $lims_customer_data->monthly_deposit_fee ?? '' }}" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">{{ trans('Yearly Deposit Fee') }} <sup
                                                class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="yearly_deposit_fee" name="yearly_deposit_fee"
                                            value="{{ $lims_customer_data->yearly_deposit_fee ?? '' }}" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold"> Daily Deposit Status</label>
                                        <select name="daily_status" class="form-control">
                                            <option value="2"
                                                {{ $lims_customer_data->daily_status == 2 ? 'Selected' : '' }}>In-Active
                                            </option>
                                            <option value="1"
                                                {{ $lims_customer_data->daily_status == 1 ? 'Selected' : '' }}>Active
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold"> Weekly Deposit Status</label>
                                        <select name="weekly_status" class="form-control">
                                            <option value="2"
                                                {{ $lims_customer_data->weekly_status == 2 ? 'Selected' : '' }}>In-Active
                                            </option>
                                            <option value="1"
                                                {{ $lims_customer_data->weekly_status == 1 ? 'Selected' : '' }}>Active
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold"> Monthly Deposit Status</label>
                                        <select name="monthly_status" class="form-control">
                                            <option value="2"
                                                {{ $lims_customer_data->monthly_status == 2 ? 'Selected' : '' }}>In-Active
                                            </option>
                                            <option value="1"
                                                {{ $lims_customer_data->monthly_status == 1 ? 'Selected' : '' }}>Active
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold"> Yearly Deposit Status</label>
                                        <select name="yearly_status" class="form-control">
                                            <option value="2"
                                                {{ $lims_customer_data->yearly_status == 2 ? 'Selected' : '' }}>In-Active
                                            </option>
                                            <option value="1"
                                                {{ $lims_customer_data->yearly_status == 1 ? 'Selected' : '' }}>Active
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="text-bold">{{ trans('Meeting Deposit Fee') }} <sup
                                                class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="meeting_deposit_fee" name="meeting_fee"
                                            value="{{ $lims_customer_data->meeting_fee ?? '' }}" required
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Email') }}</label>
                                        <input type="email" name="email" value="{{ $lims_customer_data->email }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('Reference') }} <sup class="text-danger">*</sup></strong> </label>
                                        <input type="text" id="" name="reference"
                                            value="{{ $lims_customer_data->reference ?? '' }}" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Phone Number') }} <sup class="text-danger">*</sup></label>
                                        <input type="text" name="phone_number" required
                                            value="{{ $lims_customer_data->phone_number }}" class="form-control">
                                        @if ($errors->has('phone_number'))
                                            <span>
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Emergency Contact <sup class="text-danger">*</sup></label>
                                        <input type="text" name="emergency_number"
                                            value="{{ $lims_customer_data->emergency_number }}" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('Permanent Address') }} <sup class="text-danger">*</sup></label>
                                        <input type="text" name="permanent_address" required class="form-control"
                                            value="{{ old('permanent_address', $lims_customer_data->permanent_address) }}">
                                        @if ($errors->has('permanent_address'))
                                            <span>
                                                <strong>{{ $errors->first('permanent_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('Present Address') }} <sup class="text-danger">*</sup></label>
                                        <input type="text" name="address" required
                                            value="{{ $lims_customer_data->address }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Father's Name</label>
                                        <input type="text" name="father_name"
                                            value="{{ $lims_customer_data->father_name }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mother's Name</label>
                                        <input type="text" name="mother_name"
                                            value="{{ $lims_customer_data->mother_name }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" value="{{ $lims_customer_data->dob }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Gender</label>
                                        <input type="hidden" name="gender_hidden"
                                            value="{{ $lims_customer_data->gender }}" />
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
                                        <input type="hidden" name="religion_hidden"
                                            value="{{ $lims_customer_data->religion }}" />
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
                                        <input type="hidden" name="marital_status_hidden"
                                            value="{{ $lims_customer_data->marital_status }}" />
                                        <select name="marital_status" class="form-control">
                                            <option value="1">Married</option>
                                            <option value="2">Unmarried</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <input type="text" name="nationality"
                                            value="{{ $lims_customer_data->nationality }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>National Id</label>
                                        <input type="text" name="national_id"
                                            value="{{ $lims_customer_data->national_id }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Passport Number</label>
                                        <input type="text" name="passport_no"
                                            value="{{ $lims_customer_data->passport_no }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Passport Issue Date</label>
                                        <input type="date" name="passport_issue_date"
                                            value="{{ $lims_customer_data->passport_issue_date }}" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Company Name') }} </label>
                                        <input type="text" name="company_name"
                                            value="{{ $lims_customer_data->company_name }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Tax Number') }}</label>
                                        <input type="text" name="tax_no" class="form-control"
                                            value="{{ $lims_customer_data->tax_no }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.City') }} </label>
                                        <input type="text" name="city" value="{{ $lims_customer_data->city }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.State') }}</label>
                                        <input type="text" name="state" value="{{ $lims_customer_data->state }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Postal Code') }}</label>
                                        <input type="text" name="postal_code"
                                            value="{{ $lims_customer_data->postal_code }}" class="form-control">
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

                                @if ($lims_customer_data->image != null)
                                    <div class="col-md-4" id="previous_image">
                                        <div class="form-group">
                                            <img src="{{ url('public/images/customer', $lims_customer_data->image) }}"
                                                height="60" width="60">
                                        </div>
                                    </div>
                                @endif


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{ trans('file.Country') }}</label>
                                        <input type="text" name="country" value="{{ $lims_customer_data->country }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Member Status</label>

                                        <select name="is_active" class="form-control">
                                            <option value="1"
                                                {{ $lims_customer_data->is_active == 1 ? 'Selected' : '' }}>Active</option>
                                            <option value="0"
                                                {{ $lims_customer_data->is_active == 0 ? 'Selected' : '' }}>In-Active
                                            </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mt-3">
                                        <a href="{{ route('memberinfo.index') }}" class="btn btn-success btn-sm"><i
                                                class="fa fa-undo px-2"></i> Back</a>
                                        <input type="submit" value="{{ trans('file.submit') }}"
                                            class="btn btn-primary btn-sm pull-right">
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- image-preview --}}
    <script>
        function previewImage(event) {

            // console.log(event);
            var image = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById('preview');
            var previous_Uploaded_Image = document.getElementById('previous_image');

            var newImage = document.createElement('img');
            preview.innerHTML = "";
            previous_Uploaded_Image.style.display = "none";

            newImage.src = image;
            newImage.width = "150";
            newImage.height = "80";

            preview.appendChild(newImage);
        }
    </script>

    <script type="text/javascript">
        $("ul#people").siblings('a').attr('aria-expanded', 'true');
        $("ul#people").addClass("show");

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

        //assigning value
        $('select[name="gender"]').val($('input[name="gender_hidden"]').val());
        $('select[name="religion"]').val($('input[name="religion_hidden"]').val());
        $('select[name="marital_status"]').val($('input[name="marital_status_hidden"]').val());
        $('.selectpicker').selectpicker('refresh');

        var customer_group = $("input[name='customer_group']").val();
        $('select[name=customer_group_id]').val(customer_group);
    </script>
@endsection
