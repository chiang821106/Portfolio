<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>訂單管理 - UNIQUE 獨衣無二</title>

    <link rel="icon" href="img/common/logo_ico.ico">

    <link rel="stylesheet" href="css/common/bootstrap.min.css">
    <link rel="stylesheet" href="css/backstage/backstage_order.css">
    <link rel="stylesheet" href="css/backstage/backstage_common.css">

    <script src="js/common/jquery.min.js"></script>
    <script src="js/common/popper.min.js"></script>
    <script src="js/common/bootstrap.min.js"></script>
    <script defer src="js/common/common.js"></script>
    <script defer src="js/backstage/backstage_order.js"></script>
    <script src='//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js'></script>
    <link href='//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css' rel='stylesheet'>
</head>

<body>
    {{-- 頁首 --}}
    <header id="top">
        <nav class="navbar navbar-expand-sm navbar-light fixed-top" id="navBar">

            <!-- Logo -->
            <a class="nav-brand" href="../"><img src="img/common/logoYellow.png" alt="" class="logoNav"></a>
            <!-- 漢堡選單 -->
            <button class="navbar-toggler ml-auto m-2" type="button" data-toggle="collapse" data-target=".navContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse navContent">
                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item navLink ml-auto"><a class="nav-link" href="/backstage_order">訂單管理</a></li>
                    <li class="nav-item navLink ml-auto"><a class="nav-link" href="/backstage_employees">管理者設定</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav ml-auto m-5 navFixed">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        管理員： {{ Auth::user()->u_name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('登出') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>


        </nav>
    </header>
    {{-- 頁中 --}}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center title">
                    <h2>訂單管理</h2>
                </div>
            </div>
        </div>
        <!-- 日期篩選 -->
        <form action="/finddetail"method="POST">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <input type="date" class="inputHeight" id="starttime"name="starttime" min="2020-01-01" max="2050-12-31" required>
                        <span class="fontsize">~</span>
                        <input type="date" class="inputHeight" id="endtime"name="endtime" min="2020-01-01" max="2050-12-31" required>
                        <button class="btn btn-primary buttonAlign" type="submit" id="searchbtn">訂單查詢</button>
                        <hr class="line">
                    </div>
                </div>
            </div>
        </form>
        <!-- 篩選 -->
            <div class="container " id="filterForm">
                <div class="row">
                    <div class="col-12">
                        <span class="fontZero">
                            <select name="target" class="custom-select selectBorder inputHeight " id="selectFilterColumn">
                                <option value="">全部欄位</option>
                                <option value="0">訂單號碼</option>
                                <option value="2">訂購人</option>
                                <option value="6">訂單狀態</option>
                            </select>
                        </span>
                        <!-- 修 -->
                        <input type="text" class="inputHeight inputBorder" placeholder=" 請輸入查詢關鍵字" required id="myFilter">
                        <!-- <button class="btn btn-primary buttonAlign" type="submit" >確認</button> -->
                        <!-- /修 -->
                    </div>
                    <!-- <div class="col-md-3 col-sm-12 filterBtn">
                        <span>訂單排序：</span>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btnColor btn-primary inputHeight buttonAlign sort" onclick="sort(this)"
                                type="button">舊>新</button>
                            <button class="btn btnColor inputHeight buttonAlign sort" onclick="sort(this)"
                                type="button">新>舊</button>
                        </div>
                    </div> -->

                    <!-- <div class="col-md-6 col-sm-12 filterBtn">
                        <span>訂單狀態：</span>
                        <button class="btn btn-default btnColor btn-primary inputHeight buttonAlign filterStatus"
                            type="button" onclick="filterStatus(this)">全部</button>
                        <button class="btn btn-default btnColor inputHeight buttonAlign filterStatus" type="button"
                            onclick="filterStatus(this)">處理中</button>
                        <button class="btn btn-default btnColor inputHeight buttonAlign filterStatus" type="button"
                            onclick="filterStatus(this)">出貨中</button>
                        <button class="btn btn-default btnColor inputHeight buttonAlign filterStatus" type="button"
                            onclick="filterStatus(this)">訂單完成</button>
                    </div> -->

                    <!-- <div class="col-md-4 col-sm-12 filterBtn">
                        <span>每頁筆數：</span>
                        <button class="btn btnColor btn-primary inputHeight buttonAlign page" type="button"
                            onclick="page(this)">10</button>
                        <button class="btn btnColor inputHeight buttonAlign page" type="button"
                            onclick="page(this)">25</button>
                        <button class="btn btnColor inputHeight buttonAlign page" type="button"
                            onclick="page(this)">50</button>
                        <button class="btn btnColor inputHeight buttonAlign page" type="button"
                            onclick="page(this)">100</button>
                    </div> -->

                    <div class="col-12 filterBtn">
                        <span>隱藏欄位：</span>
                        
                        <button class="toggle-vis btn btnColor inputHeight buttonAlign page" type="button"
                            data-column="0">訂單號碼</button>
                        <button class="toggle-vis btn btnColor inputHeight buttonAlign page" type="button"
                            data-column="1">訂單日期</button>
                        <button class="toggle-vis btn btnColor inputHeight buttonAlign page" type="button"
                            data-column="2">訂購人</button>
                        <button class="toggle-vis btn btnColor inputHeight buttonAlign page" type="button"
                            data-column="3">訂購數量</button>
                        <button class="toggle-vis btn btnColor inputHeight buttonAlign page" type="button"
                            data-column="4">訂單金額</button>
                        <button class="toggle-vis btn btnColor inputHeight buttonAlign page" type="button"
                            data-column="5">訂單明細</button>
                        <button class="toggle-vis btn btnColor inputHeight buttonAlign page" type="button"
                            data-column="6">訂單狀態</button>
                        <button class="toggle-vis btn btnColor inputHeight buttonAlign page" type="button"
                            data-column="7">訂單操作</button>

                    </div>
                </div>
            </div>

        <div class="container">
            <div class=" container table-responsive tableStyle">
                <!-- <div class="countData">共<span class="totalData"></span>筆資料</div> -->
                <table class="table table-hover " id="myTable">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col">訂單號碼</th>
                            <th scope="col">訂單日期</th>
                            <th scope="col">訂購人</th>
                            <th scope="col">訂購數量</th>
                            <th scope="col">訂單金額</th>
                            <th scope="col">訂單明細</th>
                            <th scope="col">訂單狀態</th>
                            <th scope="col">訂單操作</th>
                        </tr>
                    </thead>
                    <!-- 修 -->
                    <tbody id="mytbody">
                            @foreach ($employeeList as $emp)
                                <tr class="text-center">
                                    <td>#{{ $emp->o_number }}</td>
                                    <td>{{ $emp->created_at }}</td>
                                    <td>{{ $emp->o_recipient }}</td>
                                    <td>{{ $emp->o_quantity }}件</td>
                                    <td>${{ number_format($emp->o_total, 0) }}</td>


                                    <td>
                                        <a class="btn btn-info text-white"
                                            href="/backstage_order_detail{{ $emp->o_id }}" target="_blank">檢視</a>
                                    </td>

                                    <td class="td1">
                                        <span class="orderStatus">{{ $emp->o_status }}</span>
                                    </td>

                                    <td>
                                        <button data-id="{{ $emp->o_id }}" class="btn btn-success text-white change editbtn">修改</button>
                                    </td>
                                    {{-- <td>3件</td> --}}
                                    {{-- <td>$1,400</td> --}}
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <div class="countPage">

                    </div>
                </div>
            </div>
    </section>

</body>

</html>
