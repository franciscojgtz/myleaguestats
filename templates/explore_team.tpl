<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats :: Team</title>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>

<div class="wrapper">
{if isset($userLoggedIn)}
	{include file='headerloggedin.tpl'}
{else}
	{include file='header.tpl'}
{/if}

<div class="content">

<div class="primary">
   
   <ul class="breadcrumb">
      <li><a href="index.php">Home &#8594;</a></li>
      <li><a href="user.php?u_id={$user->getUserID()}">{$user->getName()} &#8594;</a></li>
      <li>{$team->getName()}</li>
   </ul>
   
   <div class="clear"></div>
   
   <h2>{$team->getName()}</h2>  

	<!--<h2>Check out the standings</h2>

{foreach item=standing from=$team->getStandingsWhereTeamIsPartOf() key=k}
	<ul class="{cycle values="evenrow,oddrow"}">
      <li><a href="season.php?s_id={$standing->getSeasonID()}">{$standing->getSeasonName()}</a></li>
{foreachelse}
	<p class="errormsg">No standings to show</p>
   </ul>
{/foreach}-->

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
{foreach item=game from=$team->getUpcomingGames() key=k}
	<tr class="{cycle values="evenrow,oddrow"}">
	<td><a href="season.php?s_id={$game->getSeasonID()}">{$game->getGameRound()}</a></td>
	<td><a href="team.php?t_id={$game->getLocalTeamID()}">{$game->getLocalTeam()}</a></td> 
	<td>vs</td> 
	<td><a href="team.php?t_id={$game->getVisitorTeamID()}">{$game->getVisitorTeam()}</a></td>
	<td>{$game->getGameDate()|date_format}</td> 
	<td>{$game->getGameTime()}</td> 
	<td>{$game->getPlace()}</td> 
	</tr>
{foreachelse}
	<p class="errormsg">No games to show</p>
{/foreach}
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
{foreach item=game from=$team->getLatestGames() key=k}
	<tr class="{cycle values="evenrow,oddrow"}">
	<td><a href="season.php?s_id={$game->getSeasonID()}">{$game->getGameRound()}</a></td>
	<td><a href="team.php?t_id={$game->getLocalTeamID()}">{$game->getLocalTeam()}</a></td> 
	<td>{$game->getLocalTeamGoals()} vs {$game->getVisitorTeamGoals()}</td> 
	<td><a href="team.php?t_id={$game->getVisitorTeamID()}">{$game->getVisitorTeam()}</a></td>
	<td>{$game->getGameDate()|date_format}</td> 
	<td>{$game->getGameTime()}</td> 
	<td>{$game->getPlace()}</td>
	</tr>
{foreachelse}
	<p class="errormsg">No games to show</p>
{/foreach}
</table>

<div class="clear"></div>
   
</div>

<div class="secondary">
{include file='navigation.tpl'}

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