<?php
session_start();

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

$smarty->assign("contact","Home");
$valid_user_id = $_SESSION['valid_user_id'];
$user_id = $_GET['u_id'];
$league_id = $_GET['l_id'];

if(isset($league_id))
{
	//CREATE A LEAGUE OBJECT  
   $league = new League($league_id); 
	$leagueUserID = $league->getUserID();
}
else
{
	$leagueUserID = "not valid";	
}

if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id))
{
	$userLoggedIn = new User($valid_user_id);
}


if(isset($_POST['submit']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //FORM WAS SUBMITTED, THE USER IS VALID USER AND A LEAGUE IS SET

	//DELETE LEAGUE
   $league->deleteLeague();
		
   header('Location: index.php');

}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   $smarty->assign("userLoggedIn",$userLoggedIn);
   $smarty->assign('league', $league);
   $smarty->display('deleteleague.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

