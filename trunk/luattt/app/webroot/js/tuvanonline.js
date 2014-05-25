function changeidTypeConsultings(){
	var s = document.getElementById('typeconsulting_id');
	var item1 = s.options[s.selectedIndex].value;
	window.location.href="/luatvnam/Tuvan/index/"+item1;
}