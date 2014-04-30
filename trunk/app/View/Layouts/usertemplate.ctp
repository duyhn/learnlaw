<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title><?php echo $title_for_layout;?></title>
        
        <?php echo $this->Html->css("styles.css"); 
        	echo $this->Html->css("lightbox.css");
        	echo $this->Html->css("tabs.css");
        ?> 
		<?php $general = $this->Common->general();?>
		<?php 
		
		echo $this->Html->script('jquery-1.7.2.min.js');
		echo $this->Html->script('validate.js');
		echo $this->Html->script('lightbox.js');
		echo $this->Html->script('jcarousellite_1.0.1c4.js');
		echo $this->Html->css("themes/1/js-image-slider.css");
		echo $this->Html->css("generic.css");
		echo $this->Html->script('themes/1/js-image-slider.js');
		echo $this->Html->script('slideShow.js');
		?>
        <div id='bttop'>BACK TO TOP</div>
    </head>

    <body onload="showhide('#link11', 1);
                showhide('#link12', 2);
                showhide('#link13', 3);
                showhide('#link14', 4);">
        <div id="wrapper">
            <div id="header"><?php echo $general['header']; ?></div>
            <div class="cach"></div>
            <div id="menu-nav"><?php echo $this->Common->create_menu(); ?></div>
            <div class="clear"></div>
            <div id="banner-main">
                <div class="div-images" >
                    <?php echo $this->Common->slideImage(); ?>
                </div>
                <div class="div-text"><ul id="tabs">
                        <li><a href="#" name="tab1">Tin Sinh Viên</a></li>
                        <li><a href="#" name="tab2">Tin Giaìo Viên</a></li>       
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
            <div id="footer"><?php echo $general['footer'];?></div>

        </div>
    </body>
</html>