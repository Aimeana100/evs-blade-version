<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GateKeeper;
use App\Models\UserLog;

class UserController extends Controller
{
    public function users()
    {
        $users = User::all();
        $gateKeeper = GateKeeper::all();

        return view('admin.user', ['users'=> $users, 'gateKeeper'=>$gateKeeper]);
    }
    public function create(Request $request){
        $validated = $request->validate([
            'names' => 'required|posts|max:255',
            'email' => 'required|unique:users',
            
        ]);


    }
    public function edit(User $user){
   
    }

    public function logs(Request $request){
        $logs = UserLog::with('user')->get();
        return view('admin.logs', ['logs'=> $logs]);

    }
}
