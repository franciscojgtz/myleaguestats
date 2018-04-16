<?php
session_start();

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

//STORE TO TEST IF THEY *WERE* LOGGED IN 
if(isset($_SESSION['valid_user_id']))
{
	$old_user = $_SESSION['valid_user_id'];
	unset($_SESSION['valid_user_id']);
	session_destroy();
}

$logout_msg = "default value";

if(!empty($old_user))
{
   //USER HAS LOGGED OUT
   
   $logout_msg = "Logged Out";

}
else
{
   //IF THEY WEREN'T LOGGED IN BUT CAME TO THIS PAGE SOMEHOW
   $logout_msg = "You were not logged in, and so have not been logged out.";
}

$smarty->assign("logout_msg",$logout_msg);
$smarty->display('logout.tpl');
?>

