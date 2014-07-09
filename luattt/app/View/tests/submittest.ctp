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
                 <div class="title">KẾT QUẢ BÀI THI</div>
                    <div class="content2">
                    <p>Xin chào: <?php echo $this->Session->read("Username");?> Kết quả bài thi của bạn:</p>
                   
                    <?php
                    	echo "<p> Số câu lời đúng:".$this->Session->read("numbercorect")."/20</p>";
                    	echo "<p>Điểm: ".$this->Session->read("core")."</p>";
                    	
                    ?>
                    </div>
                      <div class="title">ĐÁP ÁN</div>
                      <?php 
                      $page=isset($page)?$page:1;
                      $i=($page-1)*10+1;
                      $html="<div class='content2'>";
                      foreach($data as $item){
                      		$html.="<p><strong>Câu ".$i.": ".$item[0]['Question']['title']." </strong></p>";
                    		$methods=$item[0]['Method'];
                    		
                    		$char='A';
                    		//kiem tra dap an dung sai
                    		foreach($methods as $method){
                    		$check="";
                    		$class="";
                    		if($method['id']==$item['chekmethod']){
                    			$check="checked";
                    			$class="increct";
                    		}
                    		if($method['corect']!=null && $method['corect']==1){
                    			$class="corect";
                    		}
                			$html.=$char.") <span class='".$class."'><input  type='radio' name='".$item[0]['Question']['id']."' disabled value='".$item[0]['Question']['id']."-".$method['id']."' ".$check.">".$method['content']."</span><br>";
                    			$char++;
                    		}
                    		$i++;
                      }
                      $html.="</div><div id='paging' class='right'>".$this->Common->link('Trước',array('controller' => 'Tests','action' => 'viewResult','full_base' => true,($page>1?($page-1):1)));
                    	$html.=$this->Common->link(1,array('controller' => 'Tests','action' => 'viewResult','full_base' => true,1));
                    $html.=$this->Common->link(2,array('controller' => 'Tests','action' => 'viewResult','full_base' => true,2));                
                     $html.=$this->Common->link('Sau',array('controller' => 'Tests','action' => 'viewResult','full_base' => true,($page<2?($page+1):2)))."</div>";
                    	
                    	echo $html;
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="cach"></div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>;
	</div></body></html>
        