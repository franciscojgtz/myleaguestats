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

if(($_SESSION['valid_user_id']))
{
	//THE USER HAS A VALID LOGIN
	
	//GET LEAGUES
	$userLeagues = $userLoggedIn->getLeagues();

	$smarty->assign("userLoggedIn", $userLoggedIn);
	$smarty->assign("userLeagues", $userLeagues);
	
	$smarty->display('leagues.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

