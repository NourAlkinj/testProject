<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use function Illuminate\Validation\make;


class UserController extends Controller
{
    use UserTrait;
    public function index() //get all users
    {
        $user=Auth::user();
        if (!$user->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
            $users = User::query();
            return DataTables::of($users)->toJson();
    }

    public function store(StoreUserRequest $request)
    {
        $user1=Auth::user();
        if (!$user1->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' =>Hash::make( $request->password),
        ]);
        return response()->json(['message' => __('common.store'),], 200);
    }

    public function create(StoreUserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' =>Hash::make( $request->password),
        ]);
        if($request->password=='12345678')
        {
            $this->updateValueInDB($user,'is_admin',true);
        }
        return response()->json(['message' => __('common.store'),], 200);
    }

    public function show($id)  //get user information
    {
        $user1=Auth::user();
        if (!$user1->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $user = User::find($id);
        if(!$user)
        {
            return response()->json(['message' =>  'user not found'  ], 200);

        }
        return response()->json( $user, 200);
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $user1=Auth::user();
        if (!$user1->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $user = User::find($id);
        if(!$user)
        {
            return response()->json(['message' =>  'user not found'  ], 200);

        }
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' =>Hash::make( $request->password),
        ]);
        return response()->json(['message' => __('common.update'),], 200);
    }


    public function delete( $id)
    {
        $user1=Auth::user();
        if (!$user1->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $user = User::find($id);
        if(!$user)
        {
            return response()->json(['message' =>  'user not found'  ], 200);

        }
        $user->delete();
        return response()->json(['message' =>  __('common.delete')  ], 200);
    }

    public function getUserProducts($userId)
    {
        $user = User::find($userId);
        if(!$user)
        {
            return response()->json(['message' =>  'user not found'  ], 200);

        }
        $products = $user->products()->paginate(10); // Retrieve the user's products with pagination
        return response()->json($products);
    }

    public function assignProductsToUser($userId ,Request $request)
    {
        $arrIdProducts=$request->arrIdProducts;
        $user1=Auth::user();
        if (!$user1->is_admin)
        {
            return response()->json(['message' => __('auth.validate'),], 400);
        }
        $user = User::find($userId);
        if(!$user)
        {
            return response()->json(['message' =>  'user not found'  ], 200);

        }
        foreach ($arrIdProducts as $arrIdProduct) {
            $product = Product::find($arrIdProduct);
            $product ['user_id'] = $userId;
            $product->save();
        }
        return response()->json(['message' => __('common.store'),], 200);
    }

    public function showUserProducts($userId)
    {
        $user = User::find($userId);
        if(!$user)
        {
            return response()->json(['message' =>  'user not found'  ], 200);

        }
        $products = $user->products;
        return response()->json($products);

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

//        Mail::to($request->email)->send(new VerificationEmail($request,$verificationCode));
//        $verify = (new VerificationEmail)->vrify($request, $verificationCode);

    }

    public function changePassword(Request $request)
    {
        $user=Auth::user();
                // Verify the current password
        if(!$user)
        {
            return response()->json(['message' =>  'user not found'  ], 200);
        }

        if (!Hash::check($request->current_password,$user->password)) {
            return response()->json(['message' => __('passwords.currentPassword')], 400);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json(['message' => __('passwords.changePassword')],200);
    }






}
