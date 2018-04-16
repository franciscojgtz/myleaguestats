<?php
session_start();

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

//CHECK IF THE SEESION IS SET
if(isset($_SESSION['valid_user_id']))
{
	$valid_user_id = $_SESSION['valid_user_id'];
	$userLoggedIn = new User($valid_user_id);	
	$smarty->assign("userLoggedIn",$userLoggedIn);
} 

//CHECK IF THE l_id IS SET
if(isset($_GET['l_id']))
{
	$league_id = $_GET['l_id'];
	//CREATE A LEAGUE OBJECT  
   $league = new League($league_id); 
	$leagueUserID = $league->getUserID();
	$user = new User($leagueUserID);
}
else
{
	$league_id= 0;
	$league = new League($league_id); 
	$leagueUserID = "not valid";	
}

//FIND THE LEAGUE IN THE DATABASE
$leagueFound = $league->getLeagueFound();

//CHECK IF THE USER IS LOGGED IN AND THE LEAGUE BELONGS TO HER
if((isset($_SESSION['valid_user_id'])) && ($valid_user_id == $leagueUserID))
{
	//THE USER HAS A VALID LOGIN AND THIS LEAGUE BELONGS TO THE USER
	$leagueSeasons = $league->getSeasons();
	
	$smarty->assign("league",$league);
	$smarty->assign("userLoggedIn",$userLoggedIn);
	$smarty->assign("league_seasons",$leagueSeasons);
	$smarty->display('league.tpl');
}
else
{
   //THE USER IS NOT LOGGED IN OR LEAGUE DOES NOT BELONG TO THIS USER
   
   //THE LEAGUE IS WAS FOUND
	if($leagueFound)
   {
	   //THE lEAGUE IS IN THE DATABASE	   
	   $leagueSeasons = $league->getSeasons();
	   
   	$smarty->assign("league",$league);
   	$smarty->assign("leagueSeasons",$leagueSeasons);
   	$smarty->assign("user",$user);
   	$smarty->display('explore_league.tpl');
	}
	else
	{
		//THE LEAGUE IS NOT IN THE DATABASE
		$smarty->display('error.tpl');
	}
}
?>

