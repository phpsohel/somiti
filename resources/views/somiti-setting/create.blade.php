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
                            <h4> Somiti Master Setting </h4>
                        </div>
                        <div class="card-body">
                            <p class="italic "><small class="text-danger">The field labels marked with * are required input
                                    fields.</small></p>

                            @if (!empty($item->id))
                                {!! Form::model($item, [
                                    'method' => 'PATCH',
                                    'enctype' => 'multipart/form-data',
                                    'route' => ['somiti-setting.update', $item->id],
                                ]) !!}
                            @else
                                {!! Form::open(['route' => 'somiti-setting.store', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
                            @endif
                            @csrf

                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date <sup class="text-danger">*</sup></strong> </label>

                                        {!! Form::date('start_date', null, ['placeholder' => '', 'class' => 'form-control', 'required']) !!}

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Daily Fee <sup class="text-danger">*</sup></strong> </label>

                                        {!! Form::number('daily_fee', null, ['placeholder' => '', 'class' => 'form-control', 'required']) !!}

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Weekly Fee <sup class="text-danger">*</sup></strong> </label>

                                        {!! Form::number('weekly_fee', null, ['placeholder' => '', 'class' => 'form-control', 'required']) !!}

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Monthly Fee <sup class="text-danger">*</sup></strong> </label>


                                        {!! Form::number('monthly_fee', null, ['placeholder' => '', 'class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Yearly Fee <sup class="text-danger">*</sup></strong> </label>
                                        {!! Form::number('yearly_fee', null, ['placeholder' => '', 'class' => 'form-control', 'required']) !!}

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Meeting Fee <sup class="text-danger">*</sup></strong> </label>
                                        {!! Form::number('meeting_fee', null, ['placeholder' => '', 'class' => 'form-control', 'required']) !!}

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Registration Fee <sup class="text-danger">*</sup></strong> </label>

                                        {!! Form::number('registration_fee', null, ['placeholder' => '', 'class' => 'form-control', 'required']) !!}

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">
                                        @if (!empty($item->id))
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Save') }}
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Save') }}
                                            </button>
                                        @endif

                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script type="text/javascript">
        $("ul#setting").siblings('a').attr('aria-expanded', 'true');
        $("ul#setting").addClass("show");
        $("ul#setting #general-settings-menu").addClass("active");

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




        //$("#name").val(getSavedValue("name"));
        //$("#customer-group-id").val(getSavedValue("customer-group-id"));

        function saveValue(e) {
            var id = e.id; // get the sender's id to save it.
            var val = e.value; // get the value.
            localStorage.setItem(id, val); // Every time user writing something, the localStorage's value will override.
        }
        //get the saved value function - return the value of "v" from localStorage.
        function getSavedValue(v) {
            if (!localStorage.getItem(v)) {
                return ""; // You can change this to your defualt value.
            }
            return localStorage.getItem(v);
        }
    </script>
@endsection
