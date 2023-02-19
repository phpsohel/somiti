@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Update Deposit</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        <form action="{{ route('deposite.update', $edit->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Member name</strong> </label>
                                        <select required name="member_id" class="form-control selectpicker" name="customer_group_id">
                                            @foreach ($member_name as $member_nam )
                                            <option value="{{ $member_nam->id }}" {{ $member_nam->id == $edit->member_id ? "Selected":'' }}>{{ $member_nam->name ?? '' }}({{$member_nam->member_code ?? '' }})</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                @php
                                $months = array(
                                'January',
                                'February',
                                'March',
                                'April',
                                'May',
                                'June',
                                'July',
                                'August',
                                'September',
                                'October',
                                'November',
                                'December'
                                );
                                @endphp
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Month</strong> </label>
                                        <select name="month" class="form-control">
                                            @foreach ($months as $month)
                                            <option value="{{ $edit->month }}" {{ $month == $edit->month? "Selected":'' }}>{{ $month ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <select name="year" class="form-control">
                                            @for($year = 2010 ; $year <=2050 ; $year++) <option value="{{ $year }}" {{ $year ==  $edit->year? "Selected":'' }}>{{ $year ?? '' }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" name="date" value="{{ $edit->date }}" class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Monthly Fee</label>
                                        <input type="number" name="mothly_fee" value="{{ $edit->mothly_fee }}" class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Monthly Fine</label>
                                        <input type="number" name="monthly_fine" value="{{ $edit->monthly_fine }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select required name="status" class="form-control selectpicker" name="customer_group_id">
                                            <option value="1" {{ $edit->status == 1? 'selected': '' }}>Cash</option>
                                            <option value="2" {{ $edit->status == 2? 'selected': '' }}>Online</option>
                                            <option value="3" {{ $edit->status == 3? 'selected': '' }}>Bkash</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update Deposit" class="btn btn-primary btn-sm">
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
