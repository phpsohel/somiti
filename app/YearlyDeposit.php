<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearlyDeposit extends Model
{
    protected $guarded = [];

    public function yearlyDepositPaid()
    {
        return $this->belongsTo(YearlyDepositDetails::class, 'id', 'yearly_deposit_id')->where(['payment_status'=> 2])
            ->selectRaw('count(payment_status) as Paid, yearly_deposit_id')
            ->groupBy('yearly_deposit_id');
    }
    public function yearlyDepositAll()
    {
        return $this->belongsTo(YearlyDepositDetails::class, 'id', 'yearly_deposit_id')
            ->selectRaw('count(payment_status) as alldeposit, yearly_deposit_id')
            ->groupBy('yearly_deposit_id');
    }
}
