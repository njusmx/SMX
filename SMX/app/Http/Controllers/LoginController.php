<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use Redirect;
use DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('JXC.login');
    }

    public function loginPost(Request $request)
    {
        $this->validate($request, User::rules());
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password], $request->get('remember'))) {
            //if (!Auth::user()->is_admin) {
            if(Auth::user()->type == 1)
                return Redirect::route('stock');
            if(Auth::user()->type == 2)
                return Redirect::route('sale');
            if(Auth::user()->type == 3)
                return Redirect::route('finance');
            if(Auth::user()->type == 4)
                return Redirect::route('manager');
            if(Auth::user()->type == 5)
                return Redirect::route('admin');

        } else {
            return Redirect::route('login')
                ->withInput()
                ->withErrors('用户名或者密码不正确,请重试！');
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return Redirect::route('login');
    }
}
