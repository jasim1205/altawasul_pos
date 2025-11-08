<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('authentication.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['email' => 'Invalid token or email.']);
        }

        // Update the user's password
        DB::table('users')
            ->where('email', $request->email)
            ->update(['password' => bcrypt($request->password)]);

        // Delete the password reset record
        DB::table('password_resets')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('login')->with('message', 'Your password has been reset successfully!');
    }
}
