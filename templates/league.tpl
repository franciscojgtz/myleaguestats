<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats::League</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

</head>

<body>

<div class="wrapper">
{include file='headerloggedin.tpl'}

<div class="content">

<div class="primary">

<ul class="breadcrumb">
      <li><a href="index.php">{$userLoggedIn->getName()}  &#8594;</a></li>
      <li>{$league->getName()}</li>
   </ul>
   
   <div class="clear"></div>

<h1>{$league->getName()}</h1>
<h3>League ID: {$league->getLeagueID()}</h3>

<ul class="editmenu">
	<li><a href="editleague.php?u_id={$userLoggedIn->getUserID()}&&l_id={$league->getLeagueID()}">Edit</a></li>
</ul>

<h2>Seasons</h2>

   <ul>
   {foreach item=season from=$league_seasons key=k}
         <li><a href="season.php?s_id={$season->getSeasonID()}">{$season->getName()}</a></li>
   {foreachelse}
   		<p class="errormsg">You do not have any seasons yet. Please add a season using the "add a season" link below.</p>
   {/foreach}
   </ul>
   
   <p class="form-buttons"><a href="insertseason.php?u_id={$userLoggedIn->getUserID()}&&l_id={$league->getLeagueID()}" class="pure-button pure-button-primary">Add a Season</a></p>

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