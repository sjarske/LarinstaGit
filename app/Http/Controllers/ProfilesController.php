<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\Profile as ProfileResource;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    public function index()
    {
        $current_user_id = request()->user()->id;
        $profiles = Profile::all();
        $profiles_wo_current = $profiles->except($current_user_id);
        return $profiles_wo_current;
    }

    public function show($id)
    {
        $profile= [];
        $user= User::find($id);  
        $posts = DB::table('posts')->where('user_id', '=', $id)->get();
        $follows =(auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $followers_count = $user->profile->followers;
        $following_count = $user->following;
        array_push($profile, $user , $posts, $follows, $followers_count, $following_count);

        return $profile;
    }
}
