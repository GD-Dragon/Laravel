<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ShopcartController extends Controller
{
            public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

         public function shopcart(Request $request)
         {
          $arr=$request->input();
          $num=$arr['num'];
          $pid=$arr['pid'];
          $name=$arr['name'];
          $price=$arr['price'];
          $attrd_id=$arr['d_id'];
          $uid=DB::select("select id from users where name='$name'");
            foreach ($uid as $key => $value) {
               $uid=$value->id;
              }
              $arr=Db::select("select * from shopcart where uid='$uid' and pid='$pid'");
              if ($arr) {
               foreach ($arr as $key => $value) {
                $number=$value->num;
               }
               $n=$num+$number;
               Db::update("update shopcart set num='$n' where uid='$uid' and pid='$pid'");
               $arr=Db::select("select * from shopcart where uid='$uid' and pid='$pid'");
              }else{
               $arr=Db::table('shopcart')->insert(['uid'=>$uid,'pid'=>$pid,'num'=>$num,'price'=>$price,'attrd_id'=>$attrd_id,]);
              }
               return response()->json($arr);
             }

            public function cart(Request $request){
            	$arr=$request->input();
            	$name=$arr['name'];
            	$uid=DB::select("select id from users where name='$name'");
            	foreach ($uid as $key => $value) {
            		$uid=$value->id;
            	}
            	$pid=DB::select("select pid from shopcart where uid='$uid'");
            	foreach ($pid as $key => $value) {
            		$pid=$value->pid;
            	}
            	$arr=DB::select("select shopcart.id,shopcart.num,shopcart.price,shopcart.attrd_id,goods.name as g_name from goods join product on goods.id=product.goods_id join shopcart on product.id=shopcart.pid");
            	return response()->json($arr);
            }

}