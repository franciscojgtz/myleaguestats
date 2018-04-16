<?php /* Smarty version 2.6.26, created on 2014-09-24 06:19:54
         compiled from insertgame.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', 'insertgame.tpl', 58, false),array('function', 'html_select_time', 'insertgame.tpl', 61, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats::Insert Game</title>

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

   
   <h1>Add Game</h1>
   
  <form class="pure-form" method='post' action='' accept-charset='UTF-8'>
     
    <legend>Add a new Game by filling in the following form</legend>
    
    <p>Game Played</p>
    <label for="1" class="pure-radio"><input type="radio" name="gameplayed" value="1" <?php if ($this->_tpl_vars['game_played'] == 1): ?>checked="checked"<?php endif; ?> />Yes</label> 
    <label for="0" class="pure-radio"><input type="radio" name="gameplayed" value="0" <?php if ($this->_tpl_vars['game_played'] == 0): ?>checked="checked"<?php endif; ?>/> No</label>
    
    <select name="localteam">
    <?php $_from = $this->_tpl_vars['season_teams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['local_team']):
?>        
    <option value='<?php echo $this->_tpl_vars['local_team']->getTeamID(); ?>
' <?php if ($this->_tpl_vars['local_team']->getTeamID() == $this->_tpl_vars['local_team_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['local_team']->getTeamName(); ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
    </select> <span>vs</span> 
    
    <select name="visitorteam">
    <?php $_from = $this->_tpl_vars['season_teams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['visitor_team']):
?>        
    <option value='<?php echo $this->_tpl_vars['visitor_team']->getTeamID(); ?>
' <?php if ($this->_tpl_vars['visitor_team']->getTeamID() == $this->_tpl_vars['visitor_team_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['visitor_team']->getTeamName(); ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
    </select><br />
    
    <label for="localgoals">Local Team goals</label><br />
    <input type="number" id="localgoals" name="localgoals" value="<?php echo $this->_tpl_vars['local_goals']; ?>
" /><br />
    
    <label for="visitorgoals">Visitor Team goals</label><br />
    <input type="number" id="visitorgoals" name="visitorgoals" value="<?php echo $this->_tpl_vars['visitor_goals']; ?>
" /><br />
    
    <p>Game Date</p>
    <?php echo smarty_function_html_select_date(array('time' => $this->_tpl_vars['game_date'],'start_year' => -150,'end_year' => "+50"), $this);?>
<br />
    
    <p>Game Time</p>
    <?php echo smarty_function_html_select_time(array('time' => $this->_tpl_vars['game_time'],'display_seconds' => false), $this);?>
<br />
    
    <label for="gameplace">Game Place</label><br />
    <input type="text" id="gameplace" name="gameplace" value="<?php echo $this->_tpl_vars['game_place']; ?>
" placeholder="game place" required/><br />
    <label for="gameround">Round</label><br />
    <input type="text" id="gameround" name="gameround" value="<?php echo $this->_tpl_vars['game_round']; ?>
" placeholder="game round" required/><br />
    
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