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

<article class="mapPlaces">
	<div class="vertical"></div>
	<div class="horizontal"></div>
	
	<?php query_posts('category_name=location_1&orderby=date&order=desc&posts_per_page=4');?>
	<section class="locationPhotos" id="locationPhotos1">
	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		createPhotoFrame($post);
	endwhile; endif;
	?>
	</section>
	
	<?php query_posts('category_name=location_2&orderby=date&order=desc&posts_per_page=4');?>
	<section class="locationPhotos" id="locationPhotos2">
	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		createPhotoFrame($post);
	endwhile; endif;
	?>
	</section>
	
	<?php query_posts('category_name=location_3&orderby=date&order=desc&posts_per_page=4');?>
	<section class="locationPhotos" id="locationPhotos3">
	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		createPhotoFrame($post);
	endwhile; endif;
	?>
	</section>
	
	<?php query_posts('category_name=location_4&orderby=date&order=desc&posts_per_page=4');?>
	<section class="locationPhotos" id="locationPhotos4">
	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		createPhotoFrame($post);
	endwhile; endif;
	?>
	</section>
	
	<?php query_posts('category_name=location_5&orderby=date&order=asc&posts_per_page=4');?>
	<section class="locationPhotos" id="locationPhotos5">
	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		createPhotoFrame($post);
	endwhile; endif;
	?>
	</section>
	
	<?php query_posts('category_name=location_6&orderby=date&order=asc&posts_per_page=4');?>
	<section class="locationPhotos" id="locationPhotos6">
	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		createPhotoFrame($post);
	endwhile; endif;
	?>
	</section>
	
	<?php query_posts('category_name=location_7&orderby=date&order=asc&posts_per_page=4');?>
	<section class="locationPhotos" id="locationPhotos7">
	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		createPhotoFrame($post);
	endwhile; endif;
	?>
	</section>
	

	<div class="locationName" id="locationName1"><?php echo get_cat_name(9); ?></div>
	<div class="locationName" id="locationName2"><?php echo get_cat_name(10); ?></div>
	<div class="locationName" id="locationName3"><?php echo get_cat_name(11); ?></div>
	<div class="locationName" id="locationName4"><?php echo get_cat_name(12); ?></div>
	<div class="locationName" id="locationName5"><?php echo get_cat_name(13); ?></div>
	<div class="locationName" id="locationName6"><?php echo get_cat_name(14); ?></div>
	<div class="locationName" id="locationName7"><?php echo get_cat_name(15); ?></div>

	<section class="location" id="location1" targetPhoto="locationPhotos1" target="locationName1"></section>
	<section class="location" id="location2" targetPhoto="locationPhotos2" target="locationName2"></section>
	<section class="location" id="location3" targetPhoto="locationPhotos3" target="locationName3"></section>
	<section class="location" id="location4" targetPhoto="locationPhotos4" target="locationName4"></section>
	<section class="location" id="location5" targetPhoto="locationPhotos5" target="locationName5"></section>
	<section class="location" id="location6" targetPhoto="locationPhotos6" target="locationName6"></section>
	<section class="location" id="location7" targetPhoto="locationPhotos7" target="locationName7"></section>
	
</article>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>