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

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->NewPassword == $request->ConfirmNewPassword) {
            if (strlen($request->NewPassword) > 8) {
                $user = User::where('id', Auth::user()->id)->first();
                if (Hash::check($request->password, $user->password)) {
                    $hashed = Hash::make($request->NewPassword, [
                        'memory' => 1024,
                        'time' => 2,
                        'threads' => 2,
                    ]);
                    //echo "done";
                    $user->password = $hashed;
                    $user['password_modified_at'] = \Carbon\Carbon::now();

                    $user->save();

                    historique::create([
                        'user_id' => Auth::user()->id,
                        'action' => 'Changed his password'
                    ]);

                    return back()
                        ->with('successPassword', "Le mot de passe a été bien modifié");
                } else {
                    return back()
                        ->with('FalsePassword', "Mot de passe incorrect");
                }
            } else {
                return back()
                    ->with('ShortPassword', "Mot de passe trop court!");
            }
        } else {
            return back()
                ->with('PasswordsDifferent', "Les deux mots de passe ne sont pas identiques");
        }
    }

}
