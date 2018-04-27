$(function(){
	redirectmobile();
	$(".map, .site-map").hover(function(){
		$(".site-map").addClass("show");
	},function(){
		$(".site-map").removeClass("show");
	});
	$(".hot-gift li, .rank-list li, .hot-package li").hover(function(){
		$(this).addClass("hover").siblings("li").removeClass("hover");
	});

	$(".rank-tab .tit, .rank-tab .rtside-title, .rank-tab li").hover(function(){

		if($(this).hasClass("rtside-title")){
			$(this).addClass("hover").siblings(".rtside-title").removeClass("hover");
		}
		else if($(this).hasClass("tit")){
			$(this).addClass("hover").siblings(".tit").removeClass("hover");
		}
		else {
			$(this).addClass("hover").siblings("li").removeClass("hover");
		}
		var cur = $(this).index();
		$(".rank-list").eq(cur).show().siblings(".rank-list").hide();
	});


	$(".rmlb-list li").hover(function(){
		$(this).addClass("hover").siblings("li").removeClass("hover");
	},function(){
		$(".rmlb-list li").removeClass("hover");
	});


	$(".hot-tab .tit,.hot-tab .rtside-title,.hot-tab li").hover(function(){

		if($(this).hasClass("rtside-title")){
			$(this).addClass("hover").siblings(".rtside-title").removeClass("hover");
		}
		else if($(this).hasClass("tit")){
			$(this).addClass("hover").siblings(".tit").removeClass("hover");
		}
		else {
			$(this).addClass("hover").siblings("li").removeClass("hover");
		}

		var cur = $(this).index();
		switch(cur){
			case 0:
				$(".rmgl-list").show();
				$(".rmlb-list").hide();
				break;
			case 1:
				$(".rmgl-list").hide();
				$(".rmlb-list").show();
				break;
		}
	});
	//΢�ŵ���
	$(".weixin").hover(function(){
		$(".wx-pop").show();
	},function(){
		$(".wx-pop").hide();
	});
	//��Ͷ����
	$(".ad_close").live("click",function(){
		$(".ad").remove();
	});	
	//ҳ����ת
	$('.pag_btn').click(function(){
		var page = $('.pag_txt').val();
		if(!isNaN(page)){
			var url = self.location.href;
			var ex = "";
			var newurl = "";
			if(url.indexOf("_") > 0){
				//��ǰҳ�治�ǵ�һҳ
				ex = /\_([1-9]+)\.html/;
				if(page == "1"){
					newurl = url.replace(ex,'_'+page+'.html');
					newurl = newurl.replace("_1", "");
				}else{
					newurl = url.replace(ex,'_'+page+'.html');
				}
			}
			else{
				//��ǰҳ���ǵ�һҳ
				var id = url.replace("72", "").replace(/\D+/g, "");
				ex = /([1-9]+)\.html/;
				newurl = url.replace(id, id + '_'+page);
			}			
			location.href = newurl;
		}else{
			alert('����Ϊ����');
		}
	});
	var page = $('.pag a.p_hov').text();
	$('.pag_txt').val(page);

	//Ajax����start
	
	//���µ�������
//	$.post("/index.php?tp=ajax","id="+intnewsid);
	//Ajax����end
	
	//�滻ɾ����
	if(!("ActiveXObject" in window)){ 
		$("span[style='text-decoration:line-through;']").each(function(){
			$(this).replaceWith('<del>'+$(this).html()+'</del>');
		});
	}else{ 
		$("strong span").each(function(){
			$(this).replaceWith('<del>'+$(this).html()+'</del>');
		});
	}
	
	//��������
	$('div.sybl_box').html('<span class="sybl_p"><span class="sybl_p_l"></span>ʷ����ȫ����Ϸ������̳�<span class="sybl_p_r"></span><span class="sybl_p_i"></span></span><a target="_blank" href="http://zhushou.72g.com"></a>');

});
//�����ղؼ�
function AddFavorite(url, title) {
	try {
	  window.external.addFavorite(url, title);
	}
	catch (e) {
		try {
		window.sidebar.addPanel(title, url, "");
		}
		catch (e) {
		 alert("��Ǹ������ʹ�õ��������޷����ɴ˲�����\n\n�����ղ�ʧ�ܣ���ʹ��Ctrl+D��������");
		}
	}
}
//�ַ�����ȡ
function cutstr(str,len){
	var str_length = 0;
	var str_len = 0;
		str_cut = new String();
		str_len = str.length;
	for(var i = 0;i<str_len;i++){
		a = str.charAt(i);
		str_length++;
		if(escape(a).length > 4){
			//�����ַ��ĳ��Ⱦ�����֮������4
			str_length++;
		}
		str_cut = str_cut.concat(a);
		if(str_length>=len){
			str_cut = str_cut.concat("...");
			return str_cut;
		}
	}
	//���������ַ���С��ָ�����ȣ��򷵻�Դ�ַ�����
	if(str_length<len){
		return str;
	}
}

//��Ϸ����
function getgameinfo(intid, intgltype){
	if(intid == 0){
		return;	
	}
	var stract = "getgameinfo";
	$.get("/index.php", { tp: "ajaxpublic", act: stract, id: intid, gltype: intgltype, ts: new Date().getTime() },
	function(data){
		if(data != ""){
			$(".zone-ad").first().before(data);
			var detail = $(".zib p").html();
			var brief = cutstr($(".zib p").html(),126);
			var height = $(".zib p").height();
			$(".zib p").html(cutstr($(".zib p").html(),126));
			$(".zib a").click(function(){			
				if($(this).hasClass("expand")){
					$(this).removeClass().addClass("collapse").html("����");
					$(".zib p").html(detail);
				}else{
					$(this).removeClass().addClass("expand").html("չ��");
					$(".zib p").html(brief);
				}
			});
		}
	});	
}
//������Ѷ
function gethotnewslist(strid){
	var stract = "gethotnewslist";
	$.get("/index.php", { tp: "ajaxpublic", act: stract, id: strid, ts: new Date().getTime() },
	function(data){
		if(data != ""){
			$("#ul_hotnews").append(data);
		}
	});
}
//��Ѷ����
function getnewssort(id){
	var stract = "getnewssort";
	var strbigsortname = "";
	var strbigsortnamelink = "";
	var strdhlink = "";
	var strsmallsortlink = "";
	$.getJSON("/index.php", { tp: "ajaxpublic", act: stract, ts: new Date().getTime() }, function(result){
		$.each(result, function(i,val){
			$.each(val, function(indexi,valuei){
				var arr = valuei.split(',');
				if(id == arr[1]){
					strbigsortname = i;
					return false;
				}
			});
			if(strbigsortname == "��Ϸ����"){
				strbigsortnamelink = "<em class=\"yxxw\">��Ϸ����</em>";
			}else if(strbigsortname == "��Ϸ����"){
				strbigsortnamelink = "<em class=\"yxgl\">��Ϸ����</em>";
			}else if(strbigsortname == "��ɫר��"){
				strbigsortnamelink = "<em class=\"tszl\">��ɫר��</em>";
			}else{
			 
			}
			$(".site-logo a").after(strbigsortnamelink);
		});
	});
	$.getJSON("/index.php", { tp: "ajaxpublic", act: stract, ts: new Date().getTime() }, function(result){
		$.each(result, function(i,val){
			if(strbigsortname == i){		
				$.each(val, function(index,value){
					var arr = value.split(',');
					if(arr[1] == id){
						strdhlink = strdhlink + '<a href="'+arr[0]+'" target="_blank" class="hover">'+index+'<\/a>';
						strsmallsortlink = arr[0];
					}else{
						strdhlink = strdhlink + '<a href="'+arr[0]+'" target="_blank">'+index+'<\/a>';
					}
				});
			}
		});
		$(".inner-nav").html(strdhlink);
		//��ǰ����
		var strposition = "<a href=\"http://www.72g.com\" target=\"_blank\">72G��ҳ</a> &gt; <a href=\"javascript:void();\">" + strbigsortname + "</a> &gt; <a href=\""+strsmallsortlink+"\">"+ strtypename + "</a>";
		$(".icon-cur").after(strposition);
	});
}
//���ڵ���Ѷ
function getneighbornews(intid, inttypeid){
	var stract = "getneighbornews";
	$.get("/index.php", { tp: "ajaxpublic", act: stract, id: intid, typeid: inttypeid, ts: new Date().getTime() },
	function(data){
		if(data != ""){
			$(".news-side").html(data);
		}
	});
}
//������Ѷ
function getrelatenews(intid, inttypeid, strtag){
	var stract = "getrelatenews";
	$.get("/index.php", { tp: "ajaxpublic", act: stract, id: intid, typeid: inttypeid, tag: strtag, ts: new Date().getTime() },
	function(data){
		if(data != ""){
			$("#ul_relatenews").append(data);
		}
	});
}
//�༭��Ϣ
function getediterinfo(strwriter){
	var stract = "getediterinfo";
	$.get("/index.php", { tp: "ajaxpublic", act: stract, writer: strwriter, ts: new Date().getTime() },
	function(data){
		if($.trim(data) == ""){
			$(".editor-info").remove();
		}else{
			$(".editor-info").html(data);
		}
	});
}

//��Ͷ����
//function getbtad(){
//	var times = Date.parse(new Date());
//	var jssrc = 'http://adm.265g.com/js/72gbt_conf.js?'+times;
//	$.getScript(jssrc,function(){
//		var random = Math.floor(Math.random()*bt_72g['72g_index'].length);
//		var bt = '<div class="ad" style="background:url(\''+bt_72g['72g_index'][random].ad_pic+'\') no-repeat center top;"><a onclick="window.open(\''+bt_72g['72g_index'][random].company_link+'\');" class="ad_pic" href="javascript:;"></a><a class="ad_close" href="javascript:;">X �ر�</a></div>'
//		$('.main:first').before(bt);
//		$('.ad .ad_pic').live('click',function(){
//			$.ajax({
//				url:  'http://adm.265g.com/index.php?tp=adv_ajax',
//				dataType: 'jsonp',
//				data: {op: 'bt_click', tid: bt_72g['72g_index'][random].id},
//				jsonp: 'jsonpcallback',
//				success: function(d){}
//			});
//		});
//	});
//	/*var stract = "getbtad";
//	$.get("/index.php", { tp: "ajaxpublic", act: stract, ts: new Date().getTime() },
//	function(data){
//		$(".main").before(data);
//	});*/
//}
//document.write('<script src="/cache/beitou.js"><\/script>');
//�ƶ���ҳ����ת2015-9-6
function redirectmobile(){
	var url = window.location.href;
	var murl = "";
	switch (url){
		case "http://www.72g.com/":
			murl = "";
			break;
		default:
			murl = url.replace("www", "m");
			break;		
	}
	var	reg = /(iphone|ipod|ipad|ios|android|mobile|nokia|blackberry)/i;
	if ((navigator.userAgent.match(reg))) {
		location.replace(murl);
	}
}