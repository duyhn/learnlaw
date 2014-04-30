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
	  $.get("http://www.24h.com.vn/upload/rss/tintuctrongngay.rss", function (data) { 
		  var json = jQuery.xml2json(data);
		  json.artist;
		  //json.artist[1].;
	  });
	  /*$.get("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=F7667F3C-9C23-4E82-BA0C-D5B3A507418B", function (data) {
		    $(data).find("entry").each(function () { // or "item" or whatever suits your feed
		        var el = $(this);

		        console.log("------------------------");
		        console.log("title      : " + el.find("title").text());
		        console.log("author     : " + el.find("author").text());
		        console.log("description: " + el.find("description").text());
		    });
		});*/
  });
 