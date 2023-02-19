<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\SomitiSetting;
use App\GeneralSetting;
use App\DailyDeposit;
use App\DailyDepositDetails;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DailyDepositController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 20;

        $data['items'] = DailyDeposit::orderBy('id', 'DESC')->paginate($paginate);
        // return $data['items'];

        return view('dailydeposit.index', $data)->with('i', ($request->input('page', 1) - 1) * $paginate);
    }

    public function searchByAjax(Request $request)
    {
        $search = $request->search;
        $data['items'] = DailyDeposit::where('years', $search)
            ->orwhere('months', $search)
            ->orderBy('id', 'DESC')
            ->get();

        return view('dailydeposit.search_daily_deposite_by_ajax', $data);
    }

    public function dailyDepositDetails($id)
    {
        $data['item'] = DailyDeposit::find($id);
        $data['depositdetails'] = DailyDepositDetails::where('daily_deposit_id', $id)->get();
        $data['generalMemberLists'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'daily_status' => 1])->get();

        return view('dailydeposit.deposit_details', $data);
    }

    ////////////////////////// edit payment receipt  ////////////////////////
    public function moneyReceiptEdit($id)
    {
        $data['details'] = DailyDepositDetails::find($id);
        return view('dailydeposit.money_receipt_edit', $data);
    }
    public function updatedepositPayment(Request $request, $id)
    {
        $allData = DailyDepositDetails::find($id);

        $allData->transition_id = $request->transition_id;

        $grand_total = ($request->daily_fee + ($request->daily_fine ?? 0));
        $allData->payment_date = $request->payment_date;
        $allData->payment_type = $request->payment_type;
        $allData->daily_fine = $request->daily_fine;
        $allData->bank_name = $request->bank_name;
        $allData->branch_name = $request->branch_name;
        $allData->check_no = $request->check_no;
        $allData->phone_number = $request->phone_number;
        $allData->grand_total = $grand_total;
        $allData->save();
        return redirect()->back()->with('create_message', 'Deposit Updated Successfully');
    }


    public function dailydepositPayment(Request $request)
    {
        $grand_total = ($request->daily_fee + ($request->daily_fine ?? 0));

        $allData = DailyDepositDetails::where('id', $request->deposit_details_id)->first();
        $allData->payment_date = $request->payment_date;
        $allData->payment_status = 2;
        $allData->daily_fine = $request->daily_fine ?? 0;
        $allData->grand_total = $grand_total ?? 0;

        $allData->payment_type = $request->payment_type;

        $allData->transition_id = $request->transition_id;
        $allData->cheque_date = $request->cheque_date;

        $allData->bank_name = $request->bank_name;
        $allData->branch_name = $request->branch_name;
        $allData->check_no = $request->check_no;
        $allData->phone_number = $request->phone_number;

        $allData->save();
        return redirect()->route('dailydepositdetails', $request->deposit_id)->with('create_message', 'Daily Deposit collected Successfully');
    }
    // it will be full page
    public function dailyMoneyReceipt($id)
    {
        $data['item'] = DailyDeposit::find($id);
        $data['details'] = DailyDepositDetails::where('daily_deposit_id', $id)->get();
        $data['general_setting'] = GeneralSetting::latest()->first();
        // return $data['general_setting'] ;
        return view('dailydeposit.money_receipt_details', $data);

        // $customPaper = array(0,0,720,1000);
        // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('dailydeposit.money_receipt_details',$data)->setPaper($customPaper,'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString().'daily-payment-receipt-details.pdf');

        // return $pdf; 
    }
    public function dailymoneyreceiptSingle($id)
    {
         $data['detail'] = DailyDepositDetails::find($id);
        $data['general_setting'] = GeneralSetting::latest()->first();
        return view('dailydeposit.money-receipt', $data);

        // $customPaper = array(0, 0, 720, 500);  // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('dailydeposit.money-receipt', $data)->setPaper($customPaper, 'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString() . 'daily-payment-receipt.pdf');
        // return $pdf;
    }

    public function create()
    {

        return view('dailydeposit.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'month' => 'required',
            'years' => 'required',
            'deposite_date' => 'required',
        ]);
        $check = DailyDeposit::where(['years' => $request->years, 'months' => $request->month, 'deposite_date' => $request->deposite_date])->first();
        if (!$check) {
            $allData = new DailyDeposit();
            $allData->months = $request->month;
            $allData->years = $request->years;
            $allData->deposite_date = $request->deposite_date;
            $allData->note = $request->note;
            $allData->user_id = auth()->user()->id;
            $allData->save();
            $deposit_id = $allData->id;

            $members = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'daily_status' => 1])->get();

            foreach ($members as $key => $member) {

                $details = new DailyDepositDetails();
                $details->daily_deposit_id = $deposit_id;
                $details->member_id = $member->id;
                $details->years = $request->years;
                $details->month = $request->month;
                $details->deposite_date = $request->deposite_date;
                $details->daily_fee = $member->daily_deposit_fee;
                $details->save();
                $id = $details->id;
                $code = 10000;
                $receipt = DailyDepositDetails::find($id);
                $receipt->deposite_code = ($code + $id);
                $receipt->save();
            }

            return redirect()->route('dailydeposit.index')->with('create_message', 'Daily Deposit Generated Successfully');
        } else {

            return redirect()->route('dailydeposit.create')->with('not_permitted', 'Daily Deposit Already Generated');
        }
    }

    public function singleCustomerDailyDepositStore(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'daily_fee' => 'required',
        ]);
        // return $request->all();

        $deposit_year = $request->deposit_year;
        $deposit_month = $request->deposit_month;
        $member_id = $request->member_id;
        $deposit = DailyDeposit::where(['years' => $deposit_year, 'months' => $deposit_month, 'deposite_date' => $request->deposite_date])->first();

        $deposit_id = $deposit->id;
        $member = Member::where('id', $member_id)->first();
        $depositeDetails = DailyDepositDetails::where(['years' => $deposit_year, 'month' => $deposit_month, 'member_id' => $member_id, 'deposite_date' => $request->deposite_date])
            ->first();


        if ($depositeDetails) {
            return redirect()->back()->with('not_permitted', 'Deposit record for this customer ' . $member->name . ' (' . $member->member_code . ') already exists.');
        } else {

            $details = new DailyDepositDetails();
            $details->daily_deposit_id = $deposit_id;
            $details->member_id = $request->member_id;
            $details->years = $request->deposit_year;
            $details->month = $request->deposit_month;
            $details->deposite_date = $request->deposite_date;
            $details->daily_fee = $request->daily_fee;
            $details->save();
            $id = $details->id;
            $code = 10000;
            $receipt = DailyDepositDetails::find($id);
            $receipt->deposite_code = ($code + $id);
            $receipt->save();

            return redirect()->back()->with('create_message', 'Deposit For Customer ' . $member->name . ' (' . $member->member_code . ') Created Successfully');
        }
    }
}
