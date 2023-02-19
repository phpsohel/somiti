@extends('layout.main') @section('content')
@if(session()->has('message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('create_message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('create_message') !!}</div>
@endif
@if(session()->has('edit_message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
@endif
@if(session()->has('import_message'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('import_message') !!}</div>
@endif
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section>
    <div class="card">
        <div class="card-header">
            <div class="container">
             
              <a class="btn btn-primary btn-sm" href="{{ route('memberinfo.index') }}" class=""><i class="fa fa-undo px-2"></i> Back</a>
            
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <br>
                <table id="customer-table" class="table">
                    <thead>
                        <tr class="">
                            <th class="text-center text-success" colspan="8">
                                <h3 class="">{{ $member->name ?? '' }}({{ $member->member_code }})</h3>
                            </th>
                        </tr>
                        <tr>
                            <th >SL</th>
                            <th >Action</th>
                            <th class="">Month & Year</th>
                            <th>Status</th>
                            <th>Payment Date</th>
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
                        @foreach($depositdetails as $depositdetail)
                        @php
                      
                        $total_monthly_fee += $depositdetail->monthly_fee;
                        $total_monthly_fine += $depositdetail->monthly_fine;
                        $grandtotal += (($depositdetail->monthly_fee ?? 0) + ($depositdetail->monthly_fine ?? 0)) ;
                        @endphp
        
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                        {{-- <li>
                                           
                                            <p  class="btn btn-link" data-toggle="modal" data-target="#loanDeposite_{{ $depositdetail->id }}">
                                                <i class="fa fa-th "></i> {{trans('Deposit Collection')}}
                                              </p>
                                        </li> --}}
                                   
                                    
                                     
                                        <li>
                                            <a href="{{ route('moneyreceiptSingle',$depositdetail->id) }}" data-id="" target="_blank" class="getDeposit btn btn-link"><i class="fa fa-money "></i> Money Receipt</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                @if($depositdetail->payment_status == 1)
                                <p class="text-danger" >Due</p>
                                @elseif ($depositdetail->payment_status == 2)
                                <p class="text-success">Paid</p>
                                @elseif ($depositdetail->payment_status == 3)
                                <p class="text-danger">Cancelled</p>
                                @else
                                <p class="text-danger">In-Active</p>
                                @endif
        
                            </td>
                            <td>{{ $depositdetail->month ?? '' }},{{ $depositdetail->years ?? '' }}</td>
                            <td>{{ $depositdetail->payment_date?? '-' }}</td>
                            <td class="text-right">{{ $depositdetail->monthly_fee?? '' }}</td>
                            <td class="text-right">{{ $depositdetail->monthly_fine?? 0 }}</td>
                            <td class="text-right">{{ number_format(($depositdetail->monthly_fee?? 0) +($depositdetail->monthly_fine?? 0),2) }}</td>
                       
                          
                        </tr>
                        @include('deposit.deposit_collection_modal')
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="">
                            <th class="text-right" colspan="5">Total</th>
                            <th class="text-right">{{  number_format(($total_monthly_fee ?? 0),2)  }}</th>
                            <th class="text-right">{{  number_format(($total_monthly_fine ?? 0),2)  }}</th>
                            <th class="text-right">{{  number_format(($grandtotal ?? 0),2)  }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
  
</section>


<script>
 $(document).on('keyup','.monthly_fine',function(){
        var monthly_fine = $(this).val();
        var monthlyfee = $('.monthly_fee').val();
        if(!monthly_fine) monthly_fine = 0;
        var total = (parseFloat(monthlyfee) + parseFloat(monthly_fine));
        $('.grand_total').val(total);
       
 })

</script>

@endsection
