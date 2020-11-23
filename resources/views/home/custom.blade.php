<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>動手設計 - UNIQUE 獨衣無二</title>
    <!-- ------------------------------------------ -->
    <link rel="icon" href="img/common/logo_ico.ico">
    <link rel="stylesheet" href="css/common/bootstrap.min.css">
    <link rel="stylesheet" href="css/common/common.css">
    <link rel="stylesheet" href="css/custom/common.css">

    <script defer src="js/common/common.js"></script>
    <script src="js/common/jquery.min.js"></script>
    <script src="js/common/popper.min.js"></script>
    <script src="js/common/bootstrap.min.js"></script>
    <!-- ---------------------------------------------------------- -->
    {{--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    --}}
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script> -->
    {{-- <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script> --}}
    <script src="js/fabric.min.js"></script>
    <script src="js/jscolor.js"></script>


    <style>
        /* 原樣式 */
        canvas {
            border: 1px solid black;
        }

        #fcolor [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        /* #fcolor [type=radio]+img {
            margin-left: 5px;
            cursor: pointer;
        } */

        /* CHECKED STYLES */
        #fcolor [type=radio]:checked+img {
            border: 1px gray solid;
            padding: 2px;
        }

        #fcolor {
            /* background-color: #F5F5F5; */
            vertical-align: middle;
        }

        #imgfb {
            margin: 20px auto 0px;
            /* border: 1px solid black; */
        }

        #imgfbhidden {
            position: absolute;
            /* border: 1px solid black; */
            visibility: hidden;
        }

        #font,
        #back {
            position: static;
            opacity: 1;
            width: 20px;
            height: 20px;
            font-size: 80px;
            text-align: top;
        }

        /* tr{
            border: 1px solid black;
        } */
        /* tr td:nth-of-type(1){
            border-right:1px solid black;
        } */
        table {
            border-collapse: collapse;
            font-weight: bold;
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
    <div id="diyBox">
        <div id="diy" class="container">
            <div class="row">
                <div class="col-lg-6 col-12  text-center">
                    <div id="diyImg">
                        <div id="d1" style="position:absolute;"><canvas id="clothes"></canvas></div>
                        <div id="d2" style="position:absolute;display: none;"><canvas id="clotheshidden"></canvas></div>
                        <img src="images/clothes/common/0_490x530_08.png" alt="" id="imgfb" width="400px"
                            height="500px">
                        <img src="images/icon/A14-1.jpg" alt="" id="imgfbhidden" width="400px" height="500px">
                    </div>
                    <div class="">
                        <div class="color">文字顏色: <input onchange="textchange(this.value)" value="rgba(0,0,0,1)"
                            data-jscolor="">
                    </div>
                        <button class="btn btnStyle" id="undoBtn"><img src="images/icon/previous.png" alt=""
                                width="50px" height="50px"></button>
                        <button class="btn btnStyle" id="redoBtn"><img src="images/icon/next.png" alt="" width="50px"
                                height="50px"></button>
                        <a class="btn btnStyle" id="clearupload" href="#" onclick="clearmycanvas()"><img
                                src="images/icon/delete.png" alt="" width="50px" height="50px"></a>
                        <!-- <button id="saveBtn">save</button>
                    <button id="loadBtn">load</button> -->
                        <!-- <textarea name="" id="textarea" cols="30" rows="10">123</textarea>
                    <br> -->
                        <button class="btn btnStyle" id="itxtBtn"><img src="images/icon/text.png" alt="" width="50px"
                                height="50px"></button>
                        {{-- <button id="color" class="btn btnStyle"
                            onchange="textchange(this.value)" value="rgba(0,0,0,1)"
                            data-jscolor="{value:'#F1B432'}"></button> --}}
                        <a class="btn btnStyle" id="setbackwards" href="#" onclick="sendtoback()"><img
                                src="images/icon/backward.svg" alt="" width="50px" height="50px"></a>
                        <a class="btn btnStyle" id="bdownload" href="#" download="dsphoto.png"
                            onclick="downphoto()"><img src="images/icon/download.png" alt="" width="50px"
                                height="50px"></a>
                        <a class="sr-only" id="adownload" href="#">下載圖</a>
                        <!-- <a class="btn btn-primary" id="abgdownload" href="#" download="bgphoto.png"
                    onclick="downphoto(this)">下載圖片(含背景)</a> -->


                    </div>


                </div>


                <div class="col-lg-6 col-12 d-flex justify-content-center">
                    <!-- <fieldset style="text-align: center;vertical-align: middle;margin-top: 50px;">
                    <legend>自己動手設計</legend> -->
                    <section id="tab1" class="text-center">
                        <h2>動手設計</h2>
                        <table style="min-height: 500px;width: 450px;" class="text-center">
                            <tbody>
                            <tr class="trBorder">
                                <td ><img src="images/icon/upload.png" alt=""
                                        width="80px" height="80px"></td>
                                <td class="tdBg">
                                    <label><input type="radio" name="fbclothes" id="font" value="font"
                                            style="vertical-align:bottom;" checked>
                                        設計衣服前面</label>

                                    <label><input type="radio" name="fbclothes" id="back" value="back"
                                            style="vertical-align:bottom;">
                                        設計衣服背面</label>
                                    <div>
                                        <a id="fontbtn" class="btn btn-outline-success" href="#" role="button"
                                            data-toggle="modal" data-target="#staticBackdropfont">上傳正面圖片
                                        </a>
                                        <a id="backbtn" class="btn btn-outline-success invisible" href="#" role="button"
                                            data-toggle="modal" data-target="#staticBackdropback">上傳背面圖片
                                        </a>
                                        {{-- <div class="text-danger text-sm">
                                            <p>T-shirt:印雙面+NT$ 500/件</p>
                                        </div> --}}
                                    </div>
                                </td>
                            </tr>
                            <tr class="trBorder">
                                <td ><img src="images/icon/clothes1.png" alt=""
                                        width="80px" height="80px"></td>
                                <td class="tdBg">
                                    <p>請選擇版型</p>
                                    <label><input type="radio" id="common" value="common" name="modeling"
                                            checked style="vertical-align:bottom;"> 大眾版</label>
                                    <label><input type="radio" id="children" value="children"
                                            name="modeling" style="vertical-align:bottom;"> 兒童版</label>
                                    <label><input type="radio" id="woman" value="woman" name="modeling" style="vertical-align:bottom;"> 女版</label>
                                </td>

                            </tr>
                            <tr class="trBorder">
                                <td ><img src="images/icon/drawing.png" alt=""
                                        width="80px" height="80px"></td>
                                <td name="fcolor" id="fcolor" class="tdBg">
                                </td>
                            </tr>
                            {{-- <tr >
                                <td colspan="2"  ><button class="btn btnMainStyle btn-block btn-lg" type="submit"
                                        onclick="preview()">預覽作品</button></td>
                            </tr> --}}
                        </tbody>
                        </table>
                        <button class="btn btnMainStyle btn-block btn-lg" type="submit"
                                        onclick="preview()">預覽作品</button>
                    </section>
                    <!-- 隱藏表開始 -->
                    <section style="display:none;" id="tab2" class="text-center">
                        <h2>作品上傳</h2>
                        <table style="min-height: 500px;width: 450px;" >
                            <tr class="trBorder">
                                <td>
                                    <p alt="" width="80px" height="80px">是否公開</p>
                                </td>
                                <td>
                                    <label>
                                        <input type="radio" name="privacy" id="public" value="open" style="vertical-align:bottom;width: 20px;
            height: 20px;margin-left: 10px;" checked>
                                        公開
                                    </label>

                                    <label>
                                        <input type="radio" name="privacy" id="private" value="close" style="vertical-align:bottom;width: 20px;
            height: 20px;margin-left: 10px;">
                                        不公開
                                    </label>
                                    <div>
                                        <p class="small font-weight-bold">公開作品可以公開販售T恤</br>請填寫作品名稱及創作理念作品</p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="trBorder">
                                <td>
                                    <p alt="" width="80px" height="80px">作品名稱</p>
                                </td>
                                <td>
                                    <input id="usersubject" type="text" class="form-control" required>
                                </td>

                            </tr>
                            <tr class="trBorder">
                                <td>
                                    <p alt="" width="80px" height="80px">作品描述</p>
                                </td>
                                <td><textarea id="usercontent" cols="40" rows="5" style="resize:none" class="form-control" required></textarea>
                                </td>
                            </tr>

                        </table>
                        <button style="width:calc((100% - 1px) / 2 - 5px);" class="btn btn-secondary"
                                        type="button" onclick="cancel()">取消上傳</button>

                        <button style="width:calc((100% - 1px) / 2 - 5px);" class="btn btnMainStyle"
                                        type="submit" onclick="ajaxok()">確定上傳</button>
                    </section>
                    <!-- 隱藏表結束 -->
                </div>


            </div>
        </div>

        <!-- 上傳正面圖片對話框 -->
        <div class="modal fade" id="staticBackdropfont" data-backdrop="static" data-keyboard="false" role="dialog"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel1">請上傳正面圖片</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <form method="post" enctype="multipart/form-data"
                                action="http://localhost/php/bigwork/receivefont.php"> -->
                        <div class="form-group">
                            <input type="file" onchange="readURL(this)" name="file" class="form-control-file"
                                targetID="uploadfont">
                            <img id="uploadfont" src="#" alt="" width="300px" height="200px">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary" onclick="btnok('F')">確定</button>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
        <!-- 上傳背面圖片對話框 -->

        <div class="modal fade" id="staticBackdropback" data-backdrop="static" data-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel2">請上傳背面圖片</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- <form method="post" enctype="multipart/form-data"
                                action="http://localhost/php/bigwork/receivefont.php"> -->

                        <div class="form-group">
                            <input type="file" onchange="readURL(this)" name="file" class="form-control-file"
                                targetID="uploadback">
                            <img id="uploadback" src="#" alt="" width="300px" height="200px">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" onclick="btnok('B')">確定</button>
                    </div>

                    <!-- </form> -->
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
        fabric.Object.prototype.borderColor="red";
        fabric.Object.prototype.cornerColor="red";//控制點填滿色
        fabric.Object.prototype.cornerSize=10;//控制點大小
        fabric.Object.prototype.cornerStrokeColor="red";//控制點邊框顏色




        var position = $('#imgfb').offset();
        var x = position.left;
        var y = position.top;
        var form = document.getElementById('fcolor');
        var colorchildren = [00, 02, 03, 04, 07, 08, 99];
        var colorcommon = [00, 01, 02, 03, 04, 06, 07, 08, 11, 12, 13, 99];
        var colorwoman = [00, 01, 02, 03, 04, 07, 08, 11, 99];
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
        // }
        var mycanvas = new fabric.Canvas('clothes', {
            width: 183,
            height: 300,
            // left: abc.width/4,
            // top: abc.height/4,

        })
        // d1.style.top = y + 100 + 'px';
        // d1.style.left = x + 110 + 'px';
        // d2.style.top = y + 'px';
        // d2.style.left = x + 400 + 'px';
        // imgfbhidden.style.top = y + 'px';
        // imgfbhidden.style.left = x + 'px';
        // const rect = new fabric.Rect({
        //     width: 50,
        //     height: 50,
        //     top: 0,
        //     left: 0
        // })
        // mycanvas.add(rect);

        // var clothescolor = "images/clothes/common/0_490x530_99.png";

        // function inpo(intophoto) {
        //     fabric.Image.fromURL(intophoto, (img) => {
        //         const oImg = img.set({
        //             left: 0,
        //             top: 0
        //         })
        //         img.scaleToHeight(mycanvas.height / 10);
        //         img.scaleToWidth(mycanvas.width / 10);
        //         mycanvas.setBackgroundImage(oImg).renderAll()
        //         // adownload.href = mycanvas.toDataURL("image/png")
        //     })
        // }
        // inpo(clothescolor);
        function textchange(x) {
            var myitext = mycanvas.getActiveObject();
            if (myitext && myitext.text) {
                undo.push(state)
                myitext.setColor(x);
                mycanvas.renderAll();
                state = JSON.stringify(mycanvas)
            } else (
                alert("請選擇文字")
            )
        }
        function sendtoback() {
            var myObject = mycanvas.getActiveObject();
            mycanvas.sendToBack(myObject);
            mycanvas.discardActiveObject();
            mycanvas.renderAll();
        }
        function clearmycanvas() {
            undo.push(state)
            mycanvas.clear()
            state = JSON.stringify(mycanvas)
            mycanvas.renderAll()
        }

        // var aaaa = "images/clothes/common/0_490x530_13_b.png";
        // imgel(aaaa)
        // var aaaa1 = "images/clothes/common/0_490x530_04_b.png";
        // imgel(aaaa1)
        function imgel(imgsrc) {
            const imgEl = document.createElement('img')
            imgEl.src = imgsrc;
            imgEl.onload = () => {
                const image = new fabric.Image(imgEl, {
                    scaleX: mycanvas.width / imgEl.width, // 大小設置為原來的 0.1
                    scaleY: mycanvas.height / imgEl.height, // 大小設置為原來的 0.1            
                    top: 0,
                    left: 0
                })
                mycanvas.add(image)
                undo.push(state)
                state = JSON.stringify(mycanvas)

            }
        }

        function itxt() {
            const iText = new fabric.IText('雙擊我編輯', {
                fontSize: 35,
                top: mycanvas.height - mycanvas.height / 4,
                left: 0
            })
            mycanvas.add(iText);
            undo.push(state)
            state = JSON.stringify(mycanvas)
        }
        const undo = []
        const redo = []
        let state = mycanvas.toJSON()

        mycanvas.on('object:modified', e => {
            undo.push(state)
            state = JSON.stringify(mycanvas)
            redo.length = 0
        })

        function doUndo() {
            if (!undo.length) {
                alert('目前沒有動作可復原')
                return
            }
            let lastJSON = undo.pop()
            mycanvas.loadFromJSON(lastJSON)
            redo.push(state)
            state = lastJSON
        }

        function doRedo() {
            if (!redo.length) {
                alert('目前沒有動作可復原')
                return
            }
            let lastJSON = redo.pop()
            mycanvas.loadFromJSON(lastJSON)
            // 在做下一步時把目前狀態 push 到 undo 陣列
            undo.push(state)
            state = lastJSON
        }

        // var bgimg = '"backgroundImage":{"type":"image","version":"3.6.3","originX":"left","originY":"top","left":0,"top":0,"width":600,"height":650,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":0,"strokeDashArray":null,"strokeLineCap":"butt","strokeDashOffset":0,"strokeLineJoin":"miter","strokeMiterLimit":4,"scaleX":0.66,"scaleY":0.77,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","paintFirst":"fill","globalCompositeOperation":"source-over","transformMatrix":null,"skewX":0,"skewY":0,"crossOrigin":"","cropX":0,"cropY":0,"src":"http://127.0.0.1:5500/0729_2bigwork/bigwork/images/clothes/common/grayb.png","filters":[]}}';
        // var objectimg = '{"version":"3.6.3","objects":[{"type":"image","version":"3.6.3","originX":"left","originY":"top","left":100,"top":100,"width"';
        // var savejson2 = "";

        function savecanvas() {

            // var json = JSON.stringify(outerObjs);
            saveJSON = JSON.stringify(mycanvas)
            // var rebgimage = /"backgroundImage":{[\s\S]*}/;
            // var reobject = /{"version":"3.6.3","objects":\[{"type":"image","version":"3.6.3","originX":"left","originY":"top","left":[0-9]{1,2},"top":[0-9]{1,2},"width"/;
            // var savejson1 = saveJSON.replace(reobject, objectimg)
            // savejson2 = savejson1.replace(rebgimage, bgimg)
            alert('save canvas!')
            textarea.innerHTML = saveJSON
        }
        function loadcanvas() {
            alert('load canvas!')
            textarea.innerHTML = ''
            canvashidden.loadFromJSON(saveJSON)
        }


        var canvashidden = new fabric.Canvas('clotheshidden', {
            height: imgfb.height,
            width: imgfb.width,
            isDrawingMode: true,
            hoverCursor: 'progress',
            freeDrawingCursor: 'all-scroll',
        })
        // downphoto()
        function downphoto() {
            // if (dp.id == "adownload") {
            mycanvas.discardActiveObject()
            mycanvas.renderAll();
            const imghidden = document.createElement('img')
            imghidden.src = imgfb.src;

            (() => {
                const image = new fabric.Image(imghidden, {
                    scaleX: canvashidden.width / imghidden.width,
                    scaleY: canvashidden.height / imghidden.height,
                    top: 0,
                    left: 0
                })
                // canvashidden.add()

                const imageContainer = new fabric.Image(mycanvas.lowerCanvasEl, {
                    scaleX: 183 / mycanvas.lowerCanvasEl.width,
                    scaleY: 300 / mycanvas.lowerCanvasEl.height,
                    top: 100,
                    left: 110
                });
                // canvashidden.add(image);
                canvashidden.add(image, imageContainer);
                canvashidden.renderAll();
                //     var items = canvashidden.getObjects();
                // items[0].id = "items_id"
                // console.log(items[0]);


                //             for (var prop in imageContainer) {
                //   console.log(prop + ':' + imageContainer[prop]);
                // }
            })()
            // 只按一次下載會失敗
            bdownload.href = canvashidden.toDataURL();
            adownload.href = mycanvas.toDataURL();
            // console.log(bdownload.href)


            // 或  items[0].set("id", "items_id0")


            // var json = JSON.stringify(outerObjs);
            // saveJSON = JSON.stringify(mycanvas)
            // var rebgimage = /"backgroundImage":{[\s\S]*}/;
            // var reobject = /{"version":"3.6.3","objects":\[{"type":"image","version":"3.6.3","originX":"left","originY":"top","left":[0-9]{1,2},"top":[0-9]{1,2},"width"/;
            // var savejson1 = saveJSON.replace(reobject, objectimg)
            // savejson2 = savejson1.replace(rebgimage, bgimg)
            // // alert('save canvas!')
            // textarea.innerHTML = savejson2



            //         let abccanvas = mycanvas;
            //         console.log(abccanvas.backgroundImage);
            //     abccanvas.backgroundImage = 0;
            //     console.log(abccanvas.backgroundImage);

            //     adownload.href = abccanvas.toDataURL("image/png");
            //     // inpo(clothescolor);
            //     }else if(dp.id=="abgdownload"){

        }
        function ajaxok() {
            downphoto();
            var user  = {{Auth::user()->u_id}};
            var base64font = adownload.href;
            var base64back = bdownload.href;
            var priva = document.getElementsByName("privacy");
            var uploadprivacy, uploadsubject, uploadcontent;
            uploadprivacy = priva[0].checked ? "public" : "private";
            uploadsubject = usersubject.value ? usersubject.value : usersubject.placeholder;
            uploadcontent = usercontent.value;
            console.log(user,uploadprivacy, uploadsubject, uploadcontent);
            //这里对base64串进行操作，去掉url头，并转换为byte
            // var bytes = window.atob(base64String.split(',')[1]);
            // console.log(bytes);
            // var array = [];
            // for (var i = 0; i < bytes.length; i++) {
            //     array.push(bytes.charCodeAt(i));
            // }
            // var blob = new Blob([new Uint8Array(array)], { type: 'image/jpeg' });
            
            var fd = new FormData();
            // fd.append('file', blob, Date.now() + '.jpg');
            fd.append('user',user);
            fd.append('filefont', base64font);
            fd.append('fileback', base64back);
            fd.append('privacy', uploadprivacy);
            fd.append('subject', uploadsubject);
            fd.append('content', uploadcontent);
            // console.log(fd)
            // var bb = "123";
            // var fd = new FormData();
            //     fd. append('aa',bb);

            $.ajaxSetup({
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
             });

            $.ajax({
                url: '/saveimg{{Auth::user()->u_id}}',
                cache: false,
                contentType: false,
                processData: false,
                data: fd,
                //data只能指定單一物件                 
                type: 'POST',
                success: function (data) {
                    console.log(data);
                    var Today = new Date();
                    mycanvas.clear();
                    canvashidden.clear();
                    priva[0].checked = true;
                    priva[1].checked = false;
                    // imgfbhidden.style.visibility = "hidden"; 
                    usersubject.value = "";
                    // usersubject.placeholder = "作者" + Today.getFullYear() + (Today.getMonth() + 1 < 10 ? "0" : "") + (Today.getMonth() + 1) + (Today.getDate() < 10 ? "0" : "") + Today.getDate() + Today.getHours() + Today.getMinutes() + Today.getSeconds();
                    usercontent.value = "";
                    tab2.style.display = "none";
                    alert('完成作品!');
                    window.location.reload(true);


                    // alert(data);
                }
          });

        }



        //             $("#adownload").click(function(){ 
        //                 downphoto()
        //     var win=window.open(); 
        //     win.document.write("<img src='"+canvashidden.toDataURL()+"'/>"); 
        // }); 
        // }

        // canvashidden.clear();
        // const imghidden = document.createElement('img')
        // imghidden.src = imgfb.src;
        // imghidden.onload = () => {
        //     const image = new fabric.Image(imghidden, {
        //         scaleX: canvashidden.width / imghidden.width,
        //         scaleY: canvashidden.height / imghidden.height,
        //         top: 0,
        //         left: 0
        //     })
        //     canvashidden.add(image)
        // }
        // var imgInstance = new fabric.Image(mycanvas, {
        //     left: 100,
        //     top: 100,
        //     width: 183,
        //     height: 220,
        // clipTo: function (ctx) {
        //     ctx.rect( / 2 - sx, dheight / 2 - sy, swidth, sheight);
        // }
        // });
        // canvashidden.add(imgInstance);

        // canvashidden.drawImage(mycanvas, 0, 0, 183, 220, 0, 0, 183, 220);



        //   var mycanvashidden = document.getElementById('clotheshidden');

        //   var ctxhidden = mycanvashidden.getContext('2d');

        //   ctxhidden.setBackgroundImage(imgfb,
        //             () => canvas.renderAll())




        // }


        // }
        var fbclothes = "", modeling = "common", fbcolor = "08";
        function colorChange(y) {
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
        function clothesch(x) {
            canvashidden.clear()
            if (x.name == "fbclothes") {
                if (x.value == "font") {
                    fbclothes = "";
                    fontbtn.classList.remove("invisible");
                    let y = backbtn.classList.contains("invisible")
                    if (!y) {
                        backbtn.classList.add("invisible")
                    }
                } else {
                    fbclothes = "_b";
                    backbtn.classList.remove("invisible");
                    let y = fontbtn.classList.contains("invisible")
                    if (!y) {
                        fontbtn.classList.add("invisible")
                    }
                }
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


            } else if (x.name == 'fbcolor') {
                fbcolor = x.value;
            }
            imgfb.src = "images/clothes/" + modeling + "/0_490x530_" + fbcolor + fbclothes + ".png";
            // downphoto()
        }
        // if (x.vlaue == "font") {
        //     imgfb.src = "/images/clothes/common/grayf.png";
        //     fontbtn.classList.remove("invisible");
        //     let x = backbtn.classList.contains("invisible")
        //     if (!x) {
        //         backbtn.classList.add("invisible")
        //     }
        // } else {
        //     imgfb.src = "/images/clothes/common/grayb.png";
        //     backbtn.classList.remove("invisible");
        //     let y = fontbtn.classList.contains("invisible")
        //     if (!y) {
        //         fontbtn.classList.add("invisible")
        //     }
        // }



        font.addEventListener('click', function () { clothesch(this) })
        back.addEventListener('click', function () { clothesch(this) })
        common.addEventListener('click', function () { clothesch(this) })
        children.addEventListener('click', function () { clothesch(this) })
        woman.addEventListener('click', function () { clothesch(this) })
        undoBtn.addEventListener('click', doUndo)
        redoBtn.addEventListener('click', doRedo)
        itxtBtn.addEventListener('click', itxt)
        // saveBtn.addEventListener('click', savecanvas)
        // loadBtn.addEventListener('click', loadcanvas)
        // btnok.addEventListener('click', btnok)


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
        function btnok(i) {
            if (i == "F") {
                let x = uploadfont.src;
                imgel(x);
                $("#staticBackdropfont").modal("hide");
                $('.modal-backdrop').remove();


            } else {
                let x = uploadback.src;
                imgel(x);
                $("#staticBackdropback").modal("hide");
                $('.modal-backdrop').remove();



            }
            $('.modal-backdrop').remove();
            // $(document.body).removeClass("modal-open");
            // $('.modal.in').modal('hide')



        }
        // function uploadphoto(){
        //     $.ajax({
        //         type:"post",
        //         url:"testphoto.php",

        //     })
        // }
        function preview() {
            downphoto();
            var Today = new Date();
            // imgfb.src = bdownload.href
            // console.log(bdownload.href);
            // d1.style.display="none";
            imgfbhidden.src = bdownload.href;
            imgfbhidden.style.zIndex = "1";
            imgfbhidden.style.visibility = "visible";
            // usersubject.placeholder = "作者" + Today.getFullYear() + (Today.getMonth() + 1 < 10 ? "0" : "") + (Today.getMonth() + 1) + (Today.getDate() < 10 ? "0" : "") + Today.getDate() + Today.getHours() + Today.getMinutes() + Today.getSeconds();
            tab1.style.display = "none";
            tab2.style.display = "";
        }
        function cancel() {
            imgfbhidden.style.visibility = "hidden";
            tab2.style.display = "none";
            tab1.style.display = "";
        }
        var priva = document.getElementsByName("privacy");
        function aaaa() {
            var uploadprivacy, uploadsubject, uploadcontent;
            uploadprivacy = priva[0].checked ? "public" : "private";
            uploadsubject = usersubject.value;
            uploadcontent = usercontent.value;
            console.log(uploadprivacy, uploadsubject, uploadcontent);
            imgfbhidden.style.visibility = "hidden";
            console.log(imgfbhidden);
            priva[0].checked = true;
            priva[1].checked = false;
            uploadsubject = usersubject.value ? usersubject.value : usersubject.placeholder;
            console.log(uploadsubject);
            console.log(Today);
        }

        

       
    </script>

</body>

</html>
