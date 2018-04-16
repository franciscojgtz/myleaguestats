<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats :: Contact</title>

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/forms-nr-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/buttons-min.css">

<script type="text/javascript" src="javascript/recaptcha-theme.js"></script>

</head>

<body>

<div class="wrapper">
{if $user_id neq ''}
	{include file='headerloggedin.tpl'}
{else}
	{include file='header.tpl'}
{/if}

<div class="content">

<div class="primary">

   <h1>Contact Us</h1>
   
   <p>Contact us and let us know what you think. If you have any suggestion on how to improve myleaguestats.com,
    we will be happy to know. If you have an amateur soccer league and would like share your 
    statistics on myleaguestats.com, send us an email and let us know. We will be happy to add more statistics. You can find
    some instructions <a href="instructions.php">here</a>.
    For anything else, send us an email. </p>

   <p>email us at: {mailto address="admin@gutierrezfrancisco.net" subject="Comment from My League Stats"}</p>
   
   <p class="errormsg">{$captcha_error}</p>
  
   {foreach item=error from=$errors}
      <p class="errormsg">       
      {$error}
      </p>
   {/foreach}

   <h2>Contact Form</h2>
   
  <form class="pure-form pure-form-stacked" method='post' action='' accept-charset='UTF-8'>
    

    <p><label for="name">name</label><input type="text" name="name" id="name" value="{$name}" placeholder="name" required/> </p>
    <p><label for="email">email</label> <input type="text" name="email" id="email" value="{$email}" placeholder="email" required/></p>
    <p><label for="message" >message</label>
    <textarea name="message" id="message" rows="10" cols="80" placeholder="type your message" required >{$message}</textarea><br /></p>    
    {$recaptcha} 

    <p class="form-buttons"><input type="submit" name="submit" id="submit" value="Submit" class="pure-button pure-button-primary"/></p>

  </form>
   
</div>

<div class="secondary">
{if $user_id neq ''}
	{include file='navigationloggedin.tpl'}
{else}
	{include file='navigation.tpl'}
{/if}

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