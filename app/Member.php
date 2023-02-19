<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        "customer_group_id",
        "user_id",
        "member_code",
        "name",
        "company_name",
        "email",
        "phone_number",
        "tax_no",
        "address",
        "city",
        "state",
        "postal_code",
        "country",
        "deposit",
        "expense",
        "is_active",
        "father_name",
        "mother_name",
        "dob", "gender",
        "religion",
        "marital_status",
        "nationality",
        "national_id",
        "passport_no",
        "passport_issue_date",
        "emergency_number",
        "image",
        "member_id",
        "member_type",
        "permanent_address",
        "joining_fee",
        "daily_deposit_fee",
        "weekly_deposit_fee",
        "monthly_deposit_fee",
        "yearly_deposit_fee",
        "meeting_fee",
        "reference",
        "daily_status",
        "weekly_status",
        "monthly_status",
        "yearly_status",
    ];

    public function depositDetails()
    {
        return $this->hasMany(MonthlyDepositDetails::class, 'member_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tota()
    {
        return $this->belongsTo('App\User');
    }

    ///////////////////  Daily //////////////////////////////
    // public function customerDailyDeposit(){
    //     return $this->hasMany(DailyDepositDetails::class,'member_id');
    // }
    // total amount
    public function dailyDeposit()
    {
        return $this->belongsTo(DailyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(daily_fee) as totaldailyamount, member_id')->groupBy('member_id');
    }

    // given status
    public function givenDailydepositcount()
    {
        return $this->belongsTo(DailyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('count(payment_status) as givenStatusCount')
            ->where('payment_status', 2)
            ->groupBy('member_id');
    }

    // due status
    public function dueDailyDepositCount()
    {
        return $this->belongsTo(DailyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('count(payment_status) as dueStatusCount')
            ->where('payment_status', 1)
            ->groupBy('member_id');
    }

    // due amount          
    public function dueDailydeposit()
    {
        return $this->belongsTo(DailyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(daily_fee) as totaldaydueamount, member_id')
            ->where('payment_status', 1)
            ->groupBy('member_id');
    }


    ///////////////////  Weekly //////////////////////////////
    // amount
    public function weeklyDeposit()
    {
        return $this->belongsTo(WeeklyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(weekly_fee) as totalweeklyamount, member_id')->groupBy('member_id');
    }

    // due status
    public function dueweeklyDepositCount()
    {
        return $this->belongsTo(WeeklyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('count(payment_status) as dueweklyStatusCount')
            ->where('payment_status', 1)
            ->groupBy('member_id');
    }
    // given status
    public function givenWeeklydepositcount()
    {
        return $this->belongsTo(WeeklyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('count(payment_status) as givenStatusCount')
            ->where('payment_status', 2)
            ->groupBy('member_id');
    }

    // due amount 
    public function dueweeklyDepositAmount()
    {
        return $this->belongsTo(WeeklyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(weekly_fee) as dueweeklyamount, member_id')
            ->where('payment_status', 1)
            ->groupBy('member_id');
    }

    ///////////////////  monthly //////////////////////////////
    public function monthlydeposit()
    {
        return $this->belongsTo(MonthlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(monthly_fee) as totalmonthmount, member_id')
            ->groupBy('member_id');
    }

    public function monthlyLatefeedeposit()
    {
        return $this->belongsTo(MonthlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(monthly_fine) as monthlyLatefee, member_id')
            ->groupBy('member_id');
    }

    // given 
    public function givenMonthlydepositcount()
    {
        return $this->belongsTo(MonthlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('count(payment_status) as givenstatuscount, member_id')
            ->where('payment_status', 2)
            ->groupBy('member_id');
    }

    // due                    # given + due = total #
    public function dueMonthlydepositcount()
    {
        return $this->belongsTo(MonthlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('count(payment_status) as duestatuscount, member_id')
            ->where('payment_status', 1)
            ->groupBy('member_id');
    }

    // due amount          
    public function dueMonthlydeposit()
    {
        return $this->belongsTo(MonthlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(monthly_fee) as totalmonthdueamount, member_id')
            ->where('payment_status', 1)
            ->groupBy('member_id');
    }


    ///////////////////  Yearly //////////////////////////////
    // amount
    public function yearlydeposit()
    {
        return $this->belongsTo(YearlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(yearly_fee) as totalyearlyamount, member_id')
            ->groupBy('member_id');
    }

    // given status
    public function Statusyearlydepositcount()
    {
        return $this->belongsTo(YearlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('count(payment_status) as statuscount, member_id')
            ->where('payment_status', 2)
            ->groupBy('member_id');
    }
    // due status
    public function dueYearlyStatusCount()
    {
        return $this->belongsTo(YearlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('count(payment_status) as dueyearlystatuscount, member_id')
            ->where('payment_status', 1)
            ->groupBy('member_id');
    }

    // due amount
    public function dueyearlydeposit()
    {
        return $this->belongsTo(YearlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(yearly_fee) as totalDueyearlyamount, member_id')
            ->where('payment_status', 1)
            ->groupBy('member_id');
    }

    public function yearlyLatefee()
    {
        return $this->belongsTo(YearlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(yearly_fine) as yearlyLatefeeamount, member_id')
            ->where('payment_status', 2)
            ->groupBy('member_id');
    }

    public function totalCompletedDepositCount()
    {

        return $this->belongsTo(YearlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('count(id) as countstatus, member_id')
            ->where('payment_status', 2)
            ->groupBy('member_id');
    }

    public function totalDepositCount()
    {

        return $this->belongsTo(YearlyDepositDetails::class, 'id', 'member_id')
            ->selectRaw('count(id) as countstatus, member_id')
            ->groupBy('member_id');
    }

    ///////////////////  Meeting Deposit //////////////////////////////

    public function dueMeetingDeposit()
    {
        return $this->belongsTo(MeetingDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(meeting_fee) as meetingAmountdue, member_id')
            ->where('payment_status', 1)
            ->groupBy('member_id');
    }
    public function givenMeetingDeposit()
    {
        return $this->belongsTo(MeetingDepositDetails::class, 'id', 'member_id')
            ->selectRaw('sum(meeting_fee) as meetingAmountgiven, member_id')
            ->where('payment_status', 2)
            ->groupBy('member_id');
    }
}
