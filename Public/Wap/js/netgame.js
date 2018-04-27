$(function() {
  $(".load").hide();
  $(".goTop").hide()
  // 返回顶部
  $(".goTop").bind('click', function() {
    $("html,body").animate({
      scrollTop : 0
    }, 500)
  })
})
// 显示回到顶部
$(window).bind('scroll', function() {
  var scrollTop = $(this).scrollTop();
  if (scrollTop > 300) {
    $(".goTop").show()
  } else {
    $(".goTop").hide()
  }
});

$(function () {
  var $logo = $("div.topmore");
  var $ul = $(".hide-nav");
  var $cover = $("div.cover-1");
  var $ula = $('.hide-nav li a');
  $logo.on("click", function () {
      $("div.cover-1").toggle();
      $(".hide-nav").slideToggle();
  });
  $cover.bind('click', function (e) {
      $("div.cover-1").toggle();
      $(".hide-nav").slideToggle();
  });
  });
  
var touchmove = function(e) {
  e.preventDefault && e.preventDefault();
  e.returnValue = false;
  e.stopPropagation && e.stopPropagation();
  return false;
}

var defaultEvent;

var scr = function(e) {
  defaultEvent = e;
  e.preventDefault && e.preventDefault();
  e.returnValue = false;
  e.stopPropagation && e.stopPropagation();
  return false;
}

function showDown(channelId) {
  var publicArg = $('#publicArgs').attr('href');
  if (publicArg && publicArg.length > 0) {
    publicArg = publicArg.substring(1);
  }
  toUrl = contextRoot + '/e/ikaimi/m/loaddown.php?id=' + channelId + "&" + publicArg;
  $.ajax({
    url : toUrl, type : 'GET', cache : false, dataType : 'text', success : function(data) {
      $(".gmdetaDown").remove();
      var downloadFloat = $(data);
      if (downloadFloat.length > 0) {
        downloadFloat.css("top", getScrollTop() - 10);
        $(".gmdetaDown").remove();
        $(".full").remove();
        $("body").prepend('<div id="canScroll"  class="full" style="display: none;"></div>');
        $("body").prepend(downloadFloat);
        $('.gmdetaDown,.full').fadeIn(1000);
        document.body.parentNode.style.overflow = "hidden";

	
        document.getElementById("canScroll").ontouchmove = scr;

		$(".gmdetaDown").show();
		$("#canScroll").show();
      } else {

        alert("暂无下载包");
      }
    }, error : function() {
      error = 1;
    }
  });
}
function showDown2(channelId) {
  var publicArg = $('#publicArgs').attr('href');
  if (publicArg && publicArg.length > 0) {
    publicArg = publicArg.substring(1);
  }
  toUrl = contextRoot + '/e/ikaimi/m/loaddown.pojie.php?id=' + channelId + "&" + publicArg;
  $.ajax({
    url : toUrl, type : 'GET', cache : false, dataType : 'text', success : function(data) {
      $(".gmdetaDown").remove();
      var downloadFloat = $(data);
      if (downloadFloat.length > 0) {
        downloadFloat.css("top", getScrollTop() - 10);
        $(".gmdetaDown").remove();
        $(".full").remove();
        $("body").prepend('<div id="canScroll"  class="full" style="display: none;"></div>');
        $("body").prepend(downloadFloat);
        $('.gmdetaDown,.full').fadeIn(1000);
        document.body.parentNode.style.overflow = "hidden";

	
        document.getElementById("canScroll").ontouchmove = scr;

		$(".gmdetaDown").show();
		$("#canScroll").show();
      } else {

        alert("暂无下载包");
      }
    }, error : function() {
      error = 1;
    }
  });
}

function showDown3(channelId) {
  var publicArg = $('#publicArgs').attr('href');
  if (publicArg && publicArg.length > 0) {
    publicArg = publicArg.substring(1);
  }
  toUrl = contextRoot + '/e/ikaimi/m/loaddown.gm.php?id=' + channelId + "&" + publicArg;
  $.ajax({
    url : toUrl, type : 'GET', cache : false, dataType : 'text', success : function(data) {
      $(".gmdetaDown").remove();
      var downloadFloat = $(data);
      if (downloadFloat.length > 0) {
        downloadFloat.css("top", getScrollTop() - 10);
        $(".gmdetaDown").remove();
        $(".full").remove();
        $("body").prepend('<div id="canScroll"  class="full" style="display: none;"></div>');
        $("body").prepend(downloadFloat);
        $('.gmdetaDown,.full').fadeIn(1000);
        document.body.parentNode.style.overflow = "hidden";

	
        document.getElementById("canScroll").ontouchmove = scr;

		$(".gmdetaDown").show();
		$("#canScroll").show();
      } else {

        alert("暂无下载包");
      }
    }, error : function() {
      error = 1;
    }
  });
}

function hideFloatingLayer() {
  $('.gmdetaDown,.full').fadeOut(1000);
  // document.body.ontouchmove = defaultEvent;
  window.removeEventListener('ontouchmove', touchmove, false);
  document.body.parentNode.style.overflow = "auto";
}

function getScrollTop() {
  var scrollPos;
  if (window.pageYOffset) {
    scrollPos = window.pageYOffset;
  } else if (document.compatMode && document.compatMode != 'BackCompat') {
    scrollPos = document.documentElement.scrollTop;
  } else if (document.body) {
    scrollPos = document.body.scrollTop;
  }
  return scrollPos;
}

var keyword;

function inText(elem) {
  if (keyword == null || keyword == $(elem).val()) {
    keyword = $(elem).val();
    $(elem).val('');
  }
}

function outText(elem) {
  if ($(elem).val().length == 0) {
    $(elem).val(keyword);
    keyword = null;
  }
}



$(function() {
  var clientH = document.body.clientHeight-2048;
  var liW = document.body.clientWidth - 20;
  var dot = $('#dot');
  var bar = $('#menu-bar');

  dot.on('click', function() {
    $('.logbg').show();
    bar.animate({
      'right' : '0%'
    })
  });

  $('#userBtn1').bind('click', function() {
    $('.logbg').css({
      
    }).show();
    $('.userInfo').css({
      
    }).show();
    $('.userInfo').animate({
      'left' : "20%"
    }, function() {
      $('body').bind('touchmove', stopScroll);
    });
  });

  $('.userBtn2').bind('click', hideUser);
  $('.logbg').bind('click', hideUser);
  function hideUser() {
    $('.userInfo').animate({
      'left' : "100%"
    }, function() {
      $('body').unbind('touchmove', stopScroll);
      $('.logbg').hide();
    });
    bar.animate({
      'right' : '-100%'
    }, function() {
      $('body').unbind('touchmove', stopScroll);
      $('.logbg').hide();
    });
  }
  function stopScroll(e) {
    e.preventDefault();
  }

})