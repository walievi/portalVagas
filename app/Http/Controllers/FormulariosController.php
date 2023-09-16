<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormulariosController extends Controller
{
    public function index() {

        $forms = User::all();

        return view('users.users', ['users' => $users]);

    }
}
