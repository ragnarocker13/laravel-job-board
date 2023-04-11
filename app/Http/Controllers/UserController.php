<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show the register and create form
    public function create() {
        return view('users.register');
    }

    // Create new user
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|between:6,255|confirmed'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        // Login and redirect to root if successful
        auth()->login($user);
        return redirect('/')->with('message', 'User created and logged in');
    }

    public function logout(Request $request) {
        // remove user authentication
        auth()->logout();

        // invalidate then regenerate the csrf token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect then return a message
        return redirect('/')->with('message','You have been logged out');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {
        // declare the required fields
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // attempt to login
        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in');
        }

        // redirect the page to the previous page (login page) with an error message
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
