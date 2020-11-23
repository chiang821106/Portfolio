<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>會員重設密碼 - UNIQUE 獨衣無二</title>
    
    <link rel="icon" type="text/css" href="{{ asset('img/common/logo_ico.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common/common.css') }}">
    <script type="text/javascript" src="{{ URL::asset('js/common/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/common/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/common/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/common/common.js') }}"></script>
{{-- 'img/index/d3.jpg' --}}
    <style>
        /* 背景圖 */

        body {
            font-family: 'sans-serif';
        }

        .img {
            background-image:url('../../img/index/d2.jpg');
            background-attachment: fixed;
            background-position: center 0px;
            background-repeat: no-repeat;
            background-size: cover;
            height: 750px;
            padding-top: 130px;
        }

        /* navbar底部陰影 */
        #navBar {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 10px -10px;
        }

        /* 登入框樣式 */
        .card {
            border: 0;
            box-shadow: rgba(0,0,0,.16) 0 2px 5px 0, rgba(0,0,0,.12) 0 2px 10px 0;

        }

        .card-header {
            color: #fff;
            background: #F2994A;
            background-image: linear-gradient(120deg, #fda085  0%, #f6d365 100%);
        }

        /* 按鈕樣式 */
        .btn:active {
            box-shadow: none;
        }

        .btnAgree {
            background-color: #f1b432;
            color: #fff;
            box-shadow: rgba(0,0,0,.16) 0 2px 5px 0, rgba(0,0,0,.12) 0 2px 10px 0;
        }

        .btnAgree:hover,
        .btnAgree:focus {
            color: #fff;
            background-color: #f1bf52;
            box-shadow: none;
        }

        .btnAgree:active {
            background-color: #b8861c;
        }

        /* 表單樣式 */
        .form-control:focus {
            border-color: #f1b432;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            background-color: #fafafa;
        }

       

    </style>
</head>
<body>

    <header id="top">

        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navBar">

            <!-- Logo -->
            <a class="nav-brand" href="/">
                <img src="{{asset("img/common/logoYellow.png")}}" alt="" class="logoNav">
            </a>

            <!-- 漢堡選單 -->
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- 導覽標籤 -->
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mr-auto navbarul">
                    <!-- <li class="nav-item navLink"><a class="nav-link" href="#">首頁</a></li> -->
                    <li class="nav-item navLink"><a class="nav-link" href="#about">關於我們</a></li>
                    <li class="nav-item navLink"><a class="nav-link" href="#hotSales">熱銷設計</a></li>
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
                        <a href="/home" class="topIconA userIcon"><img src={{asset("img/common/user.svg")}} alt="會員登入"
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
                            <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                會員：{{ Auth::user()->u_name }}<span class="caret"></span>
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

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
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
                <a href="/cart" class="topIconA"><img src={{asset("img/common/cart.svg")}} alt="購物車" class="topIcon">
                    @if (count((array) session('cart')) > 0)

                        <span id="count">{{ count((array) session('cart')) }}</span>
                    @endif
                </a>
            </div>

            </div>
        </nav>

        <!-- TOP鍵 -->
        <a href="#top" class="scrollUpBg"><img src="{{asset("img/common/arrow-up.svg")}}" id="scrollUp"></a>

    </header>
    
    <section class="img">
        <div class="container"id="reset">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header"onclick="reset()">
                            <h3>{{ __('重設密碼') }}</h3>
                        </div>
        
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
        
                                <input type="hidden" name="token" value="{{ $token }}">
        
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('電子郵件') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" readonly>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('新密碼') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('確認密碼') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn btnAgree">
                                            {{ __('確認') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <footer class="footerArea clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class=" d-flex">
                        <!-- Logo -->
                        <div>
                            <a href="index.html"><img src={{asset("img/common/logoWhite.png")}} alt="" class="logoFooter"></a>
                        </div>

                        <div class="footerLink">
                            <ul class="d-flex" type="none">
                                <!-- <li><a href="#" class="footerAreaA">首頁</a></li> -->
                                <li><a href="#about" class="footerAreaA">關於我們</a></li>
                                <li><a href="#hotSales" class="footerAreaA">熱銷設計</a></li>
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
        function reset(){
            document.getElementById('password').value="11111111";
            document.getElementById('password-confirm').value="11111111";
        }
    </script>
    
</body>
</html>