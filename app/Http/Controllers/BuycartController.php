<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BuycartController extends Controller
{
	   public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

		public function buycart(Request $request)
    {
       $name=auth()->user();
       $uid=$name['id'];
       $arr=DB::select("select product.goods_id,product.price,shopcart.num,shopcart.attrd_id,goods.name as name,product.id as product_id,product.goods_attr_name from shopcart join product on shopcart.pid=product.id join goods on product.goods_id=goods.id where uid='$uid'");
        return response()->json($arr);
    }
      
     	public function buy(Request $request)
     {
        $num=request()->post('num');
        $porduct_id=request()->post('product_id');
          $name=auth()->user();
          $uid=$name['id'];
          DB::update("update shopcart set num='$num' where uid='$uid' and pid='$product_id'");
          return response()->json($porduct_id);
     }
}