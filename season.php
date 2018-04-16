<?php
session_start();

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

if(isset($_SESSION['valid_user_id']))
{
	$valid_user_id = $_SESSION['valid_user_id'];
	$userLoggedIn = new User($valid_user_id);	
	$smarty->assign("userLoggedIn",$userLoggedIn);
} 

if(isset($_GET['s_id']))
{
	$season_id = $_GET['s_id'];
	
	//CREATE A SEASON OBJECT  
   $season = new Season($season_id); 
	$seasonLeagueID = $season->getLeagueID();
	if(!empty($seasonLeagueID))
	{
		$seasonStandings = $season->getStandings();
   	$seasonGames = $season->getGames();
   	$seasonRounds = $season->getRounds();
	
		//CREATE A LEAGUE OBJECT  
   	$league = new League($seasonLeagueID); 
		$leagueUserID = $league->getUserID();
	
		$user = new User($leagueUserID);
	}
	else
	{
		$leagueUserID = "not valid";	
	}
}
else
{
	$leagueUserID = "not valid";	
	$season_id = 0;
	//CREATE A SEASON OBJECT  
   $season = new Season($season_id); 
}

$seasonFound = $season->getSeasonFound();

if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $leagueUserID))
{
	//THE USER HAS A VALID LOGIN AND THIS LEAGUE BELONGS TO THE USER
	$leagueSeasons = $league->getSeasons();
	
	$arrLastModified = array(0);
	foreach($seasonStandings as $standing)
	{
		$dateLastModified = $standing->getDateLastModified();	
		array_push($arrLastModified, $dateLastModified);
	}
	
	$dateLastModified = max($arrLastModified);
	$dateLastModified = date("M d, Y", strtotime($dateLastModified));
	
	$smarty->assign("season",$season);
	$smarty->assign("seasonStandings",$seasonStandings);
	$smarty->assign("dateLastModified",$dateLastModified);
   $smarty->assign("seasonGames",$seasonGames);
   $smarty->assign("seasonRounds",$seasonRounds);
	
	$smarty->assign("league",$league);
	$smarty->assign("userLoggedIn",$userLoggedIn);
	$smarty->assign("league_seasons",$leagueSeasons);
	$smarty->display('season.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   if($seasonFound)
   {
   	$seasonName = $season->getName();
   	$seasonLeagueID = $season->getLeagueID();
   
   	$seasonLeague = new League($seasonLeagueID);
   	$leagueUserID = $seasonLeague->getUserID();
   
   	$leagueUser = new User($leagueUserID);
   
   	$seasonStandings = $season->getStandings();
   	$seasonGames = $season->getGames();
   	$seasonRounds = $season->getRounds();
   	
   	$arrLastModified = array(0);
	foreach($seasonStandings as $standing)
	{
		$dateLastModified = $standing->getDateLastModified();	
		array_push($arrLastModified, $dateLastModified);
	}
	
	$dateLastModified = max($arrLastModified);
	$dateLastModified = date("M d, Y", strtotime($dateLastModified));
   	
   	$smarty->assign("season",$season);
   	$smarty->assign("user",$user);
   	$smarty->assign("league",$league);
   	$smarty->assign("dateLastModified",$dateLastModified);

   	$smarty->assign("seasonName",$seasonName);
   	$smarty->assign("seasonLeague",$seasonLeague);
   	$smarty->assign("leagueUser",$leagueUser);
   
   	$smarty->assign("seasonStandings",$seasonStandings);
   	$smarty->assign("seasonGames",$seasonGames);
   	$smarty->assign("seasonRounds",$seasonRounds);
   
   	$smarty->display('explore_season.tpl');
	}
	else
	{
		$smarty->display('error.tpl');
	}
}
?>

