var max_length_name = 25;  
var max_length_email = 50; 
var max_length_message = 1000; 

//hide all error divs
$('.errors').hide();

//event handlers for exceeding characters in contact form
$('#contact_name').keyup(function(){
	var user_name_length = $('#contact_name').val().length;
	var char_name_left = max_length_name - user_name_length;
	
	if(char_name_left == 0)
	{
		$('#name-field').show().html('Cannot exceed more than ' + max_length_name + ' characters');
	}
	else
	{
		$('#name-field').hide();
	}
});

$('#contact_email').keyup(function(){
	var user_email_length = $('#contact_email').val().length;
	var char_email_left = max_length_email - user_email_length;
	
	if(char_email_left == 0)
	{
		$('#email-field').show().html('Cannot exceed more than ' + max_length_email + ' characters');
	}
	else
	{
		$('#email-field').hide();
	}
});

$('#contact_message').keyup(function(){
	var user_msg_length = $('#contact_message').val().length;
	var char_msg_left = max_length_message - user_msg_length;
	
	//IE won't allow maxlength in textarea tag use less than zero
	if(char_msg_left <= 0)
	{
		$('#message-field').show().html('Cannot exceed more than ' + max_length_message + ' characters');
	}
	else
	{
		$('#message-field').hide();
	}
});

//validate form such that fields are not empty and a valid email is entered
$(function(){
	$(".button").click(function(){
		//check to see if all fields are not empty
		var name  = $("#contact_name").val();
		var email = $("#contact_email").val();
		var msg   = $("#contact_message").val();
	
		//pressing send button with no text display error
		if(name == "" && email == "" && msg == "")
		{
			$('#name-field').show().html('Please enter a name.');
			$('#email-field').show().html('Please enter an email');
			$('#message-field').show().html('Please enter some text');
			return false;
		}
		//if any field is empty display error
		else if(name == "")
		{
			$('#name-field').show().html('Please enter a name.');
			return false;
		}
		else if(email == "")
		{
			$('#email-field').show().html('Please enter an email');
			return false;
		}
		//this checks invalid email addresses 
		else if(!email.match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i))
		{
			$('#email-field').show().html('Invalid Email');
			return false;
		}
		else if(msg == "")
		{
			$('#message-field').show().html('Please enter some text');
			return false;
		}
		//if everything is !empty go ahead and send email
		else
		{
			var formdata = 'contact_name=' + name + '&contact_email=' + email + '&contact_message=' + msg;
			sendInfo(formdata);
		}
		return false;
	});
});

function sendInfo(formdata){
	$.ajax({
		type: "POST",
		url: "process_form.php",
		data: formdata,
		success: function(o){
			$('#contact-form').html(o);
		},
		error: function(o){
			$('#contact-form').html(o);
		}
	});
}