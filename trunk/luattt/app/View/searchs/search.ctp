<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
//van ban chinh sach
//$this->Common->getRss("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=60BA73DF-77BC-4E2B-A006-82B37A1C39C6",5);
echo $this->Common->create_heaeder();
$gerne=$this->Common->general();
?>
<div id='bttop'>BACK TO TOP</div></head>
<body>

<div id='wrapper'><div id='header'><?php echo $gerne['header'] ?></div><div class='cach'></div>
<div id='menu-nav'><?php echo $this->Common->create_menu($this->Session->read('Username'));?></div>
       <div class="clear"></div>
            <div id="banner-main">
                <div class="div-images" >
                    <?php echo $this->Common->slideImage(); ?>
                </div>
                <?php echo $this->Common->createTopRight()?>


            </div>
            <div class="clear"></div>
            <div id="main">
            
                <div id="sidebar-right">
                
                <?php echo $this->Common->create_right(); ?>
                    
                </div>
                <div class="content1">
                 <div class="title"><?php echo $this->Html->link(__('Trang chủ'),'/users',array('class'=>'title'));?>>Kêt quả tìm kiếm</div>
                    <div class="content2">
                    <?php
                    if(count($data)<=0)
                    	echo "<h3>Không tìm thấy</h3>";
                   // print_r($data);
                   else{
                    $html="";
                    foreach ($data as $item){
                    	$html.="<div class='consulting'><a href='/".$item['url']."' style='font-size:16px;'>".$this->User->noidungtt(10,$item['title'])."</a><br>";
                    	$html.="<i style='color: #008000;'>".$item['url']."</i>";
                    	$html.="<p>".$this->User->noidungtt(50,$item['decription'])."</p></div>";
                    }
                    echo $html;
                    }
                    ?>
                    </div>
                </div>
            </div>
           <div id='footer' class='clear'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>
	</div></body></html>
        