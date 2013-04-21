<?php

/**
 * GrimHearts1985
 * Using sofadesign-limonade-v0.5.1-51-g5234ce5 micro-framework
 * 
 * @author Darrell Calderon
 */

require_once 'lib/limonade.php';

/*function configure()
{
	mysql_connect('localhost', 'root', '') or die(mysql_error());
	mysql_select_db('prints') or die(mysql_error());
}*/

/**
 * Definition of routes and controllers
 * -----------------------------------------------------------------------------
 * RESTFul map:
 *  HTTP Method |  Url path                  |  Controller
 * -------------+----------------------------+----------------------------------
 *  GET         |  /                         |  enter
 *  GET         |  /home            		 |  home
 *  GET         |  /portfolio/$year 		 |  portfolio
 *  GET         |  /info            		 |  info
 *  GET         |  /prints          		 |  prints
 *  GET         |  /contact         	     |  contact
 *  GET			|  /admin				     |  admin
 *  GET			|  /admin/gh85	      		 |  admin
 *  GET			|  /admin/gh85/mover		 |  movertool
 *  GET			|  /admin/gh85/prints		 |  admin
 *  POST		|  /admin/gh85/prints/update |  printupdate
 *  POST		|  /admin/gh85/prints/upload |  printupload
 *  POST		|  /admin/gh85/prints/delete |  printdelete
 *  ------------+----------------------------+----------------------------------
 */
dispatch('/', 'enter');
	function enter()
	{
		return html('entersite.html.php');
	}

dispatch('/home', 'home');
	function home()
	{
		layout('layouts/gh85.layout.php');
		set('title', 'Grim Hearts 1985');
		//set('description', '');
		//set('keywords', '');
		return html('home.html.php');
	}
	
dispatch('/portfolio/*', 'portfolio');
	function portfolio()
	{
		$year = params(0);
		set('title', 'PORTFOLIO');
		//set('description', '');
		//set('keywords', '');
		layout('layouts/portfolio.layout.php');
		
		switch($year)
		{
			case '2007':
				return html('display/2007portfolio.html.php');
				break;
			default:
				return html('display/2007portfolio.html.php');
				break;
		}
	}
	
dispatch('/info', 'info');
	function info()
	{
		layout('layouts/gh85.layout.php');
		set('title', 'PORTFOLIO');
		//set('description', '');
		//set('keywords', '');
		return html('info.html.php');
	}

dispatch('/prints', 'prints');
	function prints()
	{
		layout('layouts/gh85.layout.php');
		set('title', 'PORTFOLIO');
		//set('description', '');
		//set('keywords', '');
		return html('prints.html.php');
	}
	
dispatch('/contact', 'contact');
	function contact()
	{
		layout('layouts/gh85.layout.php');
		set('title', 'PORTFOLIO');
		//set('description', '');
		//set('keywords', '');
		return html('contact.html.php');
	}

dispatch_post('/processform', 'processform');
	function processform()
	{
		if(isset($_POST['contact_name']) && isset($_POST['contact_email']) && isset($_POST['contact_message']))
		{
			//to guard against cross-site scripting use htmlentities to escape string
			$contact_name    = htmlentities($_POST['contact_name']);
			$contact_email   = htmlentities($_POST['contact_email']);
			$contact_message = htmlentities($_POST['contact_message']);

			if(!empty($contact_name) && !empty($contact_email) && !empty($contact_message))
			{
				$to      = 'your_name@your_email.com';
				$subject = $contact_name.' has sent you a message!';
				$body    = $contact_name.' wrote:'."\n"."\n".$contact_message;
				$headers = 'From: '.$contact_email;

				if(@mail($to, $subject, $body, $headers))
				{
					echo '<br /><br />';
					echo '<p><span style="font-size: 20px;">';
					echo 'Message has been sent, Thank you for contacting me.';
					echo '</span></p>';
				}
				else
				{
					echo '<br /><br />';
					echo '<p><span style="font-size: 20px;">';
					echo 'Sorry, something went wrong please press the back button and try again. If this continues to happen please try again later.';
					echo '</span></p>';
				}
			}
		}
	}

/**
 * Admin Tools
 */
/*dispatch('/admin/gh85', 'admin');
	function admin()
	{
		return html('admin/admin.html.php');
	}
	
dispatch('/admin/gh85/mover', 'movertool');
	function movertool()
	{
		return html('admin/mover.html.php');
	}

dispatch('/admin/gh85/prints', 'printstool');
	function printstool()
	{
		return html('admin/printstool.html.php');			
	}	
	
dispatch_post('/admin/gh85/prints/update', 'printupdate');
	function printupdate()
	{
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
		 	$name = $_POST['name'];
			$description = $_POST['description'];
			$price = $_POST['price'];
			$shipping = $_POST['shipping'];
			$quantity = $_POST['quantity'];
		
			if(!empty($id))
			{		
				if(!empty($name))
				{
					$name = "'".$name."'";
					$query = 'UPDATE products SET name = '.$name.' WHERE id = '.(int)$id;
					mysql_query($query);
					
					echo 'updated name';
					echo '<br />';
				}
				if(!empty($description))
				{
					$description = "'".$description."'";
					$query = 'UPDATE products SET description = '.$description.' WHERE id = '.(int)$id;
					mysql_query($query);
					
					echo 'updated description';
					echo '<br />';
				}
				if(!empty($price))
				{
					$price = "'".$price."'";
					$query = 'UPDATE products SET price = '.$price.' WHERE id = '.(int)$id;
					mysql_query($query);
					
					echo 'updated price';
					echo '<br />';
				}
				if(!empty($shipping))
				{
					$shipping = "'".$shipping."'";
					$query = 'UPDATE products SET shipping = '.$shipping.' WHERE id = '.(int)$id;
					mysql_query($query);
					
					echo 'updated shipping';
					echo '<br />';
				}
				if(!empty($quantity))
				{
					$quantity = "'".$quantity."'";
					$query = 'UPDATE products SET quantity = '.$quantity.' WHERE id = '.(int)$id;
					mysql_query($query);
					
					echo 'updated quantity';
					echo '<br />';
				}
				
				echo '<a href="http://'.$_SERVER['HTTP_HOST'].'/admin/gh85/prints">Return to Prints Tool</a>';
			}
			else 
			{
				echo 'no ID given';
			}
		}
	}
	
dispatch_post('/admin/gh85/prints/upload', 'printupload');
	function printupload()
	{
		if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") 
		|| ($_FILES["file"]["type"] == "image/jpg")) || ($_FILES["file"]["type"] == "image/png"))
	  	{
	  		if ($_FILES["file"]["error"] > 0)
	  		{
	  			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		    }
		  	else
		    {
			    if (file_exists("upload/" . $_FILES["file"]["name"]))
			    {
			    	echo $_FILES["file"]["name"] . " already exists. ";
			    }
			    else
			    {		    	
			    	$updatedb = "INSERT INTO products (imageurl, thumburl) VALUES('/public/img/print/image/".$_FILES["file"]["name"]."', '/public/img/print/thumbnail/".$_FILES["file"]["name"]."')";
			    	mysql_query($updatedb) or die(mysql_error());
			    	move_uploaded_file($_FILES["file"]["tmp_name"], "public/img/print/image/" . $_FILES["file"]["name"]);
			    	
			    	echo '<br />';
			    	echo "Your image has been uploaded to the server, to fill in name, description, shipping, price, quantity ";
			    	echo '<a href="http://'.$_SERVER['HTTP_HOST'].'/admin/gh85/prints">return to prints tool</a>';
			    }
		    }

	  	}
	  	else
	  	{
	  		echo "Invalid file... this needs to be .gif, .png, .jpeg, or .jpg";
	  	}	
	}
	
dispatch_post('/admin/gh85/prints/delete', 'printdelete');
	function printdelete()
	{
		if(isset($_POST['id']))
		{
			$id = $_POST['id'];
			$getimage = mysql_query("SELECT imageurl FROM products WHERE id = ".$id);
			$getthumb = mysql_query("SELECT thumburl FROM products WHERE id = ".$id);
			$imagetodelete = mysql_fetch_assoc($getimage);
			$thumbtodelete = mysql_fetch_assoc($getthumb);
			
			echo "<br />";
			echo "Your print has been removed from the database ";
			echo '<a href="http://'.$_SERVER['HTTP_HOST'].'/admin/gh85/prints">return to prints tool</a>';
		}
	}
*/

/**
 * run limonade app
 */
run();
