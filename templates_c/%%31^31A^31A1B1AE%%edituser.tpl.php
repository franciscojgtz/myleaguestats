<?php /* Smarty version 2.6.26, created on 2018-02-04 00:17:56
         compiled from edituser.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats::Edit User</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

</head>

<body>

<div class="wrapper">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'headerloggedin.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="content">

<div class="primary">
  
   <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
      <p class="errormsg">       
      <?php echo $this->_tpl_vars['error']; ?>

      </p>
   <?php endforeach; endif; unset($_from); ?>
    <h1>Edit User</h1>
  <?php if ($this->_tpl_vars['userLoggedIn']->getEmail() != 'demo@gutierrezfrancisco.net'): ?>
  <form class="pure-form pure-form-stacked" method='post' action='' accept-charset='UTF-8'>
  <fieldset>

    <ul class="editmenu">
      <li><a href="changepassword.php?u_id=<?php echo $this->_tpl_vars['userLoggedIn']->getUserID(); ?>
">Change Password</a></li>
      <li><a href="deleteuser.php?u_id=<?php echo $this->_tpl_vars['userLoggedIn']->getUserID(); ?>
">Delete User</a></li>
    </ul>  
    
    <div class="clear"></div>
  
    <p>Change your user information by filling in the following form</p>

    <p><label for="editusername">new username</label> <input type="text" name="editusername" id="editusername" value="<?php echo $this->_tpl_vars['memberuser']; ?>
" placeholder="new username" required/> </p>
    <p class="form-buttons"><input type="submit" name="submit" id="submit" value="Submit" class="pure-button pure-button-primary"/>
    <a href="index.php" class="pure-button pure-button-primary">Cancel</a></p>
  </fieldset>
  </form>
  <?php else: ?>
    <p>Demo user cannot make changes. Please go back or click home to return.</p>
  <?php endif; ?>

</div>

<div class="secondary">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'navigationloggedin.tpl', 'smarty_include_vars' => array()));
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