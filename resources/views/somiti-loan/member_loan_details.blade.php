@extends('layout.main') @section('content')
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section>
    <div class="card">
       
        <div class="card-body">
            <div class="table-responsive">
     
                <table id="payroll-table" class="table">
                    <thead>
                        <tr class="">
                            <th class="text-center text-success" colspan="9">
                                <div class="">{{ ($item->member->name ?? '').' ('.($item->member->member_code ?? '').')'}}</div>
                                <strong>Loan Code :{{ $item->loan_code ?? '' }}</strong>
                               
                                <div class="">{{ $item->loan_release_date ?? '' }}</div>

                            </th>
                        </tr>
                        <tr>
                            <th class="not-exported">{{trans('file.action')}}</th>
                            <th>{{trans('Status')}}</th>
                            <th>{{trans('Month')}}</th>
                            <th>{{trans('Payment Date')}}</th>
                            <th class="text-right">{{trans('Principal Amount')}}</th>
                            <th class="text-center">{{trans('Interest Rate %')}}</th>
                            <th class="text-right">{{trans('Interest Amount')}}</th>
                            <th class="text-right">{{trans('Fine Amount')}}</th>
                            <th class="text-right">{{trans('Grand Total')}}</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $principal_amount = 0;
                            $interest_amount = 0;
                            $fineamount = 0;
                            $groundtotal = 0;
                        @endphp
                        @forelse ($loandetails as $key=> $loandetail)
                        @php
                        $principal_amount += $loandetail->principal_amount ?? 0;
                        $interest_amount += $loandetail->loan_interest_amount ?? 0;
                        $fineamount += $loandetail->loan_fine_amount ?? 0;
                        $groundtotal += $loandetail->grand_total ?? 0;
                
                        @endphp
                        <tr data-id="">
                            <td>
                                @if($loandetail->payment_status == 2)
                                    <a href="{{ url('somiti-loan/single/'.$loandetail->somiti_laon_id.'/detail/'.$loandetail->id) }}" target="_blank" class="btn btn-info btn-sm text-white w-100">Loan Detail</a>
                                @else
                                    <p  class="btn btn-success btn-sm w-100 text-white" data-toggle="modal" data-target="#loanDeposite_{{ $loandetail->id }}">
                                        {{trans('Loan Deposite')}}
                                    </p>
                                @endif
                            </td>
                            <td>
                                @if($loandetail->payment_status == 1)
                                <span class="text-danger">Due</span>
                                @elseif ($loandetail->payment_status == 2)
                                <span class="text-success">Paid</span>
                                @else
                                <span class="text-warning">Cancelled</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($loandetail->payment_start_date)->format('F')}}</td>
                            <td>{{ $loandetail->payment_start_date ?? '' }}</td>
                            <td class="text-right">{{ $loandetail->principal_amount ?? '' }}</td>
                            <td class="text-center">{{ $loandetail->loan_interest ?? '' }}</td>
                            <td class="text-right">{{ $loandetail->loan_interest_amount ?? '' }}</td>
                            <td class="text-right">{{ $loandetail->loan_fine_amount ?? '' }}</td>
                            <td class="text-right">{{ $loandetail->grand_total ?? '' }}</td>
                          
                           
                        </tr>
                       @include('somiti-loan.loan_deposite_modal')
                       
                        @empty
                           <tr>
                            <td colspan="12" class="text-center text-danger"><h5>No data available in table.</h5></td>
                            
                           </tr> 
                        @endforelse 
                            
                    </tbody>
                    <tfoot>
                        <tr class="text-success">
                            <th class="" colspan="4">Total</th>
                            <th class="text-right">{{number_format((float)($principal_amount ?? 0),2,'.','')}}</th>
                            <th class="text-right"></th>
                            <th class="text-right">{{number_format((float)($interest_amount ?? 0),2,'.','')}}</th>
                            <th class="text-right">{{number_format((float)($fineamount ?? 0),2,'.','')}}</th>
                            <th class="text-right">{{number_format((float)($groundtotal ?? 0),2,'.','')}}</th>
                           
                        </tr>
                    </tfoot>
              
                </table>
            </div>
         
        </div>

    </div>

    
</section>




<script type="text/javascript">
    $("ul#hrm").siblings('a').attr('aria-expanded', 'true');
    $("ul#hrm").addClass("show");
    $("ul#hrm #payroll-menu").addClass("active");

    $(document).on('keyup', '.loan_fine_amount', function() {

            var loan_fine_amount = $(this).val();
            var total = $('.grand_total').val();
            var loan_interest_amount = $('.loan_interest_amount').val();
            var principal_amount = $('.principal_amount').val();
            if(!loan_fine_amount) loan_fine_amount = 0;
            var grandtotal = (parseFloat(loan_fine_amount) + parseFloat(loan_interest_amount) + parseFloat(principal_amount));
            if(!grandtotal) grandtotal=0;
            $(".grand_total").val(grandtotal);   

    }); 
</script>
@endsection
