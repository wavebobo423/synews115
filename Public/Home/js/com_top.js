(function () {
   
    //获取safty 判断是否第3方登入
    var urlSafty = window.location.href;
    var i1 = urlSafty.indexOf("?safety");
    if (i1 > 0) {
        var safety = urlSafty.substring(i1 + 8);
        $.ajax({
            url: "/UserCenter/OtherLogin",
            type: "Get",
            data: "safety=" + safety + "&cache=" + new Date().getMilliseconds(),
            success: function (msg) {
                if (msg = "Refresh") {
                    var url = window.location.href;
                    var i1 = url.indexOf("?");
                    if (i1 > 0) {
                        url = url.substring(0, i1)
                    }
                    location.replace(url);
                }
            }
        });
    }


 


    /* 关闭窗口 */
    $(".close").live('click', function () {
        $(this).parents(".container").hide().prevAll().removeClass("on");
    });

    // 点击注册显示注册框
    $("#goreg").click(function () {
        $("#login-container").hide().prevAll().removeClass("on");
        $("#reg").addClass("on").siblings("#reg-container").show();
    });

    /* 全站导航&用户信息&签到信息 */
    $("#userinfo,#checkin").live('hover', function () {
        $(this).toggleClass("on").children(".container").toggle();
    });
    $("#web-nav").live('click', function () {
        $(this).toggleClass("on").children(".container").toggle();
    });
    /* 登录&注册框&签到信息 */
    $("#login").live('click', function () {
        $(this).toggleClass("on").next(".container").toggle().siblings(".container").hide().prev().removeClass("on");
        $("#userid,#pwd,#answer,#regid,#email,#regpwd").blur(function () {
            this.value = strReplace(this.value);
            if (this.value !== "") {
                $(this).removeClass("warning");
            }
        })
    });
    

    
})();

//顶部导航
$(document).ready(function(){

        $(".top_box_l dl dt").hover(function () {
            $(".top_box_l .tb_box").show();
			$(".top_box_l dl dt").addClass("on")
        }, function () {
            $(".top_box_l .tb_box").hide();
			$(".top_box_l dl dt").removeClass("on")
        });
		
        $("#wx").hover(function () {
            $(".top_box_r .bnt p").show();
			$("#wx").addClass("on");
        }, function () {
            $(".top_box_r .bnt p").hide();
			$("#wx").removeClass("on");
        });
		
});
