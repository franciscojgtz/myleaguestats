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
$season_id = $_GET['s_id'];

if(isset($season_id))
{
	//CREATE A SEASON OBJECT  
   $season = new Season($season_id); 
	$seasonLeagueID = $season->getLeagueID();
	
	//CREATE A LEAGUE OBJECT  
   $league = new League($seasonLeagueID); 
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
   //FORM WAS SUBMITTED, THE USER IS VALID USER

   //GET THE VALUES FROM THE FORM
   $myData_seasonname = $_POST['editseasonname'];

   $smarty->assign('seasonname', $myData_seasonname);

   $validator = new FormValidator();
   $validator->addValidation("editseasonname","req","Please fill in season name"); 
   $validator->addValidation("editseasonname","alnum_s_special_chars","Only letters and numbers are accepted for season name");	
   
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL.
		 
	  //SET NEW NAME FOR THE SEASON
      $season->setName($myData_seasonname);
	
      header('Location: season.php?s_id='.$season_id);
   }
   else
   {
	   //SET THE USER
	   $smarty->assign("userLoggedIn",$userLoggedIn);
      //VALIDATION FAILED; THERE ARE ERRORS
      $error_hash = $validator->GetErrors();
      $smarty->assign('errors', $error_hash);
   
      $smarty->assign('season', $season);
      $smarty->display('editseason.tpl');       
   }
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
  $smarty->assign("userLoggedIn",$userLoggedIn);
   $smarty->assign('errors', '');
   $smarty->assign('season', $season);
   $smarty->display('editseason.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

