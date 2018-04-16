<?php

class Season {
	
	private $seasonID;
	private $seasonName;
	private $leagueID;
	
	private $_numberOfRounds;
	private $_rounds = array();
	
	private $seasonFound;
	
	public function __construct($seasonID) 
	{
		$arData = DataManager::getSeasonData($seasonID);
		
		if($arData != "error")
		{
		
			$this->seasonID = $arData['season_id'];
			$this->seasonName = $arData['season_name'];
			$this->leagueID = $arData['league_id'];
			
			$this->seasonFound = true;
		}
		else
		{
			$this->seasonFound = false;	
		}
		
	}
	
	public function __toString() 
	{
		return $this->seasonName;
	}
	
	public function getSeasonFound()
	{
		return $this->seasonFound;
	}
	
	public function getName()
	{
		return $this->seasonName;
	}
	
	public function getSeasonID()
	{
		return $this->seasonID;	
	}
	
	public function deleteSeason()
	{
		
		foreach ($this->_games as $game)
		{ 
			$game->deleteGame();
		}
		
		foreach ($this->_standings as $standing)
		{ 
			$standing->deleteStanding();
		}
		
		DataManager::deleteSeason($this->seasonID);
		}
		
	public function setName($newSeasonName)
	{
		DataManager::setSeasonName($this->seasonID, $newSeasonName);	
	}
	
	public function getLeagueID()
	{
		return $this->leagueID;
	}
	
	public function getStandings()
	{
		$standings = DataManager::getStandingObjectsForSeason($this->seasonID);
		return $standings;   
	}
	
	public function insertStanding($team, $newGmsWon, $newGmsTied, $newGmsLost, $newGlsFavor, $newGlsAgainst, $newPtsDeducted, $newBonusPts)
	{
		DataManager::insertStanding($this->seasonID, $team, $newGmsWon, $newGmsTied, $newGmsLost, $newGlsFavor, $newGlsAgainst, $newPtsDeducted, $newBonusPts);
	}
	
	public function getGames()
	{
		$games = DataManager::getGameObjectsForSeason($this->seasonID);
		return $games;   
	}
	
	public function insertGame($localTeam, $visitorTeam, $gamePlayed, $localGoals, $visitorGoals, $gameDate, $gameTime, $gamePlace, $gameRound)
	{
		DataManager::insertGame($this->seasonID, $localTeam, $visitorTeam, $gamePlayed, $localGoals, $visitorGoals, $gameDate, $gameTime, $gamePlace, $gameRound);
	}
	
	public function getRounds()
	{   
		$games = $this->getGames();
		foreach ($games as $game)
		{ 
			$inArray = false;
			//get the round
			$theRound = $game->getGameRound();
			
			//check if its in the array
			for ($i = 0; $i < sizeof($this->_rounds); ++$i)
			{   
				if ($this->_rounds[$i] == $theRound)
				{
					$inArray = true;
				}
			}
			
			//if not, push it into the array
			if(!$inArray)
			{
				array_push($this->_rounds, $theRound);
			}
		}
		
		//return array
		return $this->_rounds;
	}
}
?>
