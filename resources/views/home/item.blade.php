<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>商品購買 - UNIQUE 獨衣無二</title>
    <link rel="icon" href="img/common/logo_ico.ico">

    <link rel="stylesheet" href="css/common/bootstrap.min.css">
    <link rel="stylesheet" href="css/common/common.css">
    <link rel="stylesheet" href="css/custom/common.css">

    <!-- <link rel="stylesheet" href="css/index/index.css"> -->
    
    <!-- <script defer src="js/index/index.js"></script> -->

    <script defer src="js/common/common.js"></script>
    <script src="js/common/jquery.min.js"></script>
    <script src="js/common/popper.min.js"></script>
    <script src="js/common/bootstrap.min.js"></script>
<style>
   
</style>


</head>
<style>
    img[class~="rounded"] {
        border: 1px solid gray;
    }

    img[class~="rounded"]:hover {
        border: 1px solid #f1b432;
        cursor: pointer;
    }

    #fcolor [type=radio] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* IMAGE STYLES */
    #fcolor [type=radio]+img {
        margin-left: 5px;
        cursor: pointer;
    }

    /* CHECKED STYLES */
    #fcolor [type=radio]:checked+img {
        border: 1px gray solid;
        padding: 2px;
    }

    #fcolor {
        /* background-color: #F5F5F5; */
        vertical-align: middle;
    }

    #bgclothes {
        position: absolute;
        top: 0;
        left: 0;
    }

    #dsclothes {
        position: absolute;
        top: 104px;
        left: 107px;
        /* top: 130px;
        left: 125px; */
    }
    #font,
    #back,
    input[name="modeling"] {
        position: static;
        opacity: 1;
        width: 20px;
        height: 20px;
        font-size: 80px;
        text-align: top;
        vertical-align: bottom;
    }
    input[name="size"] {
        position: static;
        opacity: 1;
        width: 20px;
        height: 20px;
        /* font-size: 20pt; */
        /* text-align: top; */
    }
    table {
            border-collapse: collapse;
            font-weight: bold;
        }
    #item{
        margin-top: 100px;
    }
</style>

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
            </div>
        </nav>

        <!-- TOP鍵 -->
        <a href="#top" class="scrollUpBg"><img src="img/common/arrow-up.svg" id="scrollUp"></a>

   </header>

    {{-- 頁中 --}}
    <div class="container d-flex justify-content-around"id="item">
        <div class="mt-5" style="width:500px;height: 600px;">
            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
                <ol class="carousel-indicators" style="top: 500px;right: 100px;">
                    <p data-target="#carouselExampleIndicators" data-slide-to="0" class="ml-1">
                        <img id="smimg01"src="images/clothes/children/0_490x530_08.png" alt="..." class="rounded"
                            style="width: 75px;height: 75px;">
                    </p>
                    <p data-target="#carouselExampleIndicators" data-slide-to="1" class="ml-1">
                        <img id="smimg02" src="{{$emp->p_filename_design}}" alt="..." class="rounded"
                            style="width: 75px;height: 75px;">
                    </p>
                    <!-- <p data-target="#carouselExampleIndicators" data-slide-to="2" class="ml-1">
                        <img src="images/clothes/children/0_490x530_08.png" alt="..." class="rounded"
                            style="width: 75px;height: 75px;">
                    </p> -->

                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img id="dsclothes" src="{{$emp->p_filename_design}}" class="d-block" alt="..."
                            style="height: 300px;width: 183px;">
                        <img id="bfclothes" src="images/clothes/children/0_490x530_08.png" class="d-block"
                            alt="..." style="height: 500px;width: 400px;">
                    </div>
                    <div class="carousel-item">
                        <img  src="{{$emp->p_filename_design}}" class="d-block W-100  mx-auto" alt="...">
                    </div>
                    <!-- <div class="carousel-item">
                        <img src="images/clothes/children/0_490x530_08.png" class="d-block w-100" alt="...">
                    </div> -->
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div style="width: 500px;">
        <form class="text-center">   
            <h2>選擇樣式</h2>
            
            <table class="table table-bordered selectTable">
                <tr>
                    <td><img src="images/icon/clothes1.png" alt="" width="80px" height="80px"></td>
                    <td class="tdBg">
                        <p>請選擇版型</p>
                        <label><input type="radio" name="fbclothes" id="font" value="font" checked>
                            設計衣服前面</label>

                        <label><input type="radio" name="fbclothes" id="back" value="back">
                            設計衣服背面</label>
                        <br>
                        <label><input type="radio" id="common" value="common" name="modeling" checked>大眾版</label>
                        <label><input type="radio" id="children" value="children" name="modeling">兒童版</label>
                        <label><input type="radio" id="woman" value="woman" name="modeling">女版</label>
                    </td>
                </tr>

                {{-- 測試隱藏取值 --}}
                <div style="display:none">
                    <label for="p_id">商品Id</label>
                    <input type="text"id="p_id"name="p_id"value="{{$emp->p_id}}">
                </div>

                {{-- 顏色 --}}
                <tr> 
                    <td><img src="images/icon/drawing.png" alt="" width="80px" height="80px"></td>
                    <td name="fcolor" id="fcolor" class="tdBg">

                </tr>
                {{-- 尺寸 --}}
                <tr>
                    <td><img src="images/icon/size.png" alt="" width="80px" height="80px"></td>
                    <td class="tdBg">
                        <p>請選擇尺寸</p>
                        <label><input type="radio" id="size_xs" value="XS" name="size"> XS</label>
                        &nbsp;
                        <label><input type="radio" id="size_s" value="S" name="size"> S</label>
                        &nbsp;
                        <label><input type="radio" id="size_m" value="M" name="size" checked> M</label>
                        &nbsp;
                        <label><input type="radio" id="size_l" value="L" name="size"> L</label>
                        <br>
                        <label><input type="radio" id="size_xl" value="XL" name="size"> XL</label>
                        &nbsp;
                        <label><input type="radio" id="size_2xl" value="2XL" name="size"> 2XL</label>
                        &nbsp;
                        <label><input type="radio" id="size_3xl" value="3XL" name="size"> 3XL</label>
                    </td>
                </tr>

                {{-- 單價 --}}
                <tr>
                    <td><img src="images/icon/price.png" alt="" width="80px" height="80px"></td>
                    <td class="align-middle text-center tdBg">
                        <p ><span class="h4">NT$</span><span
                                class="text-monospace display-4 text-danger">500</span></p>
                    </td>
                </tr>
                
                {{-- 數量 (暫不顯示 --}}
                <tr style="display:none">
                    <td><img src="images/icon/quantity.jpg" alt="" width="80px" height="80px"></td>
                    <td >
                        <div class="input-group">
                            <select class="custom-select" id="inputGroupSelect01">
                                <!-- <option selected disabled>請選擇數量</option> -->
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="4">5</option>
                                <option value="4">6</option>
                                <option value="4">7</option>
                                <option value="4">8</option>
                                <option value="4">9</option>
                                <option value="4">10</option>
                                <option value="4">11</option>
                                <option value="4">12</option>
                            </select>
                        </div>
                    </td>
                </tr>
            </table>
            <div class=" d-flex justify-content-around">
                <a  style="width: 230px;" class="btn btn-info btn-lg text-center"href="/products">返回購物</a>
                
                <button style="width: 230px;" class="btn btn-warning btn-lg text-center text-white btnMainStyle ajaxbuy">加入購物車</button>
            </div>
        </form>
            {{-- <button onclick="ajaxbuy();" class="btn btn-secondary w-100">購買</button> --}}

        </div>
    </div>
    <!-- TOP鍵 -->
    <a href="#top" class="scrollUpBg"><img src="img/common/arrow-up.svg" id="scrollUp"></a>

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
        
        font.addEventListener('click', function () { clothesch(this) })
        back.addEventListener('click', function () { clothesch(this) })
        common.addEventListener('click', function () { clothesch(this) })
        children.addEventListener('click', function () { clothesch(this) })
        woman.addEventListener('click', function () { clothesch(this) })
        size_xs.addEventListener('click', function () { clothesch(this) })
        size_s.addEventListener('click', function () { clothesch(this) })
        size_m.addEventListener('click', function () { clothesch(this) })
        size_l.addEventListener('click', function () { clothesch(this) })
        size_xl.addEventListener('click', function () { clothesch(this) })
        size_2xl.addEventListener('click', function () { clothesch(this) })
        size_3xl.addEventListener('click', function () { clothesch(this) })
        inputGroupSelect01.addEventListener('change', function () { qty(this) })
        var form = document.getElementById('fcolor');
        var colorchildren = [00, 02, 03, 04, 07, 08, 99];
        var colorcommon = [00, 01, 02, 03, 04, 06, 07, 08, 11, 12, 13, 99];
        var colorwoman = [00, 01, 02, 03, 04, 07, 08, 11, 99];
        var colorplate = ["白","寶藍","水藍","黃","果綠","售完","紅","蜜桃紅","灰","售完","售完","藏青","軍綠","愛爾蘭綠","黑"];
        // for (i = 0; i <= 14; i++) {
        function intocolor(color) {
            form.innerHTML = "";
            form.innerHTML += '<p>請選擇衣服顏色</p>';
            color.forEach(function (v, i) {
                if (i == Math.round(color.length / 2)) {
                    form.innerHTML += "</br>"
                }
                if (v == 8) {
                    var colorchecked = "checked";
                }
                form.innerHTML += `<label>
        <input type="radio" name="fbcolor" ${colorchecked} onchange="colorChange(this);" value="${v}">
        <img src="images/colors/icon_color_${v}.jpg" alt=""></label>`;

            })
        };
        intocolor(colorcommon);
        var fbclothes = "", modeling = "common", fbcolor = "08", fbsize = "M", fbqty = 1;
        var colorchinese = "灰" ;
        
        function colorChange(y) {
            colorchinese = y.value==99?"黑":colorplate[y.value];
            let x = y.value;
            if (x < 10) {
                x = "0" + x
                fbcolor = x;
                clothesch('fbcolor');
            } else {
                fbcolor = y.value;
                clothesch('fbcolor');
            }
        }
        function qty(x) {
            if (x.id == "inputGroupSelect01") {
                fbqty = $('#inputGroupSelect01').val();

            }
        }
        function clothesch(x) {
            if (x.name == "fbclothes") {
                fbclothes = x.value=="font"?"":"_b";

            } else if (x.name == 'modeling') {
                fbcolor = "08"
                modeling = x.value;
                switch (x.value) {
                    case 'common':
                        intocolor(colorcommon)
                        break;
                    case 'children':
                        intocolor(colorchildren)
                        break;
                    case 'woman':
                        intocolor(colorwoman)
                        break;
                }


            } 
            // else if (x == 'fbcolor') {
            //     console.log(fbcolor);
            // } 
            else if (x.name == "size") {
                $("input[name='size']:checked").val();
                fbsize = x.value;
            }
            bfclothes.src = "images/clothes/" + modeling + "/0_490x530_" + fbcolor + fbclothes + ".png";
            smimg01.src =  "images/clothes/" + modeling + "/0_490x530_" + fbcolor + fbclothes + ".png";
        }

        
        $(document).ready(function(){
            $('.ajaxbuy').click(function(e){
                e.preventDefault();
                var buyfbclothes, buymodeling, buyfbcolor, buyfbsize, buyfbqty;
                buyfbclothes = fbclothes == "" ? "f" : "b";
                buymodeling = modeling;
                buyfbcolor = colorchinese;
                buyfbsize = fbsize;
                buyfbqty = fbqty;
                var fd = new FormData();
                fd.append('buyfbclothes', buyfbclothes);
                fd.append('buymodeling', buymodeling);
                fd.append('buyfbcolor', buyfbcolor);
                fd.append('buyfbsize', buyfbsize);
                fd.append('buyfbqty', buyfbqty);
                // console.log(buyfbsize);
                $.ajaxSetup({
                            headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                          });
                console.log(buyfbsize);
                console.log(buyfbcolor);
                id = document.getElementById('p_id').value;
                console.log(id);
                
                
                $.ajax({
                    url: '/lucky'+id,
                    // uri:'http://localhost/Users/keywei/Downloads/buysize/0803bigwork/buyclothes.php',
                    // url: 'http://localhost/php/0805_1bigwork/testphoto.php',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data:fd,
                    //data只能指定單一物件                 
                    type: 'post',
                    success: function (data) {
                     window.location.reload();
                    }
                });
            })
        })    
       
    </script>
</body>

</html>