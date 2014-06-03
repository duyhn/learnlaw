  $(document).ready(function(){
//	  var url="http://www.moj.gov.vn/_layouts/GenRss.aspx?List=F7667F3C-9C23-4E82-BA0C-D5B3A507418B";
//	  $.ajax({
//	        type:  'GET',
//	        cache:  false ,
//	        url:  url,
//	        dataType: 'json',
//	        success: function(resp) {
//	        	 callback(data.responseData.feed);
//	        	alert(resp);
//	        },
//	        error: function(e){  
//	        	alert('Error: ' + e);  
//	    }  
//	  });
//	  $.get("http://www.24h.com.vn/upload/rss/tintuctrongngay.rss", function (data) { 
//		  var json = jQuery.xml2json(data);
//		  json.artist;
//		  //json.artist[1].;
//	  });
	  /*$.get("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=F7667F3C-9C23-4E82-BA0C-D5B3A507418B", function (data) {
		    $(data).find("entry").each(function () { // or "item" or whatever suits your feed
		        var el = $(this);

		        console.log("------------------------");
		        console.log("title      : " + el.find("title").text());
		        console.log("author     : " + el.find("author").text());
		        console.log("description: " + el.find("description").text());
		    });
		});*/
	  var url1="/luatvnam/Tbltintucs/getNewsInWeb1/";
		$.ajax({
	        type:  'GET',
	        cache:  false ,
	        url: url1 ,
	        
	        success: function(resp) {
	        	console.log("ok");
	        },
	       error: function(e){  
	    	   console.log('Error: ' + e);  
	   }  

		});
		var url2="/luatvnam/Tbltintucs/getNewsInWeb2/";
		$.ajax({
	        type:  'GET',
	        cache:  false ,
	        url: url2 ,
	        
	        success: function(resp) {
	        	console.log("ok");
	        },
	       error: function(e){  
	    	   console.log('Error: ' + e);  
	   }  

		});
	 
  });
 function changeidTypeNews(){
	 var s = document.getElementById('id_theloai');
		var item1 = s.options[s.selectedIndex].value;
		window.location.href="/luatvnam/admin/admin/manageNews/"+item1;
 }