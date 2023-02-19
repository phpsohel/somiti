<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeeklyDeposit extends Model
{
    protected $guarded = [];

    public function weeklyDepositPaid()
    {
        return $this->belongsTo(WeeklyDepositDetails::class, 'id', 'weekly_deposit_id')->where(['payment_status'=> 2])
            ->selectRaw('count(payment_status) as paid, weekly_deposit_id')
            ->groupBy('weekly_deposit_id');
    }
    public function weeklyDepositAll()
    {
        return $this->belongsTo(WeeklyDepositDetails::class, 'id', 'weekly_deposit_id')
            ->selectRaw('count(payment_status) as alldeposit, weekly_deposit_id')
            ->groupBy('weekly_deposit_id');
    }
}
