<?php content_for('css'); ?>
<link rel="stylesheet" type="text/css" href="public/css/gh85.contact.css"/>
<?php end_content_for(); ?>

<?php content_for('js'); ?>
<script type="text/javascript" src="public/js/jquery.js"></script>
<?php end_content_for(); ?>

<div id="main">
	<div id="contact-form">
		<h2>Contact Me</h2>
		<form action="/processform" method="post">
			Name: <br />
			<input type="text" name="contact_name" maxlength="25" id="contact_name" />
			<div class="errors" id="name-field"></div>
			<br />
			<br />
			Email Address: <br />
			<input type="text" name="contact_email" maxlength="50" id="contact_email" />
			<br />
			<br />
			<div class="errors" id="email-field"></div>
			Message: <br />
			<textarea name="contact_message" rows="12" cols="55" maxlength="1000" id="contact_message"></textarea>
			<div class="errors" id="message-field"></div>
			<br />
			<input type="submit" name="submit" class="button" value ="Send Email" />	
		</form>
	</div>
	<script type="text/javascript" src="/public/js/processform.js"></script>
	<div id="contact-links">
		<h2><strong><center>Friends</center></strong></h2>
		<div id="contact-friend-list">
			<ul>
				<li><a href="#">NAMES</a></li>
				<li><a href="#">NAMES</a></li>
				<li><a href="#">NAMES</a></li>
				<li><a href="#">NAMES</a></li>
				<li><a href="#">NAMES</a></li>
				<li><a href="#">NAMES</a></li>
				<li><a href="#">NAMES</a></li>
				<li><a href="#">NAMES</a></li>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
</div>
