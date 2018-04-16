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

if(isset($user_id))
{
	$userLoggedIn = new User($user_id);
	
}


if(isset($_POST['submit']) && ($valid_user_id == $user_id))
{
   //FORM WAS SUBMITTED, THE USER IS VALID USER

   //GET THE VALUES FROM THE FORM
   $myData_teamname = $_POST['insertteamname'];

   $smarty->assign('teamname', $myData_teamname);

   $validator = new FormValidator();
   $validator->addValidation("insertteamname","req","Please fill in team name"); 
   $validator->addValidation("insertteamname","alnum_s_special_chars","Only letters, numbers and the symbols \". _ - ( ) \" are accepted for team name");	
   
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL.
		 
	  //SET NEW NAME FOR THE TEAM
      $userLoggedIn->insertTeam($myData_teamname);
	
      header('Location: index.php');
   }
   else
   {
      //VALIDATION FAILED; THERE ARE ERRORS
      $error_hash = $validator->GetErrors();
      $smarty->assign('errors', $error_hash);
		
		$smarty->assign('userLoggedIn', $userLoggedIn);
   
      $smarty->display('insertteam.tpl');       
   }
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT 
   $smarty->assign('teamname', '');
   $smarty->assign('errors', '');
	$smarty->assign('userLoggedIn', $userLoggedIn);
	
   $smarty->display('insertteam.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

