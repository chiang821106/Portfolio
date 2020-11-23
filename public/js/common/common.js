//後台引入header
$("#headerBackPage").load("backstage_header.html");


// TOP平滑捲動
$(function () {
    // 捲動超過200則顯示TOP
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 70) {
            $('.scrollUpBg').addClass("active");
            $('#navBar').css('box-shadow','rgba(0, 0, 0, 0.35) 0px 10px 10px -10px');
        } else {
            $('.scrollUpBg').removeClass("active");
            $('#navBar').css('box-shadow','');
        }
    });

    $(".scrollUpBg").click(function () {
        // 取得待顯示內容的位置
        var target = $($(this).attr("href")).offset().top;

        // 平滑捲動到指定位置
        $("html, body").animate({ scrollTop: target }, 700);

        return false;
    });

    $(".nav-link").click(function () {
        // 取得待顯示內容的位置
        var target = $($(this).attr("href")).offset().top;
        target -= 100;
        // 平滑捲動到指定位置
        $("html, body").animate({ scrollTop: target }, 700);

        return false;
    });
    
    $(".footerAreaA").click(function () {
        // 取得待顯示內容的位置
        var target = $($(this).attr("href")).offset().top;
        target -= 100;
        // 平滑捲動到指定位置
        $("html, body").animate({ scrollTop: target }, 700);

        return false;
    });
});


