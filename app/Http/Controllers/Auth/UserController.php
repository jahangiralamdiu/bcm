<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 7/31/19
 * Time: 10:24 PM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('auth.index', compact('users'));
    }
}