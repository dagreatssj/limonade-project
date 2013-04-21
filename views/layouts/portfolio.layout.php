<!doctype html>
<html>
<head>
	<title><?php echo $title; ?></title>	
	<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
	<link rel="shortcut icon" href="/public/img/site/favicon.ico" />
	<link href='http://fonts.googleapis.com/css?family=Alike' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="/public/css/gh85.main-layout.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/gh85.gallery.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/jquery.lightbox-0.5.css" media="screen"/>
	<script type="text/javascript" src="/public/js/jquery.js"></script>
	<script type="text/javascript" src="/public/js/jquery.lightbox-0.5.js"></script>
	<script type="text/javascript" src="/public/js/call.lightbox.js"></script>
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
	<div id="main">
	<div id="left-nav">
		<p><strong>Portfolio Gallery</strong></p>
		<ul>
			<?php $ROOT_URL = 'http://'.$_SERVER['HTTP_HOST'].'/'; ?> 
			<?php $currentURI = $_SERVER['REQUEST_URI']; ?>
			<li><a href="<?php echo $ROOT_URL; ?>portfolio/2011"><?php if(preg_match('#/2011#', $currentURI)){ echo "<strong>2011</strong>"; } else echo "2011";  ?></a></li>
			<li><a href="<?php echo $ROOT_URL; ?>portfolio/2010"><?php if(preg_match('#/2010#', $currentURI)){ echo "<strong>2010</strong>"; } else echo "2010";  ?></a></li>
			<li><a href="<?php echo $ROOT_URL; ?>portfolio/2009"><?php if(preg_match('#/2009#', $currentURI)){ echo "<strong>2009</strong>"; } else echo "2009";  ?></a></li>
			<li><a href="<?php echo $ROOT_URL; ?>portfolio/2008"><?php if(preg_match('#/2008#', $currentURI)){ echo "<strong>2008</strong>"; } else echo "2008";  ?></a></li>
			<li><a href="<?php echo $ROOT_URL; ?>portfolio/2007"><?php if(preg_match('#/2007#', $currentURI)){ echo "<strong>2007</strong>"; } else echo "2007";  ?></a></li>
			<li><a href="<?php echo $ROOT_URL; ?>portfolio/sketchbook"><?php if(preg_match('#/sketchbook#', $currentURI)){ echo "<strong>sketchbook</strong>"; } else echo "Sketchbook"; ?></a></li>
		</ul>
	</div>
	<div id="image-gallery">
		<div id="content">
			<div id="gallery">
				<ul>
					<?php echo $content; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="clear"></div>	
	<footer id="footer">
		<p><span style="font-size: 95%;">Visit my other sites</span>
		<a href="#"><img src="/public/img/site/facebook.png" height="45" width="45"/></a>
		<a href="#"><img src="/public/img/site/last-fm.png" height="45" width="45"/></a>
		<a href="#"><img src="/public/img/site/Tumblr-128.png" height="45" width="45"/></a></p>
		<p>All Content &copy; copyright 2011 NAME</p>
	</footer>
	</div>
</div>
</body>
</html>
