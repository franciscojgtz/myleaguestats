<?php
session_start();

/*
success tpl needs 3 variables: 
$userLoggedIn
$userLeagues
$userTeams
*/

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

if(isset($_POST['submit']))
{
   //FORM WAS SUBMITTED

   //GET THE VALUES FROM THE FORM
   $myData_useremail = $_POST['memberuseremail'];
   $myData_password = $_POST['memberpassword'];

   $smarty->assign('memberuser', $myData_useremail);
   $smarty->assign('memberpass', $myData_password);

   //THE INPUT IN CAPTCHA WAS VALID, NOW VALIDATE THE INPUT USING THE FORM VALIDATOR
   $validator = new FormValidator();
   $validator->addValidation("memberuseremail","req","Please fill in email"); 
   $validator->addValidation("memberuseremail","email","Please insert a valid email");	
   $validator->addValidation("memberpassword","req","Please fill in password"); 
   $validator->addValidation("memberpassword","alnum_s","Only letters and numbers are accepted for password");	
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL. GO AHEAD AND CHECK IF THE USER IS IN THE DATABASE
		
		//CHECK USER
		$checkUser = new UserCheck($myData_useremail,  $myData_password);
		
		if($checkUser->getIsValidUser())
		{
			//VALID USER :)
         $_SESSION['valid_user_id'] = $checkUser->getUserID();
				
			//CREATE A USER OBJECT
			$user_id = $_SESSION['valid_user_id'];   
				
         $userLoggedIn = new User($user_id);
         $userLeagues = $userLoggedIn->getLeagues();
         $userTeams = $userLoggedIn->getTeams();
				
         $smarty->assign("userLoggedIn",$userLoggedIn);
         $smarty->assign("userLeagues",$userLeagues);
         $smarty->assign("userTeams",$userTeams);
				
         $smarty->display('success.tpl');	
		}
		else
      {
         //RESULT IS EMPTY NO USER FOUND
         //GET ALL USERS
			$arUsers = DataManager::getAllUsersAsObjects();
         $smarty->assign("users",$arUsers);
    	  	$smarty->assign('errors', '');
         $smarty->assign('user_error', 'Invalid Email or Password');
         $smarty->display('index.tpl');
      }
   }
   else
   {
      //VALIDATION FAILED; THERE ARE ERRORS
      $error_hash = $validator->GetErrors();
      $smarty->assign("users",$arUsers);
      $smarty->assign('user_error', '');
      $smarty->assign('errors', $error_hash);
      $smarty->display('index.tpl');       
   }
}
else if(isset($_SESSION['valid_user_id']))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   
   //CREATE A USER OBJECT
   $user_id = $_SESSION['valid_user_id'];   
						
   $userLoggedIn = new User($user_id);
   $userLeagues = $userLoggedIn->getLeagues();
   $userTeams = $userLoggedIn->getTeams();

   $smarty->assign("userLoggedIn",$userLoggedIn);
   $smarty->assign("userID",$user_id);
   $smarty->assign("userLeagues",$userLeagues);
   $smarty->assign("userTeams",$userTeams);
	
   $smarty->display('success.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   //GET ALL USERS
	$arUsers = DataManager::getAllUsersAsObjects();
   $smarty->assign("users",$arUsers);
   
   //VARIABLES
   $smarty->assign('user_error', '');
   $smarty->assign('errors', '');
   $smarty->assign('memberuser', '');
   $smarty->assign('memberpass', '');
   
   $smarty->display('index.tpl');
}
?>

