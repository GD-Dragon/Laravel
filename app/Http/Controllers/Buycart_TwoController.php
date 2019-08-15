<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Buycart_TwoController extends Controller
{
     public function __construct()
    {
       $this->middleware('auth:api', ['except' => ['']]);
        //构造函数，过滤login
    }

    public function cart_two(Request $request)
    {
     $request=$request->input();
     $name=auth()->user();
     $uid=$name['id'];
     $h_id=$request['h_id'];
     $data=[];
     foreach ($h_id as $key => $value) {
        foreach ($value as $key => $value1) {
        $data[]=DB::select("select goods.name as g_name,shopcart.attrd_id,shopcart.num,product.price from shopcart join product on shopcart.pid=product.id join goods on product.goods_id=goods.id where shopcart.uid='$uid 'and shopcart.pid='$value1'");
          
        }
        
     }

    return response()->json($data);
     
    }

    public function cart_two1() 
    {
     $name=auth()->user();
     $uid=$name['id'];
     $arr=DB::select("select * from address where uid='$uid'");
     return response()->json($arr);
    }

   public function add(Request $request)
   {
      $request=$request->input();
     $name=auth()->user();
     $uid=$name['id'];
     $h_id=$request['h_id'];
     $data=[];
     $Ymd= date("Ymd");
     $srand=rand(1000,9999);
     $time=$Ymd.$srand;
     $times=date('Y-m-d h:i:s', time());
      foreach ($h_id as $key => $value) {
        foreach ($value as $key1 => $value1) {
        $data[]=DB::select("select goods.name as g_name,shopcart.attrd_id,shopcart.num,product.price,address.address from address join shopcart on address.uid=shopcart.uid join product on shopcart.pid=product.id join goods on product.goods_id=goods.id where shopcart.uid='$uid 'and shopcart.pid='$value1'");
        }
                 foreach ($data as $key3 => $value3) {
                    foreach ($data[$key3] as $key4 => $value4) {
                          $g_name=$value4->g_name;
                          $attrd_id=$value4->attrd_id;
                          $num=$value4->num;
                          $price=$value4->price;
                          $address=$value4->address;
                          $status=1;
                          $total=$num*$price;
                
         DB::insert("insert into order_x (`h_goods`,`h_id`,`h_type`,`num`,`price`,`order_id`) values ('$g_name','$value1','$attrd_id','$num','$total','$time')");
                    }
                }
              }
         DB::insert("insert into order_z (`time`,`status`,`uid`,`address`,`order_id`) values ('$time','$status','$uid','$address','$time')");
           return response()->json(['code' => 200,'status' => 'ok','data' =>'添加成功']);
           }     

    }
