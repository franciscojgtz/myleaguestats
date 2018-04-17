<?php
session_start();

require_once('classes/class.DataManager.php');
require("libs/Smarty.class.php");
require('libs/formvalidator.class.php');
require('libs/recaptchalib.php');

$smarty = new Smarty;
//$smarty->compile_check = true;
//$smarty->debugging = true;

if(isset($_POST['submit'])){
//FORM WAS SUBMITTED

   //GET THE VALUES FROM THE FORM
   $myData_username = $_POST['memberusername'];
   $myData_useremail = $_POST['memberuseremail'];
   $myData_useremailverified = $_POST['memberuseremailverified'];
   $myData_password = $_POST['memberpassword'];
   $myData_passwordverified = $_POST['memberpasswordverified'];

   $smarty->assign('memberuser', $myData_username);
   $smarty->assign('memberemail', $myData_useremail);

   //NOW VALIDATE THE INPUT USING THE FORM VALIDATOR
   $validator = new FormValidator();
   $validator->addValidation("memberusername","req","Please fill in username"); 
   $validator->addValidation("memberusername","alnum_s","Only letters and numbers are accepted for username");
   $validator->addValidation("memberusername","minlen=6","Username should be at least 6 digits long");
   $validator->addValidation("memberuseremail","req","Please fill in email"); 
   $validator->addValidation("memberusereamil","email","please provide a valid email address");   
   $validator->addValidation("memberuseremailverified","eqelmnt=memberuseremail","Emails don't match"); 
   $validator->addValidation("memberpassword","req","Please fill in password"); 
   $validator->addValidation("memberpassword","alnum_s","Only letters and numbers are accepted for password");  
   $validator->addValidation("memberpassword","minlen=6","Password should be at least 6 digits long");
   $validator->addValidation("memberpasswordverified","req","Please fill in password verification"); 
   $validator->addValidation("memberpasswordverified","alnum_s","Only letters and numbers are accepted for password verification"); 
   $validator->addValidation("memberpasswordverified","minlen=6","Password should be at least 6 digits long");
   $validator->addValidation("memberpasswordverified","eqelmnt=memberpassword","Passwords don't match");  
   if($validator->ValidateForm()){
      //VALIDATION WAS SUCCESSFULL. GO AHEAD AND CHECK IF THE USER IS IN THE DATABASE
      //CHECK USERNAME OR EMAIL ARE IN DATABASE
      $arUsers = DataManager::getAllUsersAsObjects();
      
      $userNameTaken;
      $userEmailTaken;

      if (empty($arUsers))
      {
        $userNameTaken = "no";
        $userEmailTaken = "no";
      }
      else{
        foreach ($arUsers as $arUser){
          $temp_user_name = $arUser->getName();
          $temp_user_email = $arUser->getEmail();
          //COMPARE USERNAME AND EMAIL WITH DABASE VALUES
          if($myData_username == $temp_user_name)
          { 
            //USERNAME ALREADY IN THE DATABASE
            $userNameTaken = "yes";
            break;
          }
          else
          {
            //USERNAME IS AVAILABLE
            $userNameTaken = "no";
          }
          if($myData_useremail == $temp_user_email)
          {
            //EMAIL ALREADY IN THE DATABASE
            $userEmailTaken = "yes";

            break;
          }
          else
          {
            //EMAIL IS AVAILABLE
            $userEmailTaken = "no";
          }
        }
      }

      //ADD USER TO DATABASE If NOT IN DATABASE ALREADY
      if($userNameTaken == "yes"){       
        $smarty->assign('errors', '');
        $smarty->assign('user_error', 'User Name has already been taken');
        $smarty->display('register.tpl'); 
      }
      else if($userEmailTaken == "yes"){
        $smarty->assign('errors', '');
        $smarty->assign('user_error', 'Email has already been taken');
        $smarty->display('register.tpl');
      }
      else if(($userNameTaken == "no") && ($userEmailTaken == "no")){ 
        $hashPassword = new HashPassword($myData_password, '');
        $hashedPassword = $hashPassword->getHashedPassword();
        $theSalt = $hashPassword->getSalt();
        //INSERT NEW USER
        //DataManager::insertUser($myData_username, $myData_useremail, $hashedPassword);
        DataManager::insertUser($myData_username, $myData_useremail, $hashedPassword, $theSalt);
          
        //REGISTRATION SHOULD BE VALID BUT LET'S DOUBLE CHECK AND LOG IN THE NEW USER
        //CHECK USER
        $checkUser = new UserCheck($myData_useremail,  $myData_password);
      
        if($checkUser->getIsValidUser())
        {
          //VALID USER :)
              $_SESSION['valid_user_id'] = $checkUser->getUserID();
          
          //CREATE A USER OBJECT
          $user_id = $_SESSION['valid_user_id'];   
          
               $user = new User($user_id);
              $userName = $user->getName();
              $userEmail = $user->getEmail();
              $userLeagues = $user->getLeagues();
              $userTeams = $user->getTeams();
          
              $smarty->assign("user",$user);
                $smarty->assign("userID",$user_id);
              $smarty->assign("userName",$userName);
              $smarty->assign("userEmail",$userEmail);
                $smarty->assign("userLeagues",$userLeagues);
                $smarty->assign("userTeams",$userTeams);
                
                //SEND EMAIL TO THE USER THANKING THEM FOR JOINING THE WEBSITE
          $to      = $userEmail;
          $subject = 'Thank you for joining myleaguestats';
          $message = 'Thank you for joining myleaguestats. Now you can use the website by using your email and the password provided. If you have any questions, please
                            contact us at admin@gutierrezfrancisco.net';
          $headers = 'From: admin@gutierrezfrancisco.net' . "\r\n" .
                      'Reply-To: admin@gutierrezfrancisco.net' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

          mail($to, $subject, $message, $headers);
  
          
              $smarty->display('success.tpl');  
        }
        else
            {
               //RESULT IS EMPTY NO USER FOUND
              $smarty->assign('captcha_error', '');
              $smarty->assign('errors', '');
              $smarty->assign('user_error', 'Invalid Username or Password');
              $smarty->display('index.tpl');
            }
            
          
        //$smarty->display('success.tpl');    
      }
   }
   else{
    //VALIDATION FAILED; THERE ARE ERRORS
    $error_hash = $validator->GetErrors();
    $smarty->assign('user_error', '');
    $smarty->assign('errors', $error_hash);
    $smarty->display('register.tpl');       
  }
}
else if(isset($_SESSION['valid_user_id'])){
   //THE USER HAS ALREADY SIGNED IN AND HAS NOT LOGGED OUT
   
   //CREATE A USER OBJECT
   $user_id = $_SESSION['valid_user_id'];   
            
   $user = new User($user_id);
   $userName = $user->getName();
   $userEmail = $user->getEmail();
   $userLeagues = $user->getLeagues();
   $userTeams = $user->getTeams();

   $smarty->assign("user",$user);
   $smarty->assign("userID",$user_id);
   $smarty->assign("userName",$userName);
   $smarty->assign("userEmail", $userEmail);
   $smarty->assign("userLeagues",$userLeagues);
   $smarty->assign("userTeams",$userTeams);
  
   $smarty->display('success.tpl');
}
else{
   //THE PAGE WAS JUST OPENED
   
   //VARIABLES
   $smarty->assign('user_error', '');
   $smarty->assign('errors', '');
   $smarty->assign('memberuser', '');
   $smarty->assign('memberemail', '');
   
   $smarty->display('register.tpl');
}

?>

