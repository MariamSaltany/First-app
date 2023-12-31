<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
class SessionsController extends Controller
{
    public function create(){
        return view('sessions.create');
    }
    public function destroy(){
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }

    public function store(){ 
        // validate the request 
       $attributes= request()->validate([
            //'email'=>'required|exists:user,email'
            'email'=>['required','email'],
            'password'=>['required']

        ]);
        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (auth()->attempt($attributes)){
             // redirect with a seccess flash message
            return redirect('/')->with('success','Welcome Back!');
        }
        session()->regenerate();
        // if auth failed
        // return back()
        //     ->withInput()
        //     ->withErrors(['email'=>'Your provided credentials could not be verified']);
       throw ValidationException::withMessages([
        'email'=>'Your provided credentials could not be verified']);
    }
}
