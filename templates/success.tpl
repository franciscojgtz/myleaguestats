<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats:: Welcome</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

</head>

<body>

<div class="wrapper">
{include file='headerloggedin.tpl'}

<div class="content">

<div class="primary">

   <h1>{$userLoggedIn->getName()}</h1>
   <h3>User Id: {$userLoggedIn->getUserID()}</h3>
   <ul class="editmenu">
      <li><a href="edituser.php?u_id={$userLoggedIn->getUserID()}">Edit User Info</a></li>
   </ul>
   <div class="clear"></div>

   <div class="leaguelist">
   	<p class="successpagebuttons"><a href="insertleague.php?u_id={$userLoggedIn->getUserID()}" class="pure-button pure-button-primary">Add a League</a>
   	<a href="leagues.php" class="pure-button pure-button-primary">Manage Leagues</a></p>
   
   	<h2>My Leagues</h2>
   	
   	<ul>
   		{foreach item=league from=$userLeagues key=k}
         	<li><a href="league.php?l_id={$league->getLeagueID()}">{$league->getName()}</a></li>
   		{foreachelse}
   			<p class="errormsg">You do not have any leagues yet. Please add a league using the "add a league" link abov.</p>
   		{/foreach}
   	</ul>
   
  		
   </div>
   
   <div class="teamlist">
  
   	<p class="successpagebuttons"><a href="insertteam.php?u_id={$userLoggedIn->getUserID()}" class="pure-button pure-button-primary">Add a Team</a>
   	<a href="teams.php" class="pure-button pure-button-primary">Manage Teams</a></p>
   	
   	<h2>My Teams</h2>
   	
   	<p>Note: in order to be able to use this web site, you need to have a minimum of two teams in the database.</p>
   	
   	<ul>
   		{foreach item=team from=$userTeams key=k}
        		<li><a href="team.php?t_id={$team->getTeamID()}">{$team->getName()}</a></li>
   		{foreachelse}
   			<p class="errormsg">You do not have any teams yet. Please add a team using the "add a team" link above.</p>
   		{/foreach}
   	</ul>
   	
	</div>
   
   <div class="clear"></div>
   
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