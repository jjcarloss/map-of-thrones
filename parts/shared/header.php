

<?php
	$imagesDir = get_theme_root().'/'.get_template().'/images/locations/';
	$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
?>

<header>
	<nav class="menu-principal">
		<ul>
				<li id="work">Locations</li>
				<li id="contact"><a href="mailto:contact@mapofthrones.com" title="Contact Us">Contact Us</a></li>
				<li id="twitter">
					<a class="twitter popup" href="http://twitter.com/share?text=Check%20out%20this%20webapp%20for%20Game%20of%20Thrones!">Tweet about this webapp</a>
					<script>
					  $('.popup').click(function(event) {
					    var width  = 575,
					        height = 400,
					        left   = ($(window).width()  - width)  / 2,
					        top    = ($(window).height() - height) / 2,
					        url    = this.href,
					        opts   = 'status=1' +
					                 ',width='  + width  +
					                 ',height=' + height +
					                 ',top='    + top    +
					                 ',left='   + left;
					    
					    window.open(url, 'twitter', opts);
					 
					    return false;
					  });
					</script>
				</li>
				<li id="dribbble"><a href='http://www.facebook.com/share.php?u=http://app.mapofthrones.com' target="_blank">Share this webapp in Facebook</a></li>
				<li id="forrst"><a href="" title="Please donate">Please donate</a></li>
				<!--<li id="about"><a href="" title="About Me">About Ryan Scherf</a></li>
				<li id="contact"><a href="" title="Contact Me">Contact Ryan Scherf</a></li>
				<li id="twitter"><a href="" title="Follow me on Twitter - @ryanscherf">@ryanscherf on Twitter</a></li>
				<li id="dribbble"><a href="" title="Follow me on Dribbble - @ryanscherf">@ryanscherf on Dribbble</a></li>
				<li id="forrst"><a href="" title="Follow me on Forrst - @ryanscherf">@ryanscherf on Forrst</a></li>-->
			</ul>
		<section id="locationsTable" class="selectionTable" style="display:none;">
			<?php 
			
			foreach($images as $image){
			$file = end(explode('/',$image));
			$imgInfo = retrieveImageInformation($file);
			
			?>
			<article target="<?php echo $imgInfo['coords'][0].$imgInfo['coords'][1]?>" class="locationHolder" newTop="<?php echo $imgInfo['coords'][1]; ?>" newLeft="<?php echo $imgInfo['coords'][0]; ?>">
				<div class="icon iconCastle icon-<?php echo $imgInfo['kind'];?>">
					&nsbp;
				</div>
				<div class="locationTitleOuter">
					<div class="locationTitle">
						<?php echo $imgInfo['name'];?>
					</div>
				</div>
			</article>
			<?php } ?>
			
		</section>
	</nav>
</header>
