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
	
	
	//CREATE USER OBJECT
	$userLoggedIn = new User($user_id);
}
else
{
	$leagueUserID = "not valid";	
}


if(isset($_POST['submit']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //FORM WAS SUBMITTED, THE USER IS VALID USER AND A LEAGUE IS SET

   //GET THE VALUES FROM THE FORM
   $myData_seasonname = $_POST['insertseasonname'];

   $smarty->assign('seasonname', $myData_seasonname);

   $validator = new FormValidator();
   $validator->addValidation("insertseasonname","req","Please fill in season name"); 
   $validator->addValidation("insertseasonname","alnum_s_special_chars","Only letters, numbers and the symbols \". _ - ( ) \" are accepted for season name");	
   
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL.
		 
	   //SET NEW NAME FOR THE SEASON
      $league->insertSeason($myData_seasonname);
	
      header('Location: league.php?l_id='.$league_id);
   }
   else
   {
      //VALIDATION FAILED; THERE ARE ERRORS
      $error_hash = $validator->GetErrors();
      $smarty->assign('errors', $error_hash);
		$smarty->assign("userLoggedIn",$userLoggedIn);
      $smarty->assign('league', $league);
      $smarty->display('insertseason.tpl');       
   }
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   $smarty->assign("userLoggedIn",$userLoggedIn);
   $smarty->assign('seasonname', '');
   $smarty->assign('errors', '');
   $smarty->assign('league', $league);
   $smarty->display('insertseason.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

