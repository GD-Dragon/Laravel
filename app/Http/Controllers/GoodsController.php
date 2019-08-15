<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class GoodsController extends Controller
{
	    public function show(){
      $arr=Db::select("select * from goods");
      $arr1=['code'=>'1','status'=>'error','data'=>$arr];
      return response()->json($arr);
    }

    public function category(){
      $arr=Db::select("select * from goods_category where 1");
      $ayy=$this->tree($arr,0,0);
      $json=['code'=>'200','status'=>'success','data'=>$ayy];
      return response()->json($ayy);
    }

    public function tree($arr,$id,$level){
      $list=array();
      foreach ($arr as $k => $v) {
        if($v->pid==$id){
          $v->level=$level;
          $v->son= $this->tree($arr,$v->id,$level+1);
          $list[]=$v;
        }
      }
      return $list;
    }


    public function floor(){
      $arr=Db::select("select goods_floor.id,floor.name as f_name,goods.id as goods_id,goods.name as g_name from goods_floor join floor on floor.id=goods_floor.f_id join goods on goods_floor.g_id=goods.id");
      $array=array();
      foreach ($arr as $k => $v) {
        $array[$v->f_name][]=[$v->g_name,$v->goods_id];

      }
                  // var_dump($cc);
      return response()->json($array);

    }
}