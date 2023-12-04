<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rule;

class RigisterController extends Controller
{
    public function create(){
        return view('register.create');
    }
    public function store(){
        
       $attributes = request()->validate([
        'name'=>[ 'required','min:7'],
        'username'=> ['required','unique:users,username'],
        // 'username'=> ['required',Rule::unique('users', 'username')],
        'password'=> ['required','min:7'],
        'email'=>['required', 'email','unique:users,email']
        ]);

        //$attributes['password'] = bcrypt($attributes['password']); //password
        
        $user = User::create($attributes);
        //session()->flash('success','Your account has been created.') ; 
        // for the login user
        auth()->login($user);
        return redirect('/')->with('success','Your account has been created.');
    }
}
