<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            $startTime = microtime(true);
            $user = User::where('email', $request->email)->first();


            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('User API')->plainTextToken;

                $success['id'] = $user->id;
                $success['name'] = $user->name;
                $success['email'] = $user->email;
                return response()->success($request, $success, 'User Login Successfully', 200, $startTime, 1);
            } else {
                Log::channel('sora_error_log')->error('Login Error: Email & Password does not match with our record.');
                return response()->error($request, null, 'Email & Password do not match with our record.', 401, $startTime);
            }
        } catch (Exception $e) {
            Log::channel('sora_error_log')->error('Login Error: ' . $e->getMessage());
            return response()->error($request, null, 'Internal Server Error', 500, $startTime);
        }
    }
}
