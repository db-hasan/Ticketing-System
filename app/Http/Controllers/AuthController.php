<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $users = User::latest()->get();
        return view('auth.index',compact('users'));
    }
    
    public function createuser() {
        return view('backend.user.create');
    }
    public function storeuser(Request $request):RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        try {
            $data = new User();
            $data->name = $request->name;
            $data->price = $request->price;
            $data->save();
            return redirect()->route('user.index')->with('success', 'user created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
        }
    }


    // Display the Password Update
    public function profileupdate() {
        $users=User::find(1);
        return view('auth.password', compact('users'));
    }

    public function passwordupdate(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
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

