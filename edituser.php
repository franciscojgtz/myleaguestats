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


if(isset($_POST['submit']) && ($_SESSION['valid_user_id'] == $_GET['u_id']))
{
   //FORM WAS SUBMITTED

   //GET THE VALUES FROM THE FORM
   $myData_username = $_POST['editusername'];

   $smarty->assign('memberuser', $myData_username);

   $validator = new FormValidator();
   $validator->addValidation("editusername","req","Please fill in username"); 
   $validator->addValidation("editusername","alnum_s","Only letters and numbers are accepted for username");	
   
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL.	 
	   //CREATE A USER OBJECT				
      $oldUser = new User($user_id);
      $oldUser->setName($myData_username);
	
      header('Location: index.php');
   }
   else
   {
	   //PASS USER
	   $smarty->assign("userLoggedIn",$userLoggedIn);
	   
      //VALIDATION FAILED; THERE ARE ERRORS
      $error_hash = $validator->GetErrors();
      $smarty->assign('errors', $error_hash);
      $smarty->display('edituser.tpl');       
   }
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
	$smarty->assign("userLoggedIn",$userLoggedIn);
   $smarty->assign('memberuser', '');
   $smarty->assign('errors', '');
   $smarty->display('edituser.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

