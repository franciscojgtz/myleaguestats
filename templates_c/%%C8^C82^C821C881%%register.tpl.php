<?php /* Smarty version 2.6.26, created on 2018-04-17 23:13:52
         compiled from register.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats :: Register</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

<script type="text/javascript" src="javascript/recaptcha-theme.js"></script>

</head>

<body>

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

   <h1>Register</h1>
   
  <form class="pure-form pure-form-stacked" method='post' action='' accept-charset='UTF-8'>

    <p><label for="memberusername">username</label> <input type="text" name="memberusername" id="memberusername" value="<?php echo $this->_tpl_vars['memberuser']; ?>
" placeholder="username" required/> </p>
    <p><label for="memberuseremail">email</label> <input type="email" name="memberuseremail" id="memberuseremail" value="<?php echo $this->_tpl_vars['memberemail']; ?>
" placeholder="email" required/> </p>
    <p><label for="memberuseremailverified">Re-enter email</label> <input type="email" name="memberuseremailverified" id="memberuseremailverified" placeholder="verify email" required/> </p>
    <p><label for="memberpassword">password</label> <input type="password" name="memberpassword" id="memberpassword" placeholder="password" required/></p>   
    <p><label for="memberpasswordverified">Re-enter password</label> <input type="password" name="memberpasswordverified" id="memberpasswordverified" placeholder="verify password" required/><br /></p>   
    <?php echo $this->_tpl_vars['recaptcha']; ?>
 

    <p class="form-buttons"><input type="submit" name="submit" id="submit" value="Submit"  class="pure-button pure-button-primary"/></p>

  </form>

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