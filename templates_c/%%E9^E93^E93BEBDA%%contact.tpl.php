<?php /* Smarty version 2.6.26, created on 2018-02-03 23:48:01
         compiled from contact.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mailto', 'contact.tpl', 37, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats :: Contact</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

<script type="text/javascript" src="javascript/recaptcha-theme.js"></script>

</head>

<body>

<div class="wrapper">
<?php if ($this->_tpl_vars['user_id'] != ''): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'headerloggedin.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<div class="content">

<div class="primary">

   <h1>Contact Us</h1>
   
   <p>Contact us and let us know what you think. If you have any suggestion on how to improve myleaguestats.com,
    we will be happy to know. If you have an amateur soccer league and would like share your 
    statistics on myleaguestats.com, send us an email and let us know. We will be happy to add more statistics. You can find
    some instructions <a href="instructions.php">here</a>.
    For anything else, send us an email. </p>

   <p>email us at: <?php echo smarty_function_mailto(array('address' => "admin@gutierrezfrancisco.net",'subject' => 'Comment from My League Stats'), $this);?>
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

   <h2>Contact Form</h2>
   
  <form class="pure-form pure-form-stacked" method='post' action='' accept-charset='UTF-8'>
    

    <p><label for="name">name</label><input type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['name']; ?>
" placeholder="name" required/> </p>
    <p><label for="email">email</label> <input type="text" name="email" id="email" value="<?php echo $this->_tpl_vars['email']; ?>
" placeholder="email" required/></p>
    <p><label for="message" >message</label>
    <textarea name="message" id="message" rows="10" cols="80" placeholder="type your message" required ><?php echo $this->_tpl_vars['message']; ?>
</textarea><br /></p>    
    <?php echo $this->_tpl_vars['recaptcha']; ?>
 

    <p class="form-buttons"><input type="submit" name="submit" id="submit" value="Submit" class="pure-button pure-button-primary"/></p>

  </form>
   
</div>

<div class="secondary">
<?php if ($this->_tpl_vars['user_id'] != ''): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'navigationloggedin.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'navigation.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

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