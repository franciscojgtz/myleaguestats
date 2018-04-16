<?php

class TeamStats extends Team{
	
	private $t_id;
	private $ts_id;
	private $gms_won;
	private $gms_lost;
	private $gms_tied;
	private $gls_favor;
	private $gls_against;
	
	private $points;
	private $gls_dif;
	private $gms_played;
	
	static $sortKey;
	
	public function __construct($teamID) 
	{
		parent::__construct($teamID);
		$arData = DataManager::getTeamStatsData($teamID);
		
		$this->t_id = $arData['t_id'];
		$this->ts_id = $arData['ts_id'];
		$this->gms_won = $arData['gms_won'];
		$this->gms_lost = $arData['gms_lost'];
		$this->gms_tied = $arData['gms_tied'];
		$this->gls_favor = $arData['gls_favor'];
		$this->gls_against = $arData['gls_against'];
		
		$this->points = $this->getPoints();
		$this->gms_played = $this->getGamesPlayed();
		$this->gls_dif = $this->getGoalsDifference();
	}
	
	public static function sorter( $a, $b )
	{
		$al = strtolower($a->{self::$sortKey});
		$bl = strtolower($b->{self::$sortKey} );
		if ($al == $bl) 
		{
			return 0;
		}
		return ($al < $bl) ? +1 : -1;
	}
	
	public static function sortByProp( &$collection, $prop )
	{
		self::$sortKey = $prop;
		usort( $collection, array('TeamStats', 'sorter' ) );
	}
	
	public function __toString() {
		return $this->name;
	}
	
	public function getPoints()
	{
		$points = (((int) $this->gms_won * 3) + ((int) $this->gms_tied));  
		
		return $points;
	}
	
	public function getGamesPlayed()
	{
		$gms_played = ((int) $this->gms_won + (int) $this->gms_lost + (int) $this->gms_tied);
		
		return $gms_played;
	}
	
	public function getGoalsDifference()
	{
		$gls_dif = (((int) $this->gls_favor) - ((int) $this->gls_against));
		
		return $gls_dif;
	}
}
?>
