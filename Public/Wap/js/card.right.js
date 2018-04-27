$(function() {
  $(".load").hide();
  $(".goTop").hide()
  // 杩斿洖椤堕儴
  $(".goTop").bind('click', function() {
    $("html,body").animate({
      scrollTop : 0
    }, 500)
  })
})
// 鏄剧ず鍥炲埌椤堕儴
$(window).bind('scroll', function() {
  var scrollTop = $(this).scrollTop();
  if (scrollTop > 300) {
    $(".goTop").show()
  } else {
    $(".goTop").hide()
  }
});	

	$(function(){
    var clientH = document.body.clientHeight-2048;
    var liW = document.body.clientWidth-20;
    var dot= $('#dot');
    var bar = $('#menu-bar');

    dot.on('click', function(){
      $('.full').show();
      bar.animate({'right':'0%'})
    });

    $('#userBtn1').bind('click',function(){
      $('.full').css({'height':clientH}).show();
      $('.userInfo').css({'height':clientH}).show();
      $('.userInfo').animate({'left':"20%"},function(){
        $('body').bind('touchmove',stopScroll);
      });
    });

    $('.userBtn2').bind('click',hideUser);
    $('.full').bind('click',hideUser);
    function hideUser(){
      $('.userInfo').animate({'left':"100%"},function(){
        $('body').unbind('touchmove',stopScroll);
        $('.full').hide();
      });
      bar.animate({'right':'-100%'},function(){
        $('body').unbind('touchmove',stopScroll);
        $('.full').hide();
      }); 
    }
    function stopScroll(e){
      e.preventDefault();
    }
  })
