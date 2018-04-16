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
require('libs/recaptchalib.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

//INSERT GLOBAL KEYS FOR RECAPTCHA
$pub_key = "6Lf1C88SAAAAAOaiUuXudBpDwbKRQzDgW6YqBzg5";
$pri_key = "6Lf1C88SAAAAAN5Js9oLZtkqP6bRpBs11ripnkw3";

//THE RESPONSE FROM RECAPTCHA
$resp = null;
//THE ERROR CODE FROM RECAPTCHA, IF ANY
$captcha_error = null;

$smarty->assign("recaptcha", recaptcha_get_html($pub_key)); 

if(isset($_POST['submit']))
{
   //FORM WAS SUBMITTED

   //GET THE VALUES FROM THE FORM
   $myData_useremail = $_POST['memberuseremail'];
   $myData_password = $_POST['memberpassword'];

   $smarty->assign('memberuser', $myData_useremail);
   $smarty->assign('memberpass', $myData_password);

   if ($_POST["recaptcha_response_field"]) 
   {
      //THERE WAS SOME KIND OF INPUT IN CAPTCHA
      $resp = recaptcha_check_answer ($pri_key,
      $_SERVER["REMOTE_ADDR"],
      $_POST["recaptcha_challenge_field"],
      $_POST["recaptcha_response_field"]);

      if ($resp->is_valid)
      {
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
               $smarty->assign('captcha_error', '');
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
   			$smarty->assign('captcha_error', '');
            $smarty->assign('errors', $error_hash);
            $smarty->display('index.tpl');       
         }
      }
      else 
      {
         //THE INPUT IN CAPTCHA WAS INVALID; SET THE ERROR CODE SO THAT WE CAN DISPLAY IT
         $captcha_error = $resp->error;
		 if($captcha_error == "incorrect-captcha-sol")
		 {
		    $captcha_error = "Captcha input was wrong";
	     }
	     //GET ALL USERS
			$arUsers = DataManager::getAllUsersAsObjects();
	     	$smarty->assign("users",$arUsers);
	      $smarty->assign('user_error', '');
  			$smarty->assign('errors', '');
         $smarty->assign('captcha_error', $captcha_error);
         $smarty->display('index.tpl');
      }
   }
   else
   {
      //THERE WAS NOTHING INPUTTED INTO CAPTCHA SO RELOAD THE FORM
      $captcha_error = 'Please solve captcha';
      //GET ALL USERS
		$arUsers = DataManager::getAllUsersAsObjects();
      $smarty->assign("users",$arUsers);
      $smarty->assign('user_error', '');
  		$smarty->assign('errors', '');
      $smarty->assign('captcha_error', $captcha_error);
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
   $smarty->assign('captcha_error', '');
   $smarty->assign('errors', '');
   $smarty->assign('memberuser', '');
   $smarty->assign('memberpass', '');
   
   $smarty->display('index.tpl');
}
?>

