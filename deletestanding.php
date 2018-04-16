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
$standing_id = $_GET['st_id'];

if(isset($standing_id))
{
	//CREATE A GAME OBJECT  
   $standing = new Standing($standing_id); 
	$standingSeasonID = $standing->getSeasonID();	
	
	//CREATE A SEASON OBJECT  
   $season = new Season($standingSeasonID); 
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
	
	//DELETE STANDING
   $standing->deleteStanding();
		
   header('Location: season.php?s_id='.$standingSeasonID);
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   $smarty->assign('userLoggedIn', $userLoggedIn);
	$smarty->assign('league', $league);
	$smarty->assign('season', $season);
	$smarty->assign('standing', $standing);
	
	$user_teams = $userLoggedIn->getTeams();
	
	$smarty->assign('user_teams', $user_teams);	

	
   $smarty->display('deletestanding.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

