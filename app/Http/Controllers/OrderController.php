<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Order_details;




class OrderController extends Controller
{
   // 商品訂單&明細生成
   public function store(Request $request)
   {   
        $user    =   $request->user();
    
        $emp = new Order();
        $emp->o_recipient = $request->o_recipient;
        $emp->o_recipient_phone = $request->o_recipient_phone;
        $emp->o_recipient_address = $request->o_recipient_address;
        $emp->o_note = $request->o_note;
        $emp->o_status = $request->o_status;
        $emp->o_number = $request->o_number;
        $emp->od_id = $request->od_id;
        $emp->u_id = $user->u_id;
        foreach(session('cart') as $id => $details){  
        
        $emp->o_quantity += $details['quantity'];
        $emp->o_total += $details['price'] * $details['quantity']*0.85;
        
        }
        $emp->save();

    foreach(session('cart') as $id => $details){
            
        if($id==NULL){
            continue;  
        }else{
            $emp = new Order_details();
            $emp->o_id = $request->o_id;
            $emp->p_id = $id;    
            // $emp->od_size = $id;    
            // $emp->od_color = $id;    
            $emp->od_price = $details['price'];    
            $emp->od_quantity = $details['quantity'];    
            $emp->od_size = $details['buyfbsize'];    
            $emp->od_color = $details['buyfbcolor'];    
            $emp->od_total = $details['price'] * $details['quantity']*0.85;    
            $emp->save();

            
             
            $item = Product::find($id);
            $item->p_total += $details['quantity'];
            $item->save();
        }
    }
        session()->forget('cart');
        return view("/home");
   }//

   // 訂單狀態(處理中/出貨中/訂單完成)
   public function edit(Request $request,$o_id){    
      $emp = Order::find($o_id);
      $emp->o_status = $request->str;
      $emp->save();
     
      return response()->json(['success'=>'Data is successfully added']);
        
   }//
   
   // 後台訂單查詢(日期區間)
   public function finddetail(Request $request){
           $start = $request->input('starttime');
           $end = $request->input('endtime');
        //    dd($start,$end);
        //    $employeeList = DB::table('orders')
        //                    ->where(function($query)
        //                    {
        //                        $query->where('created_at', '>=', '$start'); 
        //                    })
        //                    ->get();
        
        $employeeList = Order::whereBetween('created_at',[$start,$end])->get();
        return view('employees.backstage_order',compact('employeeList'));
   }//

    
}
