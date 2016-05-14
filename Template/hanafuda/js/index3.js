/**
 * Created by saki on 2016/5/12.
 */
$(document).ready(function () {

    $(".hanafuda_pic").click(function () {
        var hana_img = $(this);
        var hanafuda_bak = hana_img.parent().find('.hanafuda_bak');
        var i = hana_img.attr('data-y');//起始Y轴角度
        //最大角度为360
        if (360 / i == 1) {
            i = 0;
        }
        if (i < 180) {
            var top = 180;
        }
        if (i >= 180) {
            var top = 360;
        }
        setInterval(function () {
            if (i < top) {
                i++;
                hana_img.css("-webkit-transform", "rotateY(" + i + "deg)");
                hanafuda_bak.css("-webkit-transform", "rotateY(" + (i + 180) + "deg)");
                hana_img.attr("data-y", i);
            }
            if (i == 90) {
                hanafuda_bak.css("display", "block");
            }
        }, 1);
    });

    $(".hanafuda_bak").click(function () {
        var hanafuda_bak = $(this);
        var hana_img = hanafuda_bak.parent().find('.hanafuda_pic');
        var i = hana_img.attr('data-y');//起始Y轴角度
        //最大角度为360
        if (360 / i == 1) {
            i = 0;
        }
        if (i < 180) {
            var top = 180;
        }
        if (i >= 180) {
            var top = 360;
        }
        setInterval(function () {
            if (i < top) {
                i++;
                hana_img.css("-webkit-transform", "rotateY(" + i + "deg)");
                hanafuda_bak.css("-webkit-transform", "rotateY(" + (i + 180) + "deg)");
                hana_img.attr("data-y", i);
            }
            if (i == 270) {
                hanafuda_bak.css("display", "none");
            }
        }, 1);
    });


});