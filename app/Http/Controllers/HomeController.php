<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Gate;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    // 判斷 員工/會員
    public function index()
    {
            
        if (Gate::allows('admin')) {
            // return view('employees.backstage_employees');
            // return redirect("/backstage_order");
            echo"<script>alert('管理員您好!');location.replace('/backstage_order');</script>";
            
        }

        if (Gate::denies('admin')) {
            // return view('home');
            // echo"<script>alert('會員您好');</script>";
            return view('home');
        }
    }//
}
