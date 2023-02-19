<?php

namespace App\Http\Controllers;

use App\Member;
use App\GeneralSetting;
use App\MeetingDeposit;
use App\MeetingDepositDetails;
use App\SomitiSetting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class MeetingDepositController extends Controller
{

    public function index(Request $request)
    {
        $paginate = 20;
        $data['items'] = MeetingDeposit::orderBy('id', 'DESC')->paginate($paginate);

        return view('meetingDeposit.index', $data)->with('i', ($request->input('page', 1) - 1) * $paginate);
    }

    public function searchByAjax(Request $request)
    {
        $search = $request->search;
        $data['items'] = MeetingDeposit::where('year', $search)
            ->orwhere('month', $search)
            ->orderBy('id', 'DESC')
            ->get();

        return view('meetingDeposit.search_deposite_by_ajax', $data);
    }

    public function depositDetails($id)
    {
        $data['item'] = MeetingDeposit::find($id);
        $data['depositdetails'] = MeetingDepositDetails::where('meeting_deposit_id', $id)->get();
        $data['generalMemberLists'] = Member::where(['is_active' => 1, 'soft_deleted' => 1])->get();
        return view('meetingDeposit.deposit_details', $data);
    }

    // edit payment receipt
    public function moneyReceiptEdit($id)
    {
        $data['details'] = MeetingDepositDetails::find($id);
        // return $data['details'];
        return view('meetingDeposit.money_receipt_edit', $data);
    }
    public function updatedepositPayment(Request $request, $id)
    {
        $allData = MeetingDepositDetails::find($id);

        $allData->transition_id = $request->transition_id;
        
        $grand_total = ($request->meeting_fee + ($request->meeting_fine ?? 0));
        $allData->payment_date = $request->payment_date;
        $allData->payment_type = $request->payment_type;
        $allData->meeting_fine = $request->meeting_fine;
        $allData->bank_name = $request->bank_name;
        $allData->branch_name = $request->branch_name;
        $allData->check_no = $request->check_no;
        $allData->phone_number = $request->phone_number;
        $allData->grand_total = $grand_total;
        $allData->save();
        return redirect()->back()->with('create_message', 'Deposit Updated Successfully');
    }


    public function meetingMoneyReceipt($id)
    {
        $data['item'] = MeetingDeposit::find($id);
        $data['details'] = MeetingDepositDetails::where('meeting_deposit_id', $id)->get();
        $data['general_setting'] = GeneralSetting::latest()->first();
        return view('meetingDeposit.money_receipt_details', $data);

        // $customPaper = array(0, 0, 720, 1000);  
        // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('meetingDeposit.money_receipt_details', $data)->setPaper($customPaper, 'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString() . 'meeting-payment-receipt-details.pdf');

        // return $pdf;
    }

    public function meetingmoneyreceiptSingle($id)
    {

        $data['detail'] = MeetingDepositDetails::find($id);
        // return $detail;
        $data['general_setting'] = GeneralSetting::latest()->first();
        return view('meetingDeposit.money-receipt', $data);

        // $customPaper = array(0,0,720,500);  // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('meetingDeposit.money-receipt',$data)->setPaper($customPaper,'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString().'meeting-payment-receipt.pdf');
        // return $pdf; 
    }

    public function singlecustomermeetingdepositstore(Request $request)
    {

        // return $request->all();

        $request->validate([
            'member_id' => 'required',
            'meeting_fee' => 'required',
        ]);
        // return $request->all();

        $deposit_year = $request->deposit_year;
        $deposit_month = $request->deposit_month;
        $member_id = $request->member_id;
        $deposit = MeetingDeposit::where(['year' => $deposit_year, 'month' => $deposit_month, 'deposite_date' => $request->deposite_date])->first();
        // return $deposit;

        $deposit_id = $deposit->id;
        $member = Member::where('id', $member_id)->first();
        $depositeDetails = MeetingDepositDetails::where(['year' => $deposit_year, 'month' => $deposit_month, 'member_id' => $member_id, 'deposite_date' => $request->deposite_date])
            ->first();


        if ($depositeDetails) {
            return redirect()->back()->with('not_permitted', 'Deposit record for this Member ' . $member->name . ' (' . $member->member_code . ') already exists.');
        } else {

            $details = new MeetingDepositDetails();
            $details->meeting_deposit_id = $deposit_id;
            $details->member_id = $request->member_id;
            $details->year = $request->deposit_year;
            $details->month = $request->deposit_month;
            $details->deposite_date = $request->deposite_date;
            $details->meeting_fee = $request->meeting_fee;
            $details->save();
            $id = $details->id;
            $code = 10000;
            $receipt = MeetingDepositDetails::find($id);
            $receipt->deposite_code = ($code + $id);
            $receipt->save();

            return redirect()->back()->with('create_message', 'Deposit For Customer ' . $member->name . ' (' . $member->member_code . ') Created Successfully');
        }
    }


    public function create()
    {
        return view('meetingDeposit.create');
    }


    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'month' => 'required',
            'year' => 'required',
            'deposite_date' => 'required',
        ]);
        // return 'check';
        $check = MeetingDeposit::where(['year' => $request->year, 'month' => $request->month, 'deposite_date' => $request->deposite_date])->first();
        // return 'checked';
        if (!$check) {
            // return 'not have';
            $allData = MeetingDeposit::create([
                'month' => $request->month,
                'year' => $request->year,
                'deposite_date' => $request->deposite_date,
                'note' => $request->note,
                'user_id' => auth()->user()->id,
            ]);
            // return $allData;

            $deposit_id = $allData->id;

            $members =   Member::where(['is_active' => 1, 'soft_deleted' => 1])->get();
            // return $members;
            $somiti = SomitiSetting::first();

            foreach ($members as $key => $member) {

                $details = new MeetingDepositDetails();
                $details->meeting_deposit_id = $deposit_id;
                $details->member_id = $member->id;
                $details->year = $request->year;
                $details->month = $request->month;
                $details->deposite_date = $request->deposite_date;
                $details->meeting_fee = $somiti->meeting_fee;
                $details->save();
                $id = $details->id;
                $code = 10000;
                $receipt = MeetingDepositDetails::find($id);
                $receipt->deposite_code = ($code + $id);
                $receipt->save();
            }

            return redirect()->route('meetingdeposite.index')->with('create_message', 'Meeting Deposit Generated Successfully');
        } else {
            // return 'already have';
            return redirect()->route('meetingdeposite.create')->with('not_permitted', 'Meeting Deposit Already Generated');
        }
    }

    public function meetingDepositPayment(Request $request)
    {
        // return $request->all();

        $grand_total = ($request->meeting_fee + ($request->meeting_fine ?? 0));
        $allData = MeetingDepositDetails::where('id', $request->deposit_details_id)->first();
        // return $allData;

        $allData->payment_date = $request->payment_date;
        $allData->payment_status = 2;
        $allData->meeting_fine = $request->meeting_fine ?? 0;
        $allData->grand_total = $grand_total ?? 0;

        $allData->transition_id = $request->transition_id;
        $allData->cheque_date = $request->cheque_date;

        $allData->payment_type = $request->payment_type;
        $allData->bank_name = $request->bank_name;
        $allData->branch_name = $request->branch_name;
        $allData->check_no = $request->check_no;
        $allData->phone_number = $request->phone_number;

        $allData->save();
        return redirect()->route('meetingDepositDetails', $request->deposit_id)->with('create_message', 'Meeting Deposit collected Successfully');
    }
}
