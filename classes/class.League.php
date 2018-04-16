<?php

class League 
{

	private $leagueID;
	private $leagueName;
	private $userID;

	private $leagueFound;
	
	
	public function __construct($leagueID) 
	{
		$arData = DataManager::getLeagueData($leagueID);
		
		if($arData != "error")
		{
			$this->leagueID = $arData['league_id'];
			$this->leagueName = $arData['league_name'];
			$this->userID = $arData['user_id'];
			
			$this->leagueFound = true;
	   }
	   else
	   {
		   $this->leagueFound = false;
	   }
	}
	
	public function __toString() 
	{
		return $this->lagueName;
	}
	
	public function getLeagueFound()
	{
		return $this->leagueFound;	
	}
	
	public function getLeagueID()
	{
		return $this->leagueID;
	}
	
	public function deleteLeague()
	{
		
		foreach ($this->_seasons as $season)
		{ 
			$season->deleteSeason();
		}
		
		DataManager::deleteLeague($this->leagueID);
	}
	
	public function getUserID()
	{
		return $this->userID;
	}
	
	public function getName()
	{
		return $this->leagueName;
	}
	
	public function setName($newLeagueName)
	{
		DataManager::setLeagueName($this->leagueID, $newLeagueName);	
	}
	
	public function insertSeason($seasonName)
	{
		DataManager::insertSeason($this->leagueID, $seasonName);
	}
	
	public function getSeasons()
	{
		$seasons = DataManager::getSeasonObjectsForLeague($this->leagueID);
		return $seasons;   
	}
}
?>
