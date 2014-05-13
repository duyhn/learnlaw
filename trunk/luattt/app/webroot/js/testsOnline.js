arr;
var time;
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
