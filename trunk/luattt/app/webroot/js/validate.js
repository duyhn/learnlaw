
// JavaScript Document
//==Login
$(document).ready(function(){
	$("#btnLogin").click(function() {
	        if ($("#username").val() == "") {
	            alert("Chưa nhập Username!");
	            $("#username").focus();
	            return false;
	        }
	        if ($("#password").val() == "") {
	            alert("Chưa nhập Paswword!");
	            $("#password").focus();
	            return false;
	        }
	        
	        return true;
	 });  


	 $("#submitdk").click(function() {
			if ($("#register_name").val() == "") {
		            alert("Họ tên không được để trống!");
		            $("#register_name").focus();
		            return false;
		      }
			else if (!isNaN($("#register_name").val())) {
	            alert("Họ tên không được nhập số!");
	            $("#register_name").focus();
	            return false;
	        }
	        if ($("#register_uername").val() == "") {
	            alert("Tên đăng nhập không được để trống!");
	            $("#register_uername").focus();
	            return false;
	        }
	        if ($("#register_email").val() == "") {
	            alert("Email không được để trống!");
	            $("#register_email").focus();
	            return false;
	        }
	        m = $("#register_email").val().indexOf('@');
	        n = $("#register_email").val().indexOf('.');
	        if (m <= 0 || n < m || n == m + 1) {
	            alert("Email không đúng định dạng!");
	            $("#register_email").focus();
	            return false;
	        }
	        if ($("#register_password").val() == "") {
	            alert("Mật khẩu không được để trống!");
	            $("#register_password").focus();
	            return false;
	        }
	        else if ($("#register_password").val().length < 6 || $("#register_password").val().length > 20)
	        {
	            alert("Mật khẩu phải lớn hơn 6 kí tự và nhỏ hơn 20 kí tự!");
	            $("#register_password").focus();
	            return false;
	        }
	        if ($("#register_password_confirmation").val() == "") {
	            alert("Mật khẩu xác nhận không được để trống!");
	            $("#register_password_confirmation").focus();
	            return false;
	        }
	        //kiem tra xac nhan pass
	        if ($("#register_password").val() != $("#register_password_confirmation").val()) {
	        	 alert("Mật khẩu xác nhận không chính xác!");
	        	 $("#register_password_confirmation").focus();
		         return false;
	        }
	        if (!$("#isagree").is(':checked')) {
	        	 alert("Bạn phải xác nhận đồng ý điều khoản!");
	        	 $("#isagree").focus();
	        	 return false;
	        }
	        return true;
	 });
	 //upload tai lieu
	 $("#submitup").click(function() {
			if ($("#textfield").val() == "") {
		            alert("Bạn chưa chọn tài liệu upload!");
		            $("#textfield").focus();
		            return false;
		      }
			else {
	            var test_value = $("#textfield").val();
	            var extension = test_value.split('.').pop().toLowerCase();
	            if ($.inArray(extension, ['png', 'gif', 'jpeg', 'jpg','doc','docx','pdf','ppt']) == -1) {
	                alert("File upload không hợp lệ!");
	                $("#textfield").focus();
	                return false;
	            }
	        }
			if ($("#title").val() == "") {
	            alert("Tên tài liệu không được để trống!");
	            $("#title").focus();
	            return false;
	      }
			else if (!isNaN($("#title").val())) {
	            alert("Tên tài liệu không được nhập số!");
	            $("#title").focus();
	            return false;
	        }
	        if ($("#mota").val() == "") {
	            alert("Mô tả không được để trống!");
	            $("#mota").focus();
	            return false;
	        }
	        else if (!isNaN($("#mota").val())) {
	            alert("Mô tả không được nhập số!");
	            $("#mota").focus();
	            return false;
	        }
	       	return true;
	 });
	 
	 $("#submit_news").click(function() {
			if ($("#tieude_news").val() == "") {
		            alert("Tiêu đề không được để trống!");
		            $("#tieude_news").focus();
		            return false;
		      }
			else if (!isNaN($("#tieude_news").val())) {
	            alert("Tiêu đề không được nhập số!");
	            $("#tieude_news").focus();
	            return false;
	        }
	        if ($("#noidung_news").val() == "") {
	            alert("Nội dung không được để trống!");
	            $("#noidung_news").focus();
	            return false;
	        }
	        else if (!isNaN($("#noidung_news").val())) {
	            alert("Nội dung không được nhập số!");
	            $("#noidung_news").focus();
	            return false;
	        }
	       
	        return true;
	 });
	 
	 $("#subDatcauhoituvan").click(function() {
			if ($("#hotentuvan").val() == "") {
		            alert("Họ tên không được để trống!");
		            $("#hotentuvan").focus();
		            return false;
		      }
			else if (!isNaN($("#hotentuvan").val())) {
	            alert("Họ tên không được nhập số!");
	            $("#hotentuvan").focus();
	            return false;
	        }
			 if ($("#emailtuvan").val() == "") {
		            alert("Email không được để trống!");
		            $("#emailtuvan").focus();
		            return false;
		        }
		        m = $("#emailtuvan").val().indexOf('@');
		        n = $("#emailtuvan").val().indexOf('.');
		        if (m <= 0 || n < m || n == m + 1) {
		            alert("Email không đúng định dạng!");
		            $("#emailtuvan").focus();
		            return false;
		        }
		        if ($("#titletuvan").val() == "") {
		            alert("Tiêu đề không được để trống!");
		            $("#titletuvan").focus();
		            return false;
		        }
		        else if (!isNaN($("#titletuvan").val())) {
		            alert("Tiêu đề không được nhập số!");
		            $("#titletuvan").focus();
		            return false;
		        }
		        if ($("#contenttuvan").val() == "") {
		            alert("Nội dung không được để trống!");
		            $("#contenttuvan").focus();
		            return false;
		        }
		        else if (!isNaN($("#contenttuvan").val())) {
		            alert("Nội dung không được nhập số!");
		            $("#contenttuvan").focus();
		            return false;
		        }
	       
	        return true;
	 });
	 
	 $("#btnsearch").click(function() {
			if ($("#search").val() == "") {
		            alert("Vui lòng điền dữ liệu!");
		            $("#search").focus();
		            return false;
		      }
			else if (!isNaN($("#search").val())) {
	            alert("Không được nhập kiểu số!");
	            $("#search").focus();
	            return false;
	        }
	       
	        return true;
	 });

	 $("#btnUsermn").click(function() {
			if ($("#register_name").val() == "") {
		            alert("Họ tên không được để trống!");
		            $("#register_name").focus();
		            return false;
		      }
			else if (!isNaN($("#register_name").val())) {
	            alert("Họ tên không được nhập số!");
	            $("#register_name").focus();
	            return false;
	        }
	        if ($("#register_uername").val() == "") {
	            alert("Tên đăng nhập không được để trống!");
	            $("#register_uername").focus();
	            return false;
	        }
	        if ($("#register_email").val() == "") {
	            alert("Email không được để trống!");
	            $("#register_email").focus();
	            return false;
	        }
	        m = $("#register_email").val().indexOf('@');
	        n = $("#register_email").val().indexOf('.');
	        if (m <= 0 || n < m || n == m + 1) {
	            alert("Email không đúng định dạng!");
	            $("#register_email").focus();
	            return false;
	        }
	        if ($("#register_password").val() == "") {
	            alert("Mật khẩu không được để trống!");
	            $("#register_password").focus();
	            return false;
	        }
	        else if ($("#register_password").val().length < 6 || $("#register_password").val().length > 20)
	        {
	            alert("Mật khẩu phải lớn hơn 6 kí tự và nhỏ hơn 20 kí tự!");
	            $("#register_password").focus();
	            return false;
	        }
	        return true;
	 });
	 //Forum
	 $("#btnForum").click(function() {
			if ($("#name").val() == "") {
		            alert("Tên diễn đàn không được để trống!");
		            $("#name").focus();
		            return false;
		      }
			else if (!isNaN($("#name").val())) {
	            alert("Tên diễn đàn không được nhập số!");
	            $("#name").focus();
	            return false;
	        }
	        if ($("#decription").val() == "") {
	            alert("Mô tả không được để trống!");
	            $("#decription").focus();
	            return false;
	        }
	        else if (!isNaN($("#decription").val())) {
	            alert("Mô tả không được nhập số!");
	            $("#decription").focus();
	            return false;
	        }
	       
	        return true;
	 });
	 $("#btnTopic").click(function() {
			if ($("#name").val() == "") {
		            alert("Tên chủ đề không được để trống!");
		            $("#name").focus();
		            return false;
		      }
			else if (!isNaN($("#name").val())) {
	            alert("Tên chủ đề không được nhập số!");
	            $("#name").focus();
	            return false;
	        }
	        if ($("#content").val() == "") {
	            alert("Nội dung không được để trống!");
	            $("#content").focus();
	            return false;
	        }
	        else if (!isNaN($("#content").val())) {
	            alert("Nội dung không được nhập số!");
	            $("#content").focus();
	            return false;
	        }
	       
	        return true;
	 });
	 $("#btnPost").click(function() {
	        if ($("#content").val() == "") {
	            alert("Nội dung không được để trống!");
	            $("#content").focus();
	            return false;
	        }
	        else if (!isNaN($("#content").val())) {
	            alert("Nội dung không được nhập số!");
	            $("#content").focus();
	            return false;
	        }
	       
	        return true;
	 });
	 $("#subDatcauhoituvan").click(function(){
		 if($("#hotentuvan").val()==""){
			 alert("Họ tên không được để trống!");
			
			 return false;
		 }
		 if($("#emailtuvan").val()==""){
			 alert("Email không được để trống!");
			 return false;
		 }
		 if($("#contenttuvan").val()==""){
			 alert("Nội dung tư vấn không được để trống!");
			 return false;
		 }
		 return true;
	 });
});

