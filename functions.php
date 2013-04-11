<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	// register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'script_enqueuer' );

	add_filter( 'body_class', 'add_slug_to_body_class' );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */



	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );

		wp_register_style( 'screen', get_template_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
	}	

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}

	/* Esconder Admin Bar a usuarios normales. */
	function fb_show_admin_bar() {
	 if ( current_user_can( 'manage_options' ) )
	 return FALSE;
	 else
	 return FALSE;
	 }
	add_filter( 'show_admin_bar', 'fb_show_admin_bar' );
	
	
	/* Custom password form. */
	function my_password_form() {
		global $post;

		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<form class="protected-post-form" action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass" method="post">
		' . __( get_option('gbs_password_text') ) . '
		<label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
		</form>
		';
		return $o;
	}
	add_filter( 'the_password_form', 'my_password_form' );

	
	function get_cat_name_by_id($cat_id) {
		$cat_id = (int) $cat_id;
		$category = &get_category($cat_id);
		return $category->cat_name;
	}
	
	
	function retrieveImageInformation($image){
		$firstSlice = explode('-',$image);
		$coords = explode(',',$firstSlice[0]);
		$kind = $firstSlice[1];
		$name = '';
		for($i=2;$i<count($firstSlice);$i++){
			$name .= $firstSlice[$i].'-';
		}
		$name = current(explode('.',$name));
		$name = str_replace('_',' ',$name);
		$name = str_replace('[apo]','\'',$name);
		
		
		return array(
			'coords' => $coords,
			'kind' => $kind,
			'name' => $name
		);
	}
	
	function square_crop($src_image, $dest_image, $thumb_w = 64, $thumb_h = 64, $jpg_quality = 90) {
	 
		// Get dimensions of existing image
		$image = getimagesize($src_image);
	 
		// Check for valid dimensions
		if( $image[0] <= 0 || $image[1] <= 0 ) return false;
	 
		// Determine format from MIME-Type
		$image['format'] = strtolower(preg_replace('/^.*?\//', '', $image['mime']));
	 
		// Import image
		switch( $image['format'] ) {
			case 'jpg':
			case 'jpeg':
				$image_data = imagecreatefromjpeg($src_image);
			break;
			case 'png':
				$image_data = imagecreatefrompng($src_image);
			break;
			case 'gif':
				$image_data = imagecreatefromgif($src_image);
			break;
			default:
				// Unsupported format
				return false;
			break;
		}
	 
		// Verify import
		if( $image_data == false ) return false;
	 
		// Calculate measurements
		if( $image[0]/$image[1] > $thumb_w/$thumb_h) {
			// For landscape images
			$h = $image[1];
			$w = $thumb_w*$h/$thumb_h;
		} else {
			// For portrait and square images
			$w = $image[0];
			$h = $w*$thumb_h/$thumb_w;
		}
	 
		// Resize and crop
		$canvas = imagecreatetruecolor($thumb_w, $thumb_h);
		if( imagecopyresampled(
			$canvas,
			$image_data,
			0,
			0,
			0,
			0,
			$thumb_w,
			$thumb_h,
			$w,
			$h
		)) {
	 
			// Create thumbnail
			switch( strtolower(preg_replace('/^.*\./', '', $dest_image)) ) {
				case 'jpg':
				case 'jpeg':
					return imagejpeg($canvas, $dest_image, $jpg_quality);
				break;
				case 'png':
					return imagepng($canvas, $dest_image);
				break;
				case 'gif':
					return imagegif($canvas, $dest_image);
				break;
				default:
					// Unsupported format
					echo 'asd<br/>';
					return false;
				break;
			}
	 
		} else {
			echo 'asd<br/>';
			return false;
		}
	 
	}
 
?>