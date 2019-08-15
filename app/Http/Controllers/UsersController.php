<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UsersController extends BaseController
{
     public function goToLogin()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        // 规则
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        \Auth::logout();
        // 自定义消息
        $messages = [
            'email.required' => '请输入邮箱',
            'email.email' => '请输入正确的邮箱格式',
            'password.required' => '请输入密码'
        ];

        $this->validate($request, $rules, $messages);

        $email = $request->input('email');
        $password = $request->input('password');

        if (!\Auth::attempt(['email' => $email, 'password' => $password])) {
            return ['msg' => '登陆失败'];
        }
        return redirect()->route('user.info');
    }
}
