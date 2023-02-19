<?php

namespace App\Http\Controllers;

use App\Customer;
use App\MonthlyDeposit;
use App\SomitiSetting;
use App\MonthlyDepositDetails;
use App\GeneralSetting;
use App\Member;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class MonthlyDepositController extends Controller
{
    public function index()
    {
        $deposites = MonthlyDeposit::with('depositpaid', 'depositAll')->orderBy('id', 'DESC')->get();
        return view('monthlydeposit.index', compact('deposites'));
    }

    public function searchDepositeMember(Request $request)
    {
        $search = $request->search;
        $deposites = MonthlyDeposit::where('years', "$search")
            ->orwhere('month', "$search")
            ->orderBy('id', 'DESC')
            ->get();
        // return  $deposites;
        return view('monthlydeposit.get_monthly_report_by_ajax', compact('deposites'));
    }

    public function depositDetails($id)
    {
        $data['item'] = MonthlyDeposit::find($id);
        $data['depositdetails'] = MonthlyDepositDetails::where('monthly_deposits_id', $id)->get();
        $data['generalMemberLists'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'monthly_status' => 1])->get();

        return view('monthlydeposit.deposit_details', $data);
    }

    // edit payment receipt
    public function moneyReceiptEdit($id)
    {
        $data['details'] = MonthlyDepositDetails::find($id);
        return view('monthlydeposit.money_receipt_edit', $data);
    }
    public function updatedepositPayment(Request $request, $id)
    {
        $allData = MonthlyDepositDetails::find($id);

        $allData->transition_id = $request->transition_id;

        $grand_total = ($request->monthly_fee + ($request->monthly_fine ?? 0));
        $allData->payment_date = $request->payment_date;
        $allData->payment_type = $request->payment_type;
        $allData->monthly_fine = $request->monthly_fine;
        $allData->bank_name = $request->bank_name;
        $allData->branch_name = $request->branch_name;
        $allData->check_no = $request->check_no;
        $allData->phone_number = $request->phone_number;
        $allData->grand_total = $grand_total;
        $allData->save();
        return redirect()->back()->with('create_message', 'Deposit Updated Successfully');
    }


    public function depositPayment(Request $request)
    {
        // return $request->all();

        $grand_total = ($request->monthly_fee + ($request->monthly_fine ?? 0));

        $allData = MonthlyDepositDetails::where('id', $request->deposit_details_id)->first();

        $allData->payment_date = $request->payment_date;
        $allData->monthly_fee = $request->monthly_fee;
        $allData->payment_status = 2;
        $allData->monthly_fine = $request->monthly_fine ?? 0;
        $allData->grand_total = $grand_total ?? 0;

        $allData->transition_id = $request->transition_id;
        $allData->cheque_date = $request->cheque_date;

        $allData->payment_type = $request->payment_type;
        $allData->bank_name = $request->bank_name;
        $allData->branch_name = $request->branch_name;
        $allData->check_no = $request->check_no;
        $allData->phone_number = $request->phone_number;


        $allData->save();
        return redirect()->route('depositDetails', $request->deposit_id)->with('create_message', 'Deposit collected Successfully');
    }


    public function create()
    {

        return view('monthlydeposit.create');
    }
    public function store(Request $request)
    {
        // dd(MonthlyDepositDetails::all());
        // return $request->all();

        $request->validate([

            'month' => 'required',
            'years' => 'required',
            'deposite_date' => 'required',
        ]);
        $check = MonthlyDeposit::where(['years' => $request->years, 'month' => $request->month])->first();
        if (!$check) {
            // return "not first";
            $allData = new MonthlyDeposit();
            $allData->month = $request->month;
            $allData->years = $request->years;
            $allData->deposite_date = $request->deposite_date;
            $allData->note = $request->note;
            $allData->save();
            // return $allData;
            $monthly_deposits_id = $allData->id;
            // return $monthly_deposits_id;

            $members = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'monthly_status' => 1])->get();
            //return  $members;

            foreach ($members as $key => $member) {
                // return $monthly_deposits_id;
                $details =  new MonthlyDepositDetails();

                $details->monthly_deposits_id = $monthly_deposits_id;
                $details->member_id = $member->id;
                $details->years = $request->years;
                $details->month = $request->month;
                $details->deposite_date = $request->deposite_date;
                $details->monthly_fee = $member->monthly_deposit_fee;
                // return $details;
                $details->save();
                $id = $details->id;
                $code = 10000;
                $receipt = MonthlyDepositDetails::find($id);
                $receipt->deposite_code = ($code + $id);
                // return $receipt;
                $receipt->save();
            }
            return redirect()->route('deposite.index')->with('create_message', 'Deposit Generated Successfully');
        } else {

            return redirect()->route('deposite.create')->with('not_permitted', 'Deposit Already Generated');
        }
    }

    public function moneyReceipt($id)
    {
        $data['item'] = MonthlyDeposit::find($id);
        $data['details'] = MonthlyDepositDetails::where('monthly_deposits_id', $id)->get();
        $data['general_setting'] = GeneralSetting::latest()->first();
        return view('monthlydeposit.money_receipt_details', $data);

        // $customPaper = array(0,0,720,1000);  // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('deposit.money_receipt_details',$data)->setPaper($customPaper,'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString().'monthly-payment-receipt-details.pdf');

        // return $pdf; 
    }



    public function moneyreceiptSingle($id)
    {

        $data['detail'] = MonthlyDepositDetails::find($id);
        $data['general_setting'] = GeneralSetting::latest()->first();
        return view('monthlydeposit.money-receipt', $data);

        // $customPaper = array(0, 0, 720, 500);  // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('deposit.money-receipt', $data)->setPaper($customPaper, 'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString() . 'monthly-payment-receipt.pdf');
        // return $pdf;
    }


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | Add Single Customer Deposit
    |
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    public function singleCustomerDepositStore(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'monthly_deposit_fee' => 'required',
        ]);

        $deposit_year = $request->deposit_year;
        $deposit_month = $request->deposit_month;
        $member_id = $request->member_id;
        $deposit = MonthlyDeposit::where(['years' => $deposit_year, 'month' => $deposit_month])->first();

        $monthly_deposits_id = $deposit->id;
        $member = Member::where('id', $member_id)->first();
        $depositeDetails = MonthlyDepositDetails::select('deposite_details.id', 'customers.name', 'customers.member_code')
            ->join('customers', 'customers.id', '=', 'deposite_details.member_id')
            ->where(['deposite_details.years' => $deposit_year, 'deposite_details.month' => $deposit_month, 'deposite_details.member_id' => $member_id])
            ->first();


        if ($depositeDetails) {
            return redirect()->back()->with('not_permitted', 'Deposit record for this customer ' . $member->name . ' (' . $member->member_code . ') already exists.');
        } else {

            $details = new MonthlyDepositDetails();
            $details->monthly_deposits_id = $monthly_deposits_id;
            $details->member_id = $request->member_id;
            $details->years = $request->deposit_year;
            $details->month = $request->deposit_month;
            $details->deposite_date = $request->deposite_date;
            $details->monthly_fee = $request->monthly_deposit_fee;
            $details->save();
            $id = $details->id;
            $code = 10000;
            $receipt = MonthlyDepositDetails::find($id);
            $receipt->deposite_code = ($code + $id);
            $receipt->save();

            return redirect()->back()->with('create_message', 'Deposit For Customer ' . $member->name . ' (' . $member->member_code . ') Created Successfully');
        }
    }
}
