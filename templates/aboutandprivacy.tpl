<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My League Stats :: About and Privacy</title>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>

<div class="wrapper">
{include file='header.tpl'}

<div class="content">

<div class="primary">

   <ul class="breadcrumb">
      <li><a href="index.php">Home  &#8594;</a></li>
   </ul>
   
   <div class="clear"></div>
   
   <h2>About</h2>
   
   <p>
   My League Stats is a one man project. The goal of the website is to provide an easy yet efficient way to keep track of you soccer statistics.
   It does not matter if your league is proffesional or amateur, you should be able to easly keep track of the statistics. If you have any questions or suggestions,
   please let us know by <a href="contact.php">contacting us</a>.
   </p>
   
   <h2>Privacy</h2>
   
   <p>
   All the information collected is kept on our database and is not shared with anyone else. As mentioned before, this is a one-man project and I try to keep
   My League Stats as safe as possible.
   </p>
   
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