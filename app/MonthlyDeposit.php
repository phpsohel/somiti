<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyDeposit extends Model
{
    protected $guarded = [];

    public function depositpaid()
    {
        return $this->belongsTo(MonthlyDepositDetails::class, 'id', 'monthly_deposits_id')->where(['payment_status' => 2])
            ->selectRaw('count(payment_status) as paid, monthly_deposits_id')
            ->groupBy('monthly_deposits_id');
    }
    public function depositAll()
    {
        return $this->belongsTo(MonthlyDepositDetails::class, 'id', 'monthly_deposits_id')
            ->selectRaw('count(payment_status) as alldeposit, monthly_deposits_id')
            ->groupBy('monthly_deposits_id');
    }
}
