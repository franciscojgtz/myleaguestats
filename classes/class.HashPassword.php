<?php
	require_once('class.User.php');
 
  class HashPassword {

    private $_hashPassword;
    private $_salt;
    
    public function __construct($plainPassword, $userEmail) 
    {  
	    
		//HASH PASSWORD
		$pepper = 'y8&K35hPK1f';
		
		$userAr = DataManager::getUserIDByEmail($userEmail);
		if((sizeof($userAr) > 0) && ($userAr != ""))
		{
			$userID = $userAr['user_id'];
		}
		else
		{
			$userID = "";
		}
		
		//GET ALL USERS AND COMPARE IT TO THE ONE SUBMITTED
		$arUsers = DataManager::getAllUsersAsObjects();	
		$sizeOfArUsers = sizeof($arUsers);
		$userFound = "no";
      foreach ($arUsers as $myUserID) 
      {  
    		if($myUserID == $userID)
    		{
	    		$userFound = "yes";
	    		break;
    		}
		}
		if($userFound == "yes")
		{
			$user = new User($userID);
			$this->_salt = $user->getSalt();
		}
		else
		{
			//GENERATE SALT
			$this->_salt = $this->generateSalt();
		}
		
		$this->_hashPassword = md5($this->_salt . $pepper) . sha1($this->_salt . $plainPassword . $pepper);    
    } 

    public function __toString() {
      return $this->_hashPassword;
    }
    
    public function getHashedPassword()
    {
	    return $this->_hashPassword;
    }
    
    public function getSalt()
    {
	    return $this->_salt;
    }
    
    function generateSalt() {
		return substr(md5(uniqid(rand(), true)), 0, 12);
	}
   
  }
?>
