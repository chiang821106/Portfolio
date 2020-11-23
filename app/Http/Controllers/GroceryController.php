<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Product;
use App\User;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_encode;

class GroceryController extends Controller
{

    
  // 後台-管理者(撈取管理員資料表)
  public function action(Request $request){
        
            // $grocery = User::where('role','like','%'.$request->get('dataFromServer').'%')->get();
            // return json_encode($grocery);
           

            // $grocery = User::all();
            // return json_encode($grocery);

        $grocery = DB::table('users')
                   ->where(function($query)
                   {
                       $query->where('role', '=', 'admin'); 
                   })
                   ->get();
        return json_encode($grocery);

  }//
    
  // 後台-新增管理者資料
  public function store(Request $request)
  {
        
         $grocery = new User();
         $grocery->u_name = $request->u_name;
         $grocery->u_account = $request->u_account;
         $grocery->password = Hash::make($request['password']);
         $grocery->email = $request->email;
         $grocery->role = $request->role;
         $grocery->u_right = $request->u_right;
 
         $grocery->save();
         return response()->json(['success'=>'Data is successfully added']);
  }//

  // 後台-修改員工資料
  public function update(Request $request,$id)
  {
      $emp = User::find($id);
     //  $emp->u_account = $request->u_account;
      $emp->u_name = $request->u_name;
      $emp->password = Hash::make($request['password']);
      $emp->u_right = $request->u_right;
      $emp->save();
      return response()->json(['success'=>'Data is successfully added']);
  }//

  // 後台-停權員工
 
  public function Suspension(Request $request,$id)
  {
      
      $emp = User::find($id);
      // dd($emp);
      $emp->u_right ='3';
      $emp->save();
      return response()->json(['success'=>'Data is successfully added']);
  }//
    
  //取消停權員工
  public function CanelSuspension(Request $request,$id)
  {
      
      $emp = User::find($id);
      // dd($emp);
      $emp->u_right ='2';
      $emp->save();
      return response()->json(['success'=>'Data is successfully added']);
  }//

  //瀏覽item分頁(選size color)
  public function item(Request $request,$p_id){
      $emp = Product::find($p_id);
      
      return view('home.item',compact('emp'));
  }//
 
}
