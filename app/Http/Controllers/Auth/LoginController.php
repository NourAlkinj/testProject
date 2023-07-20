<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'phone_number';
    }

    public function login(Request $request)
    {
        $user = User::where('email',  $request->email)
            ->orWhere('phone_number', $request->phone_number)
            ->first();
        if ($user && Hash::check( $request->password, $user->password)) {
            Auth::loginUsingId($user->id,true);
            $data = [
                $user,
                'message' =>  'succes login '
            ];
            return response()->json($data, 200);
        } else {
            return response()->json([
                'message' => __('auth.Invalid_login_details'),
            ], 401);
        }
    }
}
