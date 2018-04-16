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
{if isset($userLoggedIn)}
	{include file='headerloggedin.tpl'}
{else}
	{include file='header.tpl'}
{/if}


<div class="content">

<div class="primary">

   <h1>{$user->getName()}</h1>

   <div class="clear"></div>

   <div class="leaguelist">
   
   	<h2>Leagues</h2>
   	
   	<ul>
   		{foreach item=league from=$userLeagues key=k}
         	<li><a href="league.php?l_id={$league->getLeagueID()}">{$league->getName()}</a></li>
   		{foreachelse}
   			<p class="errormsg">This user does not have any leagues registered</p>
   		{/foreach}
   	</ul>
   
   </div>
   
   <div class="teamlist">
   	
   	<h2>Teams</h2>
   	
   	<ul>
   		{foreach item=team from=$userTeams key=k}
        		<li><a href="team.php?t_id={$team->getTeamID()}">{$team->getName()}</a></li>
   		{foreachelse}
   			<p class="errormsg">This user does not have any teams registered</p>
   		{/foreach}
   	</ul>
   	
	</div>
   
   <div class="clear"></div>
   
</div>

<div class="secondary">
{if isset($userLoggedIn)}
	{include file='navigationloggedin.tpl'}
{else}
	{include file='navigation.tpl'}
{/if}


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