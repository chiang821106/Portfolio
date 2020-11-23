<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;


class DiyimageController extends Controller
{
    // 動手設計頁-會員判斷
    public function index(){
        if(null!==Auth::user()){ 
        return view('home.custom');
        }else{
            echo"<script>alert('請先登入會員');</script>";
            return view('auth.login');
        }
    }//

    // 客製化衣服-上傳
    public function saveimg(Request $request,$u_id){
        
      header('Access-Control-Allow-Origin:*');  
      
        define('UPLOAD_PATH', 'uploads/diyimage/');
      
        $imgfont = $_POST['filefont'];
        $imgback = $_POST['fileback'];
        $privacy = $_POST['privacy'];
        $subject = $_POST['subject'];
        $content = $_POST['content'];
        
        // (設計圖)
        // 轉檔 & 存檔
        $imgfont = str_replace('data:image/png;base64,', '', $imgfont);
        // echo $img."</br>";
        $imgfont = str_replace(' ', '+', $imgfont);
        // echo $img."</br></br>";
        $data = base64_decode($imgfont);
        // var_dump($data);
        $file1 = UPLOAD_PATH.$u_id .'000'. uniqid() . '.png';

        $success = file_put_contents($file1, $data);
        echo $success."</br>";

        // (成品圖正面)
        // 轉檔 & 存檔
        $imgback = str_replace('data:image/png;base64,', '', $imgback);
        // echo $img."</br>";
        $imgback = str_replace(' ', '+', $imgback);
        // echo $img."</br></br>";
        $data = base64_decode($imgback);
        // var_dump($data);
        $file2 = UPLOAD_PATH.$u_id. '000'. uniqid() . '.png';
        $success = file_put_contents($file2, $data);
        echo $success."</br>";
      
        // 寫入(商品資料庫)
        $emp = new Product();
        $user    =   $request->user();
        $emp->p_name = $subject;
        $emp->p_description = $content;
        $emp->p_filename_private = $privacy;
        $emp->p_price = '500';
        $emp->p_photo = $file2; 
        $emp->p_filename_design = $file1;
        $emp->u_id = $user->u_id;
        $emp->save();
        // return redirect('home.index');
    }// 

    // 會員-客製衣服頁
    public function display(Request $request,$u_id){
        
        $products = User::find($u_id)->product()->paginate(4);
        
        return view('member.diysell',compact('products'));
    }//


    // 會員-上架商品
    public function shelfing(Request $request,$p_id){
      
       $emp = Product::find($p_id);
       
       $emp->p_filename_private = 'public';
       
       $emp->save();
       return redirect()->back();
    }//
         
    // 下架商品
    public function undercarriage(Request $request,$p_id){
      
       $emp = Product::find($p_id);
       
       $emp->p_filename_private = 'private';
       
       $emp->save();
       return redirect()->back();
    }// 
        
}
