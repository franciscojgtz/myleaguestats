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
		
		//DISPLAY SUCCESS PAGE
		$smarty->display('contactsent.tpl');
	}
	else
	{
		//VALIDATION FAILED
	
		//there are errors
		$error_hash = $validator->GetErrors();
	
		$smarty->assign('errors', $error_hash);

		$smarty->display('contact.tpl');       
	}
}
else
{
	$smarty->assign('errors', "");
	$smarty->assign('name', "");
	$smarty->assign('email', "");
	$smarty->assign('message', "");
	$smarty->display('contact.tpl');
}

?>

