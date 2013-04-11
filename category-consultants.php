<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<?php if ( have_posts() ): ?>
<section class="consultantsContent clearfix">
<?php  while( have_posts() ): the_post(); ?>
		<article class="consultant">
			<section class="consultantTitle"><?php the_title(); ?></section>
			<section class="consultantExcerpt"><?php the_excerpt(); ?></section>
			<?php the_content(); ?>
		</article>
<?php endwhile; ?>
</section>
<?php else: ?>
<h2>No posts to display in <?php echo single_cat_title( '', false ); ?></h2>
<?php endif; ?>

<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>