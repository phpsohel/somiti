@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-center">
                        <h4>Generate Monthly Deposit for all General Member</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small class="text-danger">{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        <form action="{{ route('deposite.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                @php
                                $years = [
                                '2020',
                                '2021',
                                '2022',
                                '2023',
                                '2024',
                                '2025',
                                '2026',
                                '2027',
                                '2028',
                                '2029',
                                '2030',
                                '2031',
                                '2032',
                                '2033',
                                '2034',
                                '2035',
                                '2036',
                                '2037',
                                '2038',
                                '2039',
                                '2040',
                                ];
                                @endphp
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Year <sup class="text-danger">*</sup></label>
                                        <select name="years" class="form-control">
                                            @foreach ($years as $year)
                                            <option value="{{ $year ?? '' }}" {{ $year == date('Y')? "Selected":'' }}>{{ $year ?? '' }}</option>
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
                                        <label>Month <sup class="text-danger">*</sup></strong> </label>
                                        <select name="month" class="form-control" required>
                                            @foreach ($months as $month)
                                            <option value="{{ $month ?? '' }}" {{ $month == date('F')? "Selected":'' }}>{{ $month ?? '' }} </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                          
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date <sup class="text-danger">*</sup></label>
                                        <input type="date" name="deposite_date" value="{{ date('Y-m-d') }}" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Remarks <sup class="text-danger">*</sup></label>
                                        <input type="text" name="note" value="{{ old('note') }}"  class="form-control">
                                    </div>
                                </div>
                            
                                <div class="col-md-12">
                              
                                <div class="form-group">
                                    <a href="{{ route('deposite.index') }}" class="btn btn-success btn-sm "><i class="fa fa-undo px-1"></i> Back</a>
                                    <input type="submit" value="Submit" class="btn btn-primary btn-sm pull-right">
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
    $("ul#general").siblings('a').attr('aria-expanded', 'true');
    $("ul#general").addClass("show");
    $("ul#general #general-add-menu").addClass("active");

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
