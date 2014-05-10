
<?php 
 	
    echo $this->Html->css('styles.css');
	  echo $this->Html->script('jquery-1.7.2.min.js');
	  echo $this->Html->script('validate.js');
	  echo $this->Common->create_heaeder();
?>

<div id='wrapper'>
<?php echo $this->element('navigation');?>
<div id="mainpanel" class="border left" style="width:960px;">
<div class="left containlogin">
	<div class="left alertinfo"><?php echo $this->Session->flash('auth');?></div>
  <div class='login loginforum left'>
  <div class='title'><h1>Login</h1></div>
  <form method='post' action='/luatvnam/users/login'>
  <p><input type='text' id='username' name='username' value='' placeholder='Username'></p>
  <input type='password' id='password' name='password' value='' placeholder='Password'></p>
  <input type='hidden' name='reforums' value='forum url' type='hidden'/>   
  <p id='btnLogin' class='submit'><input type='submit' name='ok' value='Login'></p>
  </form>
  </div>
</div>


</div>
<div class="cach clear"></div>
<div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>
</div>
</body
</html>