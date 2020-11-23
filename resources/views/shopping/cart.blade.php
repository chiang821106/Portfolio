<!DOCTYPE html>
<html lang="zh"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購物車 - UNIQUE 獨衣無二</title>


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

        #tableBox{
            height: 600px;
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
                                <a class="dropdown-item" href="../home">
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
        {{-- <a href="#top" class="scrollUpBg"><img src="img/common/arrow-up.svg" id="scrollUp"></a> --}}

   </header>
    {{-- 頁中 --}}
    <section>
        {{-- 會員專區-購物車 --}}
        <div class="breadcumb_area bg-img" id="member" >
            <div class="row">
                <div class="col-12 text-center title">
                    <h2>購物車</h2>
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
                <th scope="col" class="text-right">小計</th>
                <th scope="col">更新/刪除</th>
            </tr>
            </thead>
            <tbody>
     
            <?php $total = 0 ?>
     
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
     
                    <?php $total += $details['price'] * $details['quantity']  ?>
     
                    <tr class="text-center Products">
                        <td data-th="Product">
                                <img src="{{ $details['design'] }}" width="100" height="120" class="img-responsive"/>
                                    {{-- <h4 class="nomargin">{{ $details['name'] }}</h4> --}}
                        </td>
                        <td>{{ $details['name'] }}</td>
                        <td data-th="Price" >${{ number_format($details['price'],0) }}</td>
                        <td >{{ $details['buyfbsize'] }}</td>
                        <td >{{ $details['buyfbcolor'] }}</td>
                        
                        <td data-th="Quantity">
                            <input type="number" id="number" value="{{ $details['quantity'] }}" class="form-control quantity" min="1" max="10" pattern=""/>
                        </td>
                        <td data-th="Subtotal" class="text-right">${{ number_format($details['price'] * $details['quantity'],0) }}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"> 更新</i></button>
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"> 刪除</i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
     
            </tbody>
            <tfoot>
            <tr class="visible-xs">
                {{-- <td class="text-center"><strong>Total {{ $total }}</strong></td> --}}
            </tr>
            <tr>
                <td><a href="{{ url('/products') }}" class="btn btn-info"><i class="fa fa-angle-left"></i> 繼續購物</a></td>
                <td colspan="1" class="hidden-xs"></td>
                <td colspan="1" class="hidden-xs"></td>
                <td colspan="1" class="hidden-xs"></td>
                
                <td style="visibility: hidden" colspan="2" class="hidden-xs">備註:(活動期間購物85折)</td>
                <td class="hidden-xs text-right totalText"><strong>總計 ${{number_format($total,0)  }}</strong></td>
                <td class="text-right"><a  href="{{ url('/products_order') }}" class="btn btnBill "><i class="fa fa-angle-right"></i> 前往結帳</a></td>
            </tr>
            </tfoot>
        </table>
    </div>
        



        
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
 
            if(confirm("是否確定刪除?")) {
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
        document.getElementById('number').addEventListener('keypress',function(event){
            if(event.keyCode==45){
                event.preventDefault();
            }
        });
    </script>

</body>

</html>