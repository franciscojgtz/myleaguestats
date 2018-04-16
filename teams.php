<?php
session_start();

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

$valid_user_id = $_SESSION['valid_user_id'];

$userLoggedIn = new User($valid_user_id);
$userID = $userLoggedIn->getUserID();

if(($_SESSION['valid_user_id']))
{
	//THE USER HAS A VALID LOGIN
	
	//GET TEAMS
	$userTeams = $userLoggedIn->getTeams();

	$smarty->assign("userLoggedIn", $userLoggedIn);
	$smarty->assign("userTeams", $userTeams);
	
	$smarty->display('teams.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

