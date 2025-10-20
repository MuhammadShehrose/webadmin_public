<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function verify(Request $request)
    {
        if (Auth::user()->email_verified_at) {
            return redirect()->route('admin.dashboard.index');
        }
        return view('web.auth.verify-email');
    }

    public function verified(EmailVerificationRequest $request)
    {
        $request->fulfill(); // ✅ Mark as verified (sets email_verified_at)

        return redirect()->route('admin.dashboard.index')->with('verified', true);
    }

    public function sendVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard.index');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Verification link sent!');
    }
}
