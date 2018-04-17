<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats::Login</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

<script type="text/javascript" src="javascript/recaptcha-theme.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
{literal}
<script>
$(document).ready(function(){
  $(".hideform").click(function(){
    $("form").hide();
     $(".showform").show();
  });
  $(".showform").click(function(){
    $("form").show();
    $(".showform").hide();
  });
  $("form").hide();

});
</script>
{/literal}

</head>

<body id="index-page">

<div class="wrapper">
{include file='header.tpl'}

<div class="content">

<div class="primary">

<p class="errormsg">{$user_error}</p>

<p class="errormsg">{$captcha_error}</p>
  
   {foreach item=error from=$errors}
      <p class="errormsg">       
      {$error}
      </p>
   {/foreach}
   
   <p>For a demo login with the following credentials: <br/>
		username: demo@gutierrezfrancisco.net<br/>
		password: DemoPass1 (make sure to use the capital letters)</p>
   
	<p class="showform"><a href="#">Show Log In Form</a></p>

  <form class="pure-form pure-form-stacked" method='post' action='' accept-charset='UTF-8'>
  
  		<p class="hideform"><a href="#">Hide Log In Form</a></p>
  
  		<h1>Login Form</h1>
  
    	<div class="loginfields">    
    		<p><label for="memberuseremail">email</label> <input type="email" name="memberuseremail" id="memberuseremail" value="{$memberuser}" placeholder="email" required/> </p>
    		<p><label for="memberpassword">password</label> <input type="password" name="memberpassword" id="memberpassword" placeholder="password" required/> <br /></p>
    	</div>
    
    	<div class="loginrecaptcha">  
    		
    		<p class="form-buttons"><input type="submit" name="submit" id="submit" value="Submit" class="pure-button pure-button-primary"/>
    	<a href="forgotpassword.php">Forgot Password?</a></p>
	 	</div>
	 	
	 	<div class="clear"></div>

  </form>
  
  <div class="clear"></div>
  
  <h1>Explore Users</h1>
  
  <ul>
  		{foreach item=user from=$users key=k}
         <li><a href="user.php?u_id={$user->getUserID()}">{$user->getName()}</a></li>
   	{/foreach}
  </ul>

</div>

<div class="secondary"> 
{include file='navigation.tpl'}

{include file='promo.tpl'}

</div>

</div>

{include file='footer.tpl'}

</div>

<!--analytics code-->
{literal}
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30483345-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
{/literal}

</body>
</html>