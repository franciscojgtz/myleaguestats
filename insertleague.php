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
   //FORM WAS SUBMITTED, THE USER IS VALID USER AND A LEAGUE IS SET

   //GET THE VALUES FROM THE FORM
   $myData_leaguename = $_POST['insertleaguename'];

   $smarty->assign('leaguename', $myData_leaguename);

   $validator = new FormValidator();
   $validator->addValidation("insertleaguename","req","Please fill in league name"); 
   $validator->addValidation("insertleaguename","alnum_s_special_chars","Only letters, numbers and the symbols \". _ - ( ) \" are accepted for league name");	
   
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL.
		 
	  //SET NEW NAME FOR THE LEAGUE
      $userLoggedIn->insertLeague($myData_leaguename);
	
      header('Location: index.php');
   }
   else
   {
      //VALIDATION FAILED; THERE ARE ERRORS
      $error_hash = $validator->GetErrors();
      $smarty->assign('errors', $error_hash);
		
		$smarty->assign('userLoggedIn', $userLoggedIn);
   
      $smarty->display('insertleague.tpl');       
   }
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT 
	$smarty->assign('userLoggedIn', $userLoggedIn);
	
	$smarty->assign('leaguename', '');
	$smarty->assign('errors', '');
   $smarty->display('insertleague.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

