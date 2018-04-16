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
   $myData_newpass = $_POST['newpass'];
	$myData_conpass = $_POST['conpass'];

   $validator = new FormValidator();
   $validator->addValidation("newpass","req","Please fill in new password"); 
   $validator->addValidation("newpass","alnum","Only letters and numbers are accepted for new password");	
	$validator->addValidation("conpass","req","Please fill in new password"); 
   $validator->addValidation("conpass","alnum","Only letters and numbers are accepted for new password");	
	$validator->addValidation("newpass","eqelmnt=conpass","Paswords don't match");	
	$validator->addValidation("newpass","minlen=6","Pasword should be at least 6 digits long");	
	$validator->addValidation("conpass","minlen=6","Pasword should be at least 6 digits long");	
   
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL.
					
      $userEmail = $userLoggedIn->getEmail();
      
      
      //LET THE USER KNOW THAT THE PASSWORD HAS BEEN UPDATED
		$to      = $userEmail;
		$subject = 'Password has been changed';
		$message = 'Your password has changed. Use your new password to log in. If you have any questions, please contact us at admin@franciscogutierrez.website';
		$headers = 'From: admin@myleaguestats.com' . "\r\n" .
    				  'Reply-To: admin@franciscogutierrez.website' . "\r\n" .
    				  'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
		
		//CHANGE THE PASSWORD AFTER THE EMAIL HAS BEEN SENT
		$userLoggedIn->changePassword($myData_newpass);
      
      header('Location: index.php');
   }
   else
   {
	   //PASS USER
	   $smarty->assign("userLoggedIn",$userLoggedIn);
      //VALIDATION FAILED; THERE ARE ERRORS
      $error_hash = $validator->GetErrors();
      $smarty->assign('errors', $error_hash);
      $smarty->display('changepassword.tpl');       
   }
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   $smarty->assign("userLoggedIn",$userLoggedIn);
	$smarty->assign('errors', '');
   $smarty->display('changepassword.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

