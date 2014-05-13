<div>
banner
</div>
<div id='menu-nav'> 
          <ul class='nav'>
           
            <li class='trangchu'><?php echo $this->Html->link(_('Trang chủ'),array('controller' => 'users','action' => 'index','full_base' => true))?></li>
             <?php if(!$this->Session->check('Auth.User')):?>
            <li style='float:right'><?php echo $this->Html->link(__('Đăng nhập'),array('controller'=>'users','action'=>'login'))?></li>
            <?php else: ?>
            <li style='float:right' class="dropdown">
              <a href="#">Chào <?php echo $this->Session->read('Auth.User.username');?> <b class="caret"></b></a>
              <ul class="subnav">
                 <li class="subdrop">
                    <?php echo $this->Html->link(__('Profile'),array('controller'=>'users','action'=>'profile'))?>
                 </li>
                 <li>
                    <?php echo $this->Html->link(__('Logout'),array('controller'=>'users','action'=>'logout'))?>
                 </li>
              </ul>
            </li>
            <?php endif;?>
          </ul>
</div>
<div class='cach'></div>
