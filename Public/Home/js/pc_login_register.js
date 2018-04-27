/**
 * 登录注册 处理
 */
$(function () {
    //弹窗
    $(".a_login,._open_login").click(function () {
        $(".login_box,.box_opacity").show();
    })
    $(".a_register,._open_register").click(function () {
        $(".register_box,.box_opacity").show();
    })
    $(".box_close").click(function () {
        $(this).parent(".my_box").hide();
        $(".box_opacity").hide();
    })

    //注册、登录、找回密码 窗口切换
    $("#pc_user_register").click(function () {
        //注册
        $(".login_box").hide();
        $(".register_box").show();
    })
    $("#pc_user_login").click(function () {
        //登录
        $(".login_box").show();
        $(".register_box").hide();
    })
//    $("#pc_password_forget").click(function () {
//        //登录
//        $(".login_box").hide();
//        $(".register_box").hide();
//        $(".find_p_box").show();
//    })

    //微信二维码
    $(".logo_right p").hover(function () {
        $(".logo_right p em").show();
    }, function () {
        $(".logo_right p em").hide();
    })
})


function shoucang(sTitle, sURL) {
    try {
        window.external.addFavorite(sURL, sTitle);
    } catch (e) {
        try
        {
            window.sidebar.addPanel(sTitle, sURL, "");
        } catch (e)
        {
            alert("加入收藏失败，请使用Ctrl+D进行添加");
        }
    }
}

function global_login() {

    var formObj = $('.login_box');
    var username = $.trim($(formObj).find("input[name=username]").val());
    var login_enews = $.trim($(formObj).find("input[name=enews]").val());
    var login_ecmsfrom = $.trim($(formObj).find("input[name=ecmsfrom]").val());
    $(formObj).find('.mobile_error').hide();

    if (username == "") {
        $(formObj).find('.mobile_error').show();
        $(formObj).find('.mobile_error').text("请输入 账号");
        return false;
    }

    var passwd = $.trim($(formObj).find("input[name=password]").val());

    $(formObj).find('.passwd_error').hide();
    if (passwd == "") {
        $(formObj).find('.passwd_error').show();
        $(formObj).find('.passwd_error').text("请输入 密码");
        return false;
    }

    //记住密码(自动登录)
    var remenber_pwd = $.trim($(formObj).find("input[name=remenber_pwd]:checked").val());
    var remenber_flag = 0;
    if (remenber_pwd == '1') {
        remenber_flag = 315360000;
    }

    //提交的url
    var submit_url = $.trim($(formObj).find("input[name=submit_url]").val());

    $.ajax({
        type: "post",
        url: submit_url,
        dateType: "json",
        data: {'username': username, 'password': passwd, 'remenber_flag': remenber_flag,'enews':login_enews,'ecmsfrom':login_ecmsfrom,'lifetime':remenber_flag},
        success: function (data) {
            var data = eval('(' + data + ')');
            if (data.success > 0) {
                alert("登录成功");
                window.location.href = location.href;
            } else {
                $(formObj).find('.passwd_error').show();
                $(formObj).find('.passwd_error').text(data.msg);
            }

        }
    });
}

//注册
function global_register() {
    var formObj = $('.register_box');
    var username = $.trim($(formObj).find("input[name=username]").val());

    // var sfzcard = $(formObj).find('.sfzcard').val();
    // if(sfzcard && sfzcard.toString().length != 18){
    // 	alert('请输入正确的18位身份证号码');
    // 	return false;
    // }

    $(formObj).find('.mobile_error').hide();
    if (username == "") {
        $(formObj).find('.mobile_error').show();
        $(formObj).find('.mobile_error').text("请输入 账号");
        return false;
    } else {
        if (!checkLength(6, 18, username.length) || !checkLetterOrNum(username)) {
            $(formObj).find('.mobile_error').show();
            $(formObj).find('.mobile_error').text("账号为6-18位字母或数字组成");
            return false;
        }

    }

    var passwd = $.trim($(formObj).find("input[name=passwd]").val());

    $(formObj).find('.passwd_error').hide();
    if (passwd == "") {
        $(formObj).find('.passwd_error').show();
        $(formObj).find('.passwd_error').text("请输入 密码");
        return false;
    } else {
        if (!checkLength(6, 15, passwd.length)) {
            $(formObj).find('.passwd_error').show();
            $(formObj).find('.passwd_error').text("密码为6-15位字母或数字组成");
            return false;
        }

    }

    var sure_passwd = $.trim($(formObj).find("input[name=sure_passwd]").val());

    $(formObj).find('.sure_passwd_error').hide();
    if (sure_passwd == "") {
        $(formObj).find('.sure_passwd_error').show();
        $(formObj).find('.sure_passwd_error').text("请确认 密码");
        return false;
    } else {
        if (sure_passwd != passwd) {
            $(formObj).find('.sure_passwd_error').show();
            $(formObj).find('.sure_passwd_error').text("两次密码输入不一致");
            return false;
        }

    }

    var email = $.trim($(formObj).find("input[name=email]").val());

    //提交的url
    var submit_url = $.trim($(formObj).find("input[name=submit_url]").val());

    $.ajax({
        type: "post",
        url: submit_url,
        dateType: "json",
        data: {'username': username, 'password': passwd,'repassword':sure_passwd,'enews':'register','ecmsfrom':'','siteid':1,'email':email},
        success: function (data) {
            var data = eval('(' + data + ')');
            console.log(data);
            if (data.success > 0) {
                alert("注册成功");
                window.location.href = location.href;
            } else {
                $(formObj).find('.email_error').show();
                $(formObj).find('.email_error').text(data.msg);
            }

        }
    });
}

function global_findPwd() {
    var formObj = $('.find_p_box');
    var mobile = $.trim($(formObj).find("input[name=mobile]").val());

    $(formObj).find('.mobile_error').hide();
    if (mobile == "") {
        $(formObj).find('.mobile_error').show();
        $(formObj).find('.mobile_error').text("请输入 手机号码");
        return false;
    } else {

        if (!checkMobile(mobile)) {
            $(formObj).find('.mobile_error').show();
            $(formObj).find('.mobile_error').text("手机号码格式错误");
            return false;
        }
    }

    var mobile_code = $(formObj).find("input[name=mobile_code]").val();
    var mobile_yzm = $.trim($(formObj).find("input[name=mobile_yzm]").val());


    $(formObj).find('.sure_passwd_error').hide();
    if (mobile_code == "") {
        $(formObj).find('.sure_passwd_error').show();
        $(formObj).find('.sure_passwd_error').text("请输入图片验证码");
        return false;
    }
    if (mobile_yzm == "") {
        $(formObj).find('.sure_passwd_error').show();
        $(formObj).find('.sure_passwd_error').text("请输入手机验证码");
        return false;
    }


    var passwd = $.trim($(formObj).find("input[name=passwd]").val());

    $(formObj).find('.sure_passwd_error').hide();
    if (passwd == "") {
        $(formObj).find('.sure_passwd_error').show();
        $(formObj).find('.sure_passwd_error').text("请输入 密码");
        return false;
    } else {
        if (!checkLength(6, 15, passwd.length)) {
            $(formObj).find('.sure_passwd_error').show();
            $(formObj).find('.sure_passwd_error').text("密码为6-15位字母或数字组成");
            return false;
        }

    }

    //提交的url
    var submit_url = $.trim($(formObj).find("input[name=submit_url]").val());

    $.ajax({
        type: "post",
        url: submit_url,
        dateType: "json",
        data: {'mobile': mobile, 'passwd': passwd, 'mobile_yzm': mobile_yzm},
        success: function (data) {

            var data = eval('(' + data + ')');

            if (data.success > 0) {
                alert(data.msg);
                window.location.href = location.href;
            } else {
                $(formObj).find('.sure_passwd_error').show();
                $(formObj).find('.sure_passwd_error').text(data.msg);
            }

        }
    });
}


$(function () {

    //登录
    $("#bt_pc_login").click(function () {
        global_login();
    })


    //常规用户名 或者 手机注册	
    $("#bt_pc_register").click(function () {

        global_register();
    })

    //找回密码	
    $("#find_pwd_pc").click(function () {

        global_findPwd();
    })

})

  