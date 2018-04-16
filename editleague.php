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
$league_id = $_GET['l_id'];

if(isset($league_id))
{
	//CREATE A LEAGUE OBJECT  
   $league = new League($league_id); 
	$leagueUserID = $league->getUserID();
}
else
{
	$leagueUserID = "not valid";	
}

if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id))
{
	$userLoggedIn = new User($valid_user_id);
}


if(isset($_POST['submit']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //FORM WAS SUBMITTED, THE USER IS VALID USER AND A LEAGUE IS SET

   //GET THE VALUES FROM THE FORM
   $myData_leaguename = $_POST['editleaguename'];

   $smarty->assign('leaguename', $myData_leaguename);

   $validator = new FormValidator();
   $validator->addValidation("editleaguename","req","Please fill in league name"); 
   $validator->addValidation("editleaguename","alnum_s","Only letters and numbers are accepted for league name");	
   
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL.
		 
	  //SET NEW NAME FOR THE LEAGUE
      $league->setName($myData_leaguename);
	
      header('Location: league.php?l_id='.$league_id);
   }
   else
   {
	   //ASSIGN THE USER
	   $smarty->assign("userLoggedIn",$userLoggedIn);
	   
      //VALIDATION FAILED; THERE ARE ERRORS
      $error_hash = $validator->GetErrors();
      $smarty->assign('errors', $error_hash);

      $smarty->assign('league', $league);
      $smarty->display('editleague.tpl');       
   }
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   $smarty->assign("userLoggedIn",$userLoggedIn);
   $smarty->assign('errors', '');
   $smarty->assign('league', $league);
   $smarty->display('editleague.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

