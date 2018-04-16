<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats::Edit Team</title>

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

   <h1>Edit team : {$team->getName()}</h1>
   
   <ul class="editmenu">
		<li><a href="deleteteam.php?u_id={$userLoggedIn->getUserID()}&&t_id={$team->getTeamID()}">Delete</a></li>
	</ul>
	<div class="clear"></div>
   
  <form class="pure-form pure-form-stacked" method='post' action='' accept-charset='UTF-8'>
  
    <p>Change your team information by filling in the following form</p>

    <p><label for="editteamname">New Team Name</label> <input type="text" name="editteamname" id="editteamname" value="{$teamname}" placeholder="new team name" required/> </p>
    <p class="form-buttons"><input type="submit" name="submit" id="submit" value="Submit" class="pure-button pure-button-primary"/>
    <a href="team.php?t_id={$team->getTeamID()}" class="pure-button pure-button-primary">Cancel</a></p>

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