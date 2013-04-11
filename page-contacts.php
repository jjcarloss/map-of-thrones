<?php
/*
Template Name: Contacts
*/
?>
<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<article class="contactsContent clearfix">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<section class="contactInfo">
			<?php the_content(); ?>
		</section>
	<?php endwhile; ?>
	<?php query_posts('category_name=contact_us&orderby=title&order=asc&posts_per_page=-1');?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<section class="member">
			<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');?>
			<img class="memberPhoto" src="<?php echo $large_image_url[0];?>"/>
			<h3 class="memberName"><?php the_title(); ?></h3>
			<div class="memberEmail"><?php the_excerpt();?></div>
			<section class="memberDetail">
				<?php the_content(); ?>
			</section>
		</section>
	<?php endwhile; ?>
</article>
<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>