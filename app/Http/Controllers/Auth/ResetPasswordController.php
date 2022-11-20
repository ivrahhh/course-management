<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /**
     * Render the reset password form.
     */
    public function edit(Request $request) : View
    {
        return view('pages.auth.reset-password', [
            'email' => $request->email,
            'password' => $request->token,
        ]);
    }

    /**
     * Update the user password with a new password.
     */
    public function update(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);

        $status = Password::reset($validated,
            function(User $user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ]);

                $user->save();

                event(new PasswordReset($user));
            });

        if($status === Password::PASSWORD_RESET) {
            return to_route('login')->with(['status' => __($status)]);
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }
}
