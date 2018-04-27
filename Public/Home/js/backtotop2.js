if($.browser.msie) {
  var ieVersion = parseInt($.browser.version)
}
var $backtotop=function(){
    if($(this).scrollTop() > 44) {
	  var _bw = 980,_wt = document.body.clientWidth;
	  $("#backtotop").css('right','10%');
	  $("#erweipic").css('right', ((_wt-_bw)/2)-0);
	  var st = $(document).scrollTop(), winh = $(window).height();
	  if(ieVersion != 6) {
	 	 $("#backtotop").css('top',(winh/2) - 44);
	  }
	  $("#erweipic").css('top',st+350);
	 $("#backtotop").css({"display": "block"});
    } else {
      $("#backtotop").css({"display": "none"})
    }
};
var __initEvent = function() {
  $(window).bind("resize",$backtotop);
  $(window).bind("scroll", $backtotop);
  $("#totop").bind("click", function(e) {
    e.preventDefault();
    $("html,body").animate({scrollTop:0},500)
  });
  $("#erweima").bind("mouseover",function(){
	  $('#erweipic').css('display','block');
  });
 $("#erweima").bind("mouseout",function(){
	  $('#erweipic').css('display','none');
  });
 }
$(function() {
  if(screen.width >= 1024) {
    (function() {
      __feedCreat();
      __initEvent()
    })()
  }
});
function addFav(){
	var title = document.title.toString();
	var url = window.location.href;
	    try{
    	window.external.AddFavorite(url,title);
    }catch (e) {
		try{
        	window.sidebar.addPanel(title,url, "");   
		}catch(e){
			alert("您的浏览器不支持一键收藏，请按Ctrl+D将本页添加到收藏夹");
		}
	}
}