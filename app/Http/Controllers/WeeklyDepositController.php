<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\SomitiSetting;
use App\GeneralSetting;
use App\WeeklyDeposit;
use App\WeeklyDepositDetails;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WeeklyDepositController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 20;
        $data['items'] = WeeklyDeposit::orderBy('id', 'DESC')->paginate($paginate);
        // return ($data['items']);
        return view('weeklydeposit.index', $data)->with('i', ($request->input('page', 1) - 1) * $paginate);
    }

    public function searchByAjax(Request $request)
    {
        $search = $request->search;
        $data['items'] = WeeklyDeposit::where('years',$search)
        ->orwhere('months',$search)
        ->orderBy('id','DESC')
        ->get();

        return view('weeklydeposit.search_deposite_by_ajax', $data);
    }

    public function WeeklyDepositDetails($id)
    {
        // dd($id);
        $data['item'] = WeeklyDeposit::find($id);
        // return $data['item'];
        $data['depositdetails'] = WeeklyDepositDetails::where('weekly_deposit_id', $id)->get();

        $data['generalMemberLists'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'weekly_status' => 1])->get();

        return view('weeklydeposit.deposit_details', $data);
    }

    // edit payment receipt
    public function moneyReceiptEdit($id)
    {
        $data['details'] = WeeklyDepositDetails::find($id);
        return view('weeklydeposit.money_receipt_edit', $data);
    }
    public function updatedepositPayment(Request $request, $id)
    {
        $allData = WeeklyDepositDetails::find($id);

        $allData->transition_id = $request->transition_id;

        $grand_total = ($request->weekly_fee + ($request->weekly_fine ?? 0));
        $allData->payment_date = $request->payment_date;
        $allData->payment_type = $request->payment_type;
        $allData->weekly_fine = $request->weekly_fine;
        $allData->bank_name = $request->bank_name;
        $allData->branch_name = $request->branch_name;
        $allData->check_no = $request->check_no;
        $allData->phone_number = $request->phone_number;
        $allData->grand_total = $grand_total;
        $allData->save();
        return redirect()->back()->with('create_message', 'Deposit Updated Successfully');
    }

    public function WeeklyDepositPayment(Request $request)
    {
        // return $request->all();
        
        $grand_total = ($request->weekly_fee + ($request->weekly_fine ?? 0));
        $allData = WeeklyDepositDetails::where('id', $request->deposit_details_id)->first();
        $allData->payment_date = $request->payment_date;
        // $allData->monthly_fee = $request->monthly_fee;
        $allData->payment_status = 2;
        $allData->weekly_fine = $request->weekly_fine ?? 0;
        $allData->grand_total = $grand_total ?? 0;

        $allData->transition_id = $request->transition_id;
        $allData->cheque_date = $request->cheque_date;

        $allData->payment_type = $request->payment_type;
        $allData->bank_name = $request->bank_name;
        $allData->branch_name = $request->branch_name;
        $allData->check_no = $request->check_no;
        $allData->phone_number = $request->phone_number;
        
        $allData->save();
        return redirect()->route('weeklydepositdetails', $request->deposit_id)->with('create_message', 'Weekly Deposit collected Successfully');
    }

    public function weeklyMoneyReceipt($id)
    {
        $data['item'] = WeeklyDeposit::find($id);
        $data['details'] = WeeklyDepositDetails::where('weekly_deposit_id', $id)->get();
        $data['general_setting'] = GeneralSetting::latest()->first();
        return view('weeklydeposit.money_receipt_details', $data);

        // $customPaper = array(0,0,720,1000);  // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('weeklydeposit.money_receipt_details',$data)->setPaper($customPaper,'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString().'weekly-payment-receipt-details.pdf');

        // return $pdf; 
    }

    public function weeklymoneyreceiptSingle($id)
    {

        $data['detail'] = WeeklyDepositDetails::find($id);
        // return $detail;
        $data['general_setting'] = GeneralSetting::latest()->first();
        return view('weeklydeposit.money-receipt', $data);

        // $customPaper = array(0,0,720,500);  // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('weeklydeposit.money-receipt',$data)->setPaper($customPaper,'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString().'weekly-payment-receipt.pdf');
        // return $pdf; 
    }

    public function create()
    {
        $start_week = Carbon::now()->weekOfYear;
        return view('weeklydeposit.create', compact('start_week'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([

            'weekly' => 'required',
            'month' => 'required',
            'years' => 'required',
            'deposite_date' => 'required',
        ]);
        // return 'check';
        $check = WeeklyDeposit::where(['weekly' => $request->weekly, 'years' => $request->years, 'months' => $request->month, 'deposite_date' => $request->deposite_date])->first();
        // return 'checked';
        if (!$check) {
            // return 'yes';
            $allData = new WeeklyDeposit();
            // return $allData;
            $allData->weekly = $request->weekly;
            $allData->months = $request->month;
            $allData->years = $request->years;
            $allData->deposite_date = $request->deposite_date;
            $allData->note = $request->note;
            $allData->user_id = auth()->user()->id;
            $allData->save();
            $deposit_id = $allData->id;

            $members = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'weekly_status' => 1])->get();

            foreach ($members as $key => $member) {

                $details = new WeeklyDepositDetails();
                $details->weekly_deposit_id = $deposit_id;
                $details->member_id = $member->id;
                $details->years = $request->years;
                $details->month = $request->month;
                $details->weeks = $request->weekly;
                $details->deposite_date = $request->deposite_date;
                $details->weekly_fee = $member->weekly_deposit_fee;
                $details->save();
                $id = $details->id;
                $code = 10000;
                $receipt = WeeklyDepositDetails::find($id);
                $receipt->deposite_code = ($code + $id);
                $receipt->save();
            }

            return redirect()->route('weeklydeposit.index')->with('create_message', 'Weekly Deposit Generated Successfully');
        } else {
            return redirect()->route('weeklydeposit.create')->with('not_permitted', 'Weekly Deposit Already Generated');
        }
    }

    public function singleCustomerWeeklyDepositStore(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'weekly_fee' => 'required',
        ]);
    //    return $request->all();

        $deposit_year = $request->deposit_year;
        $deposit_month = $request->deposit_month;
        $member_id = $request->member_id;
        $deposit = WeeklyDeposit::where(['years' => $deposit_year, 'months' => $deposit_month, 'weekly' => $request->deposite_date])->first();
        // return  $deposit;
        
        $deposit_id = $deposit->id;
        $member = Member::where('id', $member_id)->first();
        // return $member;

        $WeeklyDepositDetails = WeeklyDepositDetails::where(['years' => $deposit_year, 'month' => $deposit_month,'member_id' =>$member_id])
            ->where('weeks',$request->deposite_date)
            ->first();
           //  return $WeeklyDepositDetails;

        if (!empty($WeeklyDepositDetails)) {
          //  return 'already exist';
            return redirect()->back()->with('not_permitted', 'Deposit record for this customer ' . $member->name . ' (' . $member->member_code . ') already exists.');
        } else {
            //return 'data creating';

            $details = new WeeklyDepositDetails();
            $details->weekly_deposit_id = $deposit_id;
            $details->member_id = $request->member_id;
            $details->years = $request->deposit_year;
            $details->month = $request->deposit_month;
            $details->deposite_date = date('Y-m-d');
            $details->weeks = $request->deposite_date;
            $details->weekly_fee = $request->weekly_fee;
            $details->save();
            $id = $details->id;
            $code = 10000;
            $receipt = WeeklyDepositDetails::find($id);
            $receipt->deposite_code = ($code + $id);
            $receipt->save();

            return redirect()->back()->with('create_message', 'Deposit For Customer ' . $member->name . ' (' . $member->member_code . ') Created Successfully');
        }
    }
}
