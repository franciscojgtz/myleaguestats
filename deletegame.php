<?php
session_start();

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

$valid_user_id = $_SESSION['valid_user_id'];
$user_id = $_GET['u_id'];
$game_id = $_GET['g_id'];

if(isset($game_id))
{
	//CREATE A GAME OBJECT  
   $game = new Game($game_id); 
	$gameSeasonID = $game->getSeasonID();	
	
	//CREATE A SEASON OBJECT  
   $season = new Season($gameSeasonID); 
	$seasonLeagueID = $season->getLeagueID();
	
	//CREATE A LEAGUE OBJECT  
   $league = new League($seasonLeagueID); 
	$leagueUserID = $league->getUserID();
	
	$userLoggedIn = new User($leagueUserID);
	
}
else
{
	$leagueUserID = "not valid";	
}


if(isset($_POST['submit']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //FORM WAS SUBMITTED, THE USER IS VALID USER
	
	//DELETE GAME
   $game->deleteGame();
		
   header("Location: season.php?s_id=$gameSeasonID");
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   $smarty->assign('userLoggedIn', $userLoggedIn);
	$smarty->assign('league', $league);
	$smarty->assign('season', $season);
	$smarty->assign('game', $game);
	
	$local_team = $game->getLocalTeam();
	$visitor_team = $game->getVisitorTeam();
	$user_teams = $userLoggedIn->getTeams();
	
	$smarty->assign('localTeam', $local_team);
	$smarty->assign('visitorTeam', $visitor_team);
	$smarty->assign('user_teams', $user_teams);	
	
	$smarty->assign('game_round', $game->getGameRound());
	
   $smarty->display('deletegame.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

