<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    public function index() {
        #return view('users/users');

        $users = User::all();

        return view('users.users', ['users' => $users]);

    }



    
    // public function listarUsuarios()
    // {
    //     $users = User::all();
    
    //     return view('users.users', ['users' => $users]);
    // }
    


}
