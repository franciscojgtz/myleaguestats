<?php
class Game 
{
	
	private $gameID;
	private $seasonID;
	private $localTeamID;
	private $visitorTeamID;
	private $gamePlayed;
	private $localTeamGoals;
	private $visitorTeamGoals;
	private $place;
	private $gameDate;
	private $gameTime;
	private $gameRound;
	
	private $localTeam;
	private $visitorTeam;
	
	public function __construct($gameID) 
	{
		$arData = DataManager::getGameData($gameID);
		
		$this->gameID = $arData['game_id'];
		$this->seasonID = $arData['season_id'];
		$this->localTeamID = $arData['local_team_id'];
		$this->visitorTeamID = $arData['visitor_team_id'];
		$this->gamePlayed = $arData['played'];
		$this->localTeamGoals = $arData['local_goals'];
		$this->visitorTeamGoals = $arData['visitor_goals'];
		$this->place = $arData['game_place'];
		$this->gameDate = $arData['game_date'];
		$this->gameTime = $arData['game_time'];
		$this->gameRound = $arData['round'];
		
		$this->localTeam = new Team($this->localTeamID); 
		$this->visitorTeam = new Team($this->visitorTeamID);      
	}
	
	public function __toString() 
	{
		return $this->localTeam->getName . " vs " . $this->visitorTeam->getName;
	}
	
	public function getID()
	{
		return $this->gameID;
	} 
	
	public function getSeasonID()
	{
		return $this->seasonID;	
	}
	
	public function getLocalTeamID()
	{
		return $this->localTeamID;	
	}
	
	public function getVisitorTeamID()
	{
		return $this->visitorTeamID;	
	}
	
	public function getGamePlayed()
	{
		return $this->gamePlayed;	
	}
	
	public function getLocalTeamGoals()
	{
		return $this->localTeamGoals;	
	}
	
	public function getVisitorTeamGoals()
	{
		return $this->visitorTeamGoals;	
	}
	
	public function getPlace()
	{
		return $this->place;	
	}
	
	public function getGameDate()
	{
		return $this->gameDate;	
	}
	
	public function getGameTime()
	{
		return $this->gameTime;	
	}
	
	public function getGameRound()
	{
		return $this->gameRound;	
	}
	
	public function getLocalTeam()
	{
		return $this->localTeam;
	}
	
	public function getVisitorTeam()
	{
		return $this->visitorTeam;	
	}
	
	public function setGameInfo($localTeam, $visitorTeam, $gamePlayed, $localGoals, $visitorGoals, $gameDate, $gameTime, $gamePlace, $gameRound)
	{
		DataManager::setGameInfo($this->gameID, $localTeam, $visitorTeam, $gamePlayed, $localGoals, $visitorGoals, $gameDate, $gameTime, $gamePlace, $gameRound);
	}
	
	public function deleteGame()
	{
		DataManager::deleteGame($this->gameID);
	}

}
?>
