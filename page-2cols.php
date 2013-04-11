<?php
/*
Template Name: 2 Columnas
*/


$pageList = get_pages(array(
	'sort_order' => 'ASC', 
	'sort_column' => 'menu_order',
	'child_of' => $post->ID
	));

$paginas = '';	
	
foreach ($pageList as $pageKey => $page) { 
	$paginas .= '<li class="item_project"><a href="'.get_permalink($page->ID).'">'. $page->post_title .'</a></li>';
	}
	
?>

<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<div class="columnas">
	
		<div class="col_ii_1">
			<div class="cols_contenido">
				<?php the_field('columna_1'); ?>
				<?php if(get_field('listar_subpaginas')=="c1"){ echo $paginas; }; ?>
			</div>
		</div>
		
		<div class="col_ii_2">
			<div class="cols_contenido">
				<?php the_field('columna_2'); ?>
				<?php if(get_field('listar_subpaginas')=="c2"){ echo $paginas; }; ?>
			</div>
		</div>
	
	</div>

<?php endwhile; ?>	
	
<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>