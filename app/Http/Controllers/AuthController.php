<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Exception;
use Session;

class AuthController extends Controller
{
    // Display the login form
    public function login() {
        return view('auth.login');
    }
    
    public function adminlogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if(Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
        }
    }
    
    

    public function indexuser() {
        $users = User::all();
        return view('auth.index',compact('users'));
    }
    
    public function createuser() {
        $roles = Role::pluck('name','name')->all();
        return view('auth.create',compact('roles'));
    }
    public function storeuser(Request $request):RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'new_password' => 'required|confirmed|min:6',
            'roles' => 'required'
        ]);
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->new_password);
            $user->save();

            $user->assignRole($request->input('roles'));

            return redirect()->route('user.index')->with('success', 'user created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function edituser($id=null){
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('auth.edit',compact('user','roles','userRole'));
    }

    public function updateuser(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'new_password' => 'nullable|confirmed|min:6',
            'status' => 'required|in:1,2',
            'roles' => 'required'
        ]);
            try{
                $user = User::findOrFail($id);
                $user->name = $request->input('name');
                $user->email = $request->input('email');    
                $user->status = $request->input('status');    
                $user->password  = Hash::make($request->input('new_password'));
                $user->save();

                DB::table('model_has_roles')->where('model_id',$id)->delete();
    
                $user->assignRole($request->input('roles'));

                return redirect()->route('user.index')->with('success', 'Data update successfully.');
            } catch (\Exception $e) {
                return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
            }
    }



    // Display the Password Update
    public function profileupdate() {
        $users=Auth::user();;
        return view('auth.password', compact('users'));
    }

    public function passwordupdate(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        // Match old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return redirect()->route('profle.update')->with('error', 'Old password not match.');
        }

        // Update password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('profle.update')->with('success', 'Password updated successfully.');
    }

    // Display the logout
    public function logout() {
        \Session::flush();
        \Auth::logout();
        return redirect()->route('login');
    }

}

