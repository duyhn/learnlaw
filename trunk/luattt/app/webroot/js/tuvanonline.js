function changeidTypeConsultings(){
	var s = document.getElementById('typeconsulting_id');
	var item1 = s.options[s.selectedIndex].value;
	window.location.href="/luatvnam/Tuvan/index/"+item1;
}
function search(){
	if($("#title").val()=="")
		alert("Nhập thông tin tìm kiếm!");
	else{
		$("#formQuestion").attr("action","/luatvnam/admin/admin/searchQuetion");
		$('#formQuestion').submit();
	}
}
$(document).ready(function(){
	
	
	var url="/luatvnam/Tuvan/getRssTuvan/";
	$.ajax({
        type:  'GET',
        cache:  false ,
        url: url ,
        
        success: function(resp) {
        	console.log("ok");
        },
       error: function(e){  
    	   console.log('Error: ' + e);  
   }  

	});
});
