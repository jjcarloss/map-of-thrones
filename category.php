<?php
/**
 * The template for displaying Category Archive pages
 */
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<section id="menu">
    <a href="<?php echo get_category_link(get_cat_ID('architecture'));?>"><div class="title_section catTitle<?php echo is_category('architecture')?" active":""?>">architecture</div></a>
    <a href="<?php echo get_category_link(get_cat_ID('interiors'));?>"><div class="title_section catTitle<?php echo is_category('interiors')?" active":""?>">interiors</div></a>
    <a href="<?php echo get_category_link(get_cat_ID('planning'));?>"><div class="title_section catTitle<?php echo is_category('planning')?" active":""?>">planning</div></a>
</section>
<?php if ( have_posts() ): 

	get_template_part( 'parts/shared/colors' );

?>
<section class="postFrames clearfix">
<?php $i = 0; while ( have_posts() && $i<16) : the_post(); ?>
		<a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">
			<article class="postFrame">
				
				<div class="colorLayer" style="background-color:<?php echo $cssColors[$i%9];?>;"></div>
				<div class="postInfo">
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
				</div>
				<?php

					//var_dump($post);	
					
					$args = array(
						'order'				=> 'ASC',
						'orderby'			=> 'menu_order',
						'post_type'			=> 'attachment',
						'post_parent'		=> $post->ID,
						'post_mime_type'	=> 'image',
						'post_status'		=> null,
						'numberposts'		=> 1,
					);
					
					$attachments = get_posts($args);
					if ($attachments) {
						$fileName = './wp-content/uploads/medium/'.$attachments[0]->post_name.'194-127.jpg';
						if(!file_exists($fileName))
							square_crop($attachments[0]->guid, $fileName, 194, 127);?>
						<img class='indexFrameMainImage' id="archMainImg" src="<?php echo get_bloginfo('url').'/wp-content/uploads/medium/'.$attachments[0]->post_name.'194-127.jpg';?>"><?php
					}
				?>
				
			</article>
		</a>
<?php $i++; endwhile; ?>
</section>
<?php else: ?>
<h2>No posts to display in <?php echo single_cat_title( '', false ); ?></h2>
<?php endif; ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>