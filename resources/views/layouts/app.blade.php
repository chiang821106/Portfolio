<!doctype html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
--}}
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>會員登入/註冊 - UNIQUE 獨衣無二</title>


    <link rel="stylesheet" href="css/common/bootstrap.min.css">
    <link rel="stylesheet" href="css/common/common.css">

    <script src="js/common/jquery.min.js"></script>
    <script src="js/common/popper.min.js"></script>
    <script src="js/common/bootstrap.min.js"></script>
    <script defer src="js/common/common.js"></script>

</head>
<style>
    .user {
        margin-right: 30px;
    }

</style>

<body>
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
                <ul class="navbar-nav ml-auto navbarul">
                    @guest
                    <li class="nav-item navLink">
                        <a class="nav-link" href="{{ route('login') }}"><span
                                style="font-size:18px;">{{ __('會員登入') }}</span></a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item navLink">
                            <a class="nav-link" href="{{ route('register') }}"><span
                                    style="font-size:18px;">{{ __('註冊帳號') }}</span></a>
                        </li>
                    @endif

                @endguest
                </ul>
            </div>

    
        </nav>

    </header>

    @yield('content')
    {{-- <main class="py-4">
        @yield('content')
    </main> --}}

    <footer class="footerArea clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class=" d-flex">
                        <!-- Logo -->
                        <div>
                            <a href="index.html"><img src="img/common/logoWhite.png" alt="" class="logoFooter"></a>
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
</body>

</html>
