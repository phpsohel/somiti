<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingDeposit extends Model
{
    protected $guarded = [];

    public function meetingDepositPaid()
    {
        return $this->belongsTo(MeetingDepositDetails::class, 'id', 'meeting_deposit_id')->where(['payment_status'=> 2])
            ->selectRaw('count(payment_status) as Paid, meeting_deposit_id')
            ->groupBy('meeting_deposit_id');
    }
    public function meetingDepositAll()
    {
        return $this->belongsTo(MeetingDepositDetails::class, 'id', 'meeting_deposit_id')
            ->selectRaw('count(payment_status) as alldeposit, meeting_deposit_id')
            ->groupBy('meeting_deposit_id');
    }
    
    public function meetingDepositDetais(){
        return $this->hasOne(MeetingDepositDetails::class);
    }
}
