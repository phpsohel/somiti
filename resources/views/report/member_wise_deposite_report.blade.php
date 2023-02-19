@extends('layout.main') @section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header mt-2">
                    <h3 class="text-center">{{ trans('Member Wise Deposit Report') }}</h3>
                </div>
                {!! Form::open(['route' => 'report.memberwisedepositsearch', 'method' => 'post']) !!}
                <div class="row ml-4">
                    <div class="col-lg-2 col-md-2 offset-md-2">
                        <div class="form-group row">
                            <label class=""><strong>{{ trans('Start Date') }}</strong> &nbsp;</label>
                            <div class="d-tc">
                                <div class="input-group">
                                    <input type="date" name="start_date" value="{{ $start_date ?? '' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 ">
                        <div class="form-group row">
                            <label class=""><strong>{{ trans('End Date') }}</strong> &nbsp;</label>
                            <div class="d-tc">
                                <div class="input-group">
                                    <input type="date" name="end_date" value="{{ $end_date ?? '' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class=""><strong>{{ trans('Select Member') }}</strong> &nbsp;</label>
                            <div class="d-tc">

                                <select name="customer_id" class="form-control" data-live-search="true"
                                    data-live-search-style="begins">
                                    <option value="">Select All Member</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}"
                                            {{ $member->id == $customer_id ? 'Selected' : '' }}>
                                            {{ $member->member_code ?? '' }}( {{ $member->name ?? '' }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mt-4">
                        <div class="form-group d-flex">
                            <button class="btn btn-primary mt-2" type="submit">{{ trans('Show') }}</button>
                            <a id="click_print" class="btn btn-info btn-sm ml-3 mt-2 text-white"><i
                                    class="dripicons-print"></i> Print</a>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table id="table_print" class="table table-bordered table-sm table-striped text-nowrap">
                            <thead>
                                <tr class="">
                                    <th class="text-center" colspan="5">
                                        @if (!empty($setting->site_logo))
                                            <img alt="Brand" src="{{ asset('public/logo') }}/{{ $setting->site_logo }}"
                                                width="100" height="70">
                                        @else
                                            <img alt="Brand" src="{{ asset('public/logo/somity.jpg') }}" width="80"
                                                height="50">
                                        @endif

                                        <h3 class="">{{ $setting->site_title ?? '' }}</h3>
                                        <div class="">Member's Money Receive Information for all Type</div>
                                        <div class="">{{ $start_date ?? '' }} To {{ $end_date ?? '' }}</div>
                                    </th>
                                </tr>
                                <tr>
                                    <th>{{ trans('file.Date') }}</th>
                                    <th>{{ trans('file.Status') }}</th>
                                    <th>{{ trans('Receipt') }}</th>
                                    <th>{{ trans('Received From') }}</th>
                                    <th>{{ trans('Amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($depositdetails as $key => $depositdetail)
                                    @php
                                        $total += $depositdetail->monthly_fee ?? 0;
                                    @endphp
                                    <tr>
                                        <td class="">{{ $depositdetail->deposite_date ?? '' }}</td>
                                        <td class="">
                                            @if ($depositdetail->payment_status == 1)
                                                <p class="text-danger">Due</p>
                                            @else
                                                <p class="text-success">Paid</p>
                                            @endif
                                        </td>
                                        <td class="">{{ $depositdetail->deposite_code ?? '' }}</td>
                                        <td class="">{{ $depositdetail->member->name ?? '' }}
                                            {{ ($depositdetail->member->member_code) ?? '' }}
                                        </td>
                                        <td class="">{{ $depositdetail->monthly_fee ?? 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                <th colspan="4">Total:</th>
                                <th>{{ number_format($total ?? 0, 2) }}</th>

                            </tr>
                            <tfoot class="tfoot" style="color: white;">
                                <tr>
                                    <th colspan="12">
                                        <h5 class="text-center mt-4 text-capitalize"> © Developed By
                                            Acquaint Technologies </h5>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $("ul#report").siblings('a').attr('aria-expanded', 'true');
        $("ul#report").addClass("show");
        $("ul#report #member-deposit-report-menu").addClass("active");


        $('.selectpicker').selectpicker('refresh');
    </script>
    <script src="{{ asset('public/js/PrintJs.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
        $('#click_print').click(function() {
            $('#table_print').printThis();
        })
    </script>
@endsection
