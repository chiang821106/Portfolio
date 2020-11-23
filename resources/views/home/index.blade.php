<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>UNIQUE 獨衣無二</title>

    <link rel="icon" href="img/common/logo_ico.ico">


    <link rel="stylesheet" href="css/common/bootstrap.min.css">
    <link rel="stylesheet" href="css/common/common.css">
    <link rel="stylesheet" href="css/index/index.css">

    <script defer src="js/index/index.js"></script>
    <script defer src="js/common/common.js"></script>
    <script src="js/common/jquery.min.js"></script>
    <script src="js/common/popper.min.js"></script>
    <script src="js/common/bootstrap.min.js"></script>


</head>

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

    <!-- 輪播 -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
        <!-- 輪播指標 -->
        <ol class="carousel-indicators ">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>

        </ol>
        <!-- 輪播項目 -->
        <div class="carousel-inner ">
            <div class="carousel-item active">
                <img src="img/index/bg-3.jpg" alt="First slide" class="carouselImg">
            </div>
            <div class="carousel-item">
                <img src="img/index/bg-2.jpg" alt="Second slide" class="carouselImg">
            </div>

        </div>
        <!-- 輪播前後鍵 -->
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section class="line"></section>

    <!-- 關於我們 -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center title">
                    <h2>關於我們</h2>
                    {{-- <div class="hrLine"></div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-12 test">
                    <video autoplay loop muted id="viedoSize">
                        <source src="img/index/logo.mp4" type="video/mp4">
                    </video>
                </div>
                <div class="col-lg-5  col-12 textBox ">
                    <div class="text-center goodSentence sticky">
                        <p>想要無可取代，<br>就必須與眾不同。</p>
                    </div>
                    <div class="text-center aboutText ">
                        <p class="text-justify">&emsp;&emsp;2020 年夏季，<span style="color:#f1b432">「UNIQUE 獨衣無二」</span>
                            成立了，幾個資策會同學湊在一起，提出想穿著專屬於自己風格的T-shirt，同時提供設計衣服的樂趣。
                            所以我們決定提供這個平台給想體驗設計樂趣或是想找尋各式風格T-shirt的使用者們。</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="parallaxImg imgOne">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-7 col-12 textBoxTwo">
                    </div>
                    <div class="col-lg-5 col-12 textBoxTwo">
                        <div class="text-center goodSentence stickyTwo">
                            <p>一起讓衣服，<br>不只是衣服。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>




    <div class="parallaxImg imgTwo"></div>



    <section class="parallaxSection">
        <div class="container ">
            <div class="row">
                <div class="col-12 text-center parallaxText">
                    <p>UNIQUE</p>
                </div>
            </div>
        </div>
    </section>

    <div class="parallaxImg imgThree">
        <div class="container">
            <div class="row ">
                <div class="col-lg-7 col-12 textBoxTwo">
                </div>
                <div class="col-lg-5 col-12 textBoxTwo">
                    <div class="text-center text-info goodSentence stickyTwo">
                        <p>找不到好T恤?<br>來試試自己做。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="parallaxSection">
        <div class="container ">
            <div class="row">
                <div class="col-12 text-center parallaxText">
                    <p>DESIGN</p>
                </div>
            </div>
        </div>
    </section>

    <div class="parallaxImg imgFour">
        <div class="container">
            <div class="row ">
                <div class="col-lg-7 col-12 textBoxTwo">
                </div>
                <div class="col-lg-5 col-12 textBoxTwo">
                    <div class="text-center text-dark goodSentence stickyTwo">
                        <p>來創造流行吧，<br>展現你的設計作品。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <section class="parallaxSection">
        <div class="container ">
            <div class="row">
                <div class="col-12 text-center ">
                    <a href="/custom" class="btn parallaxBtn parallaxText">TRY&ensp;IT!</a>
                </div>
            </div>
        </div>
    </section>



    <section class="parallaxImg imgFive">
        <div class="container">
            <div class="row ">
                <div class="col-lg-7 col-12 textBoxTwo">
                </div>
                <div class="col-lg-5 col-12 textBoxTwo">
                    <div class="text-center text-white goodSentence stickyTwo">
                        <p>不想設計?<br>那就直接購買吧!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="parallaxSection">
        <div class="container ">
            <div class="row">
                <div class="col-12 text-center ">
                    <a href="/products" class="btn parallaxBtn parallaxText">BUY&ensp;IT!</a>
                </div>
            </div>
        </div>
    </section>


    <section class="line"></section>

    <!-- 熱銷設計 -->
    <section id="hotSales">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center title">
                    <h2>熱銷設計</h2>
                    {{-- <div class="hrLine"></div> --}}
                </div>
                <div class="col-12 text-center title">
                    <p id="time">活動倒數中．．．</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row ">
                <div class="col-lg-4 col-sm-6  cardRight ">
                    <div class="card textAnimationY ">
                        <div class="cardBox ">
                            <img src="img/index/product1.png " alt="" class="card-img-top img-fluid">
                            <img src="img/index/阿嬤從來不會讓我餓.jpg " alt="" class="card-img-top hoverImg img-fluid">
                        </div>
                        <div class="card-body">
                            <p class="card-title text-center">
                                我愛阿嬤
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <p class="card-subtitle text-center">
                                因為阿嬤從來不會讓我餓
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6  cardRight ">
                    <div class="card textAnimationY">
                        <div class="cardBox">
                            <img src="img/index/product2.png " alt="" class="card-img-top img-fluid">
                            <img src="img/index/給爸爸一點信心.jpg " alt="" class="card-img-top hoverImg img-fluid">
                        </div>
                        <div class="card-body">
                            <p class="card-title text-center">
                                我爸超帥
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <p class="card-subtitle text-center">
                                給爸爸一點信心
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6  cardRight ">
                    <div class="card textAnimationY">
                        <div class="cardBox">
                            <img src="img/index/product3.png " alt="" class="card-img-top img-fluid">
                            <img src="img/index/救救北極熊.jpg " alt=""
                                class="card-img-top hoverImg img-fluid">
                        </div>
                        <div class="card-body">
                            <p class="card-title text-center">
                                救救北極熊
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <p class="card-subtitle text-center">
                                隨手創作系列03
                            </p>
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
                            <a href="index.html"><img src="img/common/logoWhite.png" alt="" class="logoFooter"></a>
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

</body>

</html>
