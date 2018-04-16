<?php /* Smarty version 2.6.26, created on 2014-09-01 19:57:25
         compiled from explore_league.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats :: League</title>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>

<div class="wrapper">
<?php if (isset ( $this->_tpl_vars['userLoggedIn'] )): ?>
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
   
   <ul class="breadcrumb">
      <li><a href="index.php">Home  &#8594;</a></li>
      <li><a href="user.php?u_id=<?php echo $this->_tpl_vars['league']->getUserID(); ?>
"><?php echo $this->_tpl_vars['league']->getName(); ?>
  &#8594;</a></li>
      <li><?php echo $this->_tpl_vars['league']->getName(); ?>
</li>
   </ul>
   
   <div class="clear"></div>
   
   <h2><?php echo $this->_tpl_vars['league']->getName(); ?>
</h2>  

   <h3>Seasons</h3>

   <ul>
   <?php $_from = $this->_tpl_vars['leagueSeasons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['season']):
?>
         <li><a href="season.php?s_id=<?php echo $this->_tpl_vars['season']->getSeasonID(); ?>
"><?php echo $this->_tpl_vars['season']->getName(); ?>
</a></li>
   <?php endforeach; endif; unset($_from); ?>
   </ul>
   
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