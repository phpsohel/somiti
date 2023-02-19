<?php

namespace App\Http\Controllers;

use App\DailyDepositDetails;
use App\Loan;
use App\MeetingDepositDetails;
use App\Member;
use App\MonthlyDepositDetails;
use App\WeeklyDepositDetails;
use App\YearlyDepositDetails;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {

        return view('home');
    }

    public function index()
    {
        // member
        $data['generalMember'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 1])->count();
        $data['borrowerMember'] = Member::where(['is_active' => 1, 'soft_deleted' => 1, 'member_type' => 2])->count();
        $data['member'] = Member::where(['is_active' => 1, 'soft_deleted' => 1])->count();
        $data['memberInactive'] = Member::where(['is_active' => 0, 'soft_deleted' => 1])->count();

        // paid
        $data['dailyDeposit'] = $dailyDeposit = DailyDepositDetails::with('member')->where('payment_status', '=', '2')->sum('grand_total');
        $data['weeklyDeposit'] = $weeklyDeposit = WeeklyDepositDetails::with('member')->where('payment_status', '=', '2')->sum('grand_total');
        $data['monthlyDeposit'] = $monthlyDeposit = MonthlyDepositDetails::with('member')->where('payment_status', '=', '2')->sum('grand_total');
        $data['yearlyDeposit'] = $yearlyDeposit = YearlyDepositDetails::with('member')->where('payment_status', '=', '2')->sum('grand_total');
        $data['meetingDeposit'] = $meetingDeposit = MeetingDepositDetails::with('member')->where('payment_status', '=', '2')->sum('grand_total');

        $data['totalPaidAmount'] = $dailyDeposit + $weeklyDeposit + $monthlyDeposit + $yearlyDeposit + $meetingDeposit;

        // due
        $data['dailyDepositDue'] = $dailyDepositDue =  DailyDepositDetails::with('member')->where('payment_status', '=', '1')->sum('daily_fee');
        $data['weeklyDepositDue'] = $weeklyDepositDue =  WeeklyDepositDetails::with('member')->where('payment_status', '=', '1')->sum('weekly_fee');
        $data['monthlyDepositDue'] = $monthlyDepositDue =  MonthlyDepositDetails::with('member')->where('payment_status', '=', '1')->sum('monthly_fee');
        $data['yearlyDepositDue'] = $yearlyDepositDue =  YearlyDepositDetails::with('member')->where('payment_status', '=', '1')->sum('yearly_fee');
        $data['meetingDepositDue'] = $meetingDepositDue =  MeetingDepositDetails::with('member')->where('payment_status', '=', '1')->sum('meeting_fee');

        $data['totalDueAmount'] = $dailyDepositDue + $weeklyDepositDue + $monthlyDepositDue + $yearlyDepositDue + $meetingDepositDue;
        // loan
        $data['interestOnlyLoan'] = Loan::where(['loan_interest_type' => 2, 'loan_status' => 2])->sum('grand_total');
        $data['flatLoan'] = Loan::where(['loan_interest_type' => 1, 'loan_status' => 2])->sum('grand_total');

        // line chart
        // how much paid in month of a year 
        $data['dailyDepositPaidInYear'] = $dailyDepositPaidInYear = DailyDepositDetails::where('payment_status', '=', '2')
            ->whereYear('created_at', date('Y'))
            ->selectRaw('sum(grand_total) as total')
            ->groupByRaw('Month(created_at)')
            ->pluck('total');
        // return $dailyDepositPaidInYear;

        // $data['dailyDepositPaidInMonth'] = $dailyDepositPaidInMonth = DailyDepositDetails::where('payment_status', '=', '2')->whereMonth('created_at', date('m'))->sum('grand_total');

        return view('index', $data);
    }
}
