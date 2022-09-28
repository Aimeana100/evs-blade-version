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
        $taps = CardTap::orderBy('tapped_at', 'DESC')->pluck('tapped_at')->toArray();


        $visitors = Vistor::with('taps')->get();
        $employees = Employee::with('taps')->get();

        $ymdDate = array_map(function ($el) {

            return date('Y-m-d', strtotime($el));
        }, $taps);


        $noDuplicate = array_slice(array_map(function ($el) {
            return $el;
        }, array_unique($ymdDate)), 0);

        $daysTaps = [];

        $noDuplicate = array_slice($noDuplicate, 0, 5);


        foreach ($noDuplicate as $t) {

            foreach ($visitors->toArray() as $visitor) {

                // dd(array_map( function($tap){ return date('Y-m-d', strtotime($tap['tapped_at']));
                // },$visitor['taps']), $t);

     
                    if ( in_array($t, array_map(function ($tap) {

                        return date('Y-m-d', strtotime($tap['tapped_at']));
    
                    }, $visitor['taps'])) ) {

                        // dd($visitor['taps'], $t, in_array($t, array_map(function ($tap) {

                        //     return date('Y-m-d', strtotime($tap['tapped_at']));

        
                        // }, $visitor['taps'])), array_map(function ($el){return $el['tapped_at'];},$visitor['taps']), array_filter($visitor['taps'], function($element) use($t){
                        //     return date('Y-m-d', strtotime($element['tapped_at'])) == $t;
                        // }) );
    
                        if (array_key_exists($t, $daysTaps)) {

                            array_push($daysTaps[$t], $visitor);
                        } else {
    
                            $daysTaps[$t] = [];
                            array_push($daysTaps[$t], $visitor);
                        }
                }


            }

        }

        // dd($daysTaps['2022-06-19']);


        // in_array($t, $this->getTapsTime($element['taps']) )

        // dd(array_filter($visitors->toArray(), function ($element) use($noDuplicate) {
        //     return in_array($noDuplicate[0], $this->getTapsTime($element['taps']));
        // })[3],$noDuplicate[0]);


        // dd(array_map(function($element){
        //     return $element['id'];
        // }, $daysTaps['2022-06-19']));


        // dd(array_unique($daysTaps['2022-06-19']));


        // dd(array_unique(array_map(function ($el){ return $el['ID_Card'];}, $daysTaps['2022-06-18'])));



        // dd(array_slice($daysTaps,2,6)[0]);

        // $ordered = array_map(function($el) use($visitors) {return array_filter($visitors->toArray(), function($visitor){

        //     return $visitor['taps'];

        // }); }, $noDuplicate);

        // dd(array_fill_keys(range(0, count($noDuplicate)-1), $noDuplicate));

        // dd(array_map(function($el){ return $el['tapped_at'];
        // },$visitors[0]['taps']->toArray()));

        

        return view('admin.dashboard', compact('employees'));

        $last_30days = Carbon::now()->subDays(30);

        $vistors = Vistor::all();
        $employees = Employee::all();
        $users = User::all();

        // $companies = Company::all();
        // $companiesActive = Company::where(['state'=> true])->count();

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
            'email' => ['required', 'unique:users', 'max:255'],
            'names' => ['required'],
        ]);

        $user = auth()->user();

        if(Auth::user()->update([
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
           'password' =>  ['required|confirmed|min:8'],
            'old_password' => ['current_password:api']

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
