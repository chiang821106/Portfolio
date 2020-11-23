<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;


class excontroller extends Controller
{
    // 顯示index首頁
    function index() {
        return view("home.index");
    }//

    // 顯示custom分頁
    function custom() {
        return view("home.custom");
    }//
    
    // 顯示order分頁
    function order(Request $request,$u_id) {
        
        $accounts = User::find($u_id)->orders()->paginate(6);
        
        return view('member.order',compact('accounts'));
    }//

    //顯示 home會員中心
    function homes(){

        return view('home');
    }
   
}
