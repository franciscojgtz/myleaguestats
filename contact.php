<?php
session_start();

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');
require('libs/recaptchalib.php');

$smarty = new Smarty;
//$smarty->debugging = true;
//$smarty->compile_check = true;

	if(isset($_SESSION['valid_user_id']))
	{
		$valid_user_id = $_SESSION['valid_user_id'];   
		$smarty->assign("user_id",$valid_user_id);
		
		$userLoggedIn = new User($valid_user_id);
		
		$smarty->assign('userLoggedIn', $userLoggedIn);
	}
	else
	{
   	//THE PAGE WAS JUST OPENED
   	$smarty->assign("user_id","");
	}

$smarty->assign("contact","Home");

//insert goblal keys
$pub_key = "6Lf1C88SAAAAAOaiUuXudBpDwbKRQzDgW6YqBzg5";
$pri_key = "6Lf1C88SAAAAAN5Js9oLZtkqP6bRpBs11ripnkw3";

// the response from reCAPTCHA
$resp = null;
// the error code from reCAPTCHA, if any
$captcha_error = null;

$smarty->assign("recaptcha", recaptcha_get_html($pub_key)); 
//$smarty->assign("recaptcha", recaptcha_get_html($pub_key, $captcha_error)); 


if(isset($_POST['submit']))
{
	//FORM WAS SUBMITTED

	//get the values from the form
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$smarty->assign('name', $name);
	$smarty->assign('email', $email);
	$smarty->assign('message', $message);
    
	if ($_POST["recaptcha_response_field"]) 
	{
		//THERE WAS SOME KIND OF INPUT IN CAPTCHA
	
		$resp = recaptcha_check_answer ($pri_key,
		$_SERVER["REMOTE_ADDR"],
		$_POST["recaptcha_challenge_field"],
		$_POST["recaptcha_response_field"]);

		if ($resp->is_valid)
		{
			//THE INPUT IN CAPTCHA WAS VALID
		
			$validator = new FormValidator();
			$validator->addValidation("name","req","Please fill in Name"); 
			$validator->addValidation("name","alnum_s","Only letters and numbers are accepted for name");	
			$validator->addValidation("email","email","The input for Email should be a valid email value");
			$validator->addValidation("email","req","Please fill in Email");
			$validator->addValidation("message","req","Please fill in Message"); 
			$validator->addValidation("message","alnum_s","Only letters and numbers are accepted in message");
			if($validator->ValidateForm())
			{
			 
				//VALIDATION WAS SUCCESSFULL
                $content = 'name : ' . $name . '<br />';
                $content .= 'content : ' . $message . '<br />';
 
                $content = str_replace('<br />', " \n ", $content);
 
                mail('admin@gutierrezfrancisco.net', 'comment', $content, $email);
				
				//DISPLAYE SUCCESS PAGE
				$smarty->display('contactsent.tpl');
			}
			else
			{
				//VALIDATION FAILED
			
				//there are errors
				$error_hash = $validator->GetErrors();
			
				$smarty->assign('errors', $error_hash);
				$smarty->assign('captcha_error', "");

				$smarty->display('contact.tpl');       
			}
		}
		else 
		{
			//THE INPUT IN CAPTCHA WAS INVALID

			// set the error code so that we can display it
			$captcha_error = $resp->error;
			if($captcha_error == "incorrect-captcha-sol")
		   {
		   	$captcha_error = "Captcha input was wrong";
	      }
			$smarty->assign('captcha_error', $captcha_error);
			$smarty->assign('errors', "");
			
			$smarty->display('contact.tpl');
		}
	}
	else
	{
	       //THERE WAS NOTHING INPUTTED INTO CAPTCHA SO RELOAD THE FORM
		$captcha_error = 'Please solve captcha';
		$smarty->assign('errors', "");
		$smarty->assign('captcha_error', $captcha_error);
		
		$smarty->display('contact.tpl');
	}
}
else
{
	$smarty->assign('errors', "");
	$smarty->assign('name', "");
	$smarty->assign('email', "");
	$smarty->assign('message', "");
	$smarty->assign('captcha_error', "");
	$smarty->display('contact.tpl');
}

?>

