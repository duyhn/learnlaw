<div id="header">
<div id='logo' style='width:970px;'>
<?php echo $this->Html->image("image/logo.jpg", array('alt' => 'luatvn', 'class' => 'logoleft')) ?>
<?php echo $this->Html->image("image/forum.png",array('alt' => 'luatvn','style' => 'margin:10px 0 0 10px')) ?>
<div class='today' style="width:250px;text-align:right">Hôm nay: <?php echo date('d-m-Y') ?>
<div  class='right' style="margin-top:30px"><form class="right" style="width:350px;" action="/luatvnam/topics/search" method="POST"><input type="text" id="search" name="infoTopic" style="width:200px;margin-top:9px;"/>
<input class="icsearch" id="btnsearchForum" type="submit" name="searchForum" value=""/></form></div>
</div>
</div>
</div>
<div id='menu-nav'> 
          <ul class='nav'>
           
            <li class='trangchu'><?php echo $this->Html->link(_('Trang chủ'),array('controller' => 'users','action' => 'index','full_base' => true))?></li>
             <li class='trangchu'><?php echo $this->Html->link(_('Diễn đàn'),array('controller' => 'Forums','action' => 'index','full_base' => true))?></li>
             <?php if(!$this->Session->read("Username")){?>
			<li style='float:right'><?php echo $this->Html->link(__('Đăng nhập'),array('controller'=>'users','action'=>'login'))?></li>           
           	  <li style='float:right'><?php echo $this->Html->link(__('Đăng ký'),array('controller'=>'users','action'=>'register'))?></li>
            <?php }else{ ?>
            <li style='float:right' class="dropdown">
              <a href="#">Chào <?php echo $this->Session->read('Username');?> <b class="caret"></b></a>
              <ul class="subnav">
                 <li class="subdrop">
                    <?php echo $this->Html->link(__('Cá nhân'),array('controller'=>'users','action'=>'profile',$this->Session->read('Username')))?>
                 </li>
                 <li>
                    <?php echo $this->Html->link(__('Thoát'),array('controller'=>'users','action'=>'logout'))?>
                 </li>
              </ul>
            </li>
            <?php }?>
          
          </ul>
</div>
<div class='cach'></div>
