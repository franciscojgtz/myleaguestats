<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats :: Register</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

<script type="text/javascript" src="javascript/recaptcha-theme.js"></script>

</head>

<body>

<div class="wrapper">
{include file='header.tpl'}

<div class="content">

<div class="primary">

<p class="errormsg">{$user_error}</p>
  
   {foreach item=error from=$errors}
      <p class="errormsg">       
      {$error}
      </p>
   {/foreach}

   <h1>Register</h1>
   
  <form class="pure-form pure-form-stacked" method='post' action='' accept-charset='UTF-8'>

    <p><label for="memberusername">username</label> <input type="text" name="memberusername" id="memberusername" value="{$memberuser}" placeholder="username" required/> </p>
    <p><label for="memberuseremail">email</label> <input type="email" name="memberuseremail" id="memberuseremail" value="{$memberemail}" placeholder="email" required/> </p>
    <p><label for="memberuseremailverified">Re-enter email</label> <input type="email" name="memberuseremailverified" id="memberuseremailverified" placeholder="verify email" required/> </p>
    <p><label for="memberpassword">password</label> <input type="password" name="memberpassword" id="memberpassword" placeholder="password" required/></p>   
    <p><label for="memberpasswordverified">Re-enter password</label> <input type="password" name="memberpasswordverified" id="memberpasswordverified" placeholder="verify password" required/><br /></p>   

    <p class="form-buttons"><input type="submit" name="submit" id="submit" value="Submit"  class="pure-button pure-button-primary"/></p>

  </form>

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