<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{

      public function shop(Request $request)
       {
        $arr = $request->all();
        $goods_id=$arr['goods_id'];
        $arr=Db::select("select goods.id as g_id,goods.name as g_name,attr_details.name as attrdetails_name,attr_details.id as attrd_id,attribute.name as attr_name from goods_attr join goods on goods_attr.goods_id=goods.id join attr_details on goods_attr.attr_details_id=attr_details.id join attribute on goods_attr.attr_id=attribute.id where goods.id=$goods_id");
        $newarr=[];
        foreach ($arr as $key => $value) {
         $newarr[$value->attr_name][]=[$value->attrdetails_name,$value->attrd_id];
        }

        $ass['g_name']=$arr[0]->g_name;
        $ass['data']=$newarr;
        // var_dump($ass);
        return response()->json($ass);
       } 

	    public function product(Request $request){
        $arr=$request->input();
        // var_dump($arr);die;
        $d_id=$arr['d_id'];
        // var_dump($d_id);
        $goods_id=$arr['goods_id'];
        $d_id=substr($d_id,1);
        $d_id=str_replace('-', ',', $d_id);
        $d_id=explode(',', $d_id);
        sort($d_id);
        $length=count($d_id);
        $sort=[];
        for ($i=0; $i <$length ; $i++) { 
           $sort[]=$d_id[$i];
           }
           $d_id=implode('-', $sort);
           // var_dump($d_id);die;
           $arr=DB::select("select * from product where goods_id='$goods_id' and goods_attr_id='$d_id'");
           return response()->json($arr);
        }

}