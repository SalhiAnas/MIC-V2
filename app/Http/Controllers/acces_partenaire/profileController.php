<?php

namespace App\Http\Controllers\acces_partenaire;

use App\Http\Controllers\Controller;
use App\Models\historique;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function profile(){
        return view('acces_partenaire.profile');
    }

    public function edit(){
        $data = \request()->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8']
        ]);
        $data['password_modified_at'] = \Carbon\Carbon::now();
        $data['password'] = Hash::make($data['password']);

        User::findOrFail(\request()->user()->id)->update($data);

        historique::create([
            'user_id' => Auth::user()->id,
            'action' => 'Edit his profile'
        ]);
        return redirect('profile')->with('success', 'Your profile has been updated successfully');
    }
}
