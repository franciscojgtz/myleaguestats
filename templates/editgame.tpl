<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats::Edit Game</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

</head>

<body>

<div class="wrapper">
{include file='headerloggedin.tpl'}

<div class="content">

<div class="primary">

   {foreach item=error from=$errors}
      <p class="errormsg">       
      {$error}
      </p>
   {/foreach}

   <h1>Edit Game</h1>
   
  <form class="pure-form" method='post' action='' accept-charset='UTF-8'>
  
  	 <ul class="editmenu">
		<li><a href="deletegame.php?u_id={$userLoggedIn->getUserID()}&&g_id={$game->getID()}">Delete</a></li>
    </ul>  
    
    <legend>Change the Game information by filling in the following form<br />
    Team Name : {$localTeam->getName()} vs {$visitorTeam->getName()}</legend>
    
    <p>Game Played:</p>
    <label for="1" class="pure-radio"><input type="radio" name="gameplayed" value="1" {if $game_played eq 1}checked="checked"{/if} />Yes</label>
    <label for="0" class="pure-radio"><input type="radio" name="gameplayed" value="0" {if $game_played eq 0}checked="checked"{/if} />No</label>  
    

    <select name="localteam">
    {foreach item=local_team from=$season_teams key=k}        
    <option value='{$local_team->getTeamID()}' {if $local_team->getTeamID() eq $local_team_id} selected="selected"{/if}>{$local_team->getTeamName()}</option>
    {/foreach}
    </select> <span>vs</span> 
    
    <select name="visitorteam">
    {foreach item=visitor_team from=$season_teams key=k}        
    <option value='{$visitor_team->getTeamID()}' {if $visitor_team->getTeamID() eq $visitor_team_id} selected="selected"{/if}>{$visitor_team->getTeamName()}</option>
    {/foreach}
    </select><br />
    
    <label for="localgoals">Local Team goals</label><br />
    <input type="number" id="localgoals" name="localgoals" value="{$local_goals}" /><br />
    
    <label for="visitorgoals">Visitor Team goals</label><br />
    <input type="number" id="visitorgoals" name="visitorgoals" value="{$visitor_goals}" /><br />
    
    <p>Game Date</p>
    {html_select_date time=$game_date start_year=-150 end_year=+50}<br />
    
    <p>Game Time</p>
    {html_select_time time=$game_time display_seconds=false}<br />
    
    <label for="gameplace">Game Place</label><br />
    <input type="text" id="gameplace" name="gameplace" value="{$game_place}"/><br />
    <label for="gameround">Round</label><br />
    <input type="text" id="gameround" name="gameround" value="{$game_round}" /><br />
    
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