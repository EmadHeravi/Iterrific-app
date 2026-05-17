<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class Register extends Component
{

    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $password = '';

    protected $rules=[
    'first_name' => 'required|min:3',
    'last_name' => 'required|string|max:255',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|min:12',];


    public function store(){

        $attributes = $this->validate();

        $user = User::create($attributes);

        event(new Registered($user));

        auth()->login($user);
        
        return redirect()->route('verification.notice');
    } 

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('layouts.public');
    }
}
