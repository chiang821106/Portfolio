<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>直接購買 - UNIQUE 獨衣無二</title>
    <link rel="icon" href="img/common/logo_ico.ico">

    
    <link rel="stylesheet" href="css/common/bootstrap.min.css">
    <link rel="stylesheet" href="css/common/common.css">
    <link rel="stylesheet" href="css/shopping/common.css">

    

    <script src="js/common/jquery.min.js"></script>
    <script src="js/common/popper.min.js"></script>
    <script src="js/common/bootstrap.min.js"></script>
    <script defer src="js/common/common.js"></script>

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"> --}}
 
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
     
    <style>
        /* #products{
            margin-top: 45px;
        } */

        /* #cart{
            margin-left: 1650px;
            margin-top: 135px;
        } */
        .list-group-item{
            box-shadow: rgba(0, 0, 0, .16) 0 2px 5px 0, rgba(0, 0, 0, .12) 0 2px 10px 0;
        }

        .list-group-item:hover {
            transition-duration: 500ms;
            background: #F2994A;
            background-image: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            color: #fff;
        }

        /* #listgroup {
            font-family: "Microsoft JhengHei";
        } */

        /* .card:hover {
            background-color: rgb(247, 247, 247);
        } */

        .ahover:hover{
            transition-duration: 500ms;
            color:#f1b432 ;     
        }
        .ahover{
            color:black;  

        }
    </style>

</head>

<body>
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

            
    </nav>

        <!-- TOP鍵 -->
        <a href="#top" class="scrollUpBg"><img src="img/common/arrow-up.svg" id="scrollUp"></a>

</header>
    {{-- 頁中 --}}
    <section>
              {{-- 商品欄 --}}
        <div class="container sortBox">
            <div class="row">
                <div class="col-2">
                    <div id="listgroup" class="list-group border border-secondary rounded text-center sticky-top " style="top:25%">
                        <div class="h2 text-nowrap text-light bg-dark  mb-0 sort">
                            作品排序
                        </div>

                        
                        <a href="/popular" id="popular" type="button" class="list-group-item list-group-item-action ">
                            人氣作品
                        </a>
                        <a href="/newproducts" type="button" class="list-group-item list-group-item-action ">
                            最新作品
                        </a>
                    
    
                    </div>
                </div>
                <div class="col-10"id="products">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center title">
                                <h2>購物專區</h2>
                                {{-- <div class="hrLine"></div> --}}
                            </div>
                        </div>
                    <div id="cardimg" class="container"></div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                          
                        
                          <li colspan="3">
                              {{$products->render()}}               
                          </li>
                          
                        </ul>
                       
                    </nav>
                </div>
            </div>
        </div>
        <script>
            window.onload = function () {
                var colorchildren = [00, 02, 03, 04, 07, 08, 99];
                var colorcommon = [00, 01, 02, 03, 04, 06, 07, 08, 11, 12, 13, 99,00];
                var colorwoman = [00, 01, 02, 03, 04, 07, 08, 11, 99];
                var innercardmg ='<div class="row">'
                        // console.log(colorcommon.length-1)
    
                colorcommon.forEach(function (v, i) {
                    // if(i%3==0){
                    //     console.log(i)
                    //     innercardmg +=`<div class="row ">`
    
                    // }
                //     let x = v;
                // if (x < 10) 
                //     x = "0" + x
                    // console.log(i);
                    // cardimg.innerHTML += `<div class="card d-inline-block mx-2 my-3" style="width: 13rem;">
                    //     <img src="images/clothes/common/0_490x530_${x}.png" class="card-img-top" alt="...">
                    //     <div class="card-body text-nowrap overflow-hidden text-center">
                    //         <p class="card-title">紅色車子</p>
                    //         <p class="card-text">sit down please</p>
                    //     </div>
                    // </div>`
    
    
                    innercardmg =
                    `
                    <div class="container products">
                       <div class="row">
                         @foreach($products as $product)
                         <div class="col-xs-12 col-sm-6 col-md-3 productsBox">
                            <div class="card ">
                                <a href="/item{{$product->p_id}}"style="text-decoration:none;"class="ahover">
                                <div class="cardBox">
                                    <img src="{{ $product->p_photo }}" class="card-img-top   img-fluid">
                                    <img src="{{ $product->p_filename_design}}" class="card-img-top hoverImg img-fluid">
                                </div>    
                                </a>
                                <div class="caption text-center">
                                        @if($product->u_image == "")
                                        <img style="margin-right:5px;" class="rounded-circle" src="img/common/user_image.png" width="50px;"height="50px;" alt="">
                                        @else
                                        <img style="margin-right:5px;" class="rounded-circle" src="{{asset('member/user/' . $product->u_image)}}"width="50px;"height="50px;" alt="">
                                        @endif
                                        <h4>{{$product->u_name}}</h4>
                                        <h4>{{ $product->p_name }}</h4>
                                        <p>{{$product->p_description}}</p>
                                        <p style="display:none" class="btn-holder"><a href="{{ url('add-to-cart/'.$product->p_id) }}" class="btn btn-warning btn-block text-center" role="button">加入購物車</a> </p>
                                </div>
                            </div>    
                        </div>
                         @endforeach
                            
                        </div>
                    </div>
                        `
                    //     if(i%2==0){
                    //         innercardmg +=`</div>`
    
                    // }
                        // if(i==colorcommon.length-1){
                        //     innercardmg+=`</div>`
                        // }
                   
    
                })
                innercardmg += "</div>"
                cardimg.innerHTML=innercardmg
            }
    
    
        </script>
        
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

    <script>
        // $(document).ready(function(){
        //     $('#popular').click(function(e){
        //         // alert('hi');
        //         e.preventDefault();
        //         $.ajaxSetup({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 }
        //         });
        //         $.ajax({
        //                 url: '/popular',
        //                 method: "get",
        //                 success: function (response) {
        //                     //    window.location.reload();
        //                 }
        //         });
        //     })
        // })
    </script>

</body>

</html>