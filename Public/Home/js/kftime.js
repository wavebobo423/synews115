	var time=new Date();
	var localtime = new Array();
	var hours = 0;
	var minute = 0;
	var second = 0;

	localtime[0] = time.getFullYear();
	localtime[1] = time.getMonth()+1;
	localtime[2] = time.getDate();
	localtime[3]= hours = time.getHours();
	minute = time.getMinutes();
	second = time.getSeconds();
	
	remtime = ((60-minute)*60-second)*1000;
	setTimeout('reflresh()', remtime);
	
	function echotime(gtime, ghour) {
		var isday = true;
		var timestr = '';
		var getarray = gtime.split("-");
		var gettime1 = new Array(parseInt(getarray[0]), parseInt(getarray[1]), parseInt(getarray[2]));
		for(var i=0;i<3;i++) {
	        if(gettime1[i] != localtime[i]) {
	        	isday = false;
	        	break;
	        }
	    }
		if(isday) {
			timestr = '<span class="red">今天 </span>';
		} else {
			timestr = '' + getarray[1] + '-' + getarray[2] +'';
		}
		document.write(timestr);
	}