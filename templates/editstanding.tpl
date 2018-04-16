<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats::Edit Standing</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

</head>

<body>

<div class="wrapper">
{include file=headerloggedin.tpl'}

<div class="content">

<div class="primary">

   {foreach item=error from=$errors}
      <p class="errormsg">       
      {$error}
      </p>
   {/foreach}
   
	<h1>Edit Standing</h1>
	
  <form class="pure-form pure-form-stacked" method='post' action='' accept-charset='UTF-8'>
  	 <ul class="editmenu">
		<li><a href="deletestanding.php?u_id={$userLoggedIn->getUserID()}&&st_id={$standing->getStandingID()}">Delete</a></li>
    </ul>  
  
    <legend>Change the Standing information by filling in the following form<br />
    Team Name : {$team->getName()} </legend>
    
    <select name="dropdownteam">
    {foreach item=user_teams from=$user_teams key=k}        
    <option value='{$user_teams->getTeamID()}' {if $user_teams->getTeamID() == $team->getTeamID()}selected="selected"{/if}>{$user_teams->getName()}</option>
    {/foreach}
    </select>
    
    <label for="gameswon">Games Won</label>
    <input type="number" id="gameswon" name="gameswon" size="3" value="{$games_won}"/>
    <label for="gamestied">Games Tied</label>
    <input type="number" id="gamestied" name="gamestied" size="3" value="{$games_tied}"/>
    <label for="gameslost">Games Lost</label>
    <input type="number" id="gameslost" name="gameslost" size="3" value="{$games_lost}" />
    <label for="goalsfavor">Goals in Favor</label>
    <input type="number" id="goalsfavor" name="goalsfavor" size="3" value="{$goals_favor}" />
    <label for="goalsagainst">Goals Against</label>
    <input type="number" id="goalsagainst" name="goalsagainst" size="3" value="{$goals_against}" />
    <label for="pointsdeducted">Points Deducted</label>
    <input type="number" id="pointsdeducted" name="pointsdeducted" size="3" value="{$pts_deducted}" />
    <label for="bonuspoints">Bonus Points</label>
    <input type="number" id="bonuspoints" name="bonuspoints" size="3" value="{$bonus_pts}" />
    
    <p class="form-buttons"><input type="submit" name="submit" id="submit" value="Submit" class="pure-button pure-button-primary"/>
    <a href="season.php?s_id={$season->getSeasonID()}" class="pure-button pure-button-primary">Cancel</a></p>

  </form>

</div>

<div class="secondary">
{include file='navigationloggedin.tpl'}

{include file='promo.tpl'}

</div>

</div>

{include file='footer.tpl'}

</div>

<!--analytics code-->
{literal}
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30483345-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
{/literal}

</body>
</html>