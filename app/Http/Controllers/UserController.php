<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class UserController extends Controller
{
    public function show()
    {
        $tasks = User::all();
        return $tasks->toJson();
    }
}