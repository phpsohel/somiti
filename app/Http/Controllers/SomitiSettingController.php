<?php

namespace App\Http\Controllers;

use App\SomitiSetting;
use Illuminate\Http\Request;

class SomitiSettingController extends Controller
{
    public function index()
    {
        return view('somiti-setting.create');
    }
    public function create()
    {

        $data['item'] = SomitiSetting::first();
        return view('somiti-setting.create', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'monthly_fee' => 'required',
            'yearly_fee' => 'required',
            'weekly_fee' => 'required',
            'meeting_fee' => 'required',
        ]);
        $setting = new SomitiSetting();
        $setting->start_date = $request->start_date;
        $setting->monthly_fee = $request->monthly_fee;
        $setting->yearly_fee = $request->yearly_fee;
        $setting->weekly_fee = $request->weekly_fee;
        $setting->daily_fee = $request->daily_fee;
        $setting->registration_fee = $request->registration_fee;
        $setting->meeting_fee = $request->meeting_fee;
        $setting->save();
        return redirect()->route('somiti-setting.create')->with('message', 'Somity Setting Inserted Successfully');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required',
            'monthly_fee' => 'required',
            'yearly_fee' => 'required',
            'weekly_fee' => 'required',
            'meeting_fee' => 'required',
        ]);
        $setting =  SomitiSetting::find($id);
        $setting->start_date = $request->start_date;
        $setting->monthly_fee = $request->monthly_fee;
        $setting->yearly_fee = $request->yearly_fee;
        $setting->weekly_fee = $request->weekly_fee;
        $setting->daily_fee = $request->daily_fee;
        $setting->meeting_fee = $request->meeting_fee;
        $setting->registration_fee = $request->registration_fee;
        $setting->save();
        return redirect()->route('somiti-setting.create')->with('message', 'Somity Setting Updated Successfully');
    }
}
