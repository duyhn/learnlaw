
var minute;
function checkLogin(){
	  var url="/luattt/users/cheklogin";
	  $.ajax({
	        type:  'GET',
	        cache:  false ,
	        url:  url,
	        success: function(resp) {
	        	if(parseInt(resp)==2)
	        		alert("Báº¡n chÆ°a Ä‘Äƒng nháº­p!");
	        	else
	        		window.location.assign("/luattt/tests/index");
	        },
	        error: function(e){  
	        	alert('Báº¡n chÆ°a Ä‘Äƒng nháº­p!');  
	        	return false;
	    }  
	  });
	  return false;
}
function displaytime(time){
	var minute=parseInt(time/60);
	var second=parseInt(time%60);
	var stminute=""+minute;
	var stsecond=""+second;
	if(minute<10){
		stminute="0"+minute;
	}
	if(second<10){
		stsecond="0"+second;
	}
	
	 document.getElementById("minute").innerHTML=""+stminute;;
	 document.getElementById("second").innerHTML=":"+stsecond;
	 if(minute==2 && second==59){
		 $("#minute").addClass("time");
		 $("#second").addClass("time");
	}
	setTimeout(function(){displaytime(time-1);}, 1000);
}
function sumitform(id,page){
	 $("#testTestOnlineForm").attr("action","/luatvnam/tests/testOnline/"+id+"/"+page);
	 $('#testTestOnlineForm').submit();
	
}
function addmethod(){
	var a=document.getElementsByName("content[]");
	if(a.length<5){
		$('#tbform').append("<tr><td>Nội dung câu trả lời:</td><td><textarea rows='4' cols='50' name='content[]' ></textarea><td></tr>");
		$('#tbform').append("<tr><td>Đúng/sai:</td><td><select name='corect[]'><option value=0>sai</option><option value=1>Đúng</option></select><td></tr>");
	}
	else{
		alert("Bạn đã thêm quá số câu trả lời");
	}
}
function changeidtypeQuestion(){
	var s = document.getElementById('idtype');
	var item1 = s.options[s.selectedIndex].value;
	window.location.href="/luatvnam/admin/admin/manageQuestion/"+item1;
}