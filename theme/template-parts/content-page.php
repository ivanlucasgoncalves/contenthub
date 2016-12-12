<?php
/**
** The template used for displaying page content **/
$img_logo_facebook_black = get_theme_mod( 'img_logo_facebook_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-facebook-black.svg' ) ); // Logo Facebook Black
$img_logo_twitter_black = get_theme_mod( 'img_logo_twitter_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-twitter-black.svg' ) ); // Logo Twitter Black
$img_logo_linkedin_black = get_theme_mod( 'img_logo_linkedin_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-linkedin-black.svg' ) ); // Logo Linkedin Black ?>

<section class="internal-pages">
	<div id="content">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php twentysixteen_excerpt(); ?>
			<div class="entry-content">
				<?php // Content
				the_content();	?>

				<?php // Getting tags related in each single post
					$posttags = get_the_tags();
					if ($posttags) {
					  foreach ($posttags as $tag) {
					     $tagnames[count($tagnames)] = $tag->name;
					  }
					  $comma_separated_tagnames = implode(" #", $tagnames);
					  print_r("<p class='p-tags'>#$comma_separated_tagnames</p>");
					}
				?>

				<?php
				// Social Medias
				include 'social-urls.php';
				echo '<div id="social-shares" class="medias-links">';
				echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook_black.'" alt="Facebook" width="13px"></a>';
				echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter_black.'" alt="Twitter" width="27px"></a>';
				echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin_black.'" alt="Linkedin" width="24px"></a>';
				echo '</div>';?>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	</div>
</section>
