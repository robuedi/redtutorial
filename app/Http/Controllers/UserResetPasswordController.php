<?php


namespace App\Http\Controllers;


class UserResetPasswordController extends Controller
{
    public function index()
    {
        return view('user.reset_password');
    }

    public function sendResetEmail()
    {

    }

}