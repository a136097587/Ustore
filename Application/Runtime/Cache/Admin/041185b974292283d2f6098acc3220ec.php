<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CSS3动态背景登录框代码</title>
<script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/styles.css">
<style type="text/css">
img{
	width: 250px;
	height: 50px;
	opacity: 0.8;
	border-radius: 3px;
	border: 1px solid rgba(255, 255, 255, 0.4);
}
</style>
</head>
<body>


<div class="wrapper">

	<div class="container">
		<h1>MOOC 后台管理</h1>
		<form class="form" method="post" action="">
			<input type="text" name='name'placeholder="Username">
			<input type="password" name='passwd' placeholder="Password">
			<input type="text" name='code' placeholder="verify">
			<img src="<?php echo U('verify');?>"  id='captcha'>
			<br>
			<br>
			<br>
			<button type="submit" id="login-button" onclick="window.location.href='index.html';"><strong>登陆</strong></button>			
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		
	</ul>
	
</div>



</body>
</html>
<script type="text/javascript">
  $('#captcha').click(function(){
    var src="<?php echo U('verify');?>?"+Math.random();
    $(this).attr('src',src);
  })
</script>