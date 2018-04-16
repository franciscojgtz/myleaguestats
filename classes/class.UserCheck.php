<?php

require_once('class.HashPassword.php');

class UserCheck {

	private $userName;
	private $pass;
	private $userID;
	private $isValidUser;
	
	private $_hashPass;
	
	public function __construct($userEmail, $password) 
	{
		
		$this->_hashPass = $this->hashPassword($password, $userEmail);
		
		$arData = DataManager::checkValidUser($userEmail, $this->_hashPass);
		
		if($arData != "not user found")
		{
			$this->pass = $arData['user_pass'];
			$this->userName = $arData['user_name'];
			$this->userID = $arData['user_id'];
			
			$this->isValidUser = true;
		}
		else
		{
			$this->isValidUser = false;
		}
	}
	
	public function __toString() 
	{
		return $this->userName;
	}
	
	public function getName()
	{
		return $this->userName;
	}
	
	public function getPassword()
	{
		return $this->pass;
	}
	
	public function getUserID()
	{
		return $this->userID;
	}
	
	public function getIsValidUser()
	{
		return $this->isValidUser;
	}
	
	public function hashPassword($pass, $userEmail)
	{
		//HASH PASSWORD
		$hashPassword = new HashPassword($pass, $userEmail);
		
		return $hashPassword;
	}
	
	function generateSalt() 
	{
		return substr(md5(uniqid(rand(), true)), 0, 12);
	}

}
?>
