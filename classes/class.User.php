<?php

require_once('class.HashPassword.php');

class User {
	
	private $userID;
	private $name;
	
	private $email;
	private $dateCreated;
	private $dateLastModified;

	private $_salt;
	
	private $userFound;
	
	public function __construct($userID) 
	{
		$arData = DataManager::getUserData($userID);
		
		if($arData != "error")
		{
			$this->userID = $arData['user_id'];
			$this->name = $arData['user_name'];
			$this->email = $arData['user_email'];
			$this->_salt = $arData['user_salt'];
			$this->dateCreated = $arData['date_created'];
			$this->dateLastModified = $arData['date_last_modified'];
			
			$this->userFound = true;
		}
		else
		{
			$this->userFound = false;
		}
	}
	
	public function __toString() 
	{
		return $this->userID;
	}
	
	public function getUserFound()
	{
		return $this->userFound;	
	}
	
	public function getUserID()
	{
		return $this->userID;	
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($newUserName)
	{
		DataManager::setUserName($this->userID, $newUserName);	
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail()
	{
		//INSERT CODE TO SET NEW EMAIL
		DataManager::setUserEmail($this->userID, $newUserEmail);	
	}
	
	public function getDateCreated()
	{
		return $this->dateCreated;	
	}
	
	public function getDateLastModified()
	{
		return $this->dateLastModified;	
	}
	
	public function deleteUser()
	{
		foreach ($this->_leagues as $league)
		{ 
			$league->deleteLeague();
		}
		
		foreach ($this->_teams as $team)
		{ 
			$team->deleteTeam();
		}
		
		DataManager::deleteUser($this->userID);
	}
	
	public function getLeagues()
	{
		$leagues = DataManager::getLeagueObjectsForUser($this->userID);
		return $leagues;   
	}
	
	public function insertLeague($leagueName)
	{
		DataManager::insertLeague($this->userID, $leagueName);
	}
	
	public function insertTeam($teamName)
	{
		DataManager::insertTeam($this->userID, $teamName);
	}
	
	public function getTeams()
	{
		$teams = DataManager::getTeamObjectsForUser($this->userID);
		return $teams;   
	}
	
	public function changePassword($newPassword)
	{
		//HASH PASSWORD
		$hashPassword = $this->hashPassword($newPassword, $this->email);
		
		DataManager::changePassword($this->userID, $hashPassword);
	}
	
	public function getSalt()
	{
		return $this->_salt;
	}
	
	public function hashPassword($pass, $email)
	{
		//HASH PASSWORD
		$hashPassword = new HashPassword($pass, $email);
		
		return $hashPassword;
		
	}
	
	public function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
	{
   	$str = '';
    	$count = strlen($charset);
    	while ($length--) 
    	{
      	$str .= $charset[mt_rand(0, $count-1)];
    	}
    	return $str;
	}

}
?>
