<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
echo $this->Common->create_heaeder($title_for_layout);
?>
            <div class="clear"></div>
            <div id="banner-main">
                <div class="div-images" >
                    <?php echo $this->Common->slideImage(); ?>
                </div>
                <div class="div-text"><ul id="tabs">
                        <li><a href="#" name="tab1">Tin nổi bật</a></li>
                        <li><a href="#" name="tab2">Tin mới nhất</a></li>       
                    </ul>

                    <div id="contenttab"> 
                        <div id="tab1" class="blockcontent-body">                         
                        </div>
                        <div id="tab2" class="blockcontent-body">    
                        </div>
                    </div>
                </div>


            </div>
            <div class="clear"></div>
            <div id="main">
            
                <div id="sidebar-right">
                
                <?php echo $this->Common->create_right(); ?>
                    
                </div>
                <div class="content1">
                    <div class="content">
                    
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="cach"></div>
            
          <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>;
	</div></body></html>
        