<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats :: Season</title>

<link rel="stylesheet" type="text/css" href="../style.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<!--<script type="text/javascript" src="javascript/main.js"></script>-->


</head>

<body>

<div class="wrapper">
{include file='header.tpl'}

<div class="content">

<div class="primary">

   <p><a href="logout.php">log out</a></p>

   <ul class="breadcrumb">
      <li><a href="index.php">{$user->name}  &#8594;</a></li>
      <li><a href="league.php?l_id={$league->leagueID}">{$league->leagueName} &#8594;</a></li>
      <li class="">{$season->seasonName}</li>
   </ul>
   
   <div class="clear"></div>
   
   <ul>
		<li><a href="editseason.php?u_id={$user->user_id}&&s_id={$season->seasonID}">Edit</a></li>
		<li><a href="deleteseason.php?s_id={$season->seasonID}">Delete</a></li>
   </ul>

   <h2>{$seasonName}</h2>  
   
   <ul class="listlink">
      <li class="standingslistlink">Standings</li>
      <li class="gameslistlink">Games</li>
   </ul>
   
   <div id="standings">
   <table>
      <caption>Standings</caption>
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
         <th>Edit</th>
         <th>Del</th>
      </tr>
      {foreach item=standing from=$seasonStandings key=k}
         <tr class="{cycle values="evenrow,oddrow"}">
            <td>{$k+1}</td>
            <td class="teamcell">{$standing->teamName}</td>
            <td>{$standing->gmsWon+$standing->gmsTied+$standing->gmsLost}</td>
            <td>{$standing->gmsWon}</td>
            <td>{$standing->gmsTied}</td>
            <td>{$standing->gmsLost}</td>
            <td>{$standing->glsFavor}</td>
            <td>{$standing->glsAgainst}</td>
            <td>{$standing->glsDif}</td>
            <td>{$standing->pts}</td>
            <td><a href="editstanding.php?u_id={$user->user_id}&&st_id={$standing->standingID}">E</a></td>
            <td><a href="deletestanding.php?u_id={$user->user_id}&&st_id={$standing->standingID}">D</a></td>
         </tr>
      {/foreach}
   </table>
   
   <p><a href="insertstanding.php?u_id={$user->user_id}&&s_id={$season->seasonID}">Add Team to Standings table</a></p>
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
      <h1>Games</h1>
     
      <h3>Select a Round</h3>
      <select class="selectround">
      {foreach from=$seasonRounds item=round}
         <option>{$round}</option>
      {/foreach}
      </select>


      
      {foreach item=game from=$seasonGames key=k}
         <div class="gameround{$game->gameRound}">
            <p class="gameround">{$game->localTeam} {if $game->gamePlayed eq 1}{$game->localTeamGoals} {/if}
                                 vs 
                                 {if $game->gamePlayed eq 1} {$game->visitorTeamGoals}  {/if} {$game->visitorTeam}<br />
               Place: {$game->place}<br />
               Date: {$game->gameDate}<br />
               Time: {$game->gameTime}<br />
               Round: {$game->gameRound}<br />
               <a href="editgame.php?u_id={$user->user_id}&&g_id={$game->gameID}">Edit</a> 
               <a href="deletegame.php?u_id={$user->user_id}&&g_id={$game->gameID}">Delete</a>
            </p>
         </div>
      {/foreach}
      
      <p><a href="insertgame.php?u_id={$user->user_id}&&s_id={$season->seasonID}">Add Game</a></p>
      
   </div>
   
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