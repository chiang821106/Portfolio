<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訂單確認 - UNIQUE 獨衣無二</title>


    <link rel="icon" href="img/common/logo_ico.ico">


    <link rel="stylesheet" href="css/common/bootstrap.min.css">
    <link rel="stylesheet" href="css/common/common.css">
    {{-- <link rel="stylesheet" href="css/index/index.css"> --}}
    <link rel="stylesheet" href="css/shopping/common.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="js/common/common.js"></script>
    <script src="js/common/jquery.min.js"></script>
    <script src="js/common/popper.min.js"></script>
    <script src="js/common/bootstrap.min.js"></script>
     
    <style>
        #products{
            margin-top: 25px;
        }
        #member{
            margin-top:85px;
        }
    </style>

</head>

<body class="bodyBg">
     {{-- 頁首 --}}
     <header id="top">

        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navBar">

            <!-- Logo -->
            <a class="nav-brand" href="/">
                <img src="img/common/logoYellow.png" alt="" class="logoNav">
            </a>

            <!-- 漢堡選單 -->
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- 導覽標籤 -->
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mr-auto navbarul">
                    <!-- <li class="nav-item navLink"><a class="nav-link" href="#">首頁</a></li> -->
                    <li class="nav-item navLink"><a class="nav-link" href="/#about">關於我們</a></li>
                    <li class="nav-item navLink"><a class="nav-link" href="/#hotSales">熱銷設計</a></li>
                    <li class="nav-item navLink"><a class="nav-link" href="/custom">動手設計</a></li>
                    <li class="nav-item navLink"><a class="nav-link" href="/products">直接購買</a></li>
                </ul>
            </div>

            <!-- 導覽列ICON -->
            {{-- <div class="d-flex clearfix " id="iconBox">
                --}}
                <!-- 搜索框 -->

                {{-- <div class="nav-item ml-auto align-self-center" id="searchBox">
                    <img src="img/common/search.svg" alt="搜索" class="searchIcon">
                </div>
                <div class="nav-item ml-auto align-self-center">
                    <form class="form-inline" action="">
                        <input type="search" name="searchText" id="searchText" placeholder="搜尋">
                        <button type="submit" id="searchBtn"></button>
                    </form>
                </div> --}}

                <!-- 會員 -->
                @guest
                    <div class="nav-item ml-auto  topIconBox rwdUserIcon">
                        <a href="/home" class="topIconA userIcon"><img src="img/common/user.svg" alt="會員登入"
                                class="topIcon"></a>
                    </div>
                @else
                    <div class="d-flex align-items-center rwdUser">
                        @if (Auth::user()->role == 'admin')
                            <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                管理員： {{ Auth::user()->u_name }}<span class="caret"></span>
                            </a>
                        @else
                            @if(Auth::user()->u_image == "")
                            <img style="margin-right:5px;" class="rounded-circle" src="img/common/user_image.png" width="50px;"height="50px;" alt="">
                            @else
                            <img style="margin-right:5px;" class="rounded-circle" src="{{asset('member/user/' . Auth::user()->u_image)}}"width="50px;"height="50px;" alt="">
                            @endif
                            <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->u_name }}<span class="caret"></span>
                            </a>
                        @endif


                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="../home">
                                    {{ __('管理中心') }}
                                </a>
                            @else
                                <a class="dropdown-item" href="/homes">
                                    {{ __('會員中心') }}
                                </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('登出') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
             <!-- 購物車 -->
             <div class="nav-item ml-auto topIconBox">
                <a href="/cart" class="topIconA"><img src="img/common/cart.svg" alt="購物車" class="topIcon">
                    @if (count((array) session('cart')) > 0)
                        <span id="count">{{ count((array) session('cart')) }}</span>
                    @endif
                </a>
         
                 
         
                 <div class="dropdown-menu dropdown-menu-right"id="cart">
                     <div class="row total-header-section">
                         <div class="col-lg-6 col-sm-6 col-6">
                             <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                         </div>
         
                         <?php $total = 0 ?>
                         @foreach((array) session('cart') as $id => $details)
                             <?php $total += $details['price'] * $details['quantity'] ?>
                         @endforeach
         
                         <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                             <p>小計: <span class="text-info">$ {{number_format($total,0)  }}</span></p>
                         </div>
                     </div>
         
                     @if(session('cart'))
                         @foreach(session('cart') as $id => $details)
                             <div class="row cart-detail">
                                 <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                     <img src="{{ $details['design'] }}"width="100" height="100" />
                                 </div>
                                 <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                     <p>{{ $details['name'] }}</p>
                                     <span class="price text-info"> ${{ number_format($details['price'],0) }}NT</span> <span class="count"> 數量:{{ $details['quantity'] }}</span>
                                 </div>
                             </div>
                         @endforeach
                     @endif
                     <div class="row">
                         <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                             <a href="{{ url('cart') }}" class="btn btn-primary btn-block">查看已選商品</a>
                         </div>
                     </div>
                 </div>
             </div>
            </div>
        </nav>

        <!-- TOP鍵 -->
        <a href="#top" class="scrollUpBg"><img src="img/common/arrow-up.svg" id="scrollUp"></a>

   </header>
    {{-- 頁中 --}}
    <section>
        {{-- 會員專區-購物車 --}}
        <div class="breadcumb_area bg-img" id="member" >
            <div class="row">
                <div class="col-12 text-center title">
                    <h2>訂單確認</h2>
                </div>
            </div>
        </div>

                    

        {{-- 購物車清單 --}}
        <div class="container" id="tableBox">
            <div class=" table-responsive tableStyle">
                <table id="cart" class="table table-hover table-condensed">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col">設計圖</th>
                            <th scope="col">商品名稱</th>
                            <th scope="col">價格</th>
                            <th scope="col">衣服尺寸</th>
                            <th scope="col">衣服顏色</th>
                            <th scope="col">數量</th>
                            <th scope="col" class="text-right textPadding">小計</th>
                            {{-- <th style="width:10%"></th> --}}
                        </tr>
                    </thead>
                    <tbody>
     
            <?php $total = 0 ?>
     
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
     
                    <?php $total += $details['price'] * $details['quantity']* 0.85 ?>
                    <tr class="text-center Products">
                        <td data-th="Product">
                                <img src="{{ $details['design'] }}" width="100" height="120" class="img-responsive"/>
                        </td>
                        <td>{{ $details['name'] }}</td>
                        <td data-th="Price">${{ $details['price'] }}</td>
                        <td>{{ $details['buyfbsize'] }}</td>
                        <td>{{ $details['buyfbcolor'] }}</td>
                        <td data-th="Quantity">{{$details['quantity']}}
                            {{-- <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" /> --}}
                        </td>
                        <td data-th="Subtotal" class="text-right textPadding">${{ number_format($details['price'] * $details['quantity'],0) }}</td>

                    </tr>
                @endforeach
            @endif
     
            </tbody>
            <tfoot>
                <tr class="visible-xs">
                {{-- <td class="text-center"><strong>Total {{ $total }}</strong></td> --}}
                </tr>
                <tr class="visible-xs">
                    {{-- <td class="text-center"><strong>Total {{ $total }}</strong></td> --}}
                </tr>
                <tr>
                    <td colspan="1" class="hidden-xs"></td>
                    <td colspan="1" class="hidden-xs"></td>
                    <td colspan="1" class="hidden-xs"></td>
                    <td colspan="1" class="hidden-xs"></td>
                    <td colspan="2" class="hidden-xs text-right">備註:(活動優惠85折)</td>
                    <td class="hidden-xs text-right textPadding"><strong>折扣 -${{number_format( $total/0.85*0.15) }}</strong></td>
                </tr>
                <tr>
                    <td><a href="{{ url('/cart') }}" class="btn btn-info"><i class="fa fa-angle-left"></i> 返回購物車</a></td>
                    <td colspan="1" class="hidden-xs"></td>
                    <td colspan="1" class="hidden-xs"></td>
                    <td colspan="1" class="hidden-xs"></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-right totalText textPadding"><strong>總計 ${{number_format( $total) }}</strong></td>
                </tr>
            </tfoot>
        </table>
        </div>
        </div>

        {{-- 訂單資料填寫 --}}
    <form action="/p_order" target="hidden_iframe" method="POST"class="form-horizontal">
        @csrf
        {{--付款方式  --}}
        <div class="container">
                <div class="col-12 formTitleBg">
                    <h5 class="formTitle ">請選擇付款方式</h5>
                    {{-- <div class="form-group form-inline">
                        <label  class="col-md-4">付款金額：</label>
                        <p class="form-control-static">NT$ <span id="payMoney">{{ number_format($total) }}</span> 元</p>
                    </div> --}}

           
              {{-- <div class="form-group">
               <label class="col-sm-2 control-label"><font color="red">*</font>付款方式：</label>
              </div> --}}
                <div class="col-12">
                    <div class="radio">
                        <label>
                        <input type="radio" name="payment_type" value="1" checked /> 信用卡付款
                        <img src="img/bg-img/icon_creditcard.gif" alt="">
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        <input type="radio" name="payment_type" value="3" /> ATM轉帳
                        <img src="img/bg-img/icon_deposit.gif" alt="">
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        <input type="radio" name="payment_type" value="6" /> 超商代碼繳費 (手續費15元)
                        <img src="img/bg-img/icon_ibon.gif" alt="">
                        </label>
                    </div>
                </div>
                {{-- 收件人資訊 --}}
                <h5 class="formTitle ">收件人資訊</h5>
                {{-- 收件人姓名 --}}
                <div class="form-group form-inline">
                    <label class="control-label col-md-2"for="o_recipient"><font color="red">*</font>收件人姓名</label>
                    <input type="text" name="o_recipient" id="o_recipient" value="{{Auth::user()->u_name}}" class="form-control col-md-8" required />
                </div>
                {{-- 收件人電話 --}}
                <div class="form-group form-inline">
                    <label class="control-label col-md-2"for="o_recipient_phone"><font color="red">*</font>收件人電話</label>
                    <input type="tel" name="o_recipient_phone" id="o_recipient_phone" value="{{Auth::user()->u_phone}}" class="form-control col-md-8"required />
                </div>
                {{-- 寄送地址 --}}
                <div class="form-group form-inline">
                    <label class="control-label col-md-2"for="o_recipient_address"><font color="red">*</font>寄送地址</label>
                    <input type="text" name="o_recipient_address" id="o_recipient_address" value="{{Auth::user()->u_address}}" class="form-control col-md-8" placeholder="" required />
                </div>
                {{-- 訂購人信箱(同會員信箱) --}}
                {{-- <div class="form-group">
                    <label class="control-label"for="email"><font color="red">*</font>信箱：</label>
                </div>    
                <div class="col-sm-10">
                    <input type="email" name="email" id="email" value="{{Auth::user()->email}}" class="form-control"  required />
                </div> --}}
                {{-- 備註 --}}
                <div class="form-group form-inline">
                    <label class="control-label col-md-2"for="o_note">備註</label>
                    <textarea name="o_note" id="o_note" class="form-control col-md-8"  placeholder="請輸入額外的需求"></textarea>
                </div>
                
                {{-- 訂單狀態 --}}
                <div class="form-group " style="display:none">
                    <label class="control-label"for="o_status">訂單狀態：</label>
                </div>
                <div class="col-sm-10" style="display:none">
                    <input type="text" name="o_status" id="o_status" value="處理中" class="form-control"  required />
                </div>
                {{-- 顏色 --}}
                <div class="form-group" style="display:none">
                    <label class="col-sm-2 control-label"for="buyfbcolor">顏色：</label>
                </div>
                <div class="col-sm-10" style="display:none">
                    <input type="text" name="buyfbcolor" id="buyfbcolor" value="{{ $details['buyfbcolor'] }}" class="form-control"  required />
                </div>
                {{-- Size --}}
                <div class="form-group" style="display:none">
                    <label class="col-sm-2 control-label"for="buyfbsize">Size：</label>
                </div>
                <div class="col-sm-10" style="display:none">
                    <input type="text" name="buyfbsize" id="buyfbsize" value="{{ $details['buyfbsize'] }}" class="form-control"  required />
                </div>
                
                {{-- 編號id --}}
                <div class="form-group"style="display:none">
                    <label class="col-sm-2 control-label"for="o_number">編號：</label>
                </div>
                <div class="col-sm-10"style="display:none">
                <input type="text" name="o_number" id="o_number" value="" class="form-control"  required />
                </div>
                {{-- od_id --}}
                <div class="form-group"style="display:none">
                    <label class="col-sm-2 control-label"for="od_id">od編號：</label>
                </div>
                <div class="col-sm-10"style="display:none">
                <input type="text" name="od_id" id="od_id" value="" class="form-control"  required />
                </div>
                {{-- o_id --}}
                <div class="form-group"style="display:none">
                    <label class="col-sm-2 control-label"for="o_id">o_id編號：</label>
                </div>
                <div class="col-sm-10"style="display:none">
                <input type="text" name="o_id" id="o_id" value="" class="form-control"  required />
                </div>
            

            </div>
        </div>
        {{-- 確認結帳 --}}
        <div class="form-group"style="margin-top:20px;">
            <p class="text-center">
                <button type="submit" class="btn btnBill" onclick="ok()">
                    {{ __('確認結帳') }}
                </button>
            </p>
        </div>
    </form>
           



        
    </section>
    {{-- 頁尾 --}}
    <footer class="footerArea clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class=" d-flex">
                        <!-- Logo -->
                        <div>
                            <a href="/"><img src="img/common/logoWhite.png" alt="" class="logoFooter"></a>
                        </div>

                        <div class="footerLink">
                            <ul class="d-flex" type="none">
                                <!-- <li><a href="#" class="footerAreaA">首頁</a></li> -->
                                <li><a href="/#about" class="footerAreaA">關於我們</a></li>
                                <li><a href="/#hotSales" class="footerAreaA">熱銷設計</a></li>
                                <li><a href="/custom" class="footerAreaA">動手設計</a></li>
                                <li><a href="/products" class="footerAreaA">直接購買</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <span id="copyright">Copyright ©2020 獨衣無二有限公司 | All rights reserved</span>
                </div>
            </div>
        </div>
    </footer>

    
    
    <script type="text/javascript">
 
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
 
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
 
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
 
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
 
    </script>

    <script>
       function ok(){
            // const now = new Date()
            // const year = now.getFullYear();
            // let month = now.getMonth() + 1;
            // let day = now.getDate();
            // let hour = now.getHours();
            // let min = now.getMinutes();
            // let msec = now.getMilliseconds();

            // // 月份與日期補0
            // String(month).length < 2 ? (month = String("0" + month)) : month;
            // String(day).length < 2 ? (day = String("0" + day)) : day;
            // String(hour).length < 2 ? (hour = String("0" + hour)) : hour;
            
            // const date = `${year}${month}${day}${hour}${min}${msec}`;



           document.getElementById("o_number").value={{$orderList->last()->o_number}}+1;
           document.getElementById("o_id").value={{$orderList->last()->o_id}}+1;
           document.getElementById("od_id").value={{$orderList->last()->od_id}}+1;
           alert('完成訂單!')
        }
           
        
        
        
        </script>

</body>

</html>