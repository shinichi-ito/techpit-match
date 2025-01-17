<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reaction;
use App\User;
use Auth;

use App\Constant\Status;

class MatchingController extends Controller
{
    public static function index(){

        $got_reaction_ids = Reaction::where([
            ['to_user_id', Auth::id()], //to_user_idが自分になる
            ['status', Status::LIKE]
            ])->pluck('from_user_id');

        $matching_ids = Reaction::whereIn('to_user_id', $got_reaction_ids)
        ->where('status', Status::LIKE)
        ->where('from_user_id', Auth::id())
        ->pluck('to_user_id');

        $matching_users = User::whereIn('id', $matching_ids)->get();
        
        $match_users_count = count($matching_users);

        return view('users.index', compact('matching_users'))
        ->with('match_users_count', $match_users_count);
    }
}
