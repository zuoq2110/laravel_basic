<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function userList(){
        $users = DB::table('users')->get();
        return view('users.user', compact('users'));
    }
}
