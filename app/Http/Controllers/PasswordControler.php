<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRules;


class PasswordControler extends Controller
{
    public function forgotten()
    {
        return view('auth.password.forgotten');
    }

    public function sendEmail(Request $request)
    {
        $request->validate(['email' => [
            'required',
            'email',
            ]]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])->withInput()
            : back()->withErrors(['email' => __($status)])->withInput();

    }

    public function reset(string $token, Request $request)
    {
        return view('auth.password.reset',['token' => $token, 'email' => $request->input('email')]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'max:191',
                'confirmed',
                PasswordRules::min(4)
                    -> letters(),
                    //->uncompromised(),
            ],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {

                $user->update(['password' => $password]);
                //event(new PasswordReset($user));    --> pour avertir les autres
                Auth::login($user);
            }
        );

        return redirect()->route('users.index');
    }
}
