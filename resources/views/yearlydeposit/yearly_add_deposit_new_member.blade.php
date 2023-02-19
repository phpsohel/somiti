<div class="modal fade" id="addDepositDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="">Add General Member Deposit Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{route('singleMemberYearlyDepositStore')}}" class="" method="POST">
            @csrf
               
            <div class="modal-body">
                <div class="row">


                    <input type="hidden" id="deposit_year" name="years" value="{{ $item->years }}">
                    <input type="hidden" id="deposite_date" name="deposite_date" value="{{ date('Y-m-d') }}">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('General Members')}} <sup class="text-danger">*</sup></strong> </label>
                            <select required class="form-control getmember_value" id="customer-group-id" name="member_id" >
                                <option>Select</option>
                                @foreach($generalMemberLists as $data)
                                    <option value="{{ $data->id }}" data-fee="{{ $data->yearly_deposit_fee }}" class="generalMembers">{{ $data->name." (".$data->member_code.")" }}</option>
                                @endforeach
                                
                            
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('Deposit Amount')}} <sup class="text-danger">*</sup></strong> </label>
                            <input type="text" class="form-control" id="monthlyDepositFee" name="yearly_fee" value="" readonly>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>

        </form>
        
        
      
      </div>
    </div>
</div>