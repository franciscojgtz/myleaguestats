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
	$myData_localTeam = $_POST['localteam'];
   $myData_visitorTeam = $_POST['visitorteam'];
	$myData_gamePlayed = $_POST['gameplayed'];
	$myData_localGoals = $_POST['localgoals'];
	$myData_visitorGoals = $_POST['visitorgoals'];
	$myData_dateMonth = $_POST['Date_Month'];
	$myData_dateDay = $_POST['Date_Day'];
	$myData_dateYear = $_POST['Date_Year'];
	$myData_timeHour = $_POST['Time_Hour'];
	$myData_timeMinute = $_POST['Time_Minute'];
	$myData_gamePlace = $_POST['gameplace'];
	$myData_gameRound = $_POST['gameround'];
	
	//CREATE DATE AND TIME
	$gameDate = $myData_dateYear."-".$myData_dateMonth."-".$myData_dateDay;
	$gameTime = $myData_timeHour.":".$myData_timeMinute.":00";

   $validator = new FormValidator();
	$validator->addValidation("localteam","req","Please choose the local team");
	$validator->addValidation("visitorteam","req","Please choose the visitor team");
   $validator->addValidation("gameplayed","req","Please fill in game played");
	$validator->addValidation("localgoals","req","Please fill in local goals");
	$validator->addValidation("localgoals","num","local goals should be a number");
	$validator->addValidation("localgoals","gt -1","local should be zero or more ");
	$validator->addValidation("visitorgoals","req","Please fill in visitor goals");
	$validator->addValidation("visitorgoals","num","visitor goals should be a number");
	$validator->addValidation("visitorgoals","gt -1","visitor should be zero or more ");
	$validator->addValidation("Date_Month","req","Please fill in date month");
	$validator->addValidation("Date_Day","req","Please fill in date day");
	$validator->addValidation("Date_Year","req","Please fill in date year");
	$validator->addValidation("Time_Hour","req","Please fill in time hour");
	$validator->addValidation("Time_Minute","req","Please fill in time minute");
	$validator->addValidation("gameplace","req","Please fill in game place");
	$validator->addValidation("gameplace","alnum_s","Only letters and numbers are accepted for place");
	$validator->addValidation("gameround","req","Please fill in game round");
	$validator->addValidation("gameround","alnum_s","Only letters and numbers are accepted for round");
	
   
   if($validator->ValidateForm())
   {
      //VALIDATION WAS SUCCESSFULL.

	  //SET NEW INFORMATION FOR THE GAME
     $season->insertGame($myData_localTeam, $myData_visitorTeam, $myData_gamePlayed, $myData_localGoals, $myData_visitorGoals, $gameDate, $gameTime, $myData_gamePlace, $myData_gameRound);
		
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
		
		$user_teams = $userLoggedIn->getTeams();
		
		$season_teams = $season->getStandings();
		
		$smarty->assign('season_teams', $season_teams);

		$smarty->assign('user_teams', $user_teams);	
		$smarty->assign('local_team_id', $myData_localTeam);
		$smarty->assign('visitor_team_id', $myData_visitorTeam);
		$smarty->assign('game_played', $myData_gamePlayed);
		$smarty->assign('local_goals', $myData_localGoals);
		$smarty->assign('visitor_goals', $myData_visitorGoals);
		$smarty->assign('game_date', $gameDate);
		$smarty->assign('game_time', $gameTime);
		$smarty->assign('game_place', $myData_gamePlace);
		$smarty->assign('game_round', $myData_gameRound);
   
      $smarty->display('insertgame.tpl'); 
     
   }
}
else if(isset($_SESSION['valid_user_id']) && ($valid_user_id == $user_id) && ($valid_user_id == $leagueUserID))
{
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   $smarty->assign('userLoggedIn', $userLoggedIn);
	$smarty->assign('league', $league);
	$smarty->assign('season', $season);
	
	$smarty->assign('errors', '');
	$smarty->assign('local_team_id', '');
	$smarty->assign('visitor_team_id', '');
	$smarty->assign('game_played', '');
	$smarty->assign('local_goals', 0);
	$smarty->assign('visitor_goals', 0);
	$smarty->assign('game_date', '');
	$smarty->assign('game_time', '');
	$smarty->assign('game_place', '');
	$smarty->assign('game_round', '');
	
	$user_teams = $userLoggedIn->getTeams();
	$smarty->assign('user_teams', $user_teams);	
	
	$season_teams = $season->getStandings();
		
	$smarty->assign('season_teams', $season_teams);
	if(empty($season_teams))
	{
		$smarty->display('addteamstoinsertgame.tpl');	
	}
	else
	{
   	$smarty->display('insertgame.tpl'); 
	}
}
else
{
   //THE PAGE WAS JUST OPENED
   header('Location: index.php');
}
?>

