<?php

function toThumbnail()
{
	$file_path = "public/img/print/image";
	$new_file_path = "public/img/print/thumbnail";
	list($img_width, $img_height) = @getimagesize($file_path);

	if(!$img_width || !$img_height)
	{
		return false;
	}

	//desired thumbnail size 175x165
	$thumb_w = 165;
	$thumb_h = 175;

	$w_ratio = ($thumb_w / $img_width);
	$h_ratio = ($thumb_h / $img_height);

	if($img_width > $img_height)
	{
		$new_width  = round($img_width*$h_ratio);
		$new_height = $thumb_h;
		$biggestSide = $new_width;
	}
	elseif($img_width < $img_height)
	{
		$new_height = round($img_height*$w_ratio);
		$new_width  = $thumb_w;
		$biggestSide = $new_height;
	}
	else
	{
		$new_width  = $thumb_w; //$img_width * $new_size;
		$new_height = $thumb_h; //$img_height * $new_size;
	}
	 
	$new_img = @imagecreatetruecolor($new_width, $new_height);

	$offset = array(
			        	"x" => 0, 
			        	"y" => 0
	);
	 
	$cropPercent = .2;
	$cropWidth   = $biggestSide*$cropPercent;
	$cropHeight  = $biggestSide*$cropPercent;

	//override if image created is not 175x165
	//landscape
	if($new_width != $thumb_w)
	{
		$new_img = @imagecreatetruecolor($thumb_w, $new_height);
		$offset = array(
				        	"x" => (($new_width-$cropWidth)/2 + 20),
				        	"y" => 0
		);
	}
	//portrait
	if($new_height != $thumb_h)
	{
		$new_img = @imagecreatetruecolor($new_width, $thumb_h);
	}
	 
	@imagecopyresized(
	$new_img,
	$src_img,
	0, 0, $offset['x'], $offset['y'],
	$new_width,
	$new_height,
	$img_width,
	$img_height
	);
	 
	echo $_FILES["file"]["tmp_name"];
	 
	 
}
