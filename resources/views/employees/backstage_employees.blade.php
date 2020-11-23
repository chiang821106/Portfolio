<!DOCTYPE html>
<html lang="zh">

    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="_token" content="{{csrf_token()}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>管理者設定 - UNIQUE 獨衣無二</title>
    
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="img/common/logo_ico.ico">
    
        <link rel="stylesheet" href="css/common/bootstrap.min.css">
        <link rel="stylesheet" href="css/backstage/backstage_employees.css">
        <link rel="stylesheet" href="css/backstage/backstage_common.css">
    
        
        <script src="js/common/jquery.min.js"></script>
        <script src="js/common/popper.min.js"></script>
        <script src="js/common/bootstrap.min.js"></script>
        <script defer src="js/common/common.js"></script>
        <script  src="js/backstage/backstage_employees.js"></script>

        {{-- 自動序號排序 --}}
    <style type="text/css">
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
        <nav class="navbar navbar-expand-sm navbar-light fixed-top" id="navBar">

            <!-- Logo -->
            <a class="nav-brand" href="../"><img src="img/common/logoYellow.png" alt=""
                class="logoNav"></a>

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
                {{-- <li class="nav-item text-info name">"管理員帳號名" 你好!</li>
                <li class="nav-item "><a class="nav-link" href="#">登出</a></li> --}}
            
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        管理員： {{ Auth::user()->u_name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="{{ route('logout') }}"
                           onclick="event.preventDefault();
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
         <!-- TOP鍵 -->
      <a href="#top" class="scrollUpBg"><img src="img/common/arrow-up.svg" id="scrollUp"></a>
    </header>

    {{-- 頁中 --}}
    <section>

        <div class="container">
            <div class="row">
                <div class="col-12 text-center title">
                    <h2>管理者設定</h2>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary" id="myAddBtn">新增</button>
                </div>
            </div>
        </div>
        
        <script>

        </script>

        <!-- 新增對話盒 -->
        <div class="container">
            <div class="modal fade" id="myAddModal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">
                        <div class="modal-header">
                            <span onclick="addNew()">新增管理者</span>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id="myForm">
                                <div class="form-group form-inline">
                                  <label for="u_name"class="col-3">姓名:</label>
                                  <input type="text" class="form-control col-8" id="u_name">
                                </div>
                                <div class="form-group form-inline">
                                    <label for="u_account"class="col-3">帳號:</label>
                                    <input type="text" class="form-control col-8" id="u_account">
                                  </div>
                                <div class="form-group form-inline">
                                  <label for="password"class="col-3">密碼:</label>
                                  <input type="password" class="form-control col-8" id="password">
                                </div>
                                <div class="form-group form-inline">
                                  <label for="password-confirm"class="col-3">確認密碼:</label>
                                  <input type="password" class="form-control col-8" id="password-confirm">
                                </div>
                                <div class="form-group form-inline">
                                   <label for="email"class="col-3">信箱:</label>
                                   <input type="email" class="form-control col-8" id="email">
                                </div>
                                <div class="form-group"style="display:none">
                                   <label for="role">role:</label>
                                   <input type="text" class="form-control" id="role"value="admin">
                                </div>
                                <div class="form-group form-inline">
                                    <label for="u_right"class="col-3">管理者權限</label>
                                    
                                    <select id="u_right" type="text" class="form-control col-8" name="u_right" value="">
                                      <option value="1"selected>1.全部權限</option>
                                      <option value="2">2.訂單管理</option>
                                    </select>
                                   
                                </div>

                                <div class="form-group form-inline" id="wrongPsw" style="display:none">
                                    <span class="col-3"></span>
                                    <span class="col-8 text-danger">確認密碼輸入不一致</span>
                                </div>
                                
                                <div class="modalBtn">
                                    <button type="submit" class="btn btn-primary" id="myAddOkBtn">確認</button>
                                </div>
                             </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /新增對話盒 -->

        <!-- 修改對話盒 -->
        <div class="container">
            <div class="modal fade" id="myModifyModal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">
                        <div class="modal-header">
                            <span>修改</span>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <form role="form" id="editFormID">
                            <div class="modal-body">
                               {{csrf_field()}}
                               {{-- {{method_field('PUT')}} --}}
                               <input type="hidden"name="id"id="id">
                                 
                                <div class="form-group form-inline ">
                                    <label for="useraccountM" class="col-3">帳號</label>
                                    <input type="text" class="form-control col-8" id="useraccountM" value=""
                                        disabled="disabled">
                                </div>
                                <div class="form-group form-inline ">
                                    <label for="pswM" class="col-3">密碼</label>
                                    <input type="password" class="form-control col-8" id="pswM" value="" >
                                </div>
                                <div class="form-group form-inline ">
                                    <label for="pswCheckM" class="col-3">確認密碼</label>
                                    <input type="password" class="form-control col-8" id="pswCheckM" value="" >
                                </div>
                                <div class="form-group form-inline ">
                                    <label for="usernameM" class="col-3">姓名</label>
                                    <input type="text" class="form-control col-8" id="usernameM" value="" >
                                </div>
                                <div class="form-group form-inline ">
                                    <label for="rightM" class="col-3"> 權限</label>
                                    <select class="form-control col-8" id="rightM" required>
                                        <option value="" style="display:none">請選擇</option>
                                        <option value="1">1：全部權限</option>
                                        <option value="2" selected>2：訂單管理</option>
                                    </select>
                                    <input type="hidden" value="" id="inputValM">
                                </div>
                                <div class="form-group form-inline" id="wrongPswM" style="display:none">
                                    <span class="col-3"></span>
                                    <span class="col-8 text-danger">確認密碼輸入不一致</span>
                                </div>
                                <div class="modalBtn">
                                    <button type="submit" class="btn btn-primary" id="modifyOkBtn">確認</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- /修改對話盒 -->

        <div class="container">
            <div class="container table-responsive tableStyle">
                <div class="col-12">
                    <div class="countData">共<span id="totalData"></span>筆資料</div>
                    <table class="table table-hover ">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col">序號</th>
                                <th scope="col">管理者帳號</th>
                                <th scope="col">管理者姓名</th>
                                <th scope="col">權限</th>
                                <th scope="col">管理操作</th>
                            </tr>
                        </thead>
                        <tbody id="employeeTable">
                            {{-- <tr class="text-center">
                                <td>1</td>
                                <td class="td1">today</td>
                                <td class="td2">XXX</td>
                                <td>1：全部權限</td>
                                <input type="hidden" class="inputVal">
                                <td>
                                    <a class="btn btn-success text-white myModifyBtn">修改</a>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td>2</td>
                                <td class="td1">tonight</td>
                                <td class="td2">XXX</td>
                                <td>2：訂單管理 </td>
                                <td>
                                    <a class="btn btn-success text-white myModifyBtn">修改</a>
                                    <a class="btn btn-danger text-white myDeleteBtn">刪除</a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </section>

    <script>
        function addNew(){
           document.getElementById('u_name').value='訂單小幫手';
           document.getElementById('u_account').value='helper';
           document.getElementById('password').value='helper';
           document.getElementById('password-confirm').value='helper';
           document.getElementById('email').value='helper@gmail.com';
           document.getElementById('u_right').value='2';
    
        }
    </script>

</body>

</html>