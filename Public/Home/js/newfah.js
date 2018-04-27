// JavaScript Document

$(function(){
	var d=document.getElementById("say");
    if(d!=null){
	$('#say').qqFace({
		id : 'facebox', 
		assign:'saytext', 
		path:'http://re1.xiaopi.com:8118/pjt/xiaopi/fahao/arclist/'	//表情存放的路径
	});
}
});


$(document).ready(function ($) {
	var slider=document.getElementById("slider");
	if(slider!=null){
		$('#slider').nivoSlider({
			effect:'random',
			slices:15,
			animSpeed:500,
			pauseTime:3000,
			directionNav:true,
			controlNav:true,
			keyboardNav:true
		});
	}
	

$(".maxx-theme").hover(
	  function () {
		$(this).find(".nivo-directionNav").show();
	  },

	  function () {
		$(this).find(".nivo-directionNav").hide();
	  }



);


				$('.raise-box').each(function(){
					var self=$(this);
					var value=$(this).attr('data-value');
					self.bindJXJUI('DigitalTimer', {number:value,fixed:true,calls:function(now, fx){
						if(parseFloat(now)<1){
							self.text(parseFloat(now).toFixeds(2)+"%");
							return false;
						}
						var v=parseInt(now)*54;
					    now>=99?self.text(parseInt(now)+"%"):self.text(parseInt(Math.round(now))+"%");
					    self.css('backgroundPosition','-'+v+'px 0');
					}});
				});


});

(function($){if(!$)return;$.extend($.browser,{'isIE6':($.browser.msie&&$.browser.version==6)?true:false,'IEMode':(function(){if($.browser.msie){if(document.documentMode){return document.documentMode;}if(document.compatMode&&document.compatMode=='CSS1Compat'){return 7;}return 5;}return 0;})(),'isIPad':(/iPad/i).test(navigator.userAgent),'language':(navigator.language||navigator.userLanguage||'').toLowerCase()});$.fn.tagName=function(){if(this.length==0)return'';if(this.length>1){var tagNames=[];this.each(function(i,el){tagNames.push(el.tagName.toLowerCase());});return tagNames;}else{return this[0].tagName.toLowerCase();}};$.fn.attrJSON=function(attr){return(this.attr(attr||'rel')||'').parseAttrJSON();};$.fn.bindJqueryUI=function(action,params){if(this.size()==0)return this;var elm=this;JXJ.load('jqueryui',function(){elm[action](params);});return this;};$.fn.bindJXJUI=function(type,params,file){if(this.size()==0||!JXJ)return this;if(JXJ.ui&&JXJ.ui[type]){JXJ.ui[type](this,params);this.data(type+'-binded',true);}else{this.bindJXJUIExtend(file||'ui',type,params);}return this;};$.fn.bindJXJUIExtend=function(file,type,params){if(this.size()==0||!JXJ)return this;var elm=this;JXJ.load(file,function(){setTimeout(function(){if(!JXJ.ui[type])return;JXJ.ui[type](elm,params);elm.data(type+'-binded',true);},200);});return this;};})(jQuery);

//
$(document).ready(function(){	

$(".mrd_bl").addClass("mrd_blon");

//pageClass

var pageClass = 1; 

if(pageClass==null){

  var pageClass=0;

}

//如果是pageClass==1

if( pageClass==1){

 //首页左右切换滚动插件

  $(function(){
	
   var oWd=$('#scrollPic');
   
   var oPic=$('#scrollPic').find('ul');

   var oImg=oPic.find('li');
   
  // var imgs=oPic.find('li img:eq(4)');

   var oLen=oImg.length;//获取数量

   var oLi=parseInt(oImg.width())+20;

   var prev=$("#prev");

   var next=$("#next");

	//var lis=parseInt(oli);
   oPic.width(oLen*oLi);//计算总长度

   var iNow=0;
   var test=parseInt(oWd.width())/oLi;
   var tp=(oLen-test)/3;

   var iTimer=null;
   if(oLen>test){
	  prev.click(function(){

   if(iNow>0){  

		iNow--;

	}

	 ClickScroll();

	})

	next.click(function(){

	   if(iNow<tp){ 

		   iNow++

		 }

		 ClickScroll();
	 }) 
	
	}
	else{next.addClass("mrd_bron"); }

   

	 function ClickScroll(){

		 iNow==0? prev.addClass('mrd_blon'):prev.removeClass('mrd_blon');

		 iNow==tp?next.addClass("mrd_bron"):next.removeClass("mrd_bron");

		oPic.animate({left:-iNow*3*oLi})

	 }

  })

}

});
$(document).ready(function(){
$(function(){
	$(".zqlist").myScroll({
		
	});
})

});
(function($){
	$.fn.myScroll = function(options){
	//默认配置
	var defaults = {
		speed:40,  //滚动速度,值越大速度越慢
		rowHeight:93 //每行的高度
	};
	
	var opts = $.extend({}, defaults, options),intId = [];
	
	function marquee(obj, step){
	
		obj.find("ul").animate({
			marginTop: '-=1'
		},0,function(){
				var s = Math.abs(parseInt($(this).css("margin-top")));
				if(s >= step){
					$(this).find("li").slice(0, 1).appendTo($(this));
					$(this).css("margin-top", 0);
				}
			});
		}
		
		this.each(function(i){
			var sh = opts["rowHeight"],speed = opts["speed"],_this = $(this);
			intId[i] = setInterval(function(){
				if(_this.find("ul").height()<=_this.height()){
					clearInterval(intId[i]);
				}else{
					marquee(_this, sh);
				}
			}, speed);

			_this.hover(function(){
				clearInterval(intId[i]);
			},function(){
				intId[i] = setInterval(function(){
					if(_this.find("ul").height()<=_this.height()){
						clearInterval(intId[i]);
					}else{
						marquee(_this, sh);
					}
				}, speed);
			});
		
		});

	}

})(jQuery);


function shows(c) {
	$('#test_' + c + '>li').mouseover(function () {
		$(this).siblings().removeClass('last').end().addClass('last');
		var i = $(this).index() + 1;
		$('.' + c).addClass('hide');
		$('.' + c + '_' + i).removeClass('hide');
	});
}
$(function () {
	shows('kfkc_list');   //推荐栏目
	shows('ewmbox');
});


$(function(){
	$('.rmlb_list .listbox ul li:first').addClass('on');
	$('.rmlb_list .listbox ul li:last').addClass('last');
	$('.rmlb_list .listbox ul li').mouseover(function() {
		$('.rmlb_list .listbox ul li').removeClass('on');
		$(this).addClass('on');
	});	
});

/// my-placeholder

/*$(function(){
	var val = $.fn.val;
	$.fn.val = function(){
		var x = val.apply(this, arguments);
		if (!!x && x==this.attr('my-placeholder')){
			return "";
		}
		return x;
	};
	$(document.body).delegate('input[my-placeholder],textarea[my-placeholder],div[my-placeholder]', "focus", function(){
		this.isFocus = true;
		var placeholder = $(this).attr('my-placeholder');
		if (this.value == placeholder) this.value = "";
		this.style.color = "#555";
	}).delegate('input[my-placeholder],textarea[my-placeholder],div[my-placeholder]', "blur", function(){
		this.isFocus = false;
		var placeholder = $(this).attr('my-placeholder');
		if (this.value == "" || this.value == placeholder) {
			this.value = placeholder;
			$(this).attr('o-color', this.style.color||"");
			//this.style.color = "#ccc";
		}
	});
	setInterval(function(){
		$('input[my-placeholder],textarea[my-placeholder],div[my-placeholder]').each(function(){
			if (this.isFocus) return;
			var placeholder = $(this).attr('my-placeholder');
			if (!!placeholder && (this.value == "" || this.value==placeholder)) {
				this.value = placeholder;
				$(this).attr('o-color', this.style.color||"");
				this.style.color = "#d0d0d0";
			}
		});
	}, 1000);
});*/


$(function(){
	// $('.cmtlist dl dd .zchf').each(function(ind, ele) {
	// 	$(ele).find('a.zc').click(function() {
	// 		$(ele).find('span').css('top',0);
	// 		$(ele).find('span').show();
	// 		$(ele).find('span').stop(true,false).animate({
	// 			top:-25
	// 		},400);
	// 	$(ele).find('span').fadeOut();
	// 	});
	// });

	
	$('.cmtlist dl').each(function(ind, ele) {
		$(ele).find('dd .zchf a.hf').click(function() {
			$(ele).find('.hfbox').toggle();
		});
	});
})

//返回顶部
window.onload = window.onscroll = window.onresize = function () {
    var zk=document.documentElement.clientWidth,
	    zw = (zk-1200)/2,
		top= $('.go_top');
		var left_w=zw-80;
	   top.css('right', left_w+'px');
	

};
jQuery(function top(){
	//当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
	jQuery(function () {
		jQuery(window).scroll(function(){
			if (jQuery(window).scrollTop()>150){
				jQuery(".go_top").fadeIn(1000);
			}
			else
			{
				jQuery(".go_top").fadeOut(1000);
			}
		});

		//当点击跳转链接后，回到页面顶部位置

		jQuery(".go_top").click(function(){
			jQuery('body,html').animate({scrollTop:0},500);
			return false;
		});
	});
});



$(function(){
	$('.kfkc_list').each(function(ind, ele) {
		$(ele).find('dd:last').addClass('last');
	});
});

window.onload = window.onresize = function s(){
	var zch=document.body.clientHeight;
	var pmh=window.innerHeight;
	 if(pmh>zch){
        $('#foot,.lb_box .fhpage').addClass('fixed');
    }else{
        $('#foot,.lb_box .fhpage').removeClass('fixed');
    }
}