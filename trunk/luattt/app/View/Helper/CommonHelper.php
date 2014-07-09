<?php
App::import("Model", "Common");
include_once('simple_html_dom.php');
class CommonHelper extends HtmlHelper{

	function general(){
		$footer="<span>Bản quyền (C) 2013 thuộc Võ Thị Tường Vy</span></br><span>Trường Đại học Bách Khoa - Đại học Đà Nẵng</span></br>";
		$footer.="<span>Địa chỉ: 272 Thái Thị Bôi, Quận Thanh Khê, Đà Nẵng</span></br><span>Điện thoại: 0905743649</span>";
		$header="<div id='logo'>".
		$this->image("image/logo.jpg", array('alt' => 'luatvn', 'class' => 'logoleft')).
		$this->image("image/logo2.png", array('alt' => 'luatvn','style' => 'margin:10px 0 0 10px'))
		."	
		<div class='today'>Hôm nay: ". date('d-m-Y')."</div>";
//		$header="<div id='logo'><image class='logoleft' src='img/image/logo.jpg' alt='luatvn'/></div><div class='today'>Hôm nay :". date('d-m-Y')."</div> <div class='clear'></div>";		
		$header.='<form class="right" action="/luatvnam/Searchs/search" method="POST"><input type="text" id="search" name="info" style="width:200px;margin-top:9px;"/><input class="icsearch" id="btnsearch" type="submit" name="search" value=""/></form></div>';
		$data = array(
				"header" => $header,
				"footer" => $footer,
		);

		return $data;
	}
	
	//
	function create_heaeder(){
		$tt="Học Luật Việt Nam";
		$data= $this->general();
		$header="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'> <html xmlns='http://www.w3.org/1999/xhtml'><head>";
		$header.=$this->charset();
		$header.="<title>".$tt."</title>";
		$header.=$this->css(array("styles.css","tabs.css"));
		$header.= $this->script(array('jquery-1.7.2.min.js','validate.js','lightbox.js','jquery-latest.pack.js','jcarousellite_1.0.1c4.js','jquery.jgfeed.js','news.js','general.js','highlightNav.js'));
		$header.=$this->css(array("themes/1/js-image-slider.css","generic.css"));
		$header.= $this->script(array('themes/1/js-image-slider.js','slideShow.js'));
		$header.="<script type='text/javascript'>
			$(function() {
			 $('.jcarouse').jCarouselLite({
			 vertical: true,
			 hoverPause:true,
			 visible: 3,
			 auto:500,
			 speed:1000
			 });
			});
			</script>";
						
		//$header.="<div id='bttop'>BACK TO TOP</div></head>";
		//$header.="<body>";
		//$header.="<div id='wrapper'><div id='header'>".$data['header']."</div><div class='cach'></div>";
		//$header.="<div id='menu-nav'>".$this->create_menu($username)."</div>";

		return $header;
	}
	function general_admin(){
		$footer="<span>Bản quyền (C) 2013 thuộc Võ Thị Tường Vy</span></br><span>Trường Đại học Bách Khoa - Đại học Đà Nẵng</span></br>";
		$footer.="<span>Địa chỉ: 272 Thái Thị Bôi, Quận Thanh Khê, Đà Nẵng</span></br><span>Điện thoại: 0905743649</span>";
		$header="<div id='logo' style='width:1200px;'>".
		$this->image("image/logo.jpg", array('alt' => 'luatvn', 'class' => 'logoleft')).
		$this->image("image/logo2.png", array('alt' => 'luatvn','style' => 'margin:10px 0 0 10px'))
		."	
		<div class='today'>Hôm nay: ". date('d-m-Y')."</div>";
//		$header="<div id='logo'><image class='logoleft' src='img/image/logo.jpg' alt='luatvn'/></div><div class='today'>Hôm nay :". date('d-m-Y')."</div> <div class='clear'></div>";		
		$data = array(
				"header" => $header,
				"footer" => $footer,
		);

		return $data;
	}
	function header_admin(){
		$tt="Administrator";
		$data= $this->general_admin();
		$header="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'> <html xmlns='http://www.w3.org/1999/xhtml'><head>";
		$header.=$this->charset();
		$header.="<title>".$tt."</title>";
		$header.=$this->css(array("styles.css","tabs.css"));
		$header.= $this->script(array('jquery-1.7.2.min.js','validate.js','highlightNav.js'));
		return $header;
	}
	//
	function create_footer(){
		$data= $this->general();

		$footer="<div id='footer'>".$data['footer']."</div>";
		$footer.="</div></body></html>";
	}
	
	//
	function general_forum(){
		$footer="<span>Bản quyền (C) 2013 thuộc Võ Thị Tường Vy</span></br><span>Trường Đại học Bách Khoa - Đại học Đà Nẵng</span></br>";
		$footer.="<span>Địa chỉ: 272 Thái Thị Bôi, Quận Thanh Khê, Đà Nẵng</span></br><span>Điện thoại: 0905743649</span>";
		$header="<div id='logo'>".
		$this->image("image/logo.jpg", array('alt' => 'luatvn', 'class' => 'logoleft')).
		$this->image("image/forum.png", array('alt' => 'luatvn','style' => 'margin:10px 0 0 10px'))
		."	
		<div class='today'>Hôm nay: ". date('d-m-Y')."</div>";
//		$header="<div id='logo'><image class='logoleft' src='img/image/logo.jpg' alt='luatvn'/></div><div class='today'>Hôm nay :". date('d-m-Y')."</div> <div class='clear'></div>";		
		$header.='<form class="right" action="/luatvnam/Searchs/search" method="POST"><input type="text" id="search" name="info" style="width:200px;margin-top:9px;"/><input class="icsearch" id="btnsearch" type="submit" name="search" value=""/></form></div>';
		$data = array(
				"header" => $header,
				"footer" => $footer,
		);

		return $data;
	}
	
	//
	function forum_header(){
		$tt="Diễn Đàn Học Luật Việt Nam";
		$data= $this->general();
		$header="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'> <html xmlns='http://www.w3.org/1999/xhtml'><head>";
		$header.=$this->charset();
		$header.="<title>".$tt."</title>";
		$header.=$this->css(array("styles.css","tabs.css"));
		$header.= $this->script(array('jquery-1.7.2.min.js','validate.js','news.js','general.js','highlightNav.js'));	
		return $header;
	}
	
	//
	function create_menu($username){

		$menu="<ul class='nav'><li class='highlight'>".$this->link('Trang chủ',array('controller' => 'users','action' => 'index','full_base' => true)
		)."</li><li class=''>";	
		$menu.="</li><li class=''>".$this->link('Tin tức-sự kiện',array('controller' => 'tintuc','action' => '','full_base' => true))."<ul>";
		/*include_once('includes/connect-db.inc');
		 $query = mysql_query("SELECT * FROM tbltheloai,tbltintuc WHERE tbltheloai.id_theloai=tbltintuc.id_theloai GROUP BY tbltintuc.id_theloai");
		 while ($row = mysql_fetch_array($query)) {
		 echo '<li><a href="?mod=ndTin&id_theloai=' . $row['id_theloai'] . '">' . $row['ten_theloai'] . '</a></li>';
		 }*/
		$menu.="</ul></li><li class=''>".$this->link('Download',array('controller' => 'Uploads','action' => 'index','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Diễn đàn',array('controller' => 'Forums','action' => 'index','full_base' => true))."</li>";
		
		$menu.="<li class=''>".$this->link('Tư vấn pháp luật',array('controller' => 'Tuvan','action' => 'index','full_base' => true));
		$menu.="<ul><li>".$this->link("Đặt câu hỏi",array('controller' => 'Tuvan','action' => 'formConsulting','full_base' => true))."</li>";
		$menu.="<li>".$this->link("Xem tư vấn",array('controller' => 'Tuvan','action' => 'index','full_base' => true))."</li></ul></li>";
		if(!isset($username)){
			$menu.="<li class=''>".$this->link('Thi online',array('controller' => 'Users','action' => 'login','full_base' => true))."</li>";
			$menu.="<li id='' style='float:right'>".$this->link('Đăng ký',array('controller' => 'users','action' => 'register','full_base' => true))."</li>";
			$menu.="<li id='login' style='float:right'><a href='#'>Đăng nhập</a></li>";
				
		}
		else {
			$menu.="<li class=''>".$this->link('Thi online',array('controller' => 'tests','action' => '','full_base' => true))."</li>";
			$menu.="<li style='float:right'>".$this->link('Thoát',array('controller' => 'users','action' => 'logout','full_base' => true))."</li>";
			$menu.="<li style='float:right'>".$this->link('Cá nhân',array('controller' => 'users','action' => 'profile','full_base' => true,$username))."</li>";
			$menu.="<span class='titlelog'>Xin chào: ".$username." </span>";
		
		}
		$menu.=$this->login()."</ul>";
		return $menu;
	}
	function create_right(){
		$time = new Common();
		$data=$time->query("SELECT id_tintuc,tieude, ten_anh FROM tbltintucs ORDER BY ngaythang DESC LIMIT 0,5");

		$right="<div class='block' id='link' ><div class='block-title'>Thông Báo<div id='show' class='mo1'></div> </div>";
		$right.= "<div class='block-content' id='link11'>";
		foreach ($data as $item){
			$tt=$item['tbltintucs']['tieude'];
			$right.="<ul><li>".$this->link($tt,array('controller' => 'Tbltintucs','action' => 'view',$item['tbltintucs']['id_tintuc']))."</ul></li>";
		}
		$right.="</div></div>";
		$data=$time->query("SELECT id_tintuc,tieude, ten_anh FROM tbltintucs  ORDER BY solanxem DESC LIMIT 0,5");
		$right.="<div class='block' id='link' ><div class='block-title'>Tin Nổi Bật</div>";
		$right.="<div class='jcarouse' id='link12'><ul>";
		foreach ($data as $item){
			$right.="<li><div class='thumb'>";
		//	$right.=$this->image($item['tbltintucs']['ten_anh'], array('repeat alt' =>"img".$item['tbltintucs']['id_tintuc'],'title'=>$this->noidungtt(10, $item['tbltintucs']['tieude'])));
			//$right.="<img src='anhTintuc/".$item['tbltintucs']['ten_anh']."' repeat alt='".$item['tbltintucs']['tieude']."' title='".$item['tbltintucs']['tieude']."' />";
			$right.="</div><div class='info'>";
			$tt=$this->noidungtt(12, $item['tbltintucs']['tieude']);
			$right.=$this->link($tt,array('controller' => 'Tbltintucs','action' => 'view',$item['tbltintucs']['id_tintuc']))."</div><div class='clr'></div></li>";
		}
		$right.="</ul></div></div>";
		$right.="<div class='block' id='link'>";
		$right.='<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FH%25E1%25BB%258Dc-t%25E1%25BA%25ADp-Ph%25C3%25A1p-lu%25E1%25BA%25ADt-Vi%25E1%25BB%2587t-Nam%2F1427213424218495%3Fref%3Dhl&amp;width=262&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:262px; height:220px;" allowTransparency="true"></iframe>';
		$right.="</div>";
		$right.="<div class='block' id='link'><div class='block-title'>Thống Kê</div>";
		$right.="<div class='block-content' style='height: 50px; padding: 10px 0 10px 10px;'>";
		/*$data=$time->query("select * from thamdos order by qid desc");*/
		$right.=$this->create_countvisiter();
		$right.=$this->create_countonline();

		$right.="</div></div><div id='backgroundPopup'></div>";
		return $right;
	}
	function create_countonline(){
		$time = new Common();
		$countonline="</br>Đang truy cập :";
		$tg=time();
		$tgout=900;
		$tgnew=$tg - $tgout;
		try{
			$time->query("insert into useronlines(tgtmp,ip,local) values('".$tg."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['PHP_SELF']."')");
			$time->query("delete from useronlines where tgtmp <".$tgnew);
			$data=$time->query("SELECT DISTINCT ip FROM useronlines");
			$countonline.=count($data);
		}
		catch (Exception $e) {
			$time->query("delete from useronlines where tgtmp <".$tgnew);
			$data=$time->query("SELECT DISTINCT ip FROM useronlines");
			$countonline.=count($data);
		}
		
		return $countonline;
	}
	//
	function create_countvisiter(){
		$time = new Common();
		$countvisiter="Lượt truy cập: ";
		$tg=time();
		$tgout=900;
		$tgnew=$tg - $tgout;
		$time->query("delete from useronlines where tgtmp <".$tgnew);
		$data=$time->query("SELECT ip FROM useronlines where ip='".$_SERVER['REMOTE_ADDR']."'");
		$log = "counter.txt";
		if(count($data)==0){
				
			$count = file_get_contents($log) +1;
			$write = fopen($log,"w");
			fwrite($write,$count);
			fclose($write);
		}
		$read = fopen($log,"r");
		$content = fread($read,filesize($log));
		$countvisiter.=$content;
		return $countvisiter;
	}
	//
	function slideImage(){
		$time = new Common();
		$data=$time->query("SELECT id_tintuc,ten_anh,tieude FROM tbltintucs WHERE hien_an = 1 LIMIT 0,7");
		$slider="<div id='sliderFrame'><div id='slider'>";
		foreach($data as $item){
			$slider.=$this->image($item['tbltintucs']['ten_anh'], array('repeat alt' => $item['tbltintucs']['tieude'],'title'=>$item['tbltintucs']['id_tintuc']));
		}
		$slider.="</div></div>";
		return $slider;
	}
	//
	//login
	function login(){
		$login = "<div class='login' style='display:none'>";
		$login.="<div class='title'><h1>Login</h1><a href='#' class='close'></a></div>";
		
		$login.="<form method='post' action='/luatvnam/users/login'>";
		$login.="<p><input type='text' id='username' name='username' value='' placeholder='Username'></p>";
		$login.="<input type='password' id='password' name='password' value='' placeholder='Password'></p>";
		$login.="<p id='btnLogin' class='submit'><input type='submit' name='ok' value='Login'></p>";
		$login.="</form></div>";
		return $login;
	}
	//
	function getRss($urlrss,$idloai){
		try {
			include_once('simple_html_dom.php');				
			$tbltt = new Common();
			$dom=new DOMDocument('1.0','utf-8');//tao doi tuong dom
			$dom->load($urlrss)    ;//muon lay rss tu trang nao thi ban khai bao day
			$items = $dom->getElementsByTagName("item");//lay cac element co tag name la item va gan vao bien $items
			$dom1=new DOMDocument('1.0','utf-8');
			$i=0;
				
			foreach($items as $item)//lap
			{
				$i++;
				if($i==5)
				break;
				$titles=$item->getElementsByTagName('title');//lay cac element co tag name la title va gan vao bien $titles
				$title=$titles->item(0);//lay ra gia tri dau tuien trong array $titles
					
				$descriptions=$item->getElementsByTagName('description');
				$des=$descriptions->item(0);
				$links=$item->getElementsByTagName('link');
				$link=$links->item(0);
				//load tin tuc
				$html = new simple_html_dom();
				$html->load_file($link->nodeValue);
				$element = $html->find("h1");
				$spanNgay=$html->find("span.date");
				$divMota=$html->find("div.mota");
				$divcontent=$html->find("div.news-content");
				$content="<div>".$divMota[0]->outertext."".$divcontent[0]->outertext."</div>";
				//lu vao csdl
				$data=$tbltt->query("SELECT id_tintuc,tieude FROM tbltintucs WHERE tieude='".$element[0]->innertext."'");
					
				if(count($data)==0){
					$tbltt->query("insert into tbltintucs(tieude,noidung,ngaythang,id_theloai) values('".$element[0]->innertext."','".$content."','".date('y/m/d h:i:s',time())."',".$idloai.")");
				}
			}
		} catch (Exception $e) {
			return;
		}

	}
	//
	function getRssPhobien($urlrss,$idloai){
		try {
			$tbltt = new Common();
			$dom=new DOMDocument('1.0','utf-8');//tao doi tuong dom(html)
			$dom->load($urlrss)    ;//muon lay rss tu trang nao thi ban khai bao day//urlrss:link cua xml
			$items = $dom->getElementsByTagName("item");//lay cac element co tag name la item va gan vao bien $items
			$dom1=new DOMDocument('1.0','utf-8');
			$i=0;

			foreach($items as $item)//lap
			{
				$i++;
				if($i==5)
				break;
				$titles=$item->getElementsByTagName('title');//lay cac element co tag name la title va gan vao bien $titles
				$title=$titles->item(0);//lay ra gia tri dau tuien trong array $titles
					
				$descriptions=$item->getElementsByTagName('description');
				$des=$descriptions->item(0);
				$links=$item->getElementsByTagName('link');
				$link=$links->item(0);
				//load tin tuc
				$html = new simple_html_dom();
				$html->load_file($link->nodeValue);
				$element = $html->find("h1");
				$p=$html->find("p.des");
				//$divMota=$html->find("div.mota");
				$divcontent=$html->find("div.box-content-news-detail");
				$content="<div>".$p[0]->outertext."".$divcontent[0]->outertext."</div>";
				//lu vao csdl
				$data=$tbltt->query("SELECT id_tintuc,tieude FROM tbltintucs WHERE tieude='".$element[0]->innertext."'");
					
				if(count($data)==0){
					$tbltt->query("insert into tbltintucs(tieude,noidung,ngaythang,id_theloai) values('".$element[0]->innertext."','".$content."','".date('y/m/d h:i:s',time())."',".$idloai.")");
				}
				print_r("<p>".$p[0]->outertext."</p");
			}
		} catch (Exception $e) {
			echo "error";
		}

	}
	//30/4/2014
	function createTopRight(){
		$tbltt = new Common();
		$data=$tbltt->query("SELECT id_tintuc,tieude FROM tbltintucs where id_theloai=5 ORDER BY ngaythang DESC LIMIT 0,5");
		$topright="<div class='div-text'><ul id='tabs'><li><a href='#' name='tab1'>Thông báo</a></li>";
		$topright.="<li><a href='#' name='tab2'>Chính sách mới</a></li></ul>";
		$topright.="<div id='contenttab'><div id='tab1' class='blockcontent-body'>";
		foreach ($data as $dt){
			$tt=$dt['tbltintucs']['tieude'];
			$topright.="<ul><li>".$this->link($tt,array('controller' => 'Tbltintucs','action' => 'view',$dt['tbltintucs']['id_tintuc']))."</li></ul>";
		}
		$topright.="</div><div id='tab2' class='blockcontent-body'></div></div></div>";
		return $topright;
	}

	//
	//ham lay noi dung tom tat
	function noidungtt($sotu, $noidung) {
		$noidung=trim($noidung);
		$n = explode(" ", $noidung);
		$noidunginra = " ";
		if ($sotu <= count($n)) {
			for ($i = 0; $i < $sotu; $i++){
				$noidunginra.= $n[$i] . " ";
			}
			$noidunginra.="...";
		}
		return $noidunginra;
	}

}
?>