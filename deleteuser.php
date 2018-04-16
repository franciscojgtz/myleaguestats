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

if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id))
{
	$userLoggedIn = new User($valid_user_id);
}

if(isset($user_id))
{
	//CREATE A USER OBJECT  
   $userLoggedIn = new User($user_id); 
}

if(isset($_POST['submit']) && ($_SESSION['valid_user_id'] == $_GET['u_id']))
{
   //FORM WAS SUBMITTED
	
	//DELETE USER
   $userLoggedIn->deleteUser();
		
   header('Location: logout.php');
   

}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
	$smarty->assign("userLoggedIn",$userLoggedIn);
   $smarty->display('deleteuser.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

