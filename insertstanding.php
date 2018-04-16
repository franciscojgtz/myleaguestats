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
	
	$userLoggedIn = new User($leagueUserID);
}
else
{
	$leagueUserID = "not valid";	
}


if(isset($_POST['submit']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //FORM WAS SUBMITTED, THE USER IS VALID USER

   //GET THE VALUES FROM THE FORM
	$myData_team = $_POST['dropdownteam'];
   $myData_gameswon = $_POST['gameswon'];
	$myData_gamestied = $_POST['gamestied'];
	$myData_gameslost = $_POST['gameslost'];
	$myData_goalsfavor = $_POST['goalsfavor'];
	$myData_goalsagainst = $_POST['goalsagainst'];
	$myData_pointsdeducted = $_POST['pointsdeducted'];
	$myData_bonuspoints = $_POST['bonuspoints'];

   //$smarty->assign('seasonname', $myData_seasonname);

   $validator = new FormValidator();
   $validator->addValidation("gameswon","req","Please fill in games won"); 
   $validator->addValidation("gameswon","num","Only numbers are accepted for games won");	
	$validator->addValidation("gamestied","req","Please fill in games tied"); 
   $validator->addValidation("gamestied","num","Only numbers are accepted for games tied");	
	$validator->addValidation("gameslost","req","Please fill in games lost"); 
   $validator->addValidation("gameslost","num","Only numbers are accepted for games lost");	
	$validator->addValidation("goalsfavor","req","Please fill in goals in favor"); 
   $validator->addValidation("goalsfavor","num","Only numbers are accepted for goals in favor");	
	$validator->addValidation("goalsagainst","req","Please fill in goals in against"); 
   $validator->addValidation("goalsagainst","num","Only numbers are accepted for goals against");	
	$validator->addValidation("pointsdeducted","req","Please fill in points deducted"); 
   $validator->addValidation("pointsdeducted","num","Only numbers are accepted for points deducted");	
	$validator->addValidation("bonuspoints","req","Please fill in bonus points"); 
   $validator->addValidation("bonuspoints","num","Only numbers are accepted for bonus points");		
   
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL.
		 
	  //SET NEW INFORMATION FOR THE STANDING
      $season->insertStanding($myData_team, $myData_gameswon, $myData_gamestied, $myData_gameslost, $myData_goalsfavor, $myData_goalsagainst, $myData_pointsdeducted, $myData_bonuspoints);
		
      header('Location: season.php?s_id='.$season_id);
   }
   else
   {
      //VALIDATION FAILED; THERE ARE ERRORS
      $error_hash = $validator->GetErrors();
      $smarty->assign('errors', $error_hash);
	  
	   $smarty->assign('userLoggedIn', $userLoggedIn);
		$smarty->assign('league', $league);
		$smarty->assign('season', $season);
		$user_teams = $user->getTeams();
		$smarty->assign('user_teams', $user_teams);	
			
		$smarty->assign('games_won', $myData_gameswon);
		$smarty->assign('games_tied', $myData_gamestied);
		$smarty->assign('games_lost', $myData_gameslost);
		$smarty->assign('goals_favor', $myData_goalsfavor);
		$smarty->assign('goals_against', $myData_goalsagainst);
		$smarty->assign('pts_deducted', $myData_pointsdeducted);
		$smarty->assign('bonus_pts', $myData_bonuspoints);
   
      $smarty->display('insertstanding.tpl');       
   }
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   $smarty->assign('userLoggedIn', $userLoggedIn);
	$smarty->assign('league', $league);
	$smarty->assign('season', $season);

	
	$smarty->assign('errors', '');
	
	$smarty->assign('games_won', 0);
	$smarty->assign('games_tied', 0);
	$smarty->assign('games_lost', 0);
	$smarty->assign('goals_favor', 0);
	$smarty->assign('goals_against', 0);
	$smarty->assign('pts_deducted', 0);
	$smarty->assign('bonus_pts', 0);
	
	$user_teams = $userLoggedIn->getTeams();
	$smarty->assign('user_teams', $user_teams);	
	
	if(empty($user_teams))
	{
		$smarty->display('addteamtoinsertstanding.tpl');
	}
	else
	{
   	$smarty->display('insertstanding.tpl');
	}
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

