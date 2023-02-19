<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SomitiSetting extends Model
{
    protected $fillable = [
        'start_date',
        'daily_fee',
        'monthly_fee',
        'yearly_fee',
        'weekly_fee',
        'metting_fee',
        'registration_fee',
    ];
}