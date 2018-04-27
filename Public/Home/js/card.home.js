$(function(){
  var aSpan=$(".a-z-tab p span");
  var oDiv2=$(".a-z");
  $('.siteNavMenu li').hover(function(){
    $(this).addClass('hover').find('.menuHide').show();
  },function(){
    $(this).removeClass('hover').find('.menuHide').hide();
  });
  $.each(aSpan,function(){
    $(this).bind('click',function(){
      if($(oDiv2.eq($(this).index())).is(':visible')){
        oDiv2.eq($(this).index()).hide();
        aSpan.removeClass('curr');
      }else{
        aSpan.removeClass('curr');
        $(this).addClass('curr');
        oDiv2.hide();
        oDiv2.eq($(this).index()).show();
      }
    });
  });
  $('.focus').slide({
        slideItem: '.focus-ct',
        navSelected: 'focusLi',
        slideNav: 'li a',
        navParent:'.focus ul li',
        itemSelected: 'selected',
        pause : 2000,
        isAddAutoNav : false
    });
  $('.siteNavMenu li').hover(function(){
    $(this).addClass('hover').find('.menuHide').show();
  },function(){
    $(this).removeClass('hover').find('.menuHide').hide();
  });
  $('.newCode li').live('mouseover',function(){
    $('.newCode li').find('.bigLi').hide();
    $('.newCode li').find('.smallLi').show();
    $(this).find('.smallLi').hide();
    $(this).find('.bigLi').show();
  });
  var lis = $('.gap-hd .tabs span');
  var oUls = $('.tab2'); 
  lis.bind('click',function(){
    lis.removeClass('curr');
    $(this).addClass('curr');
    oUls.hide();
    oUls.eq($(this).index()).show();
  });
  $('.rank-panel ul li').mouseover(function(){
    $(this).siblings().removeClass('curr');
    $(this).addClass('curr');
  });
});