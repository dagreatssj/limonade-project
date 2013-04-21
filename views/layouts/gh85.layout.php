<!doctype html>
<html>
<head>
	<title><?php echo $title; ?></title>	
	<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
	<link rel="shortcut icon" href="/public/img/site/favicon.ico" />
	<link href='http://fonts.googleapis.com/css?family=Alike' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="/public/css/gh85.main-layout.css"/>
	<?php if(isset($css)) echo $css; ?>
	<?php if(isset($js)) echo $js; ?>
</head>
<body>
<div id="container">
	<header id="header">
		<p>IMAGE</p>
		<div id="menu-buttons">
			<?php $ROOT_URL = 'http://'.$_SERVER['HTTP_HOST'].'/'; ?>
			<a href="<?php echo $ROOT_URL; ?>home">HOME</a>
			<a href="<?php echo $ROOT_URL; ?>portfolio/2011">PORTFOLIO</a>
			<a href="http://luistinoco.blogspot.com/">BLOG</a>
			<a href="<?php echo $ROOT_URL; ?>info">INFO</a>
			<a href="<?php echo $ROOT_URL; ?>prints">PRINTS</a>
			<a href="<?php echo $ROOT_URL; ?>contact">CONTACT</a>
		</div>
	</header>
	<?php echo $content; ?>
	<footer id="footer">
		<p><span style="font-size: 95%;">Visit my other sites</span>
		<a href="#"><img src="/public/img/site/facebook.png" height="45" width="45"/></a>
		<a href="#"><img src="/public/img/site/last-fm.png" height="45" width="45"/></a>
		<a href="#"><img src="/public/img/site/Tumblr-128.png" height="45" width="45"/></a></p>
		<p>All Content &copy; copyright 2011 NAME</p>
		<p><a href="http://dagreatssj.com">DaGreatSSJ</a> Darrell Calderon</p>
	</footer>
</div>
</body>
</html>
