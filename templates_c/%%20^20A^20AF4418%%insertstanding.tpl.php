<?php /* Smarty version 2.6.26, created on 2014-10-01 23:00:42
         compiled from insertstanding.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats::Insert Standing</title>

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

   <h1>Add Standing</h1>
   
  <form class="pure-form pure-form-stacked" method='post' action='' accept-charset='UTF-8'>
    
    <legend>Add a team to  the Standing table by filling in the following form</legend>
    
    <select name="dropdownteam">
    <?php $_from = $this->_tpl_vars['user_teams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['user_teams']):
?>        
    <option value='<?php echo $this->_tpl_vars['user_teams']->getTeamID(); ?>
' ><?php echo $this->_tpl_vars['user_teams']->getName(); ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
    </select> 
    
    <label for="gameswon">Games Won</label>
    <input type="number" id="gameswon" name="gameswon" size="3" value="<?php echo $this->_tpl_vars['games_won']; ?>
"/>
    <label for="gamestied">Games Tied</label>
    <input type="number" id="gamestied" name="gamestied" size="3" value="<?php echo $this->_tpl_vars['games_tied']; ?>
"/>
    <label for="gameslost">Games Lost</label>
    <input type="number" id="gameslost" name="gameslost" size="3" value="<?php echo $this->_tpl_vars['games_lost']; ?>
" />
    <label for="goalsfavor">Goals in Favor</label>
    <input type="number" id="goalsfavor" name="goalsfavor" size="3" value="<?php echo $this->_tpl_vars['goals_favor']; ?>
" />
    <label for="goalsagainst">Goals Against</label>
    <input type="number" id="goalsagainst" name="goalsagainst" size="3" value="<?php echo $this->_tpl_vars['goals_against']; ?>
" />
    <label for="pointsdeducted">Points Deducted</label>
    <input type="number" id="pointsdeducted" name="pointsdeducted" size="3" value="<?php echo $this->_tpl_vars['pts_deducted']; ?>
" />
    <label for="bonuspoints">Bonus Points</label>
    <input type="number" id="bonuspoints" name="bonuspoints" size="3" value="<?php echo $this->_tpl_vars['bonus_pts']; ?>
" />
    
    <p class="form-buttons"><input type="submit" name="submit" id="submit" value="Submit" class="pure-button pure-button-primary"/>
    <a href="season.php?s_id=<?php echo $this->_tpl_vars['season']->getSeasonID(); ?>
" class="pure-button pure-button-primary">Cancel</a></p>

  </form>

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