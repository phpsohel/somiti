<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeeklyDepositDetails extends Model
{
    protected $guarded = [];

    public function member()
    {
    	return $this->belongsTo(Member::class );
    }
}
