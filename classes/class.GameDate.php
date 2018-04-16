<?php

class GameDate 
{

private $dateYear;
private $dateMonth;
private $dateDay;

public function __construct($date) 
{
	list($theYear, $theMonth, $theDay) = explode('-', $date);
	
	$this->dateYear = $theYear;
	$this->dateMonth = $theMonth;
	$this->dateDay = $theDay;      
}

public function __toString() 
{
	return $this->dateYear . "-" . $this->dateMonth  . "-" . $this->dateDay;
}

public function getDate()
{
	return $this->dateYear . "-" . $this->dateMonth  . "-" . $this->dateDay;
}

}
?>
