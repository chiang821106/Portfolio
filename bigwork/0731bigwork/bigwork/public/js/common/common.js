// TOP平滑捲動
$(function () {
// 捲動超過200則顯示TOP
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 200) {
            $('.scrollUpBg').addClass("active");
        } else {
            $('.scrollUpBg').removeClass("active");
        }
    });
    
    $(".scrollUpBg").click(function () {
        // 取得待顯示內容的位置
        var target = $($(this).attr("href")).offset().top;

        // 平滑捲動到指定位置
        $("html, body").animate({ scrollTop: target }, 700);

        return false;
    });
});


