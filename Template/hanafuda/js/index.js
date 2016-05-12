/**
 * Created by saki on 2016/5/12.
 */
$(document).ready(function () {


    $("img").click(function () {
        var hana_img = $(this);
        var i = hana_img.attr('data-y');//起始Y轴角度
        //最大角度为360
        if (360 / i == 1) {
            i = 0;
        }
        if(i < 180){
            var top = 180;
        }
        if (i >= 180){
            var top = 360;
        }
        var src = hana_img.attr('data-url');//原图路径
        setInterval(function () {
            if (i < top) {
                i++;
                hana_img.css("-webkit-transform", "rotateY(" + i + "deg)");
                hana_img.attr("data-y", i);
            }
            if (i == 90) {
                hana_img.attr("src", "");
            }
            if (i == 270) {
                hana_img.attr("src", src);
            }
        }, 5);
    });


});