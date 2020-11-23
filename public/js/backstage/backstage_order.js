//-----------訂單操作 

$(document).ready(function () {
    var str = "";
    $(".change").click(function () {
        // 按鈕文字儲存
        var xg = $(this).html();
        // console.log(xg);

        if (xg == '修改') {
            // 按鈕改變
            $(this).html('更新');
            $(this).addClass('btn-danger');
            $(this).removeClass('btn-success');

            // 訂單狀態改變
            $(this).parent().parent().children('td.td1').html(
                '<select name="target" class="custom-select inputHeight orderStatusSelect"><option value="" style="display:none">請選擇</option><option value="處理中">處理中</option><option value="出貨中">出貨中</option><option value="訂單完成">訂單完成</option></select>'
            );
            // $(this).parent().parent().children('td.td2').removeClass('displayNone');


            // 讓選擇後的狀態改變原始狀態
            $(".orderStatusSelect").change(function () {
                str = $(this).children(":selected").text();
                console.log(str);
                $(this).parent().parent().children('td.td1').text(str);

                $(".editbtn").click(function (e) {
                    // 防止事件提交
                    e.preventDefault();

                    var ele = $(this);
                    //    console.log(ele);
                    var o_id = ele.attr("data-id");
                    //    console.log(o_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                    $.ajax({
                        url: '/update-detail' + o_id,
                        method: "post",
                        data: { str },
                        success: function (response) {
                            //    window.location.reload();
                        }
                    });
                });
            })

        } else if (xg == '更新') {
            // 按鈕改變
            $(this).html('修改');
            $(this).addClass('btn-success');
            $(this).removeClass('btn-danger');

            // 訂單狀態改變
            // $(this).parent().parent().children('td.td2').addClass('displayNone');
            $(this).parent().parent().children('td.td1').html('<span class="orderStatus">' + str +'</span>');

        }
    })


    // 使用DataTable
    var table = $('#myTable').DataTable({
        "Filter": false,
        // "StateSave": true,
        "pagingType": "full_numbers",
        "dom": '<<i><"#selectPage"l><t>rp>',
        language: {
            "emptyTable": "無資料...",
            "processing": "處理中...",
            "loadingRecords": "載入中...",
            "lengthMenu": "每頁筆數: _MENU_ ",
            "zeroRecords": "無搜尋結果",
            "info": "共<span id='totalData'> _TOTAL_</span> 筆資料",
            "infoEmpty": "尚無資料",
            "infoFiltered": "(從 _MAX_ 筆資料中過濾)",
            "infoPostFix": "",
            "search": "搜尋字串:",
            "paginate": {
                "first": "首頁",
                "last": "末頁",
                "next": "下一頁",
                "previous": "上一頁"
            },
            "aria": {
                "sortAscending": ": 升冪",
                "sortDescending": ": 降冪"
            }
        },
        "aoColumnDefs": [
            // { "bSearchable": false, "bVisible": true, "aTargets": [ 7 ] },//bSearchable：是否可搜尋；bVisible：是否可見；aTargets：哪一列
        ]

    });


    // 隱藏欄位
    $('.toggle-vis').on('click', function (e) {
        // 防止事件提交
        // e.preventDefault();

        // 點選樣式
        if ($(this).hasClass("btn-primary")) {
            $(this).removeClass("btn-primary");
        } else {
            $(this).addClass("btn-primary");
        }

        // Get the column API object
        var column = table.column($(this).attr('data-column'));

        // Toggle the visibility
            column.visible(!column.visible());


    });



    // 搜索各欄位

    $('#myFilter').on('keyup click', function () {
        // console.log($('#selectFilterColumn').val());
        filterColumn($('#selectFilterColumn').val());
    });


    function filterColumn(i) {
        if (i == "") {
            // 全部欄位時執行
            $('#myTable').DataTable().search(
                $('#myFilter').val(),
            ).draw();
        } else {
            $('#myTable').DataTable().column(i).search(
                $('#myFilter').val(),
            ).draw();
        }
    };

    // $('#searchbtn').click(function(e){
    //     e.preventDefault();
    //     var start = document.getElementById('starttime').value;
    //     var end = document.getElementById('endtime').value;
    //     console.log(start);
    //     console.log(end);
    //     var data =[ start,end ]
    //     console.log(data);

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: '/finddetail',
    //         method: "post",
    //         data: data,
    //         success: function (response) {
    //             // window.location.reload();
    //             //    alert('hi');
    //         }
    //     });

    // })

});

//-----------訂單排序按鈕

// function sort(target) {
//     $.each($(".sort"), function () {
//         $(this).removeClass("btn-primary");
//     });
//     $(target).addClass("btn-primary");
// }

//-----------訂單狀態按鈕
// function filterStatus(target) {
//     $.each($(".filterStatus"), function () {
//         $(this).removeClass("btn-primary");
//     });
//     $(target).addClass("btn-primary");
// }


//-----------每頁筆數按鈕
// function page(target) {
//     $.each($(".page"), function () {
//         $(this).removeClass("btn-primary");
//     });
//     $(target).addClass("btn-primary");
// }