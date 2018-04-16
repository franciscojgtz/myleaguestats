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
{if isset($userLoggedIn)}
	{include file='headerloggedin.tpl'}
{else}
	{include file='header.tpl'}
{/if}

<div class="content">

<div class="primary">

   <ul class="breadcrumb">
      <li><a href="index.php">{$user->getName()}  &#8594;</a></li>
      <li><a href="league.php?l_id={$league->getLeagueID()}">{$league->getName()} &#8594;</a></li>
      <li class="">{$season->getName()}</li>
   </ul>
   
   <div class="clear"></div>
   
   <h1>{$season->getName()}</h1> 
   

   <p>Click on one of the options below:</p>
   <ul class="listlink">
      <li class="standingslistlink">Standings</li>
      <li class="gameslistlink">Games</li>
   </ul>
   
   <div id="standings">
   <h2>Standings</h2>
   <p>Last modified on : {$dateLastModified}</p>
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
      {foreach item=standing from=$seasonStandings key=k}
         <tr class="{cycle values="evenrow,oddrow"}">
            <td>{$k+1}</td>
            <td class="teamcell">{$standing->getTeamName()}</td>
            <td>{$standing->getGamesPlayed()}</td>
            <td>{$standing->getGamesWon()}</td>
            <td>{$standing->getGamesTied()}</td>
            <td>{$standing->getGamesLost()}</td>
            <td>{$standing->getGoalsInFavor()}</td>
            <td>{$standing->getGoalsAgainst()}</td>
            <td>{$standing->getGoalsDifference()}</td>
            <td>{$standing->getTotalPoints()}</td>
      {foreachelse}
   			<p class="errormsg">No teams yet</p>
         </tr>
      {/foreach}
   </table>
   
   </div>
   
   {literal}
   <script>
      $(document).ready(function () {
         $('#games').hide();
      });

      $('.standingslistlink').click(function() {
         $('#games').hide('slow', function() {
         });
         $('#standings').show('slow', function() {
         });
      });
      $('.gameslistlink').click(function() {
         $('#standings').hide('slow', function() {
         });
         $('#games').show('slow', function() {
         });
      });
      
      $(document).ready(function () {
         $('.selectround').change(function () {
            //hide all possible values
            // first get the elements into a list
            var domelts = $('.selectround option');
            // next translate that into an array of just the values
            var posValues = $.map(domelts, function(elt, i) { return $(elt).val();});
            for(var j=0; j < posValues.length; j++)
            {   
               var round = ".gameround" + posValues[j];
               $(round).hide();
            }

            var str = "";
            var roundStr = "";
            $('.selectround option:selected').each(function () {
                str += $(this).text() + "";
            });
            roundStr = ".gameround" + str;
            //display selected round
            $(roundStr).show();
         })
         .change();
      })       

   </script>
   {/literal}
   <div class="mydiv">
   
   </div>
   
   <div id="games">
      <h2>Games</h2>
     
      <h3>Select a Round</h3>
      <select class="selectround">
      {foreach from=$seasonRounds item=round}
         <option>{$round}</option>
      {/foreach}
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
		{foreach item=game from=$seasonGames key=k}
			<tr class="gameround{$game->getGameRound()} {cycle values="evenrow,oddrow"}">
				<td><a href="season.php?s_id={$game->getSeasonID()}">{$game->getGameRound()}</a></td>
				<td><a href="team.php?t_id={$game->getLocalTeamID()}">{$game->getLocalTeam()}</a></td> 
				<td>{if $game->getGamePlayed() eq 1}{$game->getLocalTeamGoals()} {/if}
                                 vs 
                                 {if $game->getGamePlayed() eq 1} {$game->getVisitorTeamGoals()}  {/if}</td> 
				<td><a href="team.php?t_id={$game->getVisitorTeamID()}">{$game->getVisitorTeam()}</a></td>
				<td>{$game->getGameDate()|date_format}</td> 
				<td>{$game->getGameTime()}</td> 
				<td>{$game->getPlace()}</td>
			</tr>
	
		{foreachelse}
			<p class="errormsg">No games to show</p>
		{/foreach}
	</table>
      
   </div>
   
</div>

<div class="secondary">
{if $user_id neq ''}
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