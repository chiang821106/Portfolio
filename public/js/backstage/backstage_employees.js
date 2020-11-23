

//-----------列表全部

$(document).ready(function () {
   

    // 測試列表
    var empolyeeList =
        [
            // { u_id: "111", u_account: "IamBoss", u_name: "陳XX", u_right: "1", u_password: "123" },
            // { u_id: "112", u_account: "Ned", u_name: "梁XX", u_right: "2", u_password: "456" },
            // { u_id: "113", u_account: "Tom", u_name: "許XX", u_right: "2", u_password: "789" },
            // { u_id: "114", u_account: "Sunny", u_name: "張XX", u_right: "2", u_password: "012" },
            // { u_id: "115", u_account: "Kiki", u_name: "林XX", u_right: "2", u_password: "345" }
        ];

    // 生成列表
    function createTable() {
        // 先清除列表
        $('#employeeTable').empty();

        $.each(empolyeeList, function (key, data) {
            // key data為自訂 key值為索引 data為值

            // 編號
            number = key + 1;

            // 各欄位產生
            var td = "", tr = "";
            // 序號
            
                td += '<td>' + number + '</td>';
            

            // 帳號
            
                td += '<td class="td1">' + empolyeeList[key].u_account + '</td>';
           
            // 姓名
           
                td += '<td class="td2">' + empolyeeList[key].u_name + '</td>';
           
            // 權限
            switch (empolyeeList[key].u_right) {

                case "3":
                    td += '<td class="text-center">' + '帳號已停權</td>';
                    break;
                case "1":
                    td += '<td class="text-center">' + empolyeeList[key].u_right + '：全部權限</td>';
                    break;
                case "2":
                    td += '<td class="text-center">' + empolyeeList[key].u_right + '：訂單管理</td>';
                    break;
                default:
                    break;
            }

            // ID
            td += '<input type="hidden" class="inputVal" value="' + empolyeeList[key].u_id + '">';

            // 修改與刪除按鈕
            // 有全部權限者不顯示刪除
            switch (empolyeeList[key].u_right) {
                case "3":
                  td += '<td>' + '<a class="btn btn-info text-white CanelDeleteBtn"onclick="ok()">取消停權</a>' + '</td>';
                  break;
                case "1":
                  td += '<td>' + '<a class="btn btn-success text-white myModifyBtn"onclick="ok()">修改</a>' + '</td>';
                  break;
                case "2":
                  td += '<td>' +'<a class="btn btn-success text-white myModifyBtn">修改</a>' + '<a class="btn btn-danger text-white myDeleteBtn">停權</a>';
                  break;
                default:
                  break;
            } 
           
            tr += '<tr class="text-center">' + td + '</tr>';
            td = "";



            // 抓表單顯示
            $('#employeeTable').append(tr);

            // 顯示共有幾筆資料
            $('#totalData').text(number);
        });

        // 呼叫修改對話框
        $(".myModifyBtn").click(function() {
            $("#myModifyModal").modal();
            $('#wrongPswM').css("display", "none");
            var useraccountM, usernameM, inputVal = "";
    
            // 當再次點擊修改時清空值
            $('#pswM').val("");
            $('#pswCheckM').val("");
    
            // 讓修改對話框帶值
            // 帳號
            useraccountM = $(this).parent().parent().children('td.td1').text();
            $('#useraccountM').val(useraccountM);
            
            // 密碼
            pswM = $(this).parent().parent().children('td.td1').text();
            $('#pswM').val(pswM);

            // 確認密碼
            pswCheckM = $(this).parent().parent().children('td.td1').text();
            $('#pswCheckM').val(pswCheckM);
    
            // 姓名
            usernameM = $(this).parent().parent().children('td.td2').text();
            $('#usernameM').val(usernameM);
    
            // ID
            inputVal = $(this).parent().parent().children('input.inputVal').val();
            $('#inputValM').val(inputVal);
            // console.log(inputVal);
    
            // 如果是BOSS就不可修改權限
            if (useraccountM == "IamBoss") {
                $("#rightM").val('1');
                $("#rightM").parent().css("display", "none");
            } else {
                $("#rightM").parent().css("display", "");
            }

        });

        // -------------停權資料_表單刪除按鈕
        $(".myDeleteBtn").click(function (e) {
        // ID
        var id = $(this).parent().parent().children('input.inputVal').val();
        console.log(id);
        // console.log(inputVal);
        var dataToServer = {
            // ID
            u_id: id
        }
        e.preventDefault();
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           }
       });
        //傳送給後端停權資料------------------------待php
        $.ajax({
            type: "post",
            url: '/grocery/delete/'+id,
            data: dataToServer
        }).then(function () {
            downloadAndUpateTable();
        })

        });
        // -------------取消停權資料_表單刪除按鈕
        $(".CanelDeleteBtn").click(function (e) {
        // ID
        var id = $(this).parent().parent().children('input.inputVal').val();
        console.log(id);
        // console.log(inputVal);
        var dataToServer = {
            // ID
            u_id: id
        }
        e.preventDefault();
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           }
       });
        //傳送給後端取消停權資料------------------------待php
        $.ajax({
            type: "post",
            url: '/grocery/canel/'+id,
            data: dataToServer
        }).then(function () {
            downloadAndUpateTable();
        })

        });

    }

    //先呼叫一次更新畫面
    createTable();

    //向後端抓資料顯示頁面------------------------待php
    //取得最新資料且更新
    function downloadAndUpateTable() {   
        $.get('users', function (dataFromServer) {
            empolyeeList = JSON.parse(dataFromServer); //將取得的字串改為陣列
            createTable();  
        })        
    }

    // 先呼叫一次
    downloadAndUpateTable();

    //呼叫新增對話框
    $("#myAddBtn").click(function () {
        $("#myAddModal").modal();
        $('#wrongPsw').css("display", "none");

        // 先清空各欄位的值
        $('#u_account').val("");
        $('#password').val("");
        $('#password-confirm').val("");
        $('#u_name').val("");
        $('#u_right').val("");
        $('#email').val("");
    });

    // -------------新增 資料_對話框確認按鈕
    jQuery('#myAddOkBtn').click(function(e){

        // 建立要輸入資料庫的值
        var dataToServer = {
            // 帳號
            u_account: $("#u_account").prop("value"),
            // 密碼
            password: $("#password").prop("value"),
            // 姓名
            u_name: $("#u_name").prop("value"),
            // 權限
            u_right: $("#u_right").prop("value"),
            // 管理員(admin)
            role: $("#role").prop("value"),
            // 信箱
            email: $("#email").prop("value"),
        };

        e.preventDefault();
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           }
       });
        // 密碼與確認密碼輸入是否相同
        if (dataToServer.password != $("#password-confirm").prop("value")) {
            $('#wrongPsw').css("display", "");
        } else {
            jQuery.ajax({
                url: '/grocery/post',
                method: 'post',
                data: dataToServer,
                }).then(function () {
                 //呼叫產生畫面
                 downloadAndUpateTable();
     
                 // 隱藏密碼錯誤文字
                 $('#wrongPsw').css("display", "none");
     
                 //關掉對話框
                 $("#myAddModal").modal("hide");
                 alert('新增成功!');
                })
        }
    })

    
    // -------------修改 資料_對話框確認按鈕
    $("#editFormID").on('submit',function (e) {

        // 紀錄要修改的資料
        var dataToServer = {
            // ID
            u_id: $("#inputValM").val(),
            // 密碼
            password: $("#pswM").val(),
            // 姓名
            u_name: $("#usernameM").val(),
            // 權限
            u_right: $("#rightM").val(),
        };
        var id =$('#inputValM').val();
        console.log(id);
        console.log(dataToServer.password);
        console.log($("#pswCheckM").val());
        console.log($("#usernameM").val()); 
        console.log($("#rightM").val());
        

        e.preventDefault();
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           }
       });
        // 密碼與確認密碼輸入是否相同
        if (dataToServer.password != $("#pswCheckM").val()) {
            $('#wrongPswM').css("display", "");
        } else {
            //傳送給後端更新資料------------------------待php
            
            $.ajax({
                type: "post",
                url:'/grocery/update/'+id,
                data:dataToServer,
            }).then(function () {
               //呼叫產生畫面
               downloadAndUpateTable();
               $('#wrongPswM').css("display", "none");
               $("#myModifyModal").modal("hide");
               alert('修改成功!')
            })
        }

        
    });

});


