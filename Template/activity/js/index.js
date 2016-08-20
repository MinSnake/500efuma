$(document).ready(function () {

    var timer_1 = null;
    var timer_2 = null;
    var timer_3 = null;

    //roll点按钮
    $("#roll-btn").click(function () {
        //1秒后开始第一个数字的滚动
        //第一个数字滚动1秒后开始滚动第二个数字
        //第二个数字滚动1秒后开始滚动第三个数字
        setTimeout(function () {
            timer_1 = num_change($("#num_1"), 200);
        }, 500);
        setTimeout(function () {
            timer_1 = burst_link(timer_1, $("#num_1"), 80);
        }, 500);


        setTimeout(function () {
            //每200毫秒数字轮换
            timer_2 = num_change($("#num_2"), 200);
        }, 800);
        setTimeout(function () {
            timer_2 = burst_link(timer_2, $("#num_2"), 80);
        }, 800);


        setTimeout(function () {
            //每200毫秒数字轮换
            timer_3 = num_change($("#num_3"), 200);
        }, 1500);
        setTimeout(function () {
            timer_3 = burst_link(timer_3, $("#num_3"), 80);
        }, 1500);

        //开始发送ajax请求
        //让服务器去计算并且保存roll点数据
        //请求的这段时间就进行滚动加速

        //ajax
        setTimeout(function () {
            get_rand_num();
        }, 3000);

    });


    function get_rand_num()
    {
        var rand_num = 0;
        $.ajax({
            type: 'get',
            url: "roll/roll",
            async: false,
            success: function (data) {
                // console.log(data);
                rand_num = data.num;

                console.log(rand_num);

                clearInterval(timer_1);
                clearInterval(timer_2);
                clearInterval(timer_3);

                var temp_num_1 = 0;
                var temp_num_2 = Math.floor(rand_num / 10);
                var temp_num_3 = rand_num - temp_num_2 * 10;

                if (temp_num_2 == 10)
                {
                    temp_num_2 = 0;
                    temp_num_1 = 1;
                }

                // console.log(temp_num_1);
                // console.log(temp_num_2);
                // console.log(temp_num_3);

                $("#num_1").text(temp_num_1);
                $("#num_2").text(temp_num_2);
                $("#num_3").text(temp_num_3);

                // varstr="abcde";截取ab;str=str.substring(0,2);意思是从第一个字符开始截取两位;

            }
        });
    }

    //固定时间，数字滚动
    function num_change(obj, time) {
        var num = obj.val();
        var timer = setInterval(function () {
            if (num < 9) {
                num++;
            }
            else {
                num = 0;
            }
            obj.text(num);
        }, time);
        return timer;
    }

    //加速数字滚动
    //骚年，想变得更快吗？
    function burst_link(timer, obj, time) {
        clearInterval(timer);
        var timer_temp = num_change(obj, time);
        return timer_temp;
    }

});