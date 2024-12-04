<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function profile(Request $request){
        return response()->json([
            'data' => User::with('roles')->find(auth()->user()->id),
            'message' => "Data user loged in",
            'status' => Response::HTTP_OK,
            'access_token' => "",
            'token_type' => 'Bearer'
        ]);
    }

    public function updatePassword(Request $request){
        try {
            $user = User::find(auth()->user()->id);
            if (!Hash::check($request->password, $user->password))
            {
                return response()
                    ->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            return response()->json([
                'data' => User::with('roles')->find(auth()->user()->id),
                'message' => "Data user loged in",
                'status' => Response::HTTP_OK,
                'access_token' => "",
                'token_type' => 'Bearer'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => [],
                'message' => $th->getMessage(),
                'status' => $th->getCode(),
                'access_token' => "",
                'token_type' => 'Bearer'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
