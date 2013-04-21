<?php
if(!session_id()){ session_start(); }
$page = 'http://'.$_SERVER['HTTP_HOST'].'/prints';

/**
 * The following adds, removes or deletes quantites from shopping cart
 */
//add
if(isset($_GET['add']))
{
	$quantity = mysql_query('SELECT id, quantity FROM products WHERE id='.mysql_real_escape_string((int)$_GET['add']));
	
	//check to make sure user can't pass the quantity permitted
	while($quantity_row = mysql_fetch_assoc($quantity))
	{
		if($quantity_row['quantity'] != $_SESSION['cart_'.(int)$_GET['add']])
		{
			//adding to quantity			
			$_SESSION['cart_'.(int)$_GET['add']]+='1';
		}
	}
	header('Location: '.$page);
}

//remove
if(isset($_GET['remove']))
{
	$_SESSION['cart_'.(int)$_GET['remove']]--;
	header('Location: '.$page);
}

//delete
if(isset($_GET['delete']))
{
	$_SESSION['cart_'.(int)$_GET['delete']] = 0;
	header('Location: '.$page);
}

/**
 * 
 * Lists the products from the database
 */
function products()
{
	$get = mysql_query('SELECT id, name, description, price, imageurl, thumburl FROM products WHERE quantity > 0 ORDER BY id DESC');
	
	if(mysql_num_rows($get) == 0)
	{
		echo "There are no products to display!";
	}
	else 
	{
		echo '<div id="gallery">'.'<ul>';
		while($get_row = mysql_fetch_assoc($get))
		{
			echo '<li>';
			echo '<img src="'.$get_row['thumburl'].'" />'; 
			echo '<p>'.$get_row['name'].'<br />'.
			           $get_row['description'].'<br />'.
			           number_format($get_row['price'], 2).'<a href="?add='.
			           $get_row['id'].'">Add</a>'.'</p>';
			echo '</li>';
		}
		echo '</ul>'.'</div>';
	}
}

/**
 * 
 * this is the function that will be used to display the cart items for paypal
 * all information is here
 * https://www.paypal.com/cgi-bin/webscr?cmd=p/pdn/howto_checkout-outside 
 */
function paypal_items()
{
	$num = 0;
	foreach($_SESSION as $name => $value)
	{
		if($value != 0)
		{
			if(substr($name, 0, 5) == 'cart_')
			{
				$id = substr($name, 5, strlen($name)-5);
				$get = mysql_query('SELECT id, name, price, shipping FROM products WHERE id='.mysql_real_escape_string((int)$id));
				while($get_row = mysql_fetch_assoc(($get)))
				{
					$num++;
					//in increasing order will display last item in array
					echo '<input type="hidden" name="item_number_'.$num.'" value="'.$id.'">';
					echo '<input type="hidden" name="item_name_'.$num.'" value="'.$get_row['name'].'">';
					echo '<input type="hidden" name="amount_'.$num.'" value="'.$get_row['price'].'">';
					echo '<input type="hidden" name="shipping_'.$num.'" value="'.$get_row['shipping'].'">';
					echo '<input type="hidden" name="shipping2_'.$num.'" value="'.$get_row['shipping'].'">';
					echo '<input type="hidden" name="quantity_'.$num.'" value="'.$value.'">';				
				}
			}
		}
	}
}

/**
 * cart function displays the number of items they have added 
 */
function cart()
{
	foreach($_SESSION as $name => $value)
	{
		if($value > 0)
		{
			if(substr($name, 0, 5) == 'cart_')
			{
				$id = substr($name, 5, (strlen($name)-5));  //we are removing cart_ which is length of 5
				$get = mysql_query('SELECT id, name, price FROM products WHERE id='.mysql_real_escape_string((int)$id));
				
				while($get_row = mysql_fetch_assoc($get))
				{
					@$sub = $get_row['price']*$value;
					echo $get_row['name'].' x '. $value.' @ '.'$'.$get_row['price'].' = '.'$'.$sub.
					'<a href="prints?remove='.$id.'"><img src="/public/img/site/down-arrow.png" height="20" width="20" /></a> 
					<a href="prints?add='.$id.'"><img src="/public/img/site/up-arrow.png" height="20" width="20" /></a> 
					<a href="prints?delete='.$id.'"><img src="/public/img/site/remove.png" /></a><br />';
				}
			}
			@$total += $sub;
		}
	}
	if($total == 0)
	{
		echo "your cart is empty.";
	}
	else 
	{
		echo '<br />';
		echo 'Total: $'.number_format($total, 2);
		?>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_cart">
		<input type="hidden" name="upload" value="1">
		<input type="hidden" name="business" value="yourname@youremail.com">
		<?php paypal_items(); ?>
		<input type="hidden" name="currency_code" value="USD">
		<input type="hidden" name="amount" value="<?php $total; ?>">
		<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but03.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
		</form>
		<?php	
	}
}

/**
 * 
 * Might use this ... truncates a string if too long and adds ellipsis 
 * @param unknown_type $string
 * @param unknown_type $length
 * @param unknown_type $stopanywhere
 */
function Truncate($string, $length, $stopanywhere=false) 
{
    //truncates a string to a certain char length, stopping on a word if not specified otherwise.
    if (strlen($string) > $length) 
    {
        //limit hit!
        $string = substr($string,0,($length -3));
        if ($stopanywhere) 
        {
            //stop anywhere
            $string .= '...';
        } 
        else
        {
            //stop on a word.
            $string = substr($string,0,strrpos($string,' ')).'...';
        }
    }
    return $string;
}
