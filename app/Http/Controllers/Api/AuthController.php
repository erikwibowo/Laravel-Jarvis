<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request){
        DB::beginTransaction();
        try {
            if(User::where(['email' => $request->email])->count() != 0){
                $response = response()->json([
                    'data' => [],
                    'message' => "Email has taken",
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'access_token' => "",
                    'token_type' => 'Bearer'
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }else{
                $user = User::with('roles')->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->assignRole('operator');
                DB::commit();
                $token = $user->createToken('auth_token')->plainTextToken;
                $response = response()->json([
                    'data' => $user,
                    'message' => "Register success",
                    'status' => Response::HTTP_OK,
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ], Response::HTTP_OK);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $response = response()->json([
                'data' => [],
                'message' => $th->getMessage(),
                'status' => $th->getCode(),
                'access_token' => "",
                'token_type' => 'Bearer'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $response;
    }

    public function login(Request $request){
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
        $user = User::with('roles')->where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()
            ->json([
                'message' => 'Hi '.$user->name.', welcome to home',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'data' => $user,
                'status' => Response::HTTP_OK
            ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
