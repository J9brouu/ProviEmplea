<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        $rol = $request->user()->rol;

        return match($rol) {
            'admin'   => redirect()->route('admin.dashboard')->with('verified', 1),
            'empresa' => redirect()->route('empresa.dashboard')->with('verified', 1),
            default   => redirect()->route('talento.dashboard')->with('verified', 1),
        };
    }
}
