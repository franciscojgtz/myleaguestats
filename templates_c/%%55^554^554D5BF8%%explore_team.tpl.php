<?php /* Smarty version 2.6.26, created on 2014-10-14 23:20:12
         compiled from explore_team.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'explore_team.tpl', 38, false),array('modifier', 'date_format', 'explore_team.tpl', 64, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats :: Team</title>

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
      <li><a href="index.php">Home &#8594;</a></li>
      <li><a href="user.php?u_id=<?php echo $this->_tpl_vars['user']->getUserID(); ?>
"><?php echo $this->_tpl_vars['user']->getName(); ?>
 &#8594;</a></li>
      <li><?php echo $this->_tpl_vars['team']->getName(); ?>
</li>
   </ul>
   
   <div class="clear"></div>
   
   <h2><?php echo $this->_tpl_vars['team']->getName(); ?>
</h2>  

	<!--<h2>Check out the standings</h2>

<?php $_from = $this->_tpl_vars['team']->getStandingsWhereTeamIsPartOf(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['standing']):
?>
	<ul class="<?php echo smarty_function_cycle(array('values' => "evenrow,oddrow"), $this);?>
">
      <li><a href="season.php?s_id=<?php echo $this->_tpl_vars['standing']->getSeasonID(); ?>
"><?php echo $this->_tpl_vars['standing']->getSeasonName(); ?>
</a></li>
<?php endforeach; else: ?>
	<p class="errormsg">No standings to show</p>
   </ul>
<?php endif; unset($_from); ?>-->

<h2>Upcoming Games</h2>


<table class="gametable">
<tr>
<th>Rnd</th>
<th>Home Team</th>
<th>VS</th>
<th>Away Team</th>
<th>Date</th>
<th>Time</th>
<th>Place</th>
</tr>
<?php $_from = $this->_tpl_vars['team']->getUpcomingGames(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['game']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "evenrow,oddrow"), $this);?>
">
	<td><a href="season.php?s_id=<?php echo $this->_tpl_vars['game']->getSeasonID(); ?>
"><?php echo $this->_tpl_vars['game']->getGameRound(); ?>
</a></td>
	<td><a href="team.php?t_id=<?php echo $this->_tpl_vars['game']->getLocalTeamID(); ?>
"><?php echo $this->_tpl_vars['game']->getLocalTeam(); ?>
</a></td> 
	<td>vs</td> 
	<td><a href="team.php?t_id=<?php echo $this->_tpl_vars['game']->getVisitorTeamID(); ?>
"><?php echo $this->_tpl_vars['game']->getVisitorTeam(); ?>
</a></td>
	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['game']->getGameDate())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td> 
	<td><?php echo $this->_tpl_vars['game']->getGameTime(); ?>
</td> 
	<td><?php echo $this->_tpl_vars['game']->getPlace(); ?>
</td> 
	</tr>
<?php endforeach; else: ?>
	<p class="errormsg">No games to show</p>
<?php endif; unset($_from); ?>
</table>


<br />

<h2>Latest Games</h2>

<table class="gametable">
<tr>
<th>Rnd</th>
<th>Home Team</th>
<th>VS</th>
<th>Away Team</th>
<th>Date</th>
<th>Time</th>
<th>Place</th>
</tr>
<?php $_from = $this->_tpl_vars['team']->getLatestGames(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['game']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => "evenrow,oddrow"), $this);?>
">
	<td><a href="season.php?s_id=<?php echo $this->_tpl_vars['game']->getSeasonID(); ?>
"><?php echo $this->_tpl_vars['game']->getGameRound(); ?>
</a></td>
	<td><a href="team.php?t_id=<?php echo $this->_tpl_vars['game']->getLocalTeamID(); ?>
"><?php echo $this->_tpl_vars['game']->getLocalTeam(); ?>
</a></td> 
	<td><?php echo $this->_tpl_vars['game']->getLocalTeamGoals(); ?>
 vs <?php echo $this->_tpl_vars['game']->getVisitorTeamGoals(); ?>
</td> 
	<td><a href="team.php?t_id=<?php echo $this->_tpl_vars['game']->getVisitorTeamID(); ?>
"><?php echo $this->_tpl_vars['game']->getVisitorTeam(); ?>
</a></td>
	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['game']->getGameDate())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td> 
	<td><?php echo $this->_tpl_vars['game']->getGameTime(); ?>
</td> 
	<td><?php echo $this->_tpl_vars['game']->getPlace(); ?>
</td>
	</tr>
<?php endforeach; else: ?>
	<p class="errormsg">No games to show</p>
<?php endif; unset($_from); ?>
</table>

<div class="clear"></div>
   
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