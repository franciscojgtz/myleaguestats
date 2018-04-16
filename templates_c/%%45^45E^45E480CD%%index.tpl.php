<?php /* Smarty version 2.6.26, created on 2018-02-03 23:38:37
         compiled from index.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats::Login</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

<script type="text/javascript" src="javascript/recaptcha-theme.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php echo '
<script>
$(document).ready(function(){
  $(".hideform").click(function(){
    $("form").hide();
     $(".showform").show();
  });
  $(".showform").click(function(){
    $("form").show();
    $(".showform").hide();
  });
  $("form").hide();

});
</script>
'; ?>


</head>

<body id="index-page">

<div class="wrapper">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="content">

<div class="primary">

<p class="errormsg"><?php echo $this->_tpl_vars['user_error']; ?>
</p>

<p class="errormsg"><?php echo $this->_tpl_vars['captcha_error']; ?>
</p>
  
   <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
      <p class="errormsg">       
      <?php echo $this->_tpl_vars['error']; ?>

      </p>
   <?php endforeach; endif; unset($_from); ?>
   
   <p>For a demo login with the following credentials: <br/>
		username: demo@gutierrezfrancisco.net<br/>
		password: DemoPass1 (make sure to use the capital letters)</p>
   
	<p class="showform"><a href="#">Show Log In Form</a></p>

  <form class="pure-form pure-form-stacked" method='post' action='' accept-charset='UTF-8'>
  
  		<p class="hideform"><a href="#">Hide Log In Form</a></p>
  
  		<h1>Login Form</h1>
  
    	<div class="loginfields">    
    		<p><label for="memberuseremail">email</label> <input type="email" name="memberuseremail" id="memberuseremail" value="<?php echo $this->_tpl_vars['memberuser']; ?>
" placeholder="email" required/> </p>
    		<p><label for="memberpassword">password</label> <input type="password" name="memberpassword" id="memberpassword" placeholder="password" required/> <br /></p>
    	</div>
    
    	<div class="loginrecaptcha">   
    		<?php echo $this->_tpl_vars['recaptcha']; ?>
 
    		
    		<p class="form-buttons"><input type="submit" name="submit" id="submit" value="Submit" class="pure-button pure-button-primary"/>
    	<a href="forgotpassword.php">Forgot Password?</a></p>
	 	</div>
	 	
	 	<div class="clear"></div>

  </form>
  
  <div class="clear"></div>
  
  <h1>Explore Users</h1>
  
  <ul>
  		<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['user']):
?>
         <li><a href="user.php?u_id=<?php echo $this->_tpl_vars['user']->getUserID(); ?>
"><?php echo $this->_tpl_vars['user']->getName(); ?>
</a></li>
   	<?php endforeach; endif; unset($_from); ?>
  </ul>

</div>

<div class="secondary"> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'navigation.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'promo.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>

<!--analytics code-->
<?php echo '
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-30483345-1\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
'; ?>


</body>
</html>