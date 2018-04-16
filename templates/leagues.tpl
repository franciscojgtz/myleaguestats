<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats::Leagues</title>

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
   </ul>
   
   <div class="clear"></div>

	<h1>My Leagues</h1>

<p class="introtext">Click the name of the league to access its seasons. Add, delete or modify leagues.</p>

<ul class="leaguelist-edit">
	{foreach item=league from=$userLeagues key=k}
         <li>
         <a class="leaguelist-edit-leaguename" href="league.php?l_id={$league->getLeagueID()}">{$league->getName()}</a>
         <a href="editleague.php?u_id={$userLoggedIn->getUserID()}&&l_id={$league->getLeagueID()}" class="pure-button pure-button-primary">Edit</a>
         </li>
   {foreachelse}
   		<p class="errormsg">You do not have any leagues yet. Please add a league using the "add a league" link below.</p>
   {/foreach}
</ul>
   
   <p class="form-buttons"><a href="insertleague.php?u_id={$userLoggedIn->getUserID()}" class="pure-button pure-button-primary">Add a League</a></p>

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