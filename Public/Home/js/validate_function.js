
/**
 * 检查字符串长度
 * @param len_1  最小长度
 * @param len_2  最大长度
 * @param str_len 字符串
 * @returns {Boolean} 符合返回true，否则false
 */
function checkLength(len_1,len_2,str_len){
	len_1=parseInt(len_1);
	len_2=parseInt(len_2);
	str_len=parseInt(str_len);
	
	if(str_len<=len_2 && str_len>=len_1){
		return true;
	}else{
		return false;
	}
	
}

/**
 * 检查手机号码
 * @param mobile
 * @returns {Boolean} 合法返回true,否则false
 */
function checkMobile(mobile){
    var my = false;
    var partten = /^((\(\d{3}\))|(\d{3}\-))?1[0-9]\d{9}$/;
    if (partten.test(mobile))
        my = true;
    if (mobile.length != 11)
        my = false;
    if (!my) {
        return false;
    }
    return true;
}

/**
 * 检查是否 为字母或者数字组成
 * @param s
 * @returns
 */
function checkLetterOrNum(s){
	 var regex=/^[0-9A-Za-z_]{6,18}$/;
	 return regex.exec(s)
	 
}




      //判断注册用户名
      function checkUsernameBlur(input) {
        var username = input.value;
        var re = /^\w{6,18}$/;
        if(re.test(username)){
            return true;
        }else{
            return false;
        } 
      }

      //发送验证码
      var canSendYzm = true;
      function getCode(flag) {
        if (!canSendYzm) {
          return;
        }
        if (flag == 1) { //register
          var formObj = $('.register_box');
        } else if (flag == 2) { //forget
          var formObj = $('.find_p_box');
        }

        var mobile = $.trim($(formObj).find("input[name=mobile]").val());
        var code = $.trim($(formObj).find("input[name=mobile_code]").val());

        $(formObj).find('.mobile_error').hide();
        if (!code) {
          $(formObj).find('.mobile_error').show();
          $(formObj).find('.mobile_error').text("请输入图片验证码!");
          return false;
        }
        if (!checkMobile(mobile)) {
          $(formObj).find('.mobile_error').show();
          $(formObj).find('.mobile_error').text("请输入正确的手机号码!");
          return false;
        }

        if (flag == 1) {
          yzmInterval = setInterval("yzmClock('.register_box .send_yzm', 1)", 1000);
        } else if (flag == 2) {
          yzmInterval = setInterval("yzmClock('.find_p_box .send_yzm', 2)", 1000);
        }
        formObj.find('.send_yzm').text('重新发送验证码(180)').css('color', 'gray');

        $(formObj).find('.sure_passwd_error').hide();

        $.ajax({
          type: "post",
          url: '/pc/user/mobileocde',
          dateType: "json",
          data: { 'mobile': mobile, 'flag': flag, 'mobile_code': code },
          success: function (data) {
            var data = eval('(' + data + ')');
            $(formObj).find('.sure_passwd_error').show();
            $(formObj).find('.sure_passwd_error').text(data.msg);
            // if(data.errorcode > 0){
            // }else{

            // }
          }
        });

      }

      //发送验证码倒计时
      var yzmWait = 180;
      function yzmClock(id, flag) {
        yzmWait--;
        if (yzmWait <= 0) {
          canSendYzm = true;
          yzmWait = 180;
          window.clearInterval(yzmInterval);
          $(id).html('重新发送验证码').css('color', '');
        } else {
          canSendYzm = false;
          $(id).text('重新发送验证码(' + yzmWait + ')').css('color', 'gray');;
        }
      }
