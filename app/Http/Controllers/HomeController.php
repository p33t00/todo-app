<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    public function warap() {
//            if (!$user = JWTAuth::parseToken()->authenticate()) {
//                return response()->json(['message' => 'User not found'], 401);
//            }
//        checks token through middleware
        return response()->json(['message' => 'some funky shit :D'], 200);
    }
}
