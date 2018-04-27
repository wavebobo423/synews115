// JavaScript Document


//Banner顶部焦点图
$(function(){
    var bannerWidth = document.body.clientWidth>1260?1200:980;
    var bannerLength = $('#banner li').length;
    var bennerCurrent = 1;
    var timer = null;
    $('#banner ul').css('left',-bannerWidth).append($('#banner li').clone()).prepend($('#banner li:last-child').clone());

    function rebind(){
        $('#banner .mask_l').click(bannerRight);
        $('#banner .mask_r').click(bannerLeft);
    }
    function unbind(){
        $('#banner .mask_l').unbind();
        $('#banner .mask_r').unbind();
    }
    function bannerLeft(){
        if(bennerCurrent>=bannerLength+1) {
            bennerCurrent = 1;
            $('#banner ul').css('left', -bennerCurrent * bannerWidth);
        }
        bennerCurrent++;
        bannerMove(-bennerCurrent*bannerWidth);
    }
    function bannerRight(){
        if(bennerCurrent<=1) {
            bennerCurrent = bannerLength + 1;
            $('#banner ul').css('left', -bennerCurrent * bannerWidth);
        }
        bennerCurrent--;
        bannerMove(-bennerCurrent*bannerWidth);
    }
    function bannerMove(targetX,finnalX){
        clearTimeout(timer);
        unbind();
        $('#banner ul').animate({left:targetX},function(){
            if(finnalX!=0) $(this).css('left',finnalX);
            rebind();
            timer = setTimeout(bannerLeft,5000);
        })
    }
    rebind();
    timer = setTimeout(bannerLeft,5000);
    function resize(clientWidth){
        clearTimeout(timer);
        if(clientWidth>1260 && bannerWidth==980){
            $('#banner ul').stop(true,true);
            bannerWidth=1200;
            $('#banner ul').css('left', -bannerWidth);
            bennerCurrent=1;
        }else if(clientWidth<=1260 && bannerWidth==1200){
            $('#banner ul').stop(true,true);
            bannerWidth=980;
            $('#banner ul').css('left', -bannerWidth);
            bennerCurrent=1;
        }
        timer = setTimeout(bannerLeft,5000);
    }
});

//返回顶部定位
window.onload = window.onscroll = window.onresize = function () {
    var zk=document.documentElement.clientWidth,
	    zw = (zk-1200)/2,
		top= $('.float_nav');
		if(zk<1300){
		   $(".scrollable").addClass("980");
		   zw = (zk-980)/2;
		   		 }
		var left_w=zw-100;
	    top.css('right', left_w+'px');
	

};

/* 浮动置顶导航 */
        $(document).ready(function () {
			var d=document.getElementById("banner");
			if(d!=null){
            var $navScroll = $("#banner");
            var $fixedNav = $(".head");
            var navTop = $navScroll.offset().top + $navScroll.height();
			var hh=$fixedNav.height();
            $(window).on("scroll", function () {
                var wt = $(this).scrollTop();
                if (wt > navTop) {
					$fixedNav.addClass('head_fixed');
					 $("#main").css("margin-top",hh);
                } else {
					$fixedNav.removeClass('head_fixed');
					$("#main").css("margin-top","0px");
                }
            });
		}
        });
		


//
$(document).ready(function(){
 $(".game_com_list").each(function() {
        var line = $(this).find(".line");
        $(this).find("li").each(function(i) {
            $(this).hover(function() {
                $(this).siblings().removeClass("on");
                $(this).addClass("on");
                line.stop(true, false).animate({
                    "left": $(this).position().left + 0 + 'px'
                },
                500)
            });
        });
    });
});

//游戏视频
$(document).ready(function(){
function bline(obj) {
    obj.each(function () {
        $(this).append("<div class='b_line'></div>");
        var b_line = $(this).find(".b_line");
        b_line.css({
            "position": "absolute",
            "width": "100%",
            "left": "-100%",
            "bottom": 0
        });
        $(this).hover(function () {
            b_line.stop(true, false).animate({
                left: 0
            }, 300)
        }, function () {
            b_line.stop(true, false).animate({
                left: "-100%"
            }, 300)
        });
    });
};
$(function () {

    bline($('.video_a'));
    bline($('.video_b'));
   
});
});
//最后一个下边框
$(document).ready(function(){
     $(".tab_menu_l").each(function(i){
		$(this).find('p:last').css("border","none");
	  });
	  $(".main3_c dl").each(function(i){
		$(this).find('dd:last').css("border","none");
	  });
	  $(".main5_r .bd").each(function(i){
		$(this).find('li:last').css("border","none");
	  });
	  $(".xypc_ul").each(function(i){
		$(this).find('li:last').css("margin-right","0");
	  });
	   $(".game_com_list ul").each(function(i){
		$(this).find('li:last').css("padding-right","0");
	  });
	  $(".game_cd").each(function(i){
		$(this).find('a:eq(9)').css("background","none");
		$(this).find('a:eq(19)').css("background","none");
	  });
	  $(".rank_list").each(function(i){
		$(this).find('dl:last').css("border","none");
	  });
	  
});
//切换	
$(document).ready(function(){
    
	//
   $(".tab_menu_l p").mouseover(function(){
	      $(".tab_menu_l p").removeClass("hover");
			$(".tab_menu_r").css("display","none");
			$(this).addClass("hover");
			var a=$(this).attr('id') + "a";
			$("#" + a).css("display","block");
		});
		
	//开测开服表
     $(".main4_r .hd ul li").mouseover(function(){
	      $(".main4_r .hd ul li").removeClass("cur");
			$(".kckf").css("display","none");
			$(this).addClass("cur");
			var k=$(this).attr('id') + "k";
			$("#" + k).css("display","block");

		});
});


//首页幻灯片
$(function() { (function($) {
        $.fn.Slide = function(options) {
            var defaults = {
                item: "slide-item",
                nav: "slide-nav",
                nowClass: "nownav",
                loading: "slide-loading"
            },
            options = options || {};
            options = $.extend(defaults, options);
            var cont = $(this),
            item = cont.find("." + options.item),
            nav = cont.find("." + options.nav),
            curr = options.nowClass,
            len = item.length,
            width = item.width(),
            html = "",
            index = order = 0,
            timer = null,
            lw = "-" + width + "px",
            rw = width + "px",
            newtimer,
            ld = cont.find("." + options.loading);
            item.each(function(i) {
                $(this).css({
                    left: i === index ? 0 : (i > index ? width + 'px': '-' + width + 'px')
                });
                html += '<a href="javascript:">' + (i + 1) + '</a>';
            });
            $("#slide").hover(function() {
                $('#next').fadeIn();
                $('#prev').fadeIn();
            },
            function() {
                $('#next').fadeOut();
                $('#prev').fadeOut();
            });
            nav.html(html);
            var navitem = nav.find("a");
            navitem.eq(index).addClass(curr);
            function anim(index, dir) {
                loading();
                if (order === len - 1 && dir === 'next') {
                    item.eq(order).stop(true, false).animate({
                        left: lw
                    });
                    item.eq(index).css({
                        left: rw
                    }).stop(true, false).animate({
                        left: 0
                    });
                } else if (order === 0 && dir === 'prev') {
                    item.eq(0).stop(true, false).animate({
                        left: rw
                    });
                    item.eq(index).css({
                        left: lw
                    }).stop(true, false).animate({
                        left: 0
                    });
                } else {
                    item.eq(order).stop(true, false).animate({
                        left: index > order ? lw: rw
                    });
                    item.eq(index).stop(true, false).css({
                        left: index > order ? rw: lw
                    }).animate({
                        left: 0
                    });
                }
                order = index;
                navitem.removeClass(curr).eq(index).addClass(curr);
            }
            function next() {
                index = order >= len - 1 ? 0 : order + 1;
                _stop();
                ld.stop(true, true).animate({
                    "width": 0
                },
                0);
                anim(index, 'next');
                timer = setInterval(next, 5000);
            }
            function prev() {
                index = order <= 0 ? len - 1 : order - 1;
                _stop();
                ld.stop(true, true).animate({
                    "width": 0
                },
                0);
                anim(index, 'prev');
                timer = setInterval(next, 5000);
            }
            function auto() {
                loading();
                timer = setInterval(next, 5000);
            }
            function _stop() {
                clearInterval(timer);
            }
            function loading() {
                ld.css({
                    "height": "0",
                    "height": "5px",
                    "position": "absolute",
                    "left": "0",
                    "bottom": "0",
                    "background": "#ffe825",
                    "z-index": "10"
                });
                ld.animate({
                    "width": "100%"
                },
                5000).animate({
                    "width": 0
                },
                0);
            }
            return this.each(function() {
                auto();
                navitem.hover(function() {
                    _stop();
                    var i = navitem.index(this);
                    if (/nownav/.test($(this).attr('class'))) {
                        return false;
                    }
                    if (newtimer) clearTimeout(newtimer);
                    newtimer = setTimeout(function() {
                        _stop();
                        ld.stop(true, true).animate({
                            "width": 0
                        },
                        0);
                        anim(i, this);
                    },
                    250);
                },
                auto);
                $('#next').on('click', next);
                $('#prev').on('click', prev);
            });
        };
    })(jQuery);
    $("#slide").Slide();
});


//游戏合集

    var $slider = $('.slider ul');
    var $slider_child_l = $('.slider ul li').length;
    var $slider_width = $('.slider ul li').width()+10;
    $slider.width($slider_child_l * $slider_width);

    var slider_count = 0;

    if ($slider_child_l <= 4) {
        $('#btn-right').css({ cursor: 'auto' });
        $('#btn-right').addClass("dasabled");
    }

    $('#btn-right').click(function () {
        if ($slider_child_l <= 4 || slider_count >= $slider_child_l - 4) {
            return false;
        }

        slider_count++;
        $slider.animate({ left: '-=' + $slider_width + 'px' }, 'slow');
        slider_pic();
    });

    $('#btn-left').click(function () {
        if (slider_count <= 0) {
            return false;
        }

        slider_count--;
        $slider.animate({ left: '+=' + $slider_width + 'px' }, 'slow');
        slider_pic();
    });

    function slider_pic() {
        if (slider_count >= $slider_child_l - 4) {
            $('#btn-right').css({ cursor: 'auto' });
            $('#btn-right').addClass("dasabled");
            $('#btn-left').css({ cursor: 'pointer' });
            $('#btn-left').removeClass("dasabled");
        }
        else if (slider_count > 0 && slider_count <= $slider_child_l - 4) {
            $('#btn-right').css({ cursor: 'pointer' });
            $('#btn-right').removeClass("dasabled");
            $('#btn-left').css({ cursor: 'pointer' });
            $('#btn-left').removeClass("dasabled");
        }
        else if (slider_count <= 0 && slider_count <= $slider_child_l - 4) {
            $('#btn-left').css({ cursor: 'auto' });
            $('#btn-left').addClass("dasabled");
            $('#btn-right').css({ cursor: 'pointer' });
            $('#btn-right').removeClass("dasabled");
        }
    }

    $('.slider a').hover(function () {
        if ($(this).find('img:animated').length) return;
        $(this).animate({ marginTop: '0px' }, 200);
        //$(this).find('img').animate({ width: '70px' }, 200);
    }, function () {

        $(this).animate({ marginTop: '0' }, 200);
        //$(this).find('img').animate({ width: '70px' }, 200);
    });

    var t = n = 0, count = $(".content a").size();
    $(function () {
        var play = ".play";
        var playText = ".play .text";
        var playNum = ".play .num a";
        var playConcent = ".play .content a";

        $(playConcent + ":not(:first)").hide();
        $(playText).html($(playConcent + ":first").find("img").attr("alt"));
        $(playNum + ":first").addClass("on");
        $(playText).mouseover(function () { window.open($(playConcent + ":first").attr('href'), "_blank") });
        $(playNum).mouseover(function () {
            var i = $(this).text() - 1;
            n = i;
            if (i >= count) return;
            $(playText).html($(playConcent).eq(i).find("img").attr('alt'));
            $(playText).unbind().click(function () { window.open($(playConcent).eq(i).attr('href'), "_blank") });
            $(playConcent).filter(":visible").hide().parent().children().eq(i).show();
            $(this).removeClass("on").siblings().removeClass("on");
            $(this).removeClass("on2").siblings().removeClass("on2");
            $(this).addClass("on").siblings().addClass("on2");
        });
        t = setInterval("showAuto()", 5000);
        $(playConcent).hover(function () { clearInterval(t) }, function () { t = setInterval("showAuto()", 5000); });
    });
    function showAuto() {
        n = (n >= count - 1) ? 0 : ++n;

        $(".num a").eq(n).trigger('mouseover');
    }
//游戏合集END	

//排行榜
$(document).ready(function(){
	$(".az .rank_list dl:first dt").css("display","none");
	$(".az .rank_list dl:first dd").css("display","block");
	$(".az .rank_list dl").mouseover(function(){
		$(".az .rank_list dl dt").css("display","block");
		$(".az .rank_list dl dd").css("display","none");
		$(this).find("dd").css("display","block");
		$(this).find("dt").css("display","none");
		});
		
		
	$(".ios .rank_list dl:first dt").css("display","none");
	$(".ios .rank_list dl:first dd").css("display","block");
	$(".ios .rank_list dl").mouseover(function(){
		$(".ios .rank_list dl dt").css("display","block");
		$(".ios .rank_list dl dd").css("display","none");
		$(this).find("dd").css("display","block");
		$(this).find("dt").css("display","none");
		});
   
   $(".pc .rank_list dl:first dt").css("display","none");
	$(".pc .rank_list dl:first dd").css("display","block");
	$(".pc .rank_list dl").mouseover(function(){
		$(".pc .rank_list dl dt").css("display","block");
		$(".pc .rank_list dl dd").css("display","none");
		$(this).find("dd").css("display","block");
		$(this).find("dt").css("display","none");
		});
	
	})


//返回顶部

        jQuery(function top(){
                //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
                jQuery(function () {
                    jQuery(window).scroll(function(){
                        if (jQuery(window).scrollTop()>50){
                            jQuery(".float_nav").fadeIn(1000);
                        }
                        else
                        {
                            jQuery(".float_nav").fadeOut(1000);
                        }
                    });
        
                    //当点击跳转链接后，回到页面顶部位置
        
                    jQuery(".go_top").click(function(){
                        jQuery('body,html').animate({scrollTop:0},500);
                        return false;
                    });
                });
            });




//登录输入框
	
$(document).ready(function(){

	$(".yh").bind("focus keydown",function(){
		$(this).removeClass("userName");
		$(this).parent().addClass("cur");
		})
		
	$(".yh").bind("focusout",function(){
		if($(this).val()=="")
		{
		$(this).addClass("userName");
		$(this).parent().removeClass("cur");
		}
		else{
			$(this).removeClass("userName");
		    $(this).parent().addClass("cur");
			}
		})
		
		
	$(".mima").bind("focus",function(){
		$(this).removeClass("password");
		$(".pop_srk").addClass("cur");
		})
		
	$(".mima").bind("focusout",function(){
		if($(this).val()=="")
		{
		$(this).addClass("password");
		$(".pop_srk").removeClass("cur");
		}
		})
})
//登录弹窗
$(document).ready(function(){
	
	$("#dengl,.xp_logins").click(function() {
		$("#fade").css({display: "block", height: $(document).height()});
        $("#popup").css("display", "block");
		})
	$(".pop_close").click(function() {
            $("#fade").css("display", "none");
            $("#popup").css("display", "none");
        });

	
	});
	
	
//友链
$(document).ready(function(){
//scrollPic();//这行是友链的
function scrollPic() {
	var scrollPic = new ScrollPic();
	scrollPic.scrollContId   = "scrollPic"; //内容容器ID
	scrollPic.arrLeftId      = "LeftArr";//左箭头ID
	scrollPic.arrRightId     = "RightArr"; //右箭头ID

	scrollPic.frameWidth     = 1128;//显示框宽度
	scrollPic.pageWidth      = 564; //翻页宽度

	scrollPic.speed          = 10; //移动速度(单位毫秒，越小越快)
	scrollPic.space          = 10; //每次移动像素(单位px，越大越快)
	scrollPic.autoPlay       = false; //自动播放
	scrollPic.autoPlayTime   = 3; //自动播放间隔时间(秒)

	scrollPic.initialize(); //初始化
}

});


 
//滑动导航
 $(document).ready(function(){
  $('#right_nav a').click(function(){
        var d = $(this).attr('data');
        $('html,body').animate({scrollTop:$('#'+d).offset().top-121},500);
    });
    
 });
 
 
 
//  try{if(window.console&&window.console.log){
// console.log("3733专注于创新产品，游戏，资源整合下载以及社交网站。\n");
// console.log("我们在有爱的工作氛围中创造，将理想化的产品理念与现实主义相结合，创造简洁而引人入胜的产品。\n");
// console.log("我们的目标是为用户提供更方便快捷的服务和更舒适的互联网产品体验。")}
// console.log("创新是我们不懈追求，时刻关注3733:%c http://www.3733.com","color:red");
// }catch(e){}


