<?php
session_start();

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

$smarty->assign("contact","Home");

if(isset($_SESSION['valid_user_id']))
{
	$valid_user_id = $_SESSION['valid_user_id'];
	$userLoggedIn = new User($valid_user_id);	
	$smarty->assign("userLoggedIn",$userLoggedIn);
}

if(isset($_GET['t_id']))
{
	$team_id = $_GET['t_id'];
	
	//CREATE A TEAM OBJECT  
   $team = new Team($team_id); 
	$teamUserID = $team->getUserID();
	$user = new User($teamUserID);
}
else
{
	$team_id = 0; 	
	$team = new Team($team_id);
	$teamUserID = "not valid";
}

//FIND THE TEAM IN THE DATABASE
$teamFound = $team->getTeamFound();

if((isset($_SESSION['valid_user_id'])) && ($valid_user_id == $teamUserID))
{
	//THE USER HAS A VALID LOGIN AND THIS TEAM BELONGS TO THE USER
	$smarty->assign("team",$team);
	$smarty->assign("userLoggedIn",$userLoggedIn);
	$smarty->display('team.tpl');
}
else
{
   //THE USER IS NOT LOGGED IN OR TEAM DOES NOT BELONG TO THIS USER
	if($teamFound)
   {
	   //THE TEAM IS IN THE DATABASE
   	$smarty->assign("team",$team);
   	$smarty->assign("user",$user);
   	$smarty->display('explore_team.tpl');
	}
	else
	{
		//THE TEAM IS NOT IN THE DATABASE
		$smarty->display('error.tpl');
	}
}
?>

