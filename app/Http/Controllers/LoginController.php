<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class LoginController extends Controller
{


      public function login(){


  }


      public function loginAction(Request $request){

        $name=$request->input('name');
        $password=$request->input('password');
        $arr = DB::select("select * from user where user_name='$name'and password='$password'");
        if (empty($arr)) {
         $arr1=['code'=>'1','status'=>'error','data'=>'用户名或密码错误'];
         return json_encode($arr1);
       }else{
        $arr2=['code'=>'0','status'=>'ok','data'=>'登录成功'];
        Session::put("name",$name);
        return json_encode($arr2);
      }
    }
}
