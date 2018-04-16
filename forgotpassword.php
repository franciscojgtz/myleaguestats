<?php
session_start();

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');
require('libs/recaptchalib.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

//VARIABLES

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

   $smarty->assign('useremail', $myData_useremail);

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
         $validator->addValidation("memberuseremail","email","Please provide a valid email address");	

         if($validator->ValidateForm() and ($myData_useremail != "demo@gutierrezfrancisco.net"))
         {
            //VALIDATION WAS SUCCESSFULL. GO AHEAD AND CHECK IF THE EMAIL IS IN THE DATABASE
				
				//CHECK USERNAME OR EMAIL ARE IN DATABASE
				$arUsers = DataManager::getAllUsersAsObjects();
				
				$userEmailInDB;
				$userID;
				
				foreach ($arUsers as $arUser)
				{
					$temp_user_email = $arUser->getEmail();
					//COMPARE EMAIL WITH DABASE VALUES

					if($myData_useremail == $temp_user_email)
					{
						//EMAIL ALREADY IN THE DATABASE
						$userEmailInDB = "yes";
						
						//GET THE ID OF THE USER
						$userID = $arUser->getUserID();
						
						break;
					}
					else
					{
						//EMAIL IS AVAILABLE
				      $userEmailInDB = "no";
					}
				}
				
				//DISPLAY ERROR IF EMAIL IS NOT IN THE DATABASE, ELSE SEND THE NEW PASSWORD TO THE EMAIL PROVIDED
				if($userEmailInDB == "no" || $myData_useremail == "demo@franciscogutierrez.website")
				{				
						$smarty->assign('captcha_error', '');
          	  		$smarty->assign('errors', '');
               	$smarty->assign('user_error', 'This is email is not in our database');
               	$smarty->display('forgotpassword.tpl');	
				}
				else if($userEmailInDB == "yes" && $myData_useremail != "demo@franciscogutierrez.website")
				{
					//CREATE, STORE, AND SEND NEW PASSWORD TO THE EMAIL
					
					//CREATE USER
					$user = new User($userID);
					
					$randPassword = $user->randString(16);
					
					//SEND NEW PASSWORD TO THE USER
					$to      = $myData_useremail;
					$subject = 'Password has been changed';
					$message = 'Your password has been reseted. Your new password is : ' . $randPassword;
					$headers = 'From: admin@myleaguestats.com' . "\r\n" .
    				'Reply-To: admin@myleaguestats.com' . "\r\n" .
    				'X-Mailer: PHP/' . phpversion();

					mail($to, $subject, $message, $headers);
					
					//STORE PASSWORD IN THE DATABASE
					$user->changePassword($randPassword);		
					
					$smarty->assign('captcha_error', '');
          	  	$smarty->assign('errors', '');
               $smarty->assign('user_error', 'Success reseting password!');
               $smarty->display('forgotpassword.tpl');				
				}
         }
         else
         {
            //VALIDATION FAILED; THERE ARE ERRORS
            $error_hash = $validator->GetErrors();
            $smarty->assign('user_error', '');
   			$smarty->assign('captcha_error', '');
            $smarty->assign('errors', $error_hash);
            $smarty->display('forgotpassword.tpl');       
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
	      $smarty->assign('user_error', '');
  			$smarty->assign('errors', '');
         $smarty->assign('captcha_error', $captcha_error);
         $smarty->display('forgotpassword.tpl');
      }
   }
   else
   {
      //THERE WAS NOTHING INPUTTED INTO CAPTCHA SO RELOAD THE FORM
      $captcha_error = 'Please solve captcha';
      
      $smarty->assign('user_error', '');
  		$smarty->assign('errors', '');
      $smarty->assign('captcha_error', $captcha_error);
      $smarty->display('forgotpassword.tpl');
   }
}
else if(isset($_SESSION['valid_user_id']))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   
   //CREATE A USER OBJECT
   $user_id = $_SESSION['valid_user_id'];   
						
   $user = new User($user_id);
   $userName = $user->getName();
   $userEmail = $user->getEmail();
   $userLeagues = $user->getLeagues();
   $userTeams = $user->getTeams();

   $smarty->assign("user",$user);
   $smarty->assign("userID",$user_id);
   $smarty->assign("userName",$userName);
   $smarty->assign("userEmail", $userEmail);
   $smarty->assign("userLeagues",$userLeagues);
   $smarty->assign("userTeams",$userTeams);
	
   $smarty->display('success.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   
   //VARIABLES
   $smarty->assign('user_error', '');
   $smarty->assign('captcha_error', '');
   $smarty->assign('errors', '');
   $smarty->assign('useremail', '');
   
   $smarty->display('forgotpassword.tpl');
}
?>

