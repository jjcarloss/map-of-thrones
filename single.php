<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/starkers-utilities.php for info on get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php 

	function getHeight($imageUrl){
		$size = getimagesize($imageUrl);
		
		return ceil((676*$size[1])/$size[0]);
	}


	get_template_part( 'parts/shared/colors' );
	get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<article>
	<?php
			$post_categories = wp_get_post_categories( $post->ID );
			
			$cats = array();
				
			foreach($post_categories as $c){
				$cat = get_category( $c );
				$cats[] = $cat->slug;
			}
	?>
	<section id="menuSingle">
		<a href="<?php echo get_category_link(get_cat_ID('architecture'));?>"><div class="title_section catTitleSingle<?php echo in_array('architecture',$cats)?" activeTitle":""?>">architecture</div></a>
		<a href="<?php echo get_category_link(get_cat_ID('interiors'));?>"><div class="title_section catTitleSingle<?php echo in_array('interiors',$cats)?" activeTitle":""?>">interiors</div></a>
		<a href="<?php echo get_category_link(get_cat_ID('planning'));?>"><div class="title_section catTitleSingle<?php echo in_array('planning',$cats)?" activeTitle":""?>">planning</div></a>
		<!--
		<div class="prevNextPosts">
			<?php previous_post_link('%link', 'prev', 'true', '9,10,11,12,13,14,15,16'); ?>
			<?php next_post_link('%link', 'next', 'true', '9,10,11,12,13,14,15,16'); ?>
		</div>
		-->
	</section>
	<section class='postArea'>
		<div class='clearfix'>
			<?php
			$args = array(
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order',
			'post_type'			=> 'attachment',
			'post_parent'		=> $post->ID,
			'post_mime_type'	=> 'image',
			'post_status'		=> null,
			'numberposts'		=> -1,
			);

			$attachments = get_posts($args);
			if ($attachments) {
				$firstImage = true;
				$photoMatrix = '';
				$j = 0;?>
				<section class="mainImages">
					<div class="imgFondo"></div>
					<?php
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
						$photoMatrix .= '<div class="selectPhoto" target="photoHolder'.(++$j).'" targetTitle="title'.$j.'" targetImg="photo'.$j.'">
											<div class="selectColorFilter'.($j==1?' first':'').'" style="background-color:'.$cssColors[$j%9].';"></div>
											<img src="'.get_bloginfo('url').$fileNameUrl.'">
										</div>';
						//$photoMatrix .= '<img class="selectPhoto" target="photo'.(++$j).'" src="'.get_bloginfo('url').$fileNameUrl.'">';
						
						if($firstImage){					
							$firstImage = false;
							?>
							<img id="photo<?php echo $j;?>" class="postMainImage active" src="<?php echo $attachment->guid;?>">
							<div id="photoHolder<?php echo $j;?>" imgID="photo<?php echo $j;?>" class='postMainImageHolder' newHeight="<?php echo getHeight($attachment->guid)?>" src="<?php echo $attachment->guid;?>" loaded="loadedImg"></div>
							<div id="title<?php echo $j;?>" class="mainPhotoTitle activePhotoTitle"><?php echo $attachment->post_content;?></div>
							<?php

							$firstName = $attachment->post_content;
						}else{
							?>
							<div id="photoHolder<?php echo $j;?>" imgID="photo<?php echo $j;?>" class='postMainImageHolder' newHeight="<?php echo getHeight($attachment->guid)?>" src="<?php echo $attachment->guid;?>" loaded="false"></div>
							<div id="title<?php echo $j;?>" class="mainPhotoTitle"><?php echo $attachment->post_content;?></div>
							<?php
						}
					}?>
				</section>
				<section id="photoMatrix" frameHeight="<?php echo (ceil(count($attachments)/3)*67 + 12);?>">
					<?php echo $photoMatrix;?>
				</section>
			<?php
			} 
			?>
		</div>
		<div class='postContent'>
			<div id="photoDescription" class="postContent_phototxt"><?php echo $firstName?></div> 
			<div class="postContent_main">
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
		</div>			
	</section>
	
</article>
<?php endwhile; ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>