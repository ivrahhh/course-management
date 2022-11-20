<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResendEmailVerificationController extends Controller
{
    /**
     * Resend verification Link
     */
    public function __invoke(Request $request) : RedirectResponse
    {
        if($request->user()->hasVerifiedEmail) {
            return redirect('/');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status','Verification Link sent !');
    }
}
