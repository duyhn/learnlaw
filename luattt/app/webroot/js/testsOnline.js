
var minute;
function checkLogin(){
	  var url="/luattt/users/cheklogin";
	  $.ajax({
	        type:  'GET',
	        cache:  false ,
	        url:  url,
	        success: function(resp) {
	        	if(parseInt(resp)==2)
	        		alert("Bạn chưa đăng nhập!");
	        	else
	        		window.location.assign("/luattt/tests/index");
	        },
	        error: function(e){  
	        	alert('Bạn chưa đăng nhập!');  
	        	return false;
	    }  
	  });
	  return false;
}

var myVar;
//tinh va hien thi thoi gian thi online
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
	if(minute==0 && second==0){
		clearTimeout(myVar);
		submittest();
	}
	 document.getElementById("minute").innerHTML=""+stminute;
	 document.getElementById("second").innerHTML=":"+stsecond;
	 if(minute==2 && second==59){
		 $("#minute").addClass("time");
		 $("#second").addClass("time");
	}
	 myVar=setTimeout(function(){displaytime(time-1);}, 1000);
}
function sumitform(id,page){
	 
	 $("#testTestOnlineForm").attr("action","/luatvnam/tests/testOnline/"+id+"/"+page);
	 $('#testTestOnlineForm').submit();
	
}
function submittest(){
	 $("#testTestOnlineForm").attr("action","/luatvnam/tests/submittest/");
	 $('#testTestOnlineForm').submit();
}
//Them cau tra loi
function addmethod(){
	var a=document.getElementsByName("content[]");
	if(a.length<5){
		$('#tbform').append();
		$('#tbform').append("<tr><td><label>Nội dung câu trả lời  </label><a style='color: #06F;' onclick='deleteRow(this)'>Xóa</a></td><td><textarea rows='4' cols='50' name='content[]' ></textarea><td></tr>");
		$('#tbform').append("<tr><td><label>Đúng/sai</label></td><td><select name='corect[]'><option value=0>sai</option><option value=1>Đúng</option></select><td></tr>");
	}
	else{
		alert("Bạn đã thêm quá số câu trả lời");
	}
}
function changeidtypeQuestion(){
	var s = document.getElementById('idtype');
	var idqs = document.getElementById('idqs').value;
	var item1 = s.options[s.selectedIndex].value;
	window.location.href="/luatvnam/admin/admin/manageQuestion/"+item1+"/"+idqs;
}
function checkpa(){
	try {
		var a=document.getElementsByName("content[]");
		if(a==null || a.length==0){
			alert("Bạn phải nhập câu trả lời..");
			return false;
		}
		for ( var iterable_element in a) {
			if(a[iterable_element].value==""){
				alert("Nhập đầy đủ thông tin..");
				return false;
			}
		}
    }
    catch(err) {
    	alert("Bạn phải nhập câu trả lời..");
    	return false;
    }
	
	
	return true;
}

function deleteRow(r)
{
	var i = r.parentNode.parentNode.rowIndex;
	document.getElementById("tbform").deleteRow(i);
	document.getElementById("tbform").deleteRow(i);
}


