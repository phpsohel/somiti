@extends('layout.main') @section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}
        </div>
    @endif
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}
        </div>
    @endif
    <section>
        <div class="card">

            <div class="card-body">
                <h4 class="pb-2"><i class="fa fa-university px-2"></i>All Member Apply for the Loan And Only Admin
                    Approved Here.</h4>
                <div class="table-responsive">

                    <table id="payroll-table" class="table table-bordered table-sm table-striped">
                        <thead>
                            <tr>
                                <th class="not-exported">{{ trans('file.action') }}</th>
                                <th>{{ trans('Status') }}</th>
                                <th>{{ trans('file.date') }}</th>
                                <th>{{ trans('Member') }}</th>
                                <th>{{ trans('Loan Code') }}</th>
                                <th>{{ trans('Principal Amount') }}</th>
                                <th>{{ trans('Interest Rate %') }}</th>
                                <th>{{ trans('Interest Amount') }}</th>
                                <th>{{ trans('Grand Total') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($somitiloans as $key=> $somitiloan)
                                <tr data-id="">
                                    <td>
                                        <a class="edit-btn change-status-btn btn btn-info btn-sm text-white"
                                            data-toggle="modal" data-target="#changeStatusModal"
                                            data-id="{{ $somitiloan->id ?? '' }}">
                                            <i class="dripicons-document-edit"></i> {{ trans('Approve Loan') }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($somitiloan->loan_status == 1)
                                            <span class="text-primary">Opened</span>
                                        @elseif ($somitiloan->loan_status == 2)
                                            <span class="text-success">Approved</span>
                                        @else
                                            <span class="text-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>{{ $somitiloan->loan_release_date ?? '' }}</td>
                                    <td class="text-success">
                                        {{ ($somitiloan->member->name ?? '') . ' (' . ($somitiloan->member->member_code ?? '') . ')' }}
                                    </td>
                                    <td>{{ $somitiloan->loan_code ?? '' }}</td>
                                    <td class="text-right">{{ $somitiloan->principal_amount ?? '' }}</td>
                                    <td class="text-right">{{ $somitiloan->loan_interest ?? '' }}</td>
                                    <td class="text-right">{{ $somitiloan->loan_interest_amount ?? '' }}</td>
                                    <td class="text-right">{{ $somitiloan->grand_total ?? '' }}</td>


                                </tr>

                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-danger">
                                        <h5>No Data Available in table.</h5>
                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
                {{ $somitiloans->links() }}
            </div>

        </div>


    </section>

    <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="">Change Loan Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('somiti-loan.update') }}" class="" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" id="loan_id" name="id">
                            <input type="hidden" id="loan_status" name="loan_status" name="2">

                            <div class="col-md-12 form-group">
                                <label>Do you want to approve this loan?</label>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="member" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">Add Loan For Member</h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $("ul#loan").siblings('a').attr('aria-expanded', 'true');
        $("ul#loan").addClass("show");
        $("ul#loan #loan-list-menu").addClass("active");


        $(document).on('keyup', '.principal_amount,.loan_interest', function() {
            var principal_amount = parseFloat($(".principal_amount").val());
            var loan_interest = parseFloat($(".loan_interest").val());
            var interest = 0;
            interest = principal_amount * loan_interest / 100;
            if (!interest) interest = 0

            $(".loan_interest_amount").val(interest);
            var grandtotal = 0;
            grandtotal = (principal_amount + parseFloat(interest));
            if (!grandtotal) grandtotal = 0;


            $(".grand_total").val(grandtotal);


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


        $(document).ready(function() {
            $('#payroll-table').on('click', '.change-status-btn', function() {

                var loanID = $(this).data('id');
                var age = $("#loan_id").val(loanID);

            });
        });
    </script>
@endsection
