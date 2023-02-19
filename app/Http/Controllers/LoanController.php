<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\CustomerGroup;
use App\Loan;
use App\GeneralSetting;
use Illuminate\Support\Facades\Auth;
use App\MemberLoanDetails;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        // $data['lims_customer_group_all'] = CustomerGroup::where('is_active', true)->get();
        $paginate = 100;
        $general_setting = GeneralSetting::latest()->first();
        if (Auth::user()->role_id > 2 && $general_setting->staff_access == 'own') {
            $data['somitiloans'] = Loan::orderBy('id', "DESC")
                ->where('created_by', auth()->user()->id)
                ->paginate($paginate);
        } else {

            $data['somitiloans'] = Loan::orderBy('id', "DESC")->paginate($paginate);
        }
        $data['members'] = Member::orderBy('id', 'DESC')->where('is_active', 1)->get();
        return view('somiti-loan.index', $data)
            ->with('i', ($request->input('page', 1) - 1) * $paginate);
    }

    public function searchloanlistbyajax(Request $request)
    {
        $search = $request->search;
        $data['somitiloans'] = Loan::with('member')
            ->where('loan_code', $search)
            ->orwhere('member_id', $search)
            ->orderBy('id', 'DESC')
            ->get();
        return view('somiti-loan.search_by_ajax', $data);
    }
    public function loanDetailReceipt($id)
    {

        $data['item'] = Loan::find($id);
        $data['loandetails'] = MemberLoanDetails::where('somiti_laon_id', $id)->get();
        return view('somiti-loan.loan_details_money_receipt', $data);

        // $customPaper = array(0,0,720,1000);  // 1,000 for full page & 500 for half page
        // $pdf = PDF::loadView('somiti-loan.loan_details_money_receipt',$data)->setPaper($customPaper,'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString().'loan-payment-receipt.pdf');
        // return $pdf;
    }

    public function memberLoanDetails($id)
    {
        $data['item'] = Loan::find($id);
        $data['loandetails'] = MemberLoanDetails::where('somiti_laon_id', $id)->get();

        return view('somiti-loan.member_loan_details', $data);
    }

    public function memberLoanDeposite(Request $request)
    {
        // return $request->all();
        $details = MemberLoanDetails::where('id', $request->loan_details_id)->first();
        $details->payment_date = $request->payment_date;
        $details->loan_fine_amount = $request->loan_fine_amount ?? 0;
        $details->grand_total = $request->grand_total;
        $details->payment_status = 2;
        $details->updated_by = Auth()->user()->id;
        $details->save();
        return back()->with('message', 'Loan Deposited Successfully');
    }

    public function create()
    {

        $lastloan = Loan::orderBy('id', 'DESC')->first();
        $alpha = "10000";
        if (!empty($lastloan)) {
            $data['code'] =  $alpha + ($lastloan->id + 1);
        } else {
            $data['code'] =  $alpha + '1';
        }

        return view('somiti-loan.create', $data);
    }


    public function getMemberbyAjax(Request $request)
    {
        $data['members'] = Member::where('member_type', $request->member_type)->where('is_active', 1)->where('soft_deleted', 1)->get();
        return view('somiti-loan.get_member_byajax', $data);
    }


    public function store(Request $request)
    {
        // return $request->all();

        $allData = new Loan();
        $allData->member_id = $request->member_id;
        $allData->disburse = $request->disburse;
        $allData->loan_code = $request->loan_code;
        $allData->loan_release_date = $request->loan_release_date;
        $allData->principal_amount = $request->principal_amount;
        $allData->loan_interest_type = $request->loan_interest_type;
        $allData->loan_interest = $request->loan_interest;
        $allData->loan_duration_type = $request->loan_duration_type;
        $allData->loan_interest_amount = $request->loan_interest_amount;
        $allData->loan_duration = $request->loan_duration;
        $allData->grand_total = $request->grand_total;
        $allData->created_by = Auth()->user()->id;
        $allData->save();
        $id = $allData->id;

        $principalamount = ($request->principal_amount / $request->loan_duration);
        $interest_amount = ($request->loan_interest_amount / $request->loan_duration);
        $ground_total = ($principalamount + $interest_amount);
        $date = $request->loan_release_date;
        $loan_duration_type = $request->loan_duration_type;
        if ($loan_duration_type == 1) {
            for ($i = 1; $i <= $request->loan_duration; $i++) {
                $detail = new MemberLoanDetails();
                $detail->somiti_laon_id = $id;
                $detail->principal_amount = $principalamount;
                $detail->loan_interest_amount = $interest_amount;
                $detail->grand_total = $ground_total;
                $detail->member_id = $request->member_id;
                $detail->loan_interest = $request->loan_interest;
                $detail->payment_start_date = date('Y-m-d', strtotime($date . ' +' . $i . 'day'));
                $detail->created_by = Auth()->user()->id;
                $detail->save();
            }
        } elseif ($loan_duration_type == 2) {
            for ($i = 1; $i <= $request->loan_duration; $i++) {
                $detail = new MemberLoanDetails();
                $detail->somiti_laon_id = $id;
                $detail->principal_amount = $principalamount;
                $detail->loan_interest_amount = $interest_amount;
                $detail->grand_total = $ground_total;
                $detail->member_id = $request->member_id;
                $detail->loan_interest = $request->loan_interest;
                $detail->payment_start_date = date('Y-m-d', strtotime($date . ' +' . $i . 'week'));
                $detail->created_by = Auth()->user()->id;
                $detail->save();
            }
        } elseif ($loan_duration_type == 3) {
            for ($i = 1; $i <= $request->loan_duration; $i++) {
                $detail = new MemberLoanDetails();
                $detail->somiti_laon_id = $id;
                $detail->principal_amount = $principalamount;
                $detail->loan_interest_amount = $interest_amount;
                $detail->grand_total = $ground_total;
                $detail->member_id = $request->member_id;
                $detail->loan_interest = $request->loan_interest;
                $detail->payment_start_date = date('Y-m-d', strtotime($date . ' +' . $i . 'months'));
                $detail->created_by = Auth()->user()->id;
                $detail->save();
            }
        } elseif ($loan_duration_type == 4) {
            for ($i = 1; $i <= $request->loan_duration; $i++) {
                $detail = new MemberLoanDetails();
                $detail->somiti_laon_id = $id;
                $detail->principal_amount = $principalamount;
                $detail->loan_interest_amount = $interest_amount;
                $detail->grand_total = $ground_total;
                $detail->member_id = $request->member_id;
                $detail->loan_interest = $request->loan_interest;
                $detail->payment_start_date = date('Y-m-d', strtotime($date . ' +' . $i . 'year'));
                $detail->created_by = Auth()->user()->id;
                $detail->save();
            }
        }

        return redirect()->route('somiti-loan.index')->with('message', 'Loan Created Successfully');
    }

    public function edit($id)
    {
        $data['members'] = Member::orderBy('id', 'DESC')->where('is_active', 1)->get();
        $data['somitiloan'] = Loan::find($id);
        // return $data['somitiloan'] ;
        return view('somiti-loan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // return $request->all(); 

        $allData = Loan::find($id);
        $allData->member_id = $request->member_id;
        $allData->disburse = $request->disburse;
        $allData->loan_code = $request->loan_code;
        $allData->loan_release_date = $request->loan_release_date;
        $allData->principal_amount = $request->principal_amount;
        $allData->loan_interest_type = $request->loan_interest_type;
        $allData->loan_interest = $request->loan_interest;
        $allData->loan_duration_type = $request->loan_duration_type;
        $allData->loan_interest_amount = $request->loan_interest_amount;
        $allData->loan_duration = $request->loan_duration;
        $allData->grand_total = $request->grand_total;
        $allData->created_by = Auth()->user()->id;
        $allData->save();
        MemberLoanDetails::where('somiti_laon_id', $id)->delete();

        $principalamount = ($request->principal_amount / $request->loan_duration);
        $interest_amount = ($request->loan_interest_amount / $request->loan_duration);
        $ground_total = ($principalamount + $interest_amount);
        $date = $request->loan_release_date;

        for ($i = 1; $i <= $request->loan_duration; $i++) {
            $detail = new MemberLoanDetails();
            $detail->somiti_laon_id = $id;
            $detail->principal_amount = $principalamount;
            $detail->loan_interest_amount = $interest_amount;
            $detail->grand_total = $ground_total;
            $detail->member_id = $request->member_id;
            $detail->loan_interest = $request->loan_interest;
            $detail->payment_start_date = date('Y-m-d', strtotime($date . ' +' . $i . 'months'));
            $detail->created_by = Auth()->user()->id;
            $detail->save();
        }
        return redirect()->route('somiti-loan.index')->with('message', 'Loan Updated Successfully');
    }


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | Approve Loan Status By Admin
    |
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    public function approveLoan(Request $request)
    {
        // return $request->all();

        // $data['lims_customer_group_all'] = CustomerGroup::where('is_active', true)->get();
        $paginate = 100;
        $general_setting = GeneralSetting::latest()->first();
        if (Auth::user()->role_id > 2 && $general_setting->staff_access == 'own') {
            $data['somitiloans'] = Loan::where('loan_status', '=', '1')
                ->orderBy('id', "DESC")
                ->paginate($paginate);
        } else {

            $data['somitiloans'] = Loan::where('loan_status', '=', '1')
                ->orderBy('id', "DESC")->paginate($paginate);
        }

        return view('somiti-loan.approve-loan', $data)
            ->with('i', ($request->input('page', 1) - 1) * $paginate);
    }


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | Update Loan Status By
    |
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    public function updateLoanStatus(Request $request)
    {
        // return $request->all(); 

        $id = $request->id;
        // return $id;

        // $allData = SomitiLoan::find($id);
        // $allData->loan_status = $request->loan_status;
        // $allData->save();

        $update = Loan::where('id', $id)->update([
            'loan_status' => '2'
        ]);
        // return $update;

        $findLoanDetail = Loan::find($id);
        // return $findLoanDetail;

        MemberLoanDetails::where('somiti_laon_id', $id)->delete();

        $principalamount = ($findLoanDetail->principal_amount / $findLoanDetail->loan_duration);
        $interest_amount = ($findLoanDetail->loan_interest_amount / $findLoanDetail->loan_duration);
        $ground_total = ($principalamount + $interest_amount);
        $date = $findLoanDetail->loan_release_date;

        for ($i = 1; $i <= $findLoanDetail->loan_duration; $i++) {
            $detail = new MemberLoanDetails();
            $detail->somiti_laon_id = $id;
            $detail->principal_amount = $principalamount;
            $detail->loan_interest_amount = $interest_amount;
            $detail->grand_total = $ground_total;
            $detail->member_id = $findLoanDetail->member_id;
            $detail->loan_interest = $findLoanDetail->loan_interest;
            $detail->payment_start_date = date('Y-m-d', strtotime($date . ' +' . $i . 'months'));
            $detail->created_by = Auth()->user()->id;
            $detail->save();
        }

        return redirect()->route('somiti-loan.approve')->with('message', 'Loan Status Updated Successfully');
    }


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | Get Single Loan Detail
    |
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    public function singleLoanDetail($loanID, $memberLoanID)
    {

        $data['item'] = Loan::find($loanID);
        $data['loandetails'] = MemberLoanDetails::where('id', $memberLoanID)->get();

        $data['general_setting'] = GeneralSetting::latest()->first();
        return view('somiti-loan.single_loan_details_money_receipt', $data);

        // $customPage = array(0,0,720,500);
        // $pdf = PDF::loadView('somiti-loan.single_loan_details_money_receipt',$data)->setPaper( $customPage,'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString().'Loan-payment-receipt.pdf');
        // return $pdf; 
    }
}
