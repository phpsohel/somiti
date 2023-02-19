<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyDeposit extends Model
{
    protected $guarded = [];

    public function dailyDepositPaid()
    {
        return $this->belongsTo(DailyDepositDetails::class,'id','daily_deposit_id')->where('payment_status',2)
        ->selectRaw('count(payment_status) as depositPaid, daily_deposit_id')
        ->groupBy('daily_deposit_id');
    }
    public function dailyDepositAll()
    {
        return $this->belongsTo(DailyDepositDetails::class,'id','daily_deposit_id')
        ->selectRaw('count(payment_status) as allDeposite, daily_deposit_id')
        ->groupBy('daily_deposit_id');
    }
  
    
}
