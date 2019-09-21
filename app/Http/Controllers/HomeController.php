<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //追加
use Auth; //追記

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        
        $userCount = $users->count(); //追加
        $from_user_id = Auth::id(); //追加

        return view('home', compact('users')) //「;」を消す
        ->with('userCount', $userCount) //追加
        ->with('from_user_id', $from_user_id); //追加
    }
}
