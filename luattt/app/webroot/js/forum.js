function changeTopic(){
	var s = document.getElementById('topic_id');
	var idpost = document.getElementById('idpost').value;
	var item1 = s.options[s.selectedIndex].value;
	var s1 = document.getElementById('forum_id');
	var item2 = s1.options[s1.selectedIndex].value;
	window.location.href="/luatvnam/admin/admin/manageComment/"+item2+"/"+item1+"/"+idpost;
}
function changeForum(){
	var s = document.getElementById('topic_id');
	var idpost = document.getElementById('idpost').value;
	
	var item1 = s.options[s.selectedIndex].value;
	var s1 = document.getElementById('forum_id');
	var item2 = s1.options[s1.selectedIndex].value;
	window.location.href="/luatvnam/admin/admin/manageComment/"+item2+"/"+item1+"/"+idpost;
}
function editPost(object,content){
	//document.getElementById("PostContent").value=document.getElementById("post_"+content).innerHTML;
	 CKEDITOR.instances.PostContent.setData(document.getElementById("post_"+content).innerHTML);
	document.getElementById("PostViewForm").action="/luatvnam/posts/update/"+object.value;
	//alert(object.value);
}
function changeidForum(e){
	window.location.href="/luatvnam/admin/admin/manageComment/"+item2+"/"+item1+"/"+idpost;
}