<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Admin\Vistor;
use Illuminate\Http\Request;
use App\Models\Admin\CardTap;
use App\Models\Admin\Company;
use App\Models\Admin\Employee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        // $taps = CardTap::orderBy('tapped_at', 'DESC')->pluck('tapped_at')->toArray();
        // $visitors = Vistor::with('taps')->get();

        $employees = Employee::with('taps')->get();
        $summary = Employee::select(DB::raw("Count('id') as categoriesSum"), 'category')->groupBy('category')->get();

        return view('admin.dashboard', compact(['summary','employees']));

        $last_30days = Carbon::now()->subDays(30);

        $vistors = Vistor::all();
        $employees = Employee::all();
        $users = User::all();

        $last_30['vistors'] = DB::table('card_taps')->distinct('ID_Card')->where(['card_type' => "VISTOR"])->where('tapped_at', '>=', $last_30days)->count();
        $inInstitution['vistors'] = Vistor::where(['status' => "IN"])->count();
        $inInstitution['employee'] = Employee::where(['state' => "IN"])->count();

    }

    public function getTapsTime($visitorTaps)
    {

        return array_map(function ($el) {
            return date('Y-m-d', strtotime($el['tapped_at']));
        }, $visitorTaps);
    }

    public function account(Request $request){

        $user_me =  auth()->user();
        // dd($user_me);

        return view('admin.account', ['user_me'=> $user_me]);
    }

    public function accountUpdate(Request $request){

        $validatedData = $request->validate([
            'email' => ['required', 'max:255'],
            'names' => ['required'],
        ]);

        $user = auth()->user();

        if($user->update([
            "names" =>$request->names,
            "email" => $request->email,
            "NID" => $request-> staff_id

        ])){
            return redirect()->back()->with('success', 'Account updated successfully');
        }
        else{
            return redirect()->back()->with(['error' , 'Error : Account not updated']);
        }

    }



    public function editPassword(){

        return view('admin.change_password');
    }

    public function updatePassword(Request $request){

        $validated = $request->validate([
           'password' =>  'required|confirmed|min:8',
            'old_password' => 'current_password'
        ]);

        if(Auth::attempt(['email'=> auth()->user()->email, 'password'=> $request->old_password])){

            Auth::user()->update(['password'=> Hash::make($request->password)]);
            return redirect()->back()->with('success', 'Password changed successfully');

        }
        else{
            return redirect()->back()->with('error', 'Old password does not exist');
        }
    }



    ///////////////////////////// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\|

    // public function vistors()
    // {
    //     return Inertia::render('Vistors');
    // }
    // public function employees()
    // {
    //     return Inertia::render('Employees');
    // }
    // public function companies()
    // {
    //     return Inertia::render('Companies');
    // }

    // public function equipments()
    // {
    //     return Inertia::render('Equipments');
    // }
}
