

//-------------UPDATE TIN----------------------
//su kien cho nut submit form updateTin
$(document).ready(function() {
    $("#btupdateTin").click(function() {
        if ($("#tieude").val() == "")
        {
            alert("Tiêu đề không được để trống!");
            $("#tieude").focus();
            return false;
        }
        else if (!isNaN($("#tieude").val())) {
            alert("Tiêu đề không được nhập số!");
            $("#tieude").focus();
            return false;
        }
        if ($("#noidung").val() == "")
        {
            alert("Nội dung không được để trống!");
            $("#noidung").focus();
            return false;
        }
        else if (!isNaN($("#noidung").val())) {
            alert("Nội dung không được nhập số!");
            $("#noidung").focus();
            return false;
        }
        if ($("#tacgia").val() == "")
        {
            alert("Tác giả không được để trống!");
            $("#tacgia").focus();
            return false;
        }
        else if (!isNaN($("#tacgia").val())) {
            alert("Tác giả không được nhập số!");
            $("#tacgia").focus();
            return false;
        }
        if ($("#hinhanh2").val() == "")
        {
            alert("Hình ảnh không được để trống!");
            $("#hinhanh2").focus();
            return false;
        }
        else {
            var test_value = $("#hinhanh2").val();
            var extension = test_value.split('.').pop().toLowerCase();
            if ($.inArray(extension, ['png', 'gif', 'jpeg', 'jpg']) == -1) {
                alert("File ảnh không hợp lệ!");
                return false;
            }
        }
         if ($("#idlt").val() == "")
        {
            alert("Chưa chọn loại tin!");
            $("#idlt").focus();
            return false;
        }
        return true;
    });
});
//-------------THEM TIN----------------------
//su kien cho nut submit form addTin
$(document).ready(function() {
    $("#btaddTin").click(function() {
        if ($("#tieude1").val() == "")
        {
            alert("Tiêu đề không được để trống!");
            $("#tieude1").focus();
            return false;
        }
        else if (!isNaN($("#tieude1").val())) {
            alert("Tiêu đề không được nhập số!");
            $("#tieude1").focus();
            return false;
        }
//        if ($("#nd").val() === "")
//        {
//            alert("Nội dung không được để trống!");
//            $("#nd").focus();
//            return false;
//        }
//        else if (!isNaN($("#nd").val())) {
//            alert("Nội dung không được nhập số!");
//            $("#nd").focus();
//            return false;
//        }
          if ($("#tacgia1").val() == "")
        {
            alert("Tác giả không được để trống!");
            $("#tacgia1").focus();
            return false;
        }
        else if (!isNaN($("#tacgia1").val())) {
            alert("Tác giả không được nhập số!");
            $("#tacgia1").focus();
            return false;
        }
        
         if ($("#idlt1").val() == "")
        {
            alert("Chưa chọn loại tin!");
            $("#idlt1").focus();
            return false;
        }
//        if ($("#hinhanh1").val() == "")
//        {
//            alert("Hình ảnh không được để trống!");
//            $("#hinhanh1").focus();
//            return false;
//        }
//        else {
//            var test_value = $("#hinhanh1").val();
//            var extension = test_value.split('.').pop().toLowerCase();
//            if ($.inArray(extension, ['png', 'gif', 'jpeg', 'jpg']) == -1) {
//                alert("File ảnh không hợp lệ!");
//                return false;
//            }
//        }
        //Kiem tra check radio
        if (!($("#hien1").is(':checked')) && !($("#an1").is(':checked')))
        {
            alert("Chưa chọn thuộc tính hiện ẩn ảnh!");
            $("#hien_an1").focus();
            return false;
        }
        return true;
    });
});

//-------------THEM THE LOAI TIN----------------------
//su kien cho nut submit form addTL
$(document).ready(function() {
    $("#btaddTL").click(function() {
        if ($("#ten_theloai").val() == "")
        {
            alert("Tên thể loại không được để trống!");
            $("#ten_theloai").focus();
            return false;
        }
        else if (!isNaN($("#ten_theloai").val())) {
            alert("Tên thể loại không được nhập số!");
            $("#ten_theloai").focus();
            return false;
        }

        return true;
    });
});
//-------------CAP NHAT THE LOAI TIN----------------------
//su kien cho nut submit form addTL
$(document).ready(function() {
    $("#btupdateTL").click(function() {
        if ($("#ten_theloai1").val() == "")
        {
            alert("Tên thể loại không được để trống!");
            $("#ten_theloai1").focus();
            return false;
        }
        else if (!isNaN($("#ten_theloai1").val())) {
            alert("Tên thể loại không được nhập số!");
            $("#ten_theloai1").focus();
            return false;
        }
        return true;
    });
});
////==========UPLOAD FILE
////-------------THEM THE LOAI TAI LIEU DOWNLOAD----------------------
////su kien cho nut submit form addTaiLieu
$(document).ready(function() {
    $("#btaddTaiLieu").click(function() {
        if ($("#tenloai").val() == "")
        {
            alert("Tên loại không được để trống!");
            $("#tenloai").focus();
            return false;
        }
        else if (!isNaN($("#tenloai").val())) {
            alert("Tên loại không được nhập số!");
            $("#tenloai").focus();
            return false;
        }

        return true;
    });
});
////-------------CAP NHAT THE LOAI TAI LIEU DOWNLOAD----------------------
////su kien cho nut submit form updateTaiLieu
$(document).ready(function() {
    $("#btupdateTailieu").click(function() {
        if ($("#tenloai1").val() == "")
        {
            alert("Tên loại không được để trống!");
            $("#tenloai1").focus();
            return false;
        }
        else if (!isNaN($("#tenloai1").val())) {
            alert("Tên loại không được nhập số!");
            $("#tenloai1").focus();
            return false;
        }

        return true;
    });
});
////========GIAO VIEN
////-------------UPDATE GIAO VIEN----------------------
////su kien cho nut submit form updateGV
$(document).ready(function() {
    $("#btupdateGV").click(function() {
        if ($("#tkGiaoVien").val() == "")
        {
            alert("Tài khoản không được để trống!");
            $("#tkGiaoVien").focus();
            return false;
        }
        else if (!isNaN($("#tkGiaoVien").val())) {
            alert("Tài khoản không được nhập số!");
            $("#tkGiaoVien").focus();
            return false;
        }
        if ($("#mkGiaoVien").val() == "")
        {
            alert("Mật khẩu không được để trống!");
            $("#mkGiaoVien").focus();
            return false;
        }
        else if ($("#mkGiaoVien").val().length < 6 || $("#mkGiaoVien").val().length > 20)
        {
            alert("Mật khẩu phải lớn hơn 6 kí tự và nhỏ hơn 20 kí tự!");
            $("#mkGiaoVien").focus();
            return false;
        }
        if ($("#tenGiaoVien").val() == "")
        {
            alert("Tên giáo viên không được để trống!");
            $("#tenGiaoVien").focus();
            return false;
        }
        else if (!isNaN($("#tenGiaoVien").val())) {
            alert("Tên giáo viên không được nhập số!");
            $("#tenGiaoVien").focus();
            return false;
        }
        if ($("#ChucVu").val() == "")
        {
            alert("Chức vụ không được để trống!");
            $("#ChucVu").focus();
            return false;
        }
        else if (!isNaN($("#ChucVu").val())) {
            alert("Chức vụ không được nhập số!");
            $("#ChucVu").focus();
            return false;
        }
        if ($("#Sodt").val() == "")
        {
            alert("Số điện thoại không được để trống!");
            $("#Sodt").focus();
            return false;
        }
        var sdt = $("#Sodt").val();
        if (sdt.length < 10 || sdt.length > 12 || sdt == "Nhap so dien thoai") {
            alert("Số điện thoại không hợp lệ!");
            $("#Sodt").focus();
            return false;
        }
        if (isNaN($("#Sodt").val())) {
            alert("Số điện thoại không được nhập chữ!");
            $("#Sodt").focus();
            return false;
        }
        if ($("#Email").val() == "")
        {
            alert("Email không được để trống!");
            $("#em").focus();
            return false;
        }
        m = $("#Email").val().indexOf('@');
        n = $("#Email").val().indexOf('.');
        if (m <= 0 || n < m || n == m + 1) {
            alert("Email không đúng định dạng!");
            $("#Email").focus();
            return false;
        }

        return true;
    });
});
////-------------ADD GIAO VIEN----------------------
////su kien cho nut submit form addGV
$(document).ready(function() {
    $("#btaddGV").click(function() {
        if ($("#tkGiaoVien1").val() == "")
        {
            alert("Tài khoản không được để trống!");
            $("#tkGiaoVien1").focus();
            return false;
        }
        else if (!isNaN($("#tkGiaoVien1").val())) {
            alert("Tài khoản không được nhập số!");
            $("#tkGiaoVien1").focus();
            return false;
        }
        if ($("#mkGiaoVien1").val() == "")
        {
            alert("Mật khẩu không được để trống!");
            $("#tkGiaoVien1").focus();
            return false;
        }
        else if ($("#tkGiaoVien1").val().length < 6 || $("#tkGiaoVien1").val().length > 20)
        {
            alert("Mật khẩu phải lớn hơn 6 kí tự và nhỏ hơn 20 kí tự!");
            $("#tkGiaoVien1").focus();
            return false;
        }
        if ($("#tenGiaoVien1").val() == "")
        {
            alert("Tên giáo viên không được để trống!");
            $("#tenGiaoVien1").focus();
            return false;
        }
        else if (!isNaN($("#tenGiaoVien1").val())) {
            alert("Tên giáo viên không được nhập số!");
            $("#tenGiaoVien1").focus();
            return false;
        }
        if ($("#ChucVu1").val() == "")
        {
            alert("Chức vụ không được để trống!");
            $("#ChucVu1").focus();
            return false;
        }
        else if (!isNaN($("#ChucVu1").val())) {
            alert("Chức vụ không được nhập số!");
            $("#ChucVu1").focus();
            return false;
        }
        if ($("#Sodt1").val() == "")
        {
            alert("Số điện thoại không được để trống!");
            $("#Sodt1").focus();
            return false;
        }
        var sdt = $("#Sodt1").val();
        if (sdt.length < 10 || sdt.length > 12 || sdt == "Nhap so dien thoai") {
            alert("Số điện thoại không hợp lệ!");
            $("#Sodt1").focus();
            return false;
        }
        if (isNaN($("#Sodt1").val())) {
            alert("Số điện thoại không được nhập chữ!");
            $("#Sodt1").focus();
            return false;
        }
        if ($("#Email1").val() == "")
        {
            alert("Email không được để trống!");
            $("#Email1").focus();
            return false;
        }
        m = $("#Email1").val().indexOf('@');
        n = $("#Email1").val().indexOf('.');
        if (m <= 0 || n < m || n == m + 1) {
            alert("Email không đúng định dạng!");
            $("#Email1").focus();
            return false;
        }

        return true;
    });
});
////============
////-------------UPDATE ADMIN----------------------
////su kien cho nut submit form updateAdmin
$(document).ready(function() {
    $("#btupdateAD").click(function() {
       if ($("#user1").val() == "")
        {
            alert("Tài khoản không được để trống!");
            $("#user1").focus();
            return false;
        }
        else if (!isNaN($("#user1").val())) {
            alert("Tài khoản không được nhập số!");
            $("#user1").focus();
            return false;
        }
        if ($("#pass1").val() == "")
        {
            alert("Mật khẩu không được để trống!");
            $("#pass1").focus();
            return false;
        }
        else if ($("#pass1").val().length < 6 || $("#pass1").val().length > 20)
        {
            alert("Mật khẩu phải lớn hơn 6 kí tự và nhỏ hơn 20 kí tự!");
            $("#pass1").focus();
            return false;
        }
        if ($("#fname1").val() == "")
        {
            alert("Tên không được để trống!");
            $("#fname1").focus();
            return false;
        }
        else if (!isNaN($("#fname1").val())) {
            alert("Tên không được nhập số!");
            $("#fname1").focus();
            return false;
        }
        if ($("#em1").val() == "")
        {
            alert("Email không được để trống!");
            $("#em1").focus();
            return false;
        }
        m = $("#em1").val().indexOf('@');
        n = $("#em1").val().indexOf('.');
        if (m <= 0 || n < m || n == m + 1) {
            alert("Email không đúng định dạng!");
            $("#em1").focus();
            return false;
        }
         if ($("#sdt1").val() == "")
        {
            alert("Số điện thoại không được để trống!");
            $("#sdt1").focus();
            return false;
        }
        var sdt = $("#sdt1").val();
        if (sdt.length < 10 || sdt.length > 12 || sdt == "Nhap so dien thoai") {
            alert("Số điện thoại không hợp lệ!");
            $("#sdt1").focus();
            return false;
        }
        if (isNaN($("#sdt1").val())) {
            alert("Số điện thoại không được nhập chữ!");
            $("#sdt1").focus();
            return false;
        }
        if ($("#quyen1").val() == "")
        {
            alert("Quyền quản trị không được để trống!");
            $("#quyen1").focus();
            return false;
        }
        
        return true;
    });
});




////-------------ADD ADMIN----------------------
////su kien cho nut submit form addAdmin
$(document).ready(function() {
    $("#btaddAdmin").click(function() {
       if ($("#user").val() == "")
        {
            alert("Tài khoản không được để trống!");
            $("#user").focus();
            return false;
        }
        else if (!isNaN($("#user").val())) {
            alert("Tài khoản không được nhập số!");
            $("#user").focus();
            return false;
        }
        if ($("#pass").val() == "")
        {
            alert("Mật khẩu không được để trống!");
            $("#pass").focus();
            return false;
        }
        else if ($("#pass").val().length < 6 || $("#pass").val().length > 20)
        {
            alert("Mật khẩu phải lớn hơn 6 kí tự và nhỏ hơn 20 kí tự!");
            $("#pass").focus();
            return false;
        }
        if ($("#fname").val() == "")
        {
            alert("Tên không được để trống!");
            $("#fname").focus();
            return false;
        }
        else if (!isNaN($("#fname").val())) {
            alert("Tên không được nhập số!");
            $("#fname").focus();
            return false;
        }
        if ($("#em").val() == "")
        {
            alert("Email không được để trống!");
            $("#em").focus();
            return false;
        }
        m = $("#em").val().indexOf('@');
        n = $("#em").val().indexOf('.');
        if (m <= 0 || n < m || n == m + 1) {
            alert("Email không đúng định dạng!");
            $("#em").focus();
            return false;
        }
         if ($("#sdt").val() == "")
        {
            alert("Số điện thoại không được để trống!");
            $("#sdt").focus();
            return false;
        }
        var sdt = $("#sdt").val();
        if (sdt.length < 10 || sdt.length > 12 || sdt == "Nhap so dien thoai") {
            alert("Số điện thoại không hợp lệ!");
            $("#sdt").focus();
            return false;
        }
        if (isNaN($("#sdt").val())) {
            alert("Số điện thoại không được nhập chữ!");
            $("#sdt").focus();
            return false;
        }
        if ($("#quyen").val() == "")
        {
            alert("Quyền quản trị không được để trống!");
            $("#quyen").focus();
            return false;
        }
        
        return true;
    });
});
////-------------UPDATE THONG TIN CA NHAN----------------------
////su kien cho nut submit form updateCanhan
$(document).ready(function() {
    $("#btcapnhatCanhan").click(function() {
       if ($("#user2").val() == "")
        {
            alert("Tài khoản không được để trống!");
            $("#user2").focus();
            return false;
        }
        else if (!isNaN($("#user2").val())) {
            alert("Tài khoản không được nhập số!");
            $("#user2").focus();
            return false;
        }
        if ($("#pass2").val() == "")
        {
            alert("Mật khẩu không được để trống!");
            $("#pass2").focus();
            return false;
        }
        else if ($("#pass2").val().length < 6 || $("#pass2").val().length > 20)
        {
            alert("Mật khẩu phải lớn hơn 6 kí tự và nhỏ hơn 20 kí tự!");
            $("#pass2").focus();
            return false;
        }
        if ($("#fname2").val() == "")
        {
            alert("Tên không được để trống!");
            $("#fname2").focus();
            return false;
        }
        else if (!isNaN($("#fname2").val())) {
            alert("Tên không được nhập số!");
            $("#fname2").focus();
            return false;
        }
        if ($("#em2").val() == "")
        {
            alert("Email không được để trống!");
            $("#em2").focus();
            return false;
        }
        m = $("#em2").val().indexOf('@');
        n = $("#em2").val().indexOf('.');
        if (m <= 0 || n < m || n == m + 1) {
            alert("Email không đúng định dạng!");
            $("#em2").focus();
            return false;
        }
         if ($("#sdt2").val() == "")
        {
            alert("Số điện thoại không được để trống!");
            $("#sdt2").focus();
            return false;
        }
        var sdt = $("#sdt2").val();
        if (sdt.length < 10 || sdt.length > 12 || sdt == "Nhap so dien thoai") {
            alert("Số điện thoại không hợp lệ!");
            $("#sdt2").focus();
            return false;
        }
        if (isNaN($("#sdt2").val())) {
            alert("Số điện thoại không được nhập chữ!");
            $("#sdt2").focus();
            return false;
        }
       
        return true;
    });
});
