<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Render the forgot password form.
     */
    public function create() : View
    {
        return view('pages.auth.forgot-password');
    }

    /**
     * Send the verifiation link to the email and save the token to the database.
     */
    public function store(Request $request) : RedirectResponse
    {
        $email = $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($email);

        if($status === Password::RESET_LINK_SENT) {
            return back()->with([
                'status' => __($status)
            ]);
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }
}
