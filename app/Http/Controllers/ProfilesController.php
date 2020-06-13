<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\Http\Resources\Profile as ProfileResource;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    public function index()
    {
        $profiles = DB::table('profiles')->get();

        return $profiles;
    }
}
