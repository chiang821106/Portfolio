<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>帳號維護 - UNIQUE 獨衣無二</title>

    <link rel="icon" href="img/common/logo_ico.ico">


    <link rel="stylesheet" href="css/common/bootstrap.min.css">
    <link rel="stylesheet" href="css/common/common.css">
    <link rel="stylesheet" href="css/user/common.css">

    {{-- <script defer src="js/index/index.js"></script> --}}
    <script defer src="js/common/common.js"></script>
    <script src="js/common/jquery.min.js"></script>
    <script src="js/common/popper.min.js"></script>
    <script src="js/common/bootstrap.min.js"></script>

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
            <li class="nav-item navLink"><a class="nav-link active" href="javascript:void(0)">帳號維護</a></li>
            <li class="nav-item navLink"><a class="nav-link" href="/order{{ Auth::user()->u_id }}">訂單查詢</a></li>
            <li class="nav-item navLink"><a class="nav-link" href="/diysell{{ Auth::user()->u_id }}">作品上架</a></li>
        </ul>

        {{-- 大頭照 --}}
        
        @if(Auth::user()->u_image == "")
            <div class="text-center">
                <a id="fontbtn"href="#" role="button"data-toggle="modal" data-target="#staticBackdropfont">
                    <img src="img/common/user_image.png" class="rounded-circle" width="150px;"height="150px;" alt="">
                </a> 
            </div>
        @else
            <div class="text-center">
                <a id="fontbtn"href="#" role="button"data-toggle="modal" data-target="#staticBackdropfont">
                   <img src="{{asset('member/user/' . Auth::user()->u_image)}}" class="rounded-circle" width="150px;"height="150px;" alt="">
                </a> 
            </div>
        @endif   
    
        {{-- 上傳大頭照 --}}
        <form action="/addimage{{Auth::user()->u_id}}"method="POST"enctype="multipart/form-data">
                @csrf
            <div class="modal fade" id="staticBackdropfont" data-backdrop="static" data-keyboard="false" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel1">請上傳大頭照</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="file" onchange="readURL(this)" name="image" class="form-control-file"
                                    targetID="uploadfont">
                                <img id="uploadfont" src="#" alt="" width="300px" height="200px">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary"name="submit">確定</button>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </form>

        
        <br>
        {{-- 資料修改 --}}
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-8 col-md-12 text-left formTitleBg">
                    <h5 class="formTitle">請填寫需要修改的欄位</h5>
                </div>
            </div>
        </div>

        <form role="form" id="editFormID" class="">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12 formBg">
                        {{ csrf_field() }}
                        {{-- {{ method_field('PUT') }}
                        --}}
                        <input type="hidden" name="id" id="id">
                        <div class="form-group form-inline">
                            <label for="usernameM" class="col-md-4">姓名</label>
                            <input type="text" class="form-control col-md-6" id="usernameM"
                                value="{{ Auth::user()->u_name }}" required>
                        </div>

                        <div class="form-group form-inline ">
                            <label for="useraccountM" class="col-md-4">會員帳號</label>
                            <input type="text" class="form-control col-md-6" id="useraccountM"
                                value="{{ Auth::user()->u_account }}" disabled="disabled">
                        </div>

                        <div class="form-group form-inline ">
                            <label for="now-password" class="col-md-4">目前密碼</label>
                            <input type="password" class="form-control col-md-6" id="now-password" placeholder="不修改免填" value="" required>
                        </div>

                        <div class="form-group form-inline ">
                            <label for="password" class="col-md-4">新會員密碼</label>
                            <input type="password" class="form-control col-md-6" id="password" placeholder="不修改免填" value="" required>
                        </div>

                        <div class="form-group form-inline">
                            <label for="password-confirm" class="col-md-4">再次確認密碼</label>
                            <input type="password" class="form-control col-md-6" id="password-confirm" placeholder="不修改免填" value="" required>
                        </div>


                        <div class="form-group form-inline"id="wrongPsw" style="display:none">
                            <label for="wrongPsw" class="col-md-4"></label>
                            <input type="text" style= "background-color:transparent;border:0" class="form-control col-md-6 text-danger" id="wrongPsw" value="確認密碼輸入不一致" required>
                        </div>

                        


                        <div class="form-group form-inline ">
                            <label for="email" class="col-md-4">電子信箱</label>
                            <input type="email" class="form-control col-md-6" id="email" value="{{ Auth::user()->email }}"
                                required>
                        </div>

                        <div class="form-group form-inline ">
                            <label for="u_address" class="col-md-4">聯絡地址</label>
                            <input type="text" class="form-control col-md-6" id="u_address"
                                value="{{ Auth::user()->u_address }}" required>
                        </div>

                        <div class="form-group form-inline ">
                            <label for="phone" class="col-md-4">手機號碼</label>
                            <input type="text" class="form-control col-md-6" id="phone" value="{{ Auth::user()->u_phone }}"
                                required>
                        </div>

                        <div class="form-group form-inline ">
                            <label for="phone" class="col-md-4"></label>
                            <button type="submit" class="btn btnAgree" id="modifyOkBtn">修改資料</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

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
        function readURL(input) {

            if (input.files && input.files[0]) {
                var uploadfb = input.getAttribute("targetID");
            
                var reader = new FileReader();
            
                reader.onload = function (e) {
            
                    var img = document.getElementById(uploadfb);
            
                    img.setAttribute("src", e.target.result)
            
                }
            
                reader.readAsDataURL(input.files[0]);
            
            }
            
        }




        $(document).ready(function() {



            $('#modifyOkBtn').click(function(e) {
                e.preventDefault();
                var usernameM = document.getElementById('usernameM').value;
                // console.log(usernameM);
                var email = document.getElementById('email').value;
                // console.log(email);
                var u_phone = document.getElementById('phone').value;
                // console.log(u_phone);
                var u_address = document.getElementById('u_address').value;
                // console.log(u_address);
                var password = document.getElementById('password').value;
                var nowpassword = document.getElementById('now-password').value; 
                // console.log(nowpassword);
                var u_id = {{Auth::user()->u_id}};
                // console.log(u_id);
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    }
                });
                if ( password != $("#password-confirm").prop("value")){
                    $('#wrongPsw').css("display", "");
                }else{
                    $.ajax({
                    url: '/update-member' + u_id,
                    method: "post",
                    data: {
                        usernameM,
                        email,
                        u_phone,
                        u_address,
                        password,
                        nowpassword
                    },
                    success: function(data) {            
                            alert(data.success);
                            $('#now-password').val("");
                            $('#password').val("");
                            $('#password-confirm').val("");
                            $('#wrongPsw').css("display", "none");
                            $("#myEditModal").modal('hide');
                            window.location.reload();
                    }
                });
                }
                
            });

        });

    </script>

</body>

</html>
