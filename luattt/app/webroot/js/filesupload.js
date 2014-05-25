function changeIdfile(){
	var s = document.getElementById('idloai');
	var item1 = s.options[s.selectedIndex].value;
	window.location.href="/luatvnam/admin/admin/manageUpload/"+item1;
}