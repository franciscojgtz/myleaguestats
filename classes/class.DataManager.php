<?php

require_once('class.User.php');
require_once('class.UserCheck.php');
require_once('class.League.php');
require_once('class.Season.php');
require_once('class.Standing.php');
require_once('class.Team.php');
require_once('class.Game.php');
require_once('class.HashPassword.php');

require_once('class.GameDate.php');



class DataManager
{
	private static function _getConnection()
	{
		static $hDB;
		
		if(isset($hDB))
		{
			return $hDB;
		}

		include('dbconfig.php');
		
		$dbcnx = @mysql_connect($host, $user, $pass);//connect to the database
		
		if (!$dbcnx)
		{
			throw new Exception("no connection was made!");            
			exit();//if no connection, exit
		}
		
		mysql_select_db($database, $dbcnx);//select database
		
		if (! @mysql_select_db($database) ) 
		{
			throw new Exception("no database exists!");        
			exit();//if no database, exit
		}
		
		return $dbcnx;
	}
	
	public static function insertUser($userName, $email, $userPassword, $salt)
	{
		$sql =  "insert into users (user_email, user_name, user_pass, user_salt )";
		$sql = $sql. "values ('".$email."', '".$userName."', '".$userPassword."', '".$salt."')";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res))
		{
			die("Failed inserting new user $userName, $email, $userPassword, $salt" . mysql_error());
		}
	}
	
	public static function checkValidUser($userEmail, $password)
	{
		$sql = "SELECT * FROM users WHERE user_email = '$userEmail' and user_pass = '$password'";
		
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res && mysql_num_rows($res)))
		{
			return "not user found";
		}
		return mysql_fetch_assoc($res);
	}
	
	public static function getUserData($userID)
	{
		$sql = "SELECT * FROM users WHERE user_id = $userID";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res && mysql_num_rows($res)))
		{
			return "error";
			//die("Failed getting user data for user $userID");
		}
		return mysql_fetch_assoc($res);
	}
	
	public static function getUserIDByEmail($userEmail)
	{
		$sql = "SELECT user_id FROM users WHERE user_email = '$userEmail'";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res && mysql_num_rows($res)))
		{
			return '';
			//die("Failed getting user id for user $userEmail");
		}
		return mysql_fetch_assoc($res);
	}
	
	public static function deleteUser($userID)
	{
		$sql =  "DELETE FROM users WHERE user_id = $userID";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed deleting user $userID");
		}
	}
	
	public static function setUserName($userID, $newUserName)
	{
		$sql =  "update users set ";
		$sql = $sql."user_name = '".$newUserName."' where user_id = '".$userID."'";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed setting username as $newUserName for user $userID");
		}
	}
	
	public static function setUserEmail($userID, $newUserEmail)
	{
		$sql =  "update users set ";
		$sql = $sql."user_email = '".$newUserEmail."' where user_id = '".$userID."'";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed setting user email as $newUserEmail for user $userID");
		}
	}
	
	public static function changePassword($userID, $newPass)
	{
		$sql =  "update users set ";
		$sql = $sql."user_pass = '".$newPass."' where user_id = '".$userID."'";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed setting changing password for user $userID");
		}
	}
	
	public static function getAllUsersAsObjects()
	{
		$sql = "SELECT user_id FROM users";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(!$res)
		{
			die("Failed getting all users");
		}
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
				try
				{
					$objs[] = new User($row['user_id']);
				}
				catch(Exception $e)
				{
					echo 'Message: ' . $e->getMessage();
				}
			
			}
			return $objs;
		}
		else
		{
			return array();
		}
	}    
	
	public static function getLeagueObjectsForUser($userID)
	{
		$sql = "SELECT * FROM leagues WHERE user_id = $userID";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
				try
				{
					$objs[] = new League($row['league_id']);
				}
				catch(Exception $e)
				{
					echo 'Message: ' . $e->getMessage();
				}
			
			}
			return $objs;
		}
		else
		{
			return array();
		}
	}
	
	public static function getTeamObjectsForUser($userID)
	{
		$sql = "SELECT * FROM teams WHERE user_id = $userID";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
				try
				{
					$objs[] = new Team($row['team_id']);
				}
				catch(Exception $e)
				{
					echo 'Message: ' . $e->getMessage();
				}
			}
			return $objs;
		}
		else
		{
			return array();
		}
	}
	
	public static function getLeagueData($leagueID)
	{
		$sql = "SELECT * FROM leagues WHERE league_id = $leagueID";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res && mysql_num_rows($res)))
		{
			return "error";
			//die("Failed getting user data for league $leagueID");
		}
		return mysql_fetch_assoc($res);
	}
	
	public static function insertLeague($userID, $leagueName)
	{
		$sql =  "insert into leagues (user_id, league_name) ";
		$sql = $sql. "values (".$userID.", '".$leagueName."')";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res))
		{
			die("Failed inserting new league for user $userID");
		}
	}
	
	public static function deleteLeague($leagueID)
	{
		$sql =  "DELETE FROM leagues WHERE league_id = $leagueID";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed deleting league $leagueID");
		}
	}
	
	public static function setLeagueName($leagueID, $newLeagueName)
	{
		$sql =  "update leagues set ";
		$sql = $sql."league_name = '".$newLeagueName."' where league_id = '".$leagueID."'";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed setting league name as $newLeagueName for league $leagueID");
		}
	}
	
	public static function getSeasonObjectsForLeague($leagueID)
	{
		$sql = "SELECT * FROM seasons WHERE league_id = $leagueID";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
				try
				{
					$objs[] = new Season($row['season_id']);
				}
				catch(Exception $e)
				{
					echo 'Message: ' . $e->getMessage();
				}
			}
			return $objs;
		}
		else
		{
			return array();
		}
	}
	
	public static function getSeasonData($seasonID)
	{
		$sql = "SELECT * FROM seasons WHERE season_id = $seasonID";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res && mysql_num_rows($res)))
		{
			return "error";
			//die("Failed getting user data for season $seasonID");
		}
		return mysql_fetch_assoc($res);
	}
	
	public static function deleteSeason($seasonID)
	{
		$sql =  "DELETE FROM seasons WHERE season_id = $seasonID";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed deleting season $seasonID");
		}
	}
	
	public static function insertSeason($leagueID, $seasonName)
	{
		$sql =  "insert into seasons (league_id, season_name) ";
		$sql = $sql. "values (".$leagueID.", '".$seasonName."')";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res))
		{
			die("Failed inserting new season $seasonName for league $leagueID");
		}
	}
	
	
	public static function setSeasonName($seasonID, $newSeasonName)
	{
		$sql =  "update seasons set ";
		$sql = $sql."season_name = '".$newSeasonName."' where season_id = '".$seasonID."'";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed setting season name as $newSeasonName for season $seasonID");
		}
	}
	
	public static function getStandingObjectsForSeason($seasonID)
	{  
		$sql = "SELECT st_id, team_id, gms_won, gms_tied, gms_lost, gls_favor, gls_against, (gls_favor)-(gls_against) AS gls_dif, pts_deducted, bonus_pts, (gms_won*3)+(gms_tied)-(pts_deducted)+(bonus_pts) AS pts FROM standings WHERE season_id = $seasonID order by pts desc, gls_dif desc, gls_favor desc";
		
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
			try
			{  
				$objs[] = new Standing($row['st_id']);
			}
			catch(Exception $e)
			{
				echo 'Message: ' . $e->getMessage();
			}	
			}
			return $objs;
		}
		else
		{
			return array();
		}
	}
	
	public static function getStandingData($standingID)
	{  
		$sql = "SELECT st_id, season_id, team_id, gms_won, gms_tied, gms_lost, gls_favor, gls_against, (gls_favor)-(gls_against) AS gls_dif, pts_deducted, bonus_pts, date_created, date_last_modified, (gms_won*3)+(gms_tied)-(pts_deducted)+(bonus_pts) AS pts FROM standings WHERE st_id = $standingID";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res && mysql_num_rows($res)))
		{
			die("Failed getting user data for standing $standingID");
		}
		return mysql_fetch_assoc($res);
	}
	
	public static function deleteStanding($standingID)
	{
		$sql =  "DELETE FROM standings WHERE st_id = $standingID";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed deleting standing $standingID");
		}
	}
	
	public static function setStandingInfo($standingID, $teamID, $gmsWon, $gmsTied, $gmsLost, $glsFavor, $glsAgainst, $ptsDeducted, $bonusPts)
	{
		$sql =  "update standings set ";
		$sql = $sql."team_id = '".$teamID."', gms_won = '".$gmsWon."', gms_tied = '".$gmsTied."', gms_lost = '".$gmsLost."', gls_favor = '".$glsFavor."', gls_against = '".$glsAgainst."', pts_deducted = '".$ptsDeducted."', bonus_pts = '".$bonusPts."'";
		$sql = $sql." where st_id = '".$standingID."'";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed setting standing info for league $standingID");
		}
	}
	
	public static function insertStanding($seasonID, $teamID, $gmsWon, $gmsTied, $gmsLost, $glsFavor, $glsAgainst, $ptsDeducted, $bonusPts)
	{
		$sql =  "insert into standings (season_id, team_id, gms_won, gms_tied, gms_lost, gls_favor, gls_against, pts_deducted, bonus_pts) ";
		$sql = $sql. "values (".$seasonID.", '".$teamID."', '".$gmsWon."', '".$gmsTied."', '".$gmsLost."',  '".$glsFavor."',  '".$glsAgainst."', '".$ptsDeducted."', '".$bonusPts."')";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed inserting standing info for season $seasonID");
		}
	}
	
	public static function getTeamData($teamID)
	{  
		$sql = "SELECT * FROM teams WHERE team_id = $teamID";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res && mysql_num_rows($res)))
		{
			return "error";
			//die("Failed getting user data for team $teamID");
		}
		return mysql_fetch_assoc($res);
	}
	
	public static function getGameObjectsWhereTeamPlays($teamID)
	{  
		$sql = "SELECT * FROM games WHERE local_team_id = $teamID OR visitor_team_id = $teamID ORDER BY game_date DESC, game_time DESC";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
				try
				{  
					$objs[] = new Game($row['game_id']);
				}
				catch(Exception $e)
				{
					echo 'Message: ' . $e->getMessage();
				}
			}
			return $objs;
		}
		else
		{
			return array();
		}
		
	}
	
	public static function getGameObjectsWhereTeamsPlayAsLocal($teamID)
	{  
		$sql = "SELECT * FROM games WHERE local_team_id = $teamID ORDER BY game_date DESC";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
				try
				{  
					$objs[] = new Game($row['game_id']);
				}
				catch(Exception $e)
				{
					echo 'Message: ' . $e->getMessage();
				}
			}
			return $objs;
		}
		else
		{
			return array();
		}
		
	}
	
	public static function getGameObjectsWhereTeamsPlayAsVisitor($teamID)
	{  
		$sql = "SELECT * FROM games WHERE visitor_team_id = $teamID ORDER BY game_date DESC";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
				try
				{  
					$objs[] = new Game($row['game_id']);
				}
				catch(Exception $e)
				{
					echo 'Message: ' . $e->getMessage();
				}
			}
			return $objs;
		}
		else
		{
			return array();
		}
	}
	
	public static function getStandingObjectsWhereTeamIsPartOf($teamID)
	{  
		$sql = "SELECT * FROM standings WHERE team_id = $teamID";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
				try
				{  
					$objs[] = new Standing($row['st_id']);
				}
				catch(Exception $e)
				{
					echo 'Message: ' . $e->getMessage();
				}
			}
			return $objs;
		}
		else
		{
			return array();
		}
	}
	
	public static function deleteTeam($teamID)
	{
		$sql =  "DELETE FROM teams WHERE team_id = $teamID";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed deleting team $teamID");
		}
	}
	
	public static function insertTeam($userID, $teamName)
	{
		$sql =  "insert into teams (user_id, team_name) ";
		$sql = $sql. "values (".$userID.", '".$teamName."')";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res))
		{
			die("Failed inserting new team $teamName for user $userID");
		}
	}
	
	public static function setTeamName($teamID, $newTeamName)
	{
		$sql =  "update teams set ";
		$sql = $sql."team_name = '".$newTeamName."' where team_id = '".$teamID."'";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed setting team name as $newTeamName for team $teamID");
		}
	}
	
	public static function getGameData($gameID)
	{  
		$sql = "SELECT * FROM games WHERE game_id = $gameID";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(! ($res && mysql_num_rows($res)))
		{
			die("Failed getting user data for game $gameID");
		}
		return mysql_fetch_assoc($res);
	}
	
	public static function insertGame($seasonID, $localTeam, $visitorTeam, $gamePlayed, $localGoals, $visitorGoals, $gameDate, $gameTime, $gamePlace, $gameRound)
	{
		$sql =  "insert into games (season_id, local_team_id, visitor_team_id,  played, local_goals, visitor_goals, game_place, game_date, game_time, round) ";
		$sql = $sql. "values (".$seasonID.", '".$localTeam."', '".$visitorTeam."', '".$gamePlayed."', '".$localGoals."', '".$visitorGoals."',  '".$gamePlace."',  '".$gameDate."', '".$gameTime."', '".$gameRound."')";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed inserting game info for season $seasonID");
		}
	}
	
	public static function deleteGame($gameID)
	{
		$sql =  "DELETE FROM games WHERE game_id = $gameID";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed deleting game $gameID");
		}
	}
	
	public static function getGameObjectsForSeason($seasonID)
	{
		$sql = "SELECT * FROM games WHERE season_id = $seasonID order by game_date desc, game_time desc";
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
				try
				{  
					$objs[] = new Game($row['game_id']);
				}
				catch(Exception $e)
				{
					echo 'Message: ' . $e->getMessage();
				}
			}
			return $objs;
		}
		else
		{
			return array();
		}
	}
	
	public static function setGameInfo($gameID, $localTeam, $visitorTeam, $gamePlayed, $localGoals, $visitorGoals, $gameDate, $gameTime, $gamePlace, $gameRound)
	{
		$sql =  "update games set ";
		$sql = $sql."local_team_id = '".$localTeam."', visitor_team_id = '".$visitorTeam."', played = '".$gamePlayed."', local_goals = '".$localGoals."', visitor_goals = '". $visitorGoals."', game_date = '".$gameDate."', game_time = '".$gameTime."', game_place = '".$gamePlace."', round = '".$gameRound."'";
		$sql = $sql." where game_id = '".$gameID."'";
		$res = mysql_query($sql, DataManager::_getConnection());
		if(! ($res ))
		{
			die("Failed setting game info for game $gameID");
		}
	}
	
	public static function getUserObjectForLeague($leagueID)
	{  
		$sql = "SELECT user_id, FROM leaugues WHERE season_id = $leagueID";
		
		$res = mysql_query($sql, DataManager::_getConnection());
		
		if(mysql_num_rows($res))
		{
			$objs = array();
			while($row = mysql_fetch_assoc($res))
			{            
				try
				{  
					$objs[] = new Standing($row['st_id']);
				}
				catch(Exception $e)
				{
					echo 'Message: ' . $e->getMessage();
				}
				
			}
			return $objs;
		}
		else
		{
			return array();
		}
	}
}
?>
