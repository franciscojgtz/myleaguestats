<?php
	session_start();
	
   require_once('classes/class.DataManager.php');
   require("libs/Smarty.class.php");
   $smarty = new Smarty; 
   //$smarty->debugging = true;
   
   if(isset($_SESSION['valid_user_id']))
	{
		$user_id = $_SESSION['valid_user_id'];   
		$smarty->assign("user_id",$user_id);
	}
	else
	{
   	//THE PAGE WAS JUST OPENED
   	$smarty->assign("user_id","");
	}


	$smarty->display('instructions.tpl');
   
   
?>
