<?php
/*
Template Name: Services / About Us
*/
?>

<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<article class="thinColumnContent clearfix">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php the_content(); ?>
	<?php endwhile; ?>
</article>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>