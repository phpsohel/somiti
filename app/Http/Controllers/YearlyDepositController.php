<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Deposit;
use App\DepositeDetails;
use App\User;
use App\YearlyDeposit;
use App\YearlyDepositDetails;
use App\SomitiSetting;
use App\GeneralSetting;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class YearlyDepositController extends Controller
{


    public function index()
    {
        $data['items'] = YearlyDeposit::orderBy('id', 'DESC')->get();

        return view('yearlydeposit.index', $data);
    }

    public function depositDetails($id)
    {
        $data['item'] = YearlyDeposit::find($id);
        $data['depositdetails'] = YearlyDepositDetails::where('yearly_deposit_id', $id)->get();
        $data['generalMemberLists'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'yearly_status' => 1])->get();
        return view('yearlydeposit.deposit_details', $data);
    }
// edit payment receipt
public function moneyReceiptEdit($id)
{
    $data['details'] = YearlyDepositDetails::find($id);
    return view('yearlydeposit.money_receipt_edit', $data);
}
public function updatedepositPayment(Request $request, $id)
{
    $allData = YearlyDepositDetails::find($id);

    $allData->transition_id = $request->transition_id;

    $grand_total = ($request->yearly_fee + ($request->yearly_fine ?? 0));
    $allData->payment_date = $request->payment_date;
    $allData->payment_type = $request->payment_type;
    $allData->yearly_fine = $request->yearly_fine;
    $allData->bank_name = $request->bank_name;
    $allData->branch_name = $request->branch_name;
    $allData->check_no = $request->check_no;
    $allData->phone_number = $request->phone_number;
    $allData->grand_total = $grand_total;
    $allData->save();
    return redirect()->back()->with('create_message', 'Deposit Updated Successfully');
}

    public function moneyReceipt($id)
    {
        $data['item'] = YearlyDeposit::find($id);
        $data['details'] = YearlyDepositDetails::where('yearly_deposit_id', $id)->get();
        $data['general_setting'] = GeneralSetting::latest()->first();
        return view('yearlydeposit.money_receipt_details', $data);

        // $customPaper = array(0,0,720,1000);  // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('yearlydeposit.money_receipt_details',$data)->setPaper($customPaper,'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString().'yearly-payment-receipt-details.pdf');

        // return $pdf; 
    }

    public function searchYearlyDeposite(Request $request)
    {
        $search = $request->search;
        $data['items'] = YearlyDeposit::where('years', $search)->orderBy('id', 'DESC')->get();

        return view('yearlydeposit.search_yearly_deposite_by_ajax', $data);
    }



    public function yearlymoneyreceiptSingle($id)
    {

        $data['detail'] = YearlyDepositDetails::find($id);
        $data['general_setting'] = GeneralSetting::latest()->first();
        return view('yearlydeposit.money-receipt', $data);

        // $customPaper = array(0,0,720,500);  // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('yearlydeposit.money-receipt',$data)->setPaper($customPaper,'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString().'yearly-payment-receipt.pdf');
        // return $pdf; 
    }


    public function depositPayment(Request $request)
    {
        // return $request->all();
        $grand_total = ($request->yearly_fee + ($request->yearly_fine ?? 0));
        $allData = YearlyDepositDetails::where('id', $request->deposit_details_id)->first();
        $allData->payment_date = $request->payment_date;
        $allData->yearly_fee = $request->yearly_fee;
        $allData->payment_status = 2;
        $allData->yearly_fine = $request->yearly_fine ?? 0;
        $allData->grand_total = $grand_total ?? 0;

        $allData->transition_id = $request->transition_id;
        $allData->cheque_date = $request->cheque_date;

        $allData->payment_type = $request->payment_type;
        $allData->bank_name = $request->bank_name;
        $allData->branch_name = $request->branch_name;
        $allData->check_no = $request->check_no;
        $allData->phone_number = $request->phone_number;

        $allData->save();
        return redirect()->route('yearlydepositDetails', $request->yearly_deposit_id)->with('create_message', 'Deposit collected Successfully');
    }

    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | Add Single Customer Yearly Deposit
    |
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    public function singleMemberYearlyDepositStore(Request $request)
    {

        //return $request->all();
        $request->validate([
            'member_id' => 'required',
            'yearly_fee' => 'required',
        ]);

        $deposit_year = $request->years;
        $yearly_fee = $request->yearly_fee;
        $member_id = $request->member_id;
        $deposit = YearlyDeposit::where(['years' => $deposit_year])->first();

        $deposit_id = $deposit->id;

        $depositeDetails = YearlyDepositDetails::where(['years' => $deposit_year, 'member_id' => $member_id])
            ->first();
        $customer = Member::where('id', $member_id)->select('id', 'name', 'member_code')->first();

        if ($depositeDetails) {
            return redirect()->back()->with('not_permitted', 'Deposit record for this customer ' . $customer->name . ' (' . $customer->member_code . ') already exists.');
        } else {

            $details = new YearlyDepositDetails();
            $details->yearly_deposit_id = $deposit_id;
            $details->member_id = $request->member_id;
            $details->years = $deposit_year;
            $details->deposite_date = $request->deposite_date;
            $details->yearly_fee = $request->yearly_fee;
            $details->save();
            $id = $details->id;
            $code = 10000;
            $receipt = YearlyDepositDetails::find($id);
            $receipt->deposite_code = ($code + $id);
            $receipt->save();

            return redirect()->back()->with('create_message', 'Deposit For Customer ' . $customer->name . ' (' . $customer->member_code . ') Created Successfully');
        }
    }

    public function create()
    {

        return view('yearlydeposit.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'years' => 'required',
            'deposite_date' => 'required',
        ]);
        $check = YearlyDeposit::where(['years' => $request->years])->first();
        if (!$check) {
            $allData = new YearlyDeposit();
            $allData->years = $request->years;
            $allData->deposite_date = $request->deposite_date;
            $allData->note = $request->note;
            $allData->save();
            $deposit_id = $allData->id;

            $members = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'yearly_status' => 1])->get();
            // return $members;
            foreach ($members as $key => $member) {

                $details = new YearlyDepositDetails();
                $details->yearly_deposit_id = $deposit_id;
                $details->member_id = $member->id;
                $details->years = $request->years;
                $details->deposite_date = $request->deposite_date;
                $details->yearly_fee = $member->yearly_deposit_fee;
                $details->grand_total = $member->yearly_deposit_fee;
                $details->save();
                $id = $details->id;
                $code = 10000;
                $receipt = YearlyDepositDetails::find($id);
                $receipt->deposite_code = ($code + $id);
                $receipt->save();
            }
            return redirect()->route('yearlydeposite.index')->with('create_message', 'Yearly Deposit Generated Successfully');
        } else {

            return redirect()->route('yearlydeposite.create')->with('not_permitted', 'Yearly Deposit Already Generated');
        }
    }
}
