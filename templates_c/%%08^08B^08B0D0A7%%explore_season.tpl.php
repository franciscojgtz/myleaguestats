<?php /* Smarty version 2.6.26, created on 2014-10-15 01:20:22
         compiled from explore_season.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'explore_season.tpl', 65, false),array('modifier', 'date_format', 'explore_season.tpl', 162, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats :: Season</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<!--<script type="text/javascript" src="javascript/main.js"></script>-->


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
      <li><a href="index.php"><?php echo $this->_tpl_vars['user']->getName(); ?>
  &#8594;</a></li>
      <li><a href="league.php?l_id=<?php echo $this->_tpl_vars['league']->getLeagueID(); ?>
"><?php echo $this->_tpl_vars['league']->getName(); ?>
 &#8594;</a></li>
      <li class=""><?php echo $this->_tpl_vars['season']->getName(); ?>
</li>
   </ul>
   
   <div class="clear"></div>
   
   <h1><?php echo $this->_tpl_vars['season']->getName(); ?>
</h1> 
   

   <p>Click on one of the options below:</p>
   <ul class="listlink">
      <li class="standingslistlink">Standings</li>
      <li class="gameslistlink">Games</li>
   </ul>
   
   <div id="standings">
   <h2>Standings</h2>
   <p>Last modified on : <?php echo $this->_tpl_vars['dateLastModified']; ?>
</p>
   <table class="standingstable">
      <tr>
         <th>place</th>
         <th>team</th>
         <th>pld</th>
         <th>win</th>
         <th>tie</th>
         <th>loss</th>
         <th>gf+</th>
         <th>ga-</th>
         <th>gd</th>
         <th>pts</th>
      </tr>
      <?php $_from = $this->_tpl_vars['seasonStandings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['standing']):
?>
         <tr class="<?php echo smarty_function_cycle(array('values' => "evenrow,oddrow"), $this);?>
">
            <td><?php echo $this->_tpl_vars['k']+1; ?>
</td>
            <td class="teamcell"><?php echo $this->_tpl_vars['standing']->getTeamName(); ?>
</td>
            <td><?php echo $this->_tpl_vars['standing']->getGamesPlayed(); ?>
</td>
            <td><?php echo $this->_tpl_vars['standing']->getGamesWon(); ?>
</td>
            <td><?php echo $this->_tpl_vars['standing']->getGamesTied(); ?>
</td>
            <td><?php echo $this->_tpl_vars['standing']->getGamesLost(); ?>
</td>
            <td><?php echo $this->_tpl_vars['standing']->getGoalsInFavor(); ?>
</td>
            <td><?php echo $this->_tpl_vars['standing']->getGoalsAgainst(); ?>
</td>
            <td><?php echo $this->_tpl_vars['standing']->getGoalsDifference(); ?>
</td>
            <td><?php echo $this->_tpl_vars['standing']->getTotalPoints(); ?>
</td>
      <?php endforeach; else: ?>
   			<p class="errormsg">No teams yet</p>
         </tr>
      <?php endif; unset($_from); ?>
   </table>
   
   </div>
   
   <?php echo '
   <script>
      $(document).ready(function () {
         $(\'#games\').hide();
      });

      $(\'.standingslistlink\').click(function() {
         $(\'#games\').hide(\'slow\', function() {
         });
         $(\'#standings\').show(\'slow\', function() {
         });
      });
      $(\'.gameslistlink\').click(function() {
         $(\'#standings\').hide(\'slow\', function() {
         });
         $(\'#games\').show(\'slow\', function() {
         });
      });
      
      $(document).ready(function () {
         $(\'.selectround\').change(function () {
            //hide all possible values
            // first get the elements into a list
            var domelts = $(\'.selectround option\');
            // next translate that into an array of just the values
            var posValues = $.map(domelts, function(elt, i) { return $(elt).val();});
            for(var j=0; j < posValues.length; j++)
            {   
               var round = ".gameround" + posValues[j];
               $(round).hide();
            }

            var str = "";
            var roundStr = "";
            $(\'.selectround option:selected\').each(function () {
                str += $(this).text() + "";
            });
            roundStr = ".gameround" + str;
            //display selected round
            $(roundStr).show();
         })
         .change();
      })       

   </script>
   '; ?>

   <div class="mydiv">
   
   </div>
   
   <div id="games">
      <h2>Games</h2>
     
      <h3>Select a Round</h3>
      <select class="selectround">
      <?php $_from = $this->_tpl_vars['seasonRounds']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['round']):
?>
         <option><?php echo $this->_tpl_vars['round']; ?>
</option>
      <?php endforeach; endif; unset($_from); ?>
      </select>
    
      <table class="gametable">
			<tr>
				<th>Rnd</th>
				<th>Home Team</th>
				<th>VS</th>
				<th>Away Team</th>
				<th>Date</th>
				<th>Time</th>
				<th>Place</th>
			</tr >
		<?php $_from = $this->_tpl_vars['seasonGames']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['game']):
?>
			<tr class="gameround<?php echo $this->_tpl_vars['game']->getGameRound(); ?>
 <?php echo smarty_function_cycle(array('values' => "evenrow,oddrow"), $this);?>
">
				<td><a href="season.php?s_id=<?php echo $this->_tpl_vars['game']->getSeasonID(); ?>
"><?php echo $this->_tpl_vars['game']->getGameRound(); ?>
</a></td>
				<td><a href="team.php?t_id=<?php echo $this->_tpl_vars['game']->getLocalTeamID(); ?>
"><?php echo $this->_tpl_vars['game']->getLocalTeam(); ?>
</a></td> 
				<td><?php if ($this->_tpl_vars['game']->getGamePlayed() == 1): ?><?php echo $this->_tpl_vars['game']->getLocalTeamGoals(); ?>
 <?php endif; ?>
                                 vs 
                                 <?php if ($this->_tpl_vars['game']->getGamePlayed() == 1): ?> <?php echo $this->_tpl_vars['game']->getVisitorTeamGoals(); ?>
  <?php endif; ?></td> 
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
      
   </div>
   
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