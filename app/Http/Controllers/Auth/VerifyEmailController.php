<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Verify the user email.
     */
    public function __invoke(EmailVerificationRequest $request) : RedirectResponse
    {
        $request->fulfill();

        return redirect('/');
    }
}
