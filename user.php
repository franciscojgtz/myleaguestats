<?php
session_start();
	
require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
$smarty = new Smarty; 
//$smarty->debugging = true;

//CHECK IF THERE IS A USER LOGGED IN
if(isset($_SESSION['valid_user_id']))
{
	//THERE IS A USER LOGGED IN
	$user_loggedin_id = $_SESSION['valid_user_id'];   
	
	$userLoggedIn = new User($user_loggedin_id);
	$smarty->assign("userLoggedIn",$userLoggedIn);	
}
else
{
	//NO USER LOGGED IN
   //THE PAGE WAS JUST OPENED
}

//CHECK FOR THE USER TO GET INFO ABOUT
if(isset($_GET['u_id'])) 
{
   $user_id = $_GET['u_id'];   
}
else
{
	//THE USER WAS NOT FOUND
	$user_id = 0;  
}

//CREATE A NEW USER   
$user = new User($user_id);
$userFound = $user->getUserFound();
   
if($userFound)
{
   $userLeagues = $user->getLeagues();
   $userTeams = $user->getTeams();
   	
   $smarty->assign("user",$user);
   $smarty->assign("userLeagues",$userLeagues);
   $smarty->assign("userTeams",$userTeams);
   
   $smarty->display('user.tpl');
}
else
{
	$smarty->display('error.tpl');
}
      
?>
