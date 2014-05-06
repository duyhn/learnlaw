<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
 	echo $this->Session->flash('auth');
    echo $this->Html->css('styles.css');
	  echo $this->Html->script('jquery-1.7.2.min.js');
	  echo $this->Html->script('validate.js');
?>
</head>
<body>
<?php echo$this->element('menu'); ?>
<?php echo $this->element('navigation');?>
<div id='wrapper'>

<?php  	
  $login = "<div class='login loginforum'>";
  $login.="<div class='title'><h1>Login</h1></div>";
  $login.="<form method='post' action='/luatvnam/users/login'>";
  $login.="<p><input type='text' id='username' name='username' value='' placeholder='Username'></p>";
  $login.="<input type='password' id='password' name='password' value='' placeholder='Password'></p>"; 
  $login.="<input type='hidden' name='reforums' value='forum url' type='hidden'/>";    
  $login.="<p id='btnLogin' class='submit'><input type='submit' name='ok' value='Login'></p>";
  $login.="</form></div>";
  echo $login;
?>

</div>
<div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>;
</body>
</htlm>