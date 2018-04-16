<?php

class Team {
	
	private $teamID;
	private $teamName;
	private $userID;
	
	private $teamFound;
	
	public function __construct($teamID) 
	{
		$arData = DataManager::getTeamData($teamID);
		
		if($arData != "error")
		{
			$this->teamID = $arData['team_id'];
			$this->teamName = $arData['team_name'];
			$this->userID = $arData['user_id'];
			
			$this->teamFound = true;
		}
		else
		{
			$this->teamFound = false;
		}
	
	}
	
	public function __toString()
	{
		return $this->teamName;
	}
	
	public function getTeamFound()
	{
		return $this->teamFound;	
	}
	
	public function getTeamID()
	{
		return $this->teamID;
	}
	
	public function getUserID()
	{
		return $this->userID;
	}
	
	public function getName()
	{
		return $this->teamName;
	}
	
	public function getGameObjectsWhereTeamPlays()
	{
		$gamesWhereTeamPlays = DataManager::getGameObjectsWhereTeamPlays($this->teamID);
		return $gamesWhereTeamPlays;
	}
	
	public function getGamesWhereTeamsPlayAsLocal()
	{
		$gamesWhereTeamsPlayAsLocal = DataManager::getGameObjectsWhereTeamsPlayAsLocal($this->teamID);
		return $gamesWhereTeamsPlayAsLocal;
	}
	
	public function getGamesWhereTeamsPlayAsVisitor()
	{
		$gamesWhereTeamsPlayAsVisitor = DataManager::getGameObjectsWhereTeamsPlayAsVisitor($this->teamID);
		return $gamesWhereTeamsPlayAsVisitor;
	}

	public function getUpcomingGames()
	{
		$upcomingGames = array();
		
		$games = $this->getGameObjectsWhereTeamPlays();

		foreach($games as $game)
		{  
			$myDate = $game->getGameDate() .  " " . $game->getGameTime(); 
			if(strtotime($myDate) > time())  
			{   
     			//push into upcoming games array;
     			array_push($upcomingGames, $game);
   		}
	   }
		
		return $upcomingGames;
	}
	
	public function getLatestGames()
	{
		$latestGames = array();
		
		$games = $this->getGameObjectsWhereTeamPlays();

		foreach($games as $game)
		{  
			$myDate = $game->getGameDate() .  " " . $game->getGameTime(); 
			if(strtotime($myDate) < time())  
			{   
     			//push into latest games array;
     			array_push($latestGames, $game);
   		}
	   }
		
		return $latestGames;
	}
	
	public function getStandingsWhereTeamIsPartOf()
	{
		$standingsWhereTeamIsPartOf = DataManager::getStandingObjectsWhereTeamIsPartOf($this->teamID);
		return $standingsWhereTeamIsPartOf;
	}
	public function setName($newTeamName)
	{
		DataManager::setTeamName($this->teamID, $newTeamName);	
	}
	
	public function deleteTeam()
	{
		$gamesWhereTeamsPlayAsLocal = $this->getGamesWhereTeamsPlayAsLocal();
		$gamesWhereTeamsPlayAsVisitor = $this->getGamesWhereTeamsPlayAsVisitor();
		$standingsWhereTeamIsPartOf = $this->getStandingsWhereTeamIsPartOf();
		DataManager::deleteTeam($this->teamID);
		
		foreach ($gamesWhereTeamsPlayAsLocal as $game)
		{ 
			$game->deleteGame();
		}
		
		foreach ($gamesWhereTeamsPlayAsVisitor as $game)
		{ 
			$game->deleteGame();
		}
		
		foreach ($standingsWhereTeamIsPartOf as $standing)
		{ 
			$standing->deleteStanding();
		}
		
	}

}
?>
