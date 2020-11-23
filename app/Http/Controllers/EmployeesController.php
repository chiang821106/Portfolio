<?php

namespace App\Http\Controllers;

//使用use App/Employee
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Product;
use App\User;
use App\Order;
use App\Order_details;
use Laravel\Ui\Presets\React;

class EmployeesController extends Controller
{
    // 顯示訂單管理分頁
    function backstage_order() {
        $employeeList = Order::all();
        $orderList = order_details::all();

        return view('employees.backstage_order', compact('employeeList'));
    }//

    // 顯示管理者設定分頁
    function backstage_employees(Request $request) {
        
        $user    =   Auth::user()->u_right;
        // dd($user);
        if($user != '1'){
            // echo('無此權限');
            echo "<script>alert('你沒有權限瀏覽此頁');history.go(-1);</script>";
            
            // return redirect()->back();
        }else{
            $employeeList = User::all(); 
            return view('employees.backstage_employees',compact('employeeList'));
        }
    

    }//

    // 顯示管理者detail分頁
    function backstage_order_detail(Request $request,$o_id) {
    
        $detailList = Order::find($o_id);
        
        $accounts = Order::find($o_id)->order_details()
        ->join('products', 'order_details.p_id', '=', 'products.p_id')
        ->get();

        $products = Product::all();;
        $items = Order::find($o_id)->product()->get();
           
        return view('employees.backstage_order_detail',compact('detailList','accounts','products','items'));
       
    }//

    // 會員-修改會員資料
    public function edit(Request $request,$u_id){

        
        $emp = User::find($u_id);
        
        

        

        if($request->nowpassword == NULL and $request->password == NULL){

            $emp->u_name = $request->usernameM;
            $emp->email = $request->email;
            $emp->u_phone = $request->u_phone;
            $emp->u_address = $request->u_address;
            $emp->save();
            return response()->json(['success'=>"修改成功"]);            
        }else{
            if(!Hash::check($request->nowpassword, $emp->password)){
                return response()->json(['success'=>"原密碼不相符"]);
            }else{
                $emp->u_name = $request->usernameM;
                $emp->password = Hash::make($request['password']);
                $emp->email = $request->email;
                $emp->u_phone = $request->u_phone;
                $emp->u_address = $request->u_address;
                $emp->save();
                return response()->json(['success'=>"修改成功"]);
            }
        }
        
    }//

    public function store(Request $request,$u_id){
        
        $emp = User::find($u_id);
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = $u_id .'000'.time() . '.' . $extension;
            $file->move('member/user/',$filename);
            $emp->u_image = $filename;
        } else{
            return $request;
            $emp->u_image = '';
        }

        $emp->save();

        return redirect()->back();
    }

    
}
