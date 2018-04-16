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
$team_id = $_GET['t_id'];

if(isset($team_id))
{
	//CREATE A LEAGUE OBJECT  
   $team = new Team($team_id); 
	$teamUserID = $team->getUserID();
}
else
{
	$teamUserID = "not valid";	
}

if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id))
{
	$userLoggedIn = new User($valid_user_id);
}

if(isset($_POST['submit']) && ($valid_user_id == $user_id) && ($valid_user_id == $teamUserID))
{
   //FORM WAS SUBMITTED, THE USER IS VALID USER AND A TEAM IS SET

   //GET THE VALUES FROM THE FORM
   $myData_teamname = $_POST['editteamname'];

   $smarty->assign("teamname", $myData_teamname);

   $validator = new FormValidator();
   $validator->addValidation("editteamname","req","Please fill in team name"); 
   $validator->addValidation("editteamname","alnum_s","Only letters and numbers are accepted for team name");	
   
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL.
		 
	  //SET NEW NAME FOR THE TEAM
      $team->setName($myData_teamname);
	
      header('Location: team.php?t_id='.$team_id);
   }
   else
   {
	   //SET THE USER
	   $smarty->assign("userLoggedIn",$userLoggedIn);
      //VALIDATION FAILED; THERE ARE ERRORS
      $error_hash = $validator->GetErrors();
      $smarty->assign('errors', $error_hash);
	  
	  //GET NAME FOR THE TEAM
      $team_name = $team->getName();
   
      $smarty->assign('team', $team);
      $smarty->display('editteam.tpl');       
   }
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id) && ($valid_user_id == $teamUserID))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   $smarty->assign("userLoggedIn",$userLoggedIn);
   $smarty->assign('errors', '');
   $smarty->assign('team', $team);
   $smarty->display('editteam.tpl');
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

