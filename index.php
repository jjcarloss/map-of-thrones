<?php
/*
Template Name: Map
*/

function createPhotoFrame($post){
	$args = array(
	'order'				=> 'ASC',
	'orderby'			=> 'menu_order',
	'post_type'			=> 'attachment',
	'post_parent'		=> $post->ID,
	'post_mime_type'	=> 'image',
	'post_status'		=> null,
	'numberposts'		=> 1,
	);
	$photoMatrix = '';
	$attachments = get_posts($args);
	if ($attachments) {
		foreach($attachments as $attachment) {
			$fileName = end(explode('/', $attachment->guid));
			$fileNameParts = explode('.', $fileName);
			$fileName = '';
			for($i = 0; $i < count($fileNameParts) - 1; $i++) {
				$fileName .= $fileNameParts[$i].($i == count($fileNameParts) - 2?'mini':'.');
			}
			$fileName .= '.jpg';
			$fileNameUrl = '/wp-content/uploads/medium/'.$fileName;
			$fileName = './wp-content/uploads/medium/'.$fileName;
			//echo $fileName.'</br>';


			if(!file_exists($fileName))
				square_crop($attachment->guid, $fileName, 96, 60);
			$photoMatrix .= '<div class="photoMap"><a href="'. $post->guid .'"><img src="'.get_bloginfo('url').$fileNameUrl.'"></a></div>';
		}
	} 
	echo $photoMatrix;
}

get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 

$location_1_x = get_option('gbs_location_1_x'); 
$location_1_y = get_option('gbs_location_1_y'); 

$location_2_x = get_option('gbs_location_2_x'); 
$location_2_y = get_option('gbs_location_2_y'); 

$location_3_x = get_option('gbs_location_3_x'); 
$location_3_y = get_option('gbs_location_3_y'); 

$location_4_x = get_option('gbs_location_4_x');
$location_4_y = get_option('gbs_location_4_y');

$location_5_x = get_option('gbs_location_5_x');
$location_5_y = get_option('gbs_location_5_y');

$location_6_x = get_option('gbs_location_6_x');
$location_6_y = get_option('gbs_location_6_y');

$location_7_x = get_option('gbs_location_7_x');
$location_7_y = get_option('gbs_location_7_y');


?>

<style>

#location1{
	top: 	<?php echo $location_1_y; ?>;
	left: 	<?php echo $location_1_x; ?>;
	}
	
#location2{
	top: 	<?php echo $location_2_y; ?>;
	left: 	<?php echo $location_2_x; ?>;
	}
	
#location3{
	top: 	<?php echo $location_3_y; ?>;
	left: 	<?php echo $location_3_x; ?>;
	}
	
#location4{
	top: 	<?php echo $location_4_y; ?>;
	left: 	<?php echo $location_4_x; ?>;
	}
	
#location5{
	top: 	<?php echo $location_5_y; ?>;
	left: 	<?php echo $location_5_x; ?>;
	}
	
#location6{
	top: 	<?php echo $location_6_y; ?>;
	left: 	<?php echo $location_6_x; ?>;
	}
	
#location7{
	top: 	<?php echo $location_7_y; ?>;
	left: 	<?php echo $location_7_x; ?>;
	}
	
#locationPhotos1{
	top: 	<?php echo $location_1_y; ?>;
	left: 	<?php echo $location_1_x; ?>;
	}
	
#locationPhotos2{
	top: 	<?php echo $location_2_y; ?>;
	left: 	<?php echo $location_2_x; ?>;
	}
	
#locationPhotos3{
	top: 	<?php echo $location_3_y; ?>;
	left: 	<?php echo $location_3_x; ?>;
	}
	
#locationPhotos4{
	top: 	<?php echo $location_4_y; ?>;
	left: 	<?php echo $location_4_x; ?>;
	}
	
#locationPhotos5{
	top: 	<?php echo $location_5_y; ?>;
	left: 	<?php echo $location_5_x; ?>;
	}
	
#locationPhotos6{
	top: 	<?php echo $location_6_y; ?>;
	left: 	<?php echo $location_6_x; ?>;
	}

#locationPhotos7{
	top: 	<?php echo $location_7_y; ?>;
	left: 	<?php echo $location_7_x; ?>;
	}
	
#locationName1{
	top: 	<?php echo $location_1_y; ?>;
	left: 	<?php echo $location_1_x; ?>;
	}

#locationName2{
	top: 	<?php echo $location_2_y; ?>;
	left: 	<?php echo $location_2_x; ?>;
	}

#locationName3{
	top: 	<?php echo $location_3_y; ?>;
	left: 	<?php echo $location_3_x; ?>;
	}

#locationName4{
	top: 	<?php echo $location_4_y; ?>;
	left: 	<?php echo $location_4_x; ?>;
	}

#locationName5{
	top: 	<?php echo $location_5_y; ?>;
	left: 	<?php echo $location_5_x; ?>;
	}

#locationName6{
	top: 	<?php echo $location_6_y; ?>;
	left: 	<?php echo $location_6_x; ?>;
	}
	
#locationName7{
	top: 	<?php echo $location_7_y; ?>;
	left: 	<?php echo $location_7_x; ?>;
	}

</style>
	
	<?php
	$imagesDir = get_theme_root().'/'.get_template().'/images/locations/';
	$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
	?>
	<img src="<?php echo get_bloginfo('template_url')?>/images/EN-general.jpg" style="display:block;position:absolute;"/>
	<?php
	foreach($images as $image){
		$file = end(explode('/',$image));
		$imgInfo = retrieveImageInformation($file);?>
		
		<img class="locationImg" id="<?php echo $imgInfo['coords'][0].$imgInfo['coords'][1]?>" src="<?php echo get_bloginfo('template_url')?>/images/locations/<?php echo $file;?>" style="display:none;position:absolute;top:<?php echo $imgInfo['coords'][1]?>px;left:<?php echo $imgInfo['coords'][0]?>px;"/>
	
	<?php } ?>
	
	<article class="mapPlaces">
	</article>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
