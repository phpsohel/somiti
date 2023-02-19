@extends('layout.main') @section('content')
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
    <section>
        <div class="card">

            <div class="card-header">
                <h4 class="card-title mb-2"> Monthly Deposit Details</h4>

                <div class="card-tools">
                    <a class="btn btn-dark btn-sm" href="{{ route('deposite.index') }}"><i class="fa fa-undo px-2"></i>
                        Back</a> &nbsp;
                    <a class="btn btn-success btn-sm text-white pull-right" data-toggle="modal"
                        data-target="#addDepositDetailModal"><i class="fa fa-plus px-2"></i>Add new member</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="customer-table" class="table table-bordered table-sm table-striped">
                        <thead>
                            <tr class="">
                                <th class="text-center text-success" colspan="13">
                                    <div class="">Deposit List : {{ $item->month . ' , ' . $item->years }}</div>
                                    <div class="">{{ $item->deposite_date ?? '' }}</div>

                                </th>
                            </tr>
                            <tr>
                                <th>SL</th>
                                <th>Action</th>
                                <th>Status</th>
                                <th>Member Name</th>
                                <th>Paid By</th>
                                <th>Transaction id</th>
                                <th>Bank Name</th>
                                <th>Branch Name</th>
                                <th>Cheque Number</th>                                <th>Payment Date</th>
                                <th class="text-right">Monthly fee</th>
                                <th class="text-right">Monthly Fine</th>
                                <th class="text-right">Grand Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                                $total_monthly_fee = 0;
                                $total_monthly_fine = 0;
                                $grandtotal = 0;
                            @endphp
                            @foreach ($depositdetails as $depositdetail)
                                @php
                                    
                                    $total_monthly_fee += $depositdetail->monthly_fee;
                                    $total_monthly_fine += $depositdetail->monthly_fine;
                                    $grandtotal += ($depositdetail->monthly_fee ?? 0) + ($depositdetail->monthly_fine ?? 0);
                                @endphp

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        @if ($depositdetail->payment_status == 1)
                                            <a class="btn btn-primary btn-sm text-white w-100" data-toggle="modal"
                                                data-target="#loanDeposite_{{ $depositdetail->id }}">
                                                <i class="fa fa-bath"></i> {{ trans('Fee Collection') }}
                                            </a>
                                        @else
                                            <a href="{{ route('moneyreceiptSingle', $depositdetail->id) }}"
                                                target="_blank" class="btn btn-info btn-sm w-100"><i
                                                    class="fa fa-money px-2"></i> Money Receipt</a>
                                            {{-- edit --}}
                                            @if (!empty(auth()->user()->role_id == 1))
                                                <a href="{{ route('monthly_money_receipt_edit', $depositdetail->id) }}"
                                                    class="btn btn-secondary btn-sm mt-2 w-100">
                                                    <i class="fa fa-edit px-2"> Edit</i>
                                                </a>
                                            @endif
                                        @endif

                                    </td>
                                    <td>
                                        @if ($depositdetail->payment_status == 1)
                                            <p class="text-danger">Due</p>
                                        @elseif ($depositdetail->payment_status == 2)
                                            <p class="text-success">Paid</p>
                                        @elseif ($depositdetail->payment_status == 3)
                                            <p class="text-danger">Cancelled</p>
                                        @else
                                            <p class="text-danger">In-Active</p>
                                        @endif

                                    </td>
                                    <td>{{ $depositdetail->member->name ?? '' }}
                                        ({{ $depositdetail->member->member_code ?? '' }})
                                    </td>
                                    <td>
                                        @if ($depositdetail->payment_type == 1)
                                            <p>Cash</p>
                                        @elseif ($depositdetail->payment_type == 2)
                                            <p>Bank</p>
                                        @elseif ($depositdetail->payment_type == 3)
                                            <p>Bkash- {{ $depositdetail->phone_number ?? '-' }}</p>
                                        @elseif ($depositdetail->payment_type == 4)
                                            <p>Rocket - ({{ $depositdetail->phone_number ?? '-' }})</p>
                                        @elseif ($depositdetail->payment_type == 5)
                                            <p>Nogot ({{ $depositdetail->phone_number ?? '-' }})</p>
                                        @elseif($depositdetail->payment_type == 6)
                                            <p>others</p>
                                        @else
                                            <p>-</p>
                                        @endif
                                    </td>
                                    <td>{{ $depositdetail->transition_id ?? '-' }}</td>


                                    <td>{{ $depositdetail->bank_name ?? '-' }}</td>
                                    <td>{{ $depositdetail->branch_name ?? '-' }}</td>
                                    <td>{{ $depositdetail->check_no ?? '-' }}</td>

                                    <td>{{ $depositdetail->payment_date ?? '-' }}</td>
                                    <td class="text-right">{{ $depositdetail->monthly_fee ?? '' }}</td>
                                    <td class="text-right">{{ $depositdetail->monthly_fine ?? 0 }}</td>
                                    <td class="text-right">
                                        {{ number_format(($depositdetail->monthly_fee ?? 0) + ($depositdetail->monthly_fine ?? 0), 2) }}
                                    </td>


                                </tr>
                                @include('monthlydeposit.deposit_collection_modal')
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="">
                                <th class="text-right" colspan="10">Total</th>
                                <th class="text-right">{{ number_format($total_monthly_fee ?? 0, 2) }}</th>
                                <th class="text-right">{{ number_format($total_monthly_fine ?? 0, 2) }}</th>
                                <th class="text-right">{{ number_format($grandtotal ?? 0, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


    </section>


    <div class="modal fade" id="addDepositDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="">Add General Member Deposit Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('deposit.singleCustomerStore') }}" class="" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" id="deposit_month" name="deposit_month" value="{{ $item->month }}">
                            <input type="hidden" id="deposit_year" name="deposit_year" value="{{ $item->years }}">
                            <input type="hidden" id="deposite_date" name="deposite_date" value="{{ date('Y-m-d') }}">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('General Members') }} <sup class="text-danger">*</sup></strong>
                                    </label>
                                    <select required class="form-control getmember_value" id="customer-group-id"
                                        name="member_id">
                                        <option>Select</option>
                                        @foreach ($generalMemberLists as $data)
                                            <option value="{{ $data->id }}"
                                                data-fee="{{ $data->monthly_deposit_fee }}" class="generalMembers">
                                                {{ $data->name . ' (' . $data->member_code . ')' }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Deposit Amount') }} <sup class="text-danger">*</sup></strong>
                                    </label>
                                    <input type="text" class="form-control" id="monthlyDepositFee"
                                        name="monthly_deposit_fee" value="" readonly>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>



            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var paymentType = $('.payment_type').find('option:selected').val();
            $('.payment_type_value').val(paymentType);
            $('.banking').hide();
            $('.mobile_banking').hide();

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

    <script>
 $("ul#deposit").siblings('a').attr('aria-expanded', 'true');
        $("ul#deposit").addClass("show");
        $("ul#deposit #monthly-deposit-list-menu").addClass("active");



        $(document).on('keyup', '.monthly_fine', function() {
            var monthly_fine = $(this).val();
            var monthlyfee = $('.monthly_fee').val();
            if (!monthly_fine) monthly_fine = 0;
            var total = (parseFloat(monthlyfee) + parseFloat(monthly_fine));
            $('.grand_total').val(total);

        })


        $(document).ready(function() {


            /* ...... */
            $('.getmember_value').on('change', function() {

                var depositFee = $(this).find('option:selected').data('fee');
                $("#monthlyDepositFee").val(depositFee);
                // alert(depositFee);

            });

        });
    </script>
@endsection
