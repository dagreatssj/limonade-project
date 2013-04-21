<?php require_once 'common/functions/cart/cart.php' ?>

<?php content_for('css'); ?>
<link rel="stylesheet" type="text/css" href="/public/css/gh85.prints.css"/>
<link rel="stylesheet" type="text/css" href="/public/css/gh85.gallery.css"/>
<link rel="stylesheet" type="text/css" href="/public/css/jquery.lightbox-0.5.css" media="screen"/>
<?php end_content_for(); ?>

<?php content_for('js'); ?>
<script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript" src="/public/js/jquery.lightbox-0.5.js"></script>
<?php end_content_for(); ?>

<div id="main">
	<div id="prints">
		<?php products(); ?>
	</div>
	<div id="shopping-cart">
		<?php cart(); ?>
	</div>
	<div id="clear"></div>
</div>