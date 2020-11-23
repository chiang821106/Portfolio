<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>作品上架 - UNIQUE 獨衣無二</title>

    <link rel="icon" href="img/common/logo_ico.ico">


    <link rel="stylesheet" href="css/common/bootstrap.min.css">
    <link rel="stylesheet" href="css/common/common.css">
    <link rel="stylesheet" href="css/user/common.css">

    {{-- <script defer src="js/index/index.js"></script> --}}
    <script defer src="js/common/common.js"></script>
    <script src="js/common/jquery.min.js"></script>
    <script src="js/common/popper.min.js"></script>
    <script src="js/common/bootstrap.min.js"></script>

    <style>
        tbody {
        
        counter-reset:sectioncounter;
     
        }                      
        .SortId:before {
        
           content:counter(sectioncounter); 
        
           counter-increment:sectioncounter;
        
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
            <div class="nav-item ml-auto topIconBox rwdCartIcon">
                <a href="/cart" class="topIconA"><img src="img/common/cart.svg" alt="購物車" class="topIcon">
                    @if (count((array) session('cart')) > 0)

                        <span id="count">{{ count((array) session('cart')) }}</span>
                    @endif
                </a>
            </div>

            </div>
        </nav>

        <!-- TOP鍵 -->
        <a href="#top" class="scrollUpBg"><img src="img/common/arrow-up.svg" id="scrollUp"></a>

    </header>


    {{-- 會員專區 --}}
    <div id="contentBox">

        {{-- 會員中心 --}}
        <div class="container">
            <div class="row">
                <div class="col-12 text-center title">
                    <h2>會員專區</h2>
                    {{-- <div class="hrLine"></div> --}}
                </div>
            </div>
        </div>

        {{-- 導覽列 --}}
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item navLink"><a class="nav-link " href="/homes">帳號維護</a></li>
            <li class="nav-item navLink"><a class="nav-link " href="/order{{ Auth::user()->u_id }}">訂單查詢</a></li>
            <li class="nav-item navLink"><a class="nav-link active" href="javascript:void(0)">作品上架</a></li>
        </ul>




        <div class="container">
            <div class=" container table-responsive tableStyle">
                {{-- <div class="countData">共"X"筆資料</div>
                --}}
                <table class="table table-hover ">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col">序號</th>
                            <th scope="col">成品圖</th>
                            <th scope="col">作品名稱</th>
                            <th scope="col">作品描述</th>
                            <th scope="col">狀態</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr class="text-center">
                                <td class="SortId"></td>

                                <td>
                                    <img src={{ $item->p_photo }} width="100" height="100">
                                </td>
                                <td>{{ $item->p_name }}</td>
                                <td>{{ $item->p_description}}</td>
                                @switch($item->p_filename_private)
                                    @case('public')
                                    <td>公開</td>
                                    <form action="/undercarriage{{ $item->p_id }}" method="POST">
                                        @csrf
                                        <td>
                                            <button type="submit" class="btn btnOff text-white"
                                                target="_blank">下架</button>
                                        </td>
                                    </form>
                                    @break
                                    @case('private')
                                    <td>未公開</td>
                                    <form action="/shelfing{{ $item->p_id }}" method="POST">
                                        @csrf
                                        <td>
                                            <button type="submit" class="btn btn-primary text-white"
                                                target="_blank">上架</button>
                                        </td>
                                    </form>
                                    @break
                                    @default
                                @endswitch($item->p_filename_private == 'public')
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    {{-- 分頁 --}}
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <div>
                    <div class=" row justify-content-center">
                        <div>{{ $products->render() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

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

                        <div>
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

    </script>
</body>

</html>
