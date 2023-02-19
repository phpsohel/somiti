<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SomitiSetting;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Member;
use App\MonthlyDeposit;
use App\MonthlyDepositDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Throwable;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if (empty($all_permission))
                $all_permission[] = 'dummy text';
            $paginate = 20;
            $lims_customer_all = Member::orderBy('id', 'DESC')->where('soft_deleted', 1)->paginate($paginate);
            return view('customer.index', compact('lims_customer_all', 'all_permission'))
                ->with('i', ($request->input('page', 1) - 1) * $paginate);
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }


    // search customer by ajax
    public function customerSearch(Request $request)
    {

        $search = $request->search;

        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if (empty($all_permission))
                $all_permission[] = 'dummy text';
            $paginate = 20;
            $lims_customer_all = Member::where('name', 'like', "%$search%")
                ->orwhere('company_name', 'like', "%$search%")
                ->orwhere('email', 'like', "%$search%")
                ->orwhere('member_code', 'like', "%$search%")
                ->orwhere('phone_number', 'like', "%$search%")
                ->paginate($paginate);
            // dd( $lims_customer_all);
            return view('customer.get_by_ajax_member_search', compact('lims_customer_all', 'all_permission'))
                ->with('i', ($request->input('page', 1) - 1) * $paginate);
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function create()
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-add')) {
            // $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
            $somiti_setting = SomitiSetting::first();
            $lastmember = Member::orderBy('id', 'DESC')->first();
            $alpha = "100";
            if (!empty($lastmember)) {
                $code =  $alpha . ($lastmember->id + 1);
            } else {
                $code = $alpha . '1';
            }
            return view('customer.create', compact('code', 'somiti_setting'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function store(Request $request)
    {

        // return $request->all();

        $this->validate($request, [
            'phone_number' => [
                'max:255',
                Rule::unique('members')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            'email' => 'unique:members',
        ]);
        // return 'validated';

        $lims_customer_data = $request->all();
        //  return  $lims_customer_data;
        $lims_customer_data['is_active'] = true;
        $image = $request->image;
        if ($image) {
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '.' . $ext;
            $image->move('public/images/customer', $imageName);

            $lims_customer_data['image'] = $imageName;
        }
        //creating user if given user access

        $message = 'Member created successfully';

        $lims_customer_data['name'] = $lims_customer_data['name'];
        try{
            Member::create($lims_customer_data);
        }catch(Throwable $e){
            return redirect()->back()->with('not_permitted','Email should be unique');
        }
        // return $member;

        return redirect()->route('memberinfo.index')->with('create_message', $message);
    }

    public function edit($id)
    {
        // dd('here');
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-edit')) {
            $lims_customer_data = Member::find($id);
            // return $lims_customer_data;
            // $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
            return view('customer.edit', compact('lims_customer_data'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }


    public function customerProfile($id)
    {

        $data['lims_customer_data'] = Member::find($id);
        // $data['lims_customer_group_all'] = CustomerGroup::where('is_active', true)->get();
        return view('customer.profile', $data);

        // $customPaper = array(0,0,720,1000);
        // $pdf = PDF::loadView('customer.profile',$data)->setPaper($customPaper,'portrait');
        // $pdf = $pdf->stream(Carbon::today()->toDateString().'profile.pdf');

        // return $pdf; 
    }
    public function memberDepositDetail(Request $request, $id)
    {

        $data['member'] = Member::find($id);
        $data['depositdetails'] = MonthlyDepositDetails::orderBy('id', 'DESC')->where('member_id', $id)->get();
        return view('customer.member_deposit_details', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'phone_number' => [
                'max:255',
                Rule::unique('members')->ignore($id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);
        $input = $request->except('image');
        $image = $request->image;
        if ($image) {
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = date("Ymdhis");
            $imageName = $imageName . '.' . $ext;
            $image->move('public/images/customer', $imageName);
            $input['image'] = $imageName;
        }
        $lims_customer_data = Member::find($id);
        $message = 'Member updated successfully';
        $lims_customer_data->update($input);
        return redirect()->route('memberinfo.index')->with('edit_message', $message);
    }

    public function importCustomer(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-add')) {
            $upload = $request->file('file');
            $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
            if ($ext != 'csv')
                return redirect()->back()->with('not_permitted', 'Please upload a CSV file');
            $filename =  $upload->getClientOriginalName();
            $filePath = $upload->getRealPath();
            //open and read
            $file = fopen($filePath, 'r');
            $header = fgetcsv($file);
            $escapedHeader = [];
            //validate
            foreach ($header as $key => $value) {
                $lheader = strtolower($value);
                $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
                array_push($escapedHeader, $escapedItem);
            }
            //looping through othe columns
            while ($columns = fgetcsv($file)) {
                if ($columns[0] == "")
                    continue;
                foreach ($columns as $key => $value) {
                    $value = preg_replace('/\D/', '', $value);
                }
                $data = array_combine($escapedHeader, $columns);
                $customer = Member::firstOrNew(['name' => $data['name']]);
                $customer->name = $data['name'];
                $customer->name = $data['member_code'];
                $customer->company_name = $data['companyname'];
                $customer->email = $data['email'];
                $customer->phone_number = $data['phonenumber'];
                $customer->address = $data['address'];
                $customer->city = $data['city'];
                $customer->state = $data['state'];
                $customer->postal_code = $data['postalcode'];
                $customer->country = $data['country'];
                $customer->is_active = true;
                $customer->save();
                $message = 'Customer Imported Successfully';
                if ($data['email']) {
                    try {
                        Mail::send('mail.customer_create', $data, function ($message) use ($data) {
                            $message->to($data['email'])->subject('New Customer');
                        });
                    } catch (\Exception $e) {
                        $message = 'Customer imported successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                    }
                }
            }
            return redirect('customer')->with('import_message', $message);
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function getDeposit($id)
    {
        $lims_deposit_list = MonthlyDeposit::where('customer_id', $id)->get();
        $deposit_id = [];
        $deposits = [];
        foreach ($lims_deposit_list as $deposit) {
            $deposit_id[] = $deposit->id;
            $date[] = $deposit->created_at->toDateString() . ' ' . $deposit->created_at->toTimeString();
            $amount[] = $deposit->amount;
            $note[] = $deposit->note;
            $lims_user_data = User::find($deposit->user_id);
            $name[] = $lims_user_data->name;
            $email[] = $lims_user_data->email;
        }
        if (!empty($deposit_id)) {
            $deposits[] = $deposit_id;
            $deposits[] = $date;
            $deposits[] = $amount;
            $deposits[] = $note;
            $deposits[] = $name;
            $deposits[] = $email;
        }
        return $deposits;
    }

    public function addDeposit(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $lims_customer_data = Member::find($data['customer_id']);
        $lims_customer_data->deposit += $data['amount'];
        $lims_customer_data->save();
        MonthlyDeposit::create($data);
        $message = 'Data inserted successfully';
        if ($lims_customer_data->email) {
            $data['name'] = $lims_customer_data->name;
            $data['email'] = $lims_customer_data->email;
            $data['balance'] = $lims_customer_data->deposit - $lims_customer_data->expense;
            try {
                Mail::send('mail.customer_deposit', $data, function ($message) use ($data) {
                    $message->to($data['email'])->subject('Recharge Info');
                });
            } catch (\Exception $e) {
                $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
            }
        }
        return redirect('customer')->with('create_message', $message);
    }

    public function updateDeposit(Request $request)
    {
        $data = $request->all();
        $lims_deposit_data = MonthlyDeposit::find($data['deposit_id']);
        $lims_customer_data = Member::find($lims_deposit_data->customer_id);
        $amount_dif = $data['amount'] - $lims_deposit_data->amount;
        $lims_customer_data->deposit += $amount_dif;
        $lims_customer_data->save();
        $lims_deposit_data->update($data);
        return redirect('customer')->with('create_message', 'Data updated successfully');
    }

    public function deleteDeposit(Request $request)
    {
        $data = $request->all();
        $lims_deposit_data = MonthlyDeposit::find($data['id']);
        $lims_customer_data = Member::find($lims_deposit_data->customer_id);
        $lims_customer_data->deposit -= $lims_deposit_data->amount;
        $lims_customer_data->save();
        $lims_deposit_data->delete();
        return redirect('customer')->with('not_permitted', 'Data deleted successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $customer_id = $request['customerIdArray'];
        foreach ($customer_id as $id) {
            $lims_customer_data = Member::find($id);
            $lims_customer_data->is_active = false;
            $lims_customer_data->save();
        }
        return 'Customer deleted successfully!';
    }

    public function destroy($id)
    {
        $lims_customer_data = Member::find($id);
        $lims_customer_data->soft_deleted = 0;
        $lims_customer_data->save();
        return redirect()->route('memberinfo.index')->with('not_permitted', 'Data deleted Successfully');
    }
}
