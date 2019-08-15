<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
	    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }
    public function member_address(Request $request)
    {
     $request=$request->input();
     $p_id=$request['p_id'];
     $arr=DB::select("select * from area where parent_id='$p_id'");
     return response()->json($arr);
    }

    public function address(Request $request)
    {
      $request=$request->input();
      $name=$request['name'];
      $address=$request['address'];
      $phone=$request['phone'];
      $email=$request['email'];
      $phone_d=$request['phone_d'];
      $code=$request['code'];
      DB::insert ("insert into address (`address`,`phone`,`email`,`code`,`name`,`phone_d` ) values ('$address','$phone','$email',' $code','$name',' $phone_d')");
       return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' =>'添加成功' ,
          
        ]);

    }

    public function show()
    {
    	$arr=DB::select("select * from address");
    	 return response()->json($arr);
    }
}