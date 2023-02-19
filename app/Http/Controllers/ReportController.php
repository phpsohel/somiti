<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DailyDepositDetails;
use App\MonthlyDepositDetails;
use App\Member;
use App\MemberLoanDetails;
use App\WeeklyDepositDetails;
use App\YearlyDepositDetails;

class ReportController extends Controller
{

    public function memberWiseDeposit(Request $request)
    {
        $data['start_date'] = '';
        $data['end_date'] = '';
        $data['customer_id'] = '';
        $data['setting'] = \App\GeneralSetting::first();
        $data['depositdetails'] = MonthlyDepositDetails::orderBy('id', 'DESC')->where('deposite_date', date('Y-m-d'))->get();
        $data['members'] = Member::with('depositDetails')->where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1])->get();

        return view('report.member_wise_deposite_report', $data);
    }

    public function memberWiseDepositSearch(Request $request)
    {
        // return $request->all();

        $data['start_date'] = $start_date = $request->start_date;
        $data['end_date'] = $end_date = $request->end_date;
        $data['customer_id'] = $customer_id = $request->customer_id;
        $data['setting'] = \App\GeneralSetting::first();
        $data['members'] = Member::with('depositDetails')->where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1])->get();

        if ($start_date && $end_date && $customer_id) {
            $data['depositdetails'] = MonthlyDepositDetails::with('member')->orderBy('id', 'DESC')
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->where('member_id', $customer_id)
                ->get();
        } elseif ($customer_id) {
            $data['depositdetails'] = MonthlyDepositDetails::with('member')
                ->where('member_id', '=', $customer_id)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $data['depositdetails'] = MonthlyDepositDetails::with('member')->orderBy('id', 'DESC')->get();
        }

        return view('report.member_wise_deposite_report', $data);
    }

    public function memberWiseLoanDetail(Request $request)
    {
        $data['start_date'] = '';
        $data['end_date'] = '';
        $data['customer_id'] = '';
        $data['payment_status'] = '';
        $data['setting'] = \App\GeneralSetting::first();
        $data['loandetails'] = MemberLoanDetails::orderBy('id', 'DESC')
            ->where('payment_start_date', date('Y-m-d'))
            ->get();
        $data['members'] = Member::where(['is_active' => 1, 'soft_deleted' => 1])->get();

        return view('report.member_wise_loan_report', $data);
    }

    public function memberWiseLoanDetailSearch(Request $request)
    {
        // return $request->all();

        $data['start_date'] = $start_date = $request->start_date;
        $data['end_date'] = $end_date = $request->end_date;
        $data['customer_id'] = $customer_id = $request->customer_id;
        $data['payment_status'] = $payment_status = $request->payment_status;
        $data['setting'] = \App\GeneralSetting::first();

        if ($start_date && $end_date && $customer_id && $payment_status) {
            $data['loandetails'] = MemberLoanDetails::orderBy('id', 'DESC')
                ->whereBetween('payment_start_date', array($start_date, $end_date))
                ->where(['member_id' => $customer_id, 'payment_status' => $payment_status])
                ->get();
        } elseif ($start_date && $end_date && $customer_id) {
            $data['loandetails'] = MemberLoanDetails::orderBy('id', 'DESC')
                ->whereBetween('payment_start_date', array($start_date, $end_date))
                ->where(['member_id' => $customer_id])
                ->get();
        } elseif ($start_date && $end_date && $payment_status) {
            //return $payment_status;
            $data['loandetails'] = MemberLoanDetails::orderBy('id', 'DESC')
                ->whereBetween('payment_start_date', array($start_date, $end_date))
                ->where('payment_status', $payment_status)
                ->get();
        } elseif ($customer_id && $payment_status) {
            $data['loandetails'] = MemberLoanDetails::orderBy('id', 'DESC')
                ->where(['member_id' => $customer_id, 'payment_status' => $payment_status])
                ->get();
        } elseif ($payment_status) {

            $data['loandetails'] = MemberLoanDetails::where('payment_status', $payment_status)
                ->get();
        } elseif ($customer_id) {
            $data['loandetails'] = MemberLoanDetails::orderBy('id', 'DESC')
                ->where('member_id', $customer_id)
                ->get();
        } else {

            $data['loandetails'] = MemberLoanDetails::orderBy('id', 'DESC')
                ->get();
        }
        $data['members'] = Member::where(['is_active' => 1, 'soft_deleted' => 1])->get();

        return view('report.member_wise_loan_report', $data);
    }

    //////////////////////// daily report  ////////////////////////
    public function dailyContributionReport(Request $request)
    {
        $data['start_date'] = date('Y-m-d');
        $data['end_date'] = date('Y-m-d');
        $data['customer_id'] = '';
        $data['payment_status'] = '';
        $data['members'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'daily_status' => 1])->get();

        $data['setting'] = \App\GeneralSetting::first();
        $data['customers'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'daily_status' => 1])->get();
        // return $data['customers'];
        return view('report.daily_contribution_report', $data);
    }

    public function dailydepositreportsearch(Request $request)
    {
        // return $request->all();

        $data['start_date'] = $start_date = $request->start_date;
        $data['end_date'] = $end_date = $request->end_date;
        $data['payment_status'] = $payment_status =  $request->payment_status;
        $data['customer_id'] = $customer_id = $request->customer_id;
        $data['setting'] = \App\GeneralSetting::first();
        // return $request->all();
        $data['members'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'daily_status' => 1])->get();
        // return $data['members'];

        if ($start_date && $end_date && $payment_status && $customer_id) {
            $data['dailyDetails'] = DailyDepositDetails::orderBy('id', 'DESC')
                ->where(['member_id' => $customer_id, 'payment_status' => $payment_status])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date && $payment_status) {
            $data['dailyDetails'] = DailyDepositDetails::orderBy('id', 'DESC')
                ->where(['payment_status' => $payment_status])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date && $customer_id) {
            $data['dailyDetails'] = DailyDepositDetails::orderBy('id', 'DESC')
                ->where(['member_id' => $customer_id])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date) {
            $data['dailyDetails'] = DailyDepositDetails::orderBy('id', 'DESC')
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($customer_id) {
            $data['dailyDetails'] = DailyDepositDetails::where('member_id', '=', $customer_id)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $data['dailyDetails'] = DailyDepositDetails::all();
        }
        return view('report.daily_contribution_report_search', $data);
    }

    ////////////////////////// weekly report ////////////////////////
    public function weeklyContributionReport(Request $request)
    {
        $data['start_date'] = '';
        $data['end_date'] = '';
        $data['customer_id'] = '';
        $data['payment_status'] = '';
        $data['members'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'weekly_status' => 1])->get();

        $data['setting'] = \App\GeneralSetting::first();
        $data['customers'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'weekly_status' => 1])->get();

        return view('report.weekly_contribution_report', $data);
    }

    public function weeklyContributionReportSearch(Request $request)
    {
        // return $request->all();

        $data['start_date'] = $start_date = $request->start_date;
        $data['end_date'] = $end_date = $request->end_date;
        $data['payment_status'] = $payment_status =  $request->payment_status;
        $data['customer_id'] = $customer_id = $request->customer_id;
        $data['setting'] = \App\GeneralSetting::first();
        $data['members'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'weekly_status' => 1])->get();

        if ($start_date && $end_date && $payment_status && $customer_id) {
            $data['weeklyDetails'] = WeeklyDepositDetails::orderBy('id', 'DESC')
                ->where(['member_id' => $customer_id, 'payment_status' => $payment_status])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date && $payment_status) {
            $data['weeklyDetails'] = WeeklyDepositDetails::orderBy('id', 'DESC')
                ->where(['payment_status' => $payment_status])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date && $customer_id) {
            $data['weeklyDetails'] = WeeklyDepositDetails::orderBy('id', 'DESC')
                ->where(['member_id' => $customer_id])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date) {
            $data['weeklyDetails'] = WeeklyDepositDetails::orderBy('id', 'DESC')
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($customer_id) {
            $data['weeklyDetails'] = WeeklyDepositDetails::where('member_id', '=', $customer_id)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $data['weeklyDetails'] = WeeklyDepositDetails::all();
        }
        return view('report.weekly_contribution_report_search', $data);
    }

    ////////////////////////// monthly report ////////////////////////
    public function monthlyContributionReport(Request $request)
    {
        $data['start_date'] = '';
        $data['end_date'] = '';
        $data['customer_id'] = '';
        $data['payment_status'] = '';
        $data['members'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'monthly_status' => 1])->get();

        $data['setting'] = \App\GeneralSetting::first();
        $data['customers'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'monthly_status' => 1])->get();

        return view('report.monthly_contribution_report', $data);
    }

    public function monthlyContributionReportSearch(Request $request)
    {
        // return $request->all();

        $data['start_date'] = $start_date = $request->start_date;
        $data['end_date'] = $end_date = $request->end_date;
        $data['payment_status'] = $payment_status =  $request->payment_status;
        $data['customer_id'] = $customer_id = $request->customer_id;
        $data['setting'] = \App\GeneralSetting::first();
        $data['members'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'monthly_status' => 1])->get();

        if ($start_date && $end_date && $payment_status && $customer_id) {
            $data['monthlyDetails'] = MonthlyDepositDetails::orderBy('id', 'DESC')
                ->where(['member_id' => $customer_id, 'payment_status' => $payment_status])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date && $payment_status) {
            $data['monthlyDetails'] = MonthlyDepositDetails::orderBy('id', 'DESC')
                ->where(['payment_status' => $payment_status])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date && $customer_id) {
            $data['monthlyDetails'] = MonthlyDepositDetails::orderBy('id', 'DESC')
                ->where(['member_id' => $customer_id])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date) {
            $data['monthlyDetails'] = MonthlyDepositDetails::orderBy('id', 'DESC')
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($customer_id) {
            $data['monthlyDetails'] = MonthlyDepositDetails::where('member_id', '=', $customer_id)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $data['monthlyDetails'] = MonthlyDepositDetails::all();
        }
        return view('report.monthly_contribution_report_search', $data);
    }

    ////////////////////////// yearly report ////////////////////////
    public function yearlyContributionReport(Request $request)
    {
        $data['start_date'] = '';
        $data['end_date'] = '';
        $data['customer_id'] = '';
        $data['payment_status'] = '';
        $data['members'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'yearly_status' => 1])->get();

        $data['setting'] = \App\GeneralSetting::first();
        $data['customers'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'yearly_status' => 1])->get();

        return view('report.yearly_contribution_report', $data);
    }

    public function yearlyContributionReportSearch(Request $request)
    {

        // return $request->all();

        $data['start_date'] = $start_date = $request->start_date;
        $data['end_date'] = $end_date = $request->end_date;
        $data['payment_status'] = $payment_status =  $request->payment_status;
        $data['customer_id'] = $customer_id = $request->customer_id;
        $data['setting'] = \App\GeneralSetting::first();
        $data['members'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1, 'yearly_status' => 1])->get();

        if ($start_date && $end_date && $payment_status && $customer_id) {
            $data['yearlyDetails'] = YearlyDepositDetails::orderBy('id', 'DESC')
                ->where(['member_id' => $customer_id, 'payment_status' => $payment_status])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date && $payment_status) {
            $data['yearlyDetails'] = YearlyDepositDetails::orderBy('id', 'DESC')
                ->where(['payment_status' => $payment_status])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date && $customer_id) {
            $data['yearlyDetails'] = YearlyDepositDetails::orderBy('id', 'DESC')
                ->where(['member_id' => $customer_id])
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($start_date && $end_date) {
            $data['yearlyDetails'] = YearlyDepositDetails::orderBy('id', 'DESC')
                ->whereBetween('deposite_date', array($start_date, $end_date))
                ->get();
        } elseif ($customer_id) {
            $data['yearlyDetails'] = YearlyDepositDetails::where('member_id', '=', $customer_id)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $data['yearlyDetails'] = YearlyDepositDetails::all();
        }
        return view('report.yearly_contribution_report_search', $data);
    }

    //////////////////////// Summary Report ////////////////////////
    public function depositReport(Request $request)
    {
        $data['setting'] = \App\GeneralSetting::first();
        $data['customers'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1])->get();
        return view('report.monthly_yearly_deposit_report', $data);
    }
}
