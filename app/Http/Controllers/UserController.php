<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function signup(Request $request) {
        $this->validate($request, [
           'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $users = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $users->save();
        return response()->json(['message' => 'Successfully created user'], 200);
    }

    public function signin(Request $request) {

//        Log::info('inside of signin', ['resp' => $request->input('email')]);
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only(['email', 'password']);
        try{
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid Credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not create token'], 500);
        }
        return response()->json(['token' => $token], 200);
    }

    public function isAuthenticated(Request $request) {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    public function signOut()
    {
        $token = JWTAuth::getToken();
        $return_data = JWTAuth::invalidate($token) ? ['invalidate' => 'OK'] : ['invalidate' => 'Fail'];
        return response()->json($return_data);
    }
}
