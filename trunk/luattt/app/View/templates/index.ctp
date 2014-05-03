<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
//van ban chinh sach
$this->Common->getRss("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=60BA73DF-77BC-4E2B-A006-82B37A1C39C6",5);
echo $this->Common->create_heaeder($this->Session->read('Username'));

?>
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
                   <div class="title">PHỔ BIẾN KIẾN THỨC PHÁP LUẬT</div>
                	<div class="content">
                    
                    	<?php $this->Common->getRssPhobien("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=976539B6-94DB-48F3-9186-3F6F47C3DA1A",8);
                    	echo $this->Contentnews->hienthinoidung(8);?>

                	</div>
                </div>
                
                <div class="content1">
                   <div class="title">TIN TỨC SỰ-KIỆN</div>
                	<div class="content">
                    
                    	<?php $this->Common->getRss("http://www.moj.gov.vn/_layouts/GenRss.aspx?List=9BB9ECE7-A84C-4671-A699-2EC8D1F7FE9D",7);
                    	echo $this->Contentnews->hienthinoidung(7);?>

                	</div>
                </div>
                <div class="clear"></div>
            </div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>
	</div></body></html>
        