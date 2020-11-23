<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訂單明細 - UNIQUE 獨衣無二</title>
    <!-- 待 -->
    <link rel="icon" href="img/common/logo_ico.ico">
    <!-- 待 -->

    <link rel="stylesheet" href="css/common/bootstrap.min.css">
    <link rel="stylesheet" href="css/backstage/backstage_order_detial.css">
    <!-- <link rel="stylesheet" href="css/backstage/backstage_common.css"> -->

    <script src="js/common/jquery.min.js"></script>
    <script src="js/common/popper.min.js"></script>
    <script src="js/common/bootstrap.min.js"></script>

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
    <div class="container">
        <div class="row">
            <div class="col-12 text-center divMargin">
                <h1>訂單明細</h1>
            </div>
        </div>
        <div class="col-12 divMargin">
            <h2  class="fontStyle">訂單資訊</h2>
            <span class="fontSize">    
                <div>訂單明細 : {{$detailList->o_number}}</div>    
                <div>訂單日期 : {{$detailList->created_at}}</div>
            </span>
        </div>
        <div class="col-12 divMargin">
            <h2 class="fontStyle">配送資訊</h2>
            <span class="fontSize">
            <div>收件人   : {{$detailList->o_recipient}}</div>
            <div>聯絡電話 : {{$detailList->o_recipient_phone}}</div>
            <div>收件地址 : {{$detailList->o_recipient_address}}</div>
            {{-- <div>收件地址 : {{$employeeList->first()->o_recipient_address}}</div> --}}
</span>
        </div>
        <div class="col-12 divMargin">
            <h2 class="fontStyle">商品明細</h2>
            <table class="table table-hover fontSize">
                <thead>
                    <tr class="text-center">
                        <th>序號</th>
                        <th>設計圖</th>
                        <th>商品名稱</th>
                        <th>衣服尺寸</th>
                        <th>衣服顏色</th>
                        <th>單價</th>
                        <th class="text-right">數量</th>
                        <th class="text-right">小計</th>
                    </tr>
                </thead>
                <tbody>
                   
                  @foreach ($accounts as $emp)
                  <tr class="text-center">
                       <td class="SortId"></td>                
                       <td ><img src="{{$emp->p_filename_design}}" width="100px"height="120px" alt=""></td>
                       <td>{{$emp->p_name}}</td>
                       <td >{{$emp->od_size}}</td>
                       <td>{{$emp->od_color}}</td>
                       <td>${{$emp->od_price}}</td>
                       <td class="text-right">{{$emp->od_quantity}}</td>
                       <td class="text-right">${{number_format($emp->od_total/0.85,0)}}</td>
                      </tr>
                  @endforeach        
                     

                    
                    <tr>
                        <td colspan="8">訂單備註： {{$detailList->o_note}}</td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="5"></td>
                        <td colspan="2"class="text-right">合計</td>
                        <td colspan="1" class="text-right">${{number_format(($detailList->o_total)/0.85,0)}}</td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="5"></td>
                        <td colspan="2"class="text-right">活動85折</td>
                        <td colspan="1"class="text-right">-${{number_format(($detailList->o_total)/0.85*0.15,0)}}</td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="5"></td>
                        <td colspan="2"class="text-right">訂單金額</td>
                        
                        <td colspan="1"class="text-right">${{number_format($detailList->o_total,0)}}</td>
                    </tr>
                </tbody>
            </table>

        </div> <!-- /.. end row -->


    </div>

</body>

</html>