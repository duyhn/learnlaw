<?php
App::import("Model", "Common");
include_once('simple_html_dom.php');
class CommonHelper extends HtmlHelper{

	function general(){
		$footer="<span>Bản quyền (C) 2013 thuộc Võ Thị TƯờng Vy</span></br><span>Trường Đại học Bách Khoa - Đại học Đà Nẵng</span></br>";
		$footer.="<span>Địa chỉ: 272 Thái Thị Bôi, Quận Thanh Khê, Đà Nẵng</span></br><span>Điện thoại: 0905743649</span>";
		$header="<div id='logo'>".$this->image("image/logo2.png", array('alt' => 'lawVN'))."</div><div class='today'>Hôm nay :". date('d-m-Y')."</div> <div class='clear'></div>";
		$data = array(
				"header" => $header,
				"footer" => $footer,
		);

		return $data;
	}
	//
	function create_heaeder(){
		$tt="Learn Law";
		$data= $this->general();
		$header="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'> <html xmlns='http://www.w3.org/1999/xhtml'><head>";
		$header.=$this->charset();
		$header.="<title>".$tt."</title>";
		$header.=$this->css(array("styles.css","lightbox.css","tabs.css"));
		$header.= $this->script(array('jquery-1.7.2.min.js','validate.js','lightbox.js','jcarousellite_1.0.1c4.js','jquery.jgfeed','news.js','general.js','highlightNav.js'));
		$header.=$this->css(array("themes/1/js-image-slider.css","generic.css"));
		$header.= $this->script(array('themes/1/js-image-slider.js','slideShow.js'));
		
			
		//$header.="<div id='bttop'>BACK TO TOP</div></head>";
		//$header.="<body>";
		//$header.="<div id='wrapper'><div id='header'>".$data['header']."</div><div class='cach'></div>";
		//$header.="<div id='menu-nav'>".$this->create_menu($username)."</div>";

		return $header;
	}
	//
	function create_footer(){
		$data= $this->general();

		$footer="<div id='footer'>".$data['footer']."</div>";
		$footer.="</div></body></html>";
	}
	//
	function create_menu($username){

		$menu="<ul class='nav'><li class='highlight'>".$this->link('Trang chủ',array('controller' => 'users','action' => 'index','full_base' => true)
		)."</li><li class=''>";
		$menu.=$this->link('Giới thiệu',array('controller' => 'gioithieu','action' => '','full_base' => true));		
		$menu.="</li><li class=''>".$this->link('Tin tức-sự kiện',array('controller' => 'tintuc','action' => '','full_base' => true))."<ul>";
		/*include_once('includes/connect-db.inc');
		 $query = mysql_query("SELECT * FROM tbltheloai,tbltintuc WHERE tbltheloai.id_theloai=tbltintuc.id_theloai GROUP BY tbltintuc.id_theloai");
		 while ($row = mysql_fetch_array($query)) {
		 echo '<li><a href="?mod=ndTin&id_theloai=' . $row['id_theloai'] . '">' . $row['ten_theloai'] . '</a></li>';
		 }*/
		$menu.="</ul></li><li class=''>".$this->link('Download',array('controller' => 'Uploads','action' => 'index','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Diễn đàn',array('controller' => 'Forums','action' => 'index','full_base' => true))."</li>";
		$menu.="<li class=''>".$this->link('Thi online',array('controller' => 'tests','action' => '','full_base' => true))."</li>";

		if(!isset($username)){
			$menu.="<li id='' style='float:right'>".$this->link('Đăng ký',array('controller' => 'users','action' => 'register','full_base' => true))."</li>";
			$menu.="<li id='login' style='float:right'><a href='#'>Đăng nhập</a></li>";
				
		}
		else {
			$menu.="<li style='float:right'>".$this->link('Thoát',array('controller' => 'users','action' => 'logout','full_base' => true))."</li>";
			$menu.="<li style='float:right'>".$this->link('Cá nhân',array('controller' => 'users','action' => 'profile','full_base' => true,$username))."</li>";
			$menu.="<span class='titlelog'>Xin chào: ".$username." </span>";
		
		}
		$menu.=$this->login()."</ul>";
		return $menu;
	}
	function create_right(){
		$time = new CommonModel();
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
			$right.=$this->image("anhTintuc/".$item['tbltintucs']['ten_anh'], array('repeat alt' =>"img".$item['tbltintucs']['id_tintuc'],'title'=>$this->noidungtt(10, $item['tbltintucs']['tieude'])));
			//$right.="<img src='anhTintuc/".$item['tbltintucs']['ten_anh']."' repeat alt='".$item['tbltintucs']['tieude']."' title='".$item['tbltintucs']['tieude']."' />";
			$right.="</div><div class='info'>";
			$tt=$this->noidungtt(12, $item['tbltintucs']['tieude']);
			$right.=$this->link($tt,array('controller' => 'Tbltintucs','action' => 'view',$item['tbltintucs']['id_tintuc']))."</div><div class='clr'></div></li>";
		}
		$right.="</ul></div></div>";
		/*$right.="<div class='block' id='link'>";
		 $right.="<div class='block-title'>THĂM DÒ <div id='show' class='mo3'>-</div> <div id='show' class='dong3'>+</div></div>";
		 $right.="<div class='block-content' id='link13'><div class='div-limited'>";
		 /*<?php
		 // error_reporting(0);
		 include('modules/giaodien/poll.module.php');
		 ?>*/
		//$right.="</div></div></div>";
		$right.="<div class='block' id='link'><div class='block-title'>Thống Kê</div>";
		$right.="<div class='block-content' style='height: 50px; padding: 10px 0 10px 10px;'>";
		/*$data=$time->query("select * from thamdos order by qid desc");*/
		$right.=$this->create_countvisiter();
		$right.=$this->create_countonline();

		$right.="</div></div><div id='backgroundPopup'></div>";
		return $right;
	}
	function create_countonline(){
		$time = new CommonModel();
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
		$time = new CommonModel();
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
		$time = new CommonModel();
		$data=$time->query("SELECT id_tintuc,ten_anh,tieude FROM tbltintucs WHERE hien_an = 1 LIMIT 0,7");
		$slider="<div id='sliderFrame'><div id='slider'>";
		foreach($data as $item){
			$slider.=$this->image("anhTintuc/".$item['tbltintucs']['ten_anh'], array('repeat alt' => $item['tbltintucs']['tieude'],'title'=>$item['tbltintucs']['id_tintuc']));
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
			$tbltt = new CommonModel();
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
			$tbltt = new CommonModel();
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
				$p=$html->find("p.des");
				//$divMota=$html->find("div.mota");
				$divcontent=$html->find("div.box-content-news-detail");
				$content="<div>".$p[0]->outertext."".$divcontent[0]->outertext."</div>";
				//lu vao csdl
				$data=$tbltt->query("SELECT id_tintuc,tieude FROM tbltintucs WHERE tieude='".$element[0]->innertext."'");
					
				if(count($data)==0){
					$tbltt->query("insert into tbltintucs(tieude,noidung,ngaythang,id_theloai) values('".$element[0]->innertext."','".$content."','".date('y/m/d h:i:s',time())."',".$idloai.")");
				}
			}
		} catch (Exception $e) {
			echo "error";
		}

	}
	//30/4/2014
	function createTopRight(){
		$tbltt = new CommonModel();
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
	function getCauhoi($urlrss,$idloai=null){
	
		try {
			//include_once('simple_html_dom.php');
			$tbltt = new CommonModel();
			$dom=new DOMDocument('1.0','utf-8');//tao doi tuong dom
			$dom->load($urlrss)    ;//muon lay rss tu trang nao thi ban khai bao day
			$items = $dom->getElementsByTagName("item");//lay cac element co tag name la item va gan vao bien $items
			$dom1=new DOMDocument('1.0','utf-8');
			$i=0;
			$data="<table>";
			foreach($items as $item)//lap
			{
// 				$i++;
// 				if($i==5)
// 					break;
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
				$spanNgay=$html->find("span");
				$data.="<tr><td>".$element[0]->innertext."<td><td>".$spanNgay[0]->outertext."</td></tr>";
				$divMota=$html->find("div.one_answer");
				//$content="<div>".$divMota[0]->outertext."".$divcontent[0]->outertext."</div>";
				//lu vao csdl
				//$datas=$tbltt->query("SELECT * FROM consultings WHERE title='".$element[0]->innertext."'");
				//if(count($datas)==0){
				//$tbltt->query("insert into consultings(typeconsulting_id,title,content,auther) values(1,'".$element[0]->innertext."','".$spanNgay[0]->outertext."','guest')");
				//$datas=$tbltt->query("SELECT * FROM consultings WHERE title='".$element[0]->innertext."'");
				//$tbltt->query("insert into resultconsultings(consulting_id,title,content,user_id) values(".$datas['consultings']['id'].",'".$element[0]->innertext."','".$divMota[0]->outertext."',1)");
				//}
			}
			$data.="</table>";
			return $data;
		} catch (Exception $e) {
			echo "error";
		}
		return "";
	
	
	}
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