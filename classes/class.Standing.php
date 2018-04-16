<?php

class Standing 
{
	
	private $standingID;
	private $seasonID;
	private $teamID;
	private $teamName;
	private $gmsWon;
	private $gmsTied;
	private $gmsLost;
	private $glsFavor;
	private $glsAgainst;
	private $glsDif;
	private $pts;
	private $ptsDeducted;
	private $bonusPts;
	private $dateCrated;
	private $dateLastModified;
	
	//GET THE NAME OF THE SEASON
	private $getSeasonName;
	
	public function __construct($standingID) 
	{ 
		$arData = DataManager::getStandingData($standingID);
		
		
		$this->standingID = $arData['st_id'];
		$this->seasonID = $arData['season_id'];
		$this->teamID = $arData['team_id'];
		$this->gmsWon = $arData['gms_won'];
		$this->gmsTied = $arData['gms_tied'];
		$this->gmsLost = $arData['gms_lost'];
		$this->glsFavor = $arData['gls_favor'];
		$this->glsAgainst = $arData['gls_against'];
		$this->glsDif = $arData['gls_dif'];
		$this->pts = $arData['pts'];
		$this->ptsDeducted = $arData['pts_deducted'];
		$this->bonusPts = $arData['bonus_pts'];
		$this->dateCrated = $arData['date_created'];
		$this->dateLastModified = $arData['date_last_modified'];
		
		//get team data
		$team = new Team($this->teamID);
		$this->teamName = $team->getName();
	}
	
	public function __toString() 
	{
		return $this->teamName;
	}
	
	public function getStandingID()
	{
		return $this->standingID;	
	}
	
	public function getTeamID()
	{
		return $this->teamID;	
	}
	
	public function getTeamName()
	{
		return $this->teamName;
	}
	
	public function getSeasonID()
	{
		return $this->seasonID;
	}
	
	public function getGamesWon()
	{
		return $this->gmsWon;	
	}
	
	public function getGamesTied()
	{
		return $this->gmsTied;	
	}
	
	public function getGamesLost()
	{
		return $this->gmsLost;	
	}
	
	public function getGoalsInFavor()
	{
		return $this->glsFavor;	
	}
	
	public function getGoalsAgainst()
	{
		return $this->glsAgainst;	
	}
	
	public function getGoalsDifference()
	{
		return $this->glsDif;	
	}
	
	public function getPoints()
	{
		return $this->pts;	
	}
	
	public function getPointsDeducted()
	{
		return $this->ptsDeducted;	
	}
	
	public function getBonusPoints()
	{
		return $this->bonusPts;
	}
	
	public function getGamesPlayed()
	{
		$gamesPlayed = $this->gmsWon+$this->gmsTied+$this->gmsLost;
		return $gamesPlayed;
	}
	
	public function getTotalPoints()
	{
		$totalPoints = $this->pts-$this->ptsDeducted+$this->bonusPts;
		return $totalPoints;
	}
	
	public function getDateCreated()
	{
		return $this->dateCreated;	
	}
	
	public function getDateLastModified()
	{
		return $this->dateLastModified;	
	}
	
	public function getSeasonName()
	{
		$season = new Season($this->seasonID);
		return $season->getName();	
	}
	
	public function setStandingInfo($team, $newGmsWon, $newGmsTied, $newGmsLost, $newGlsFavor, $newGlsAgainst, $newPtsDeducted, $newBonusPts)
	{
		DataManager::setStandingInfo($this->standingID, $team, $newGmsWon, $newGmsTied, $newGmsLost, $newGlsFavor, $newGlsAgainst, $newPtsDeducted, $newBonusPts);
	}
	
	public function deleteStanding()
	{
		DataManager::deleteStanding($this->standingID);
	}
	

}
?>
