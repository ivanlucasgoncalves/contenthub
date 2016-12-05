<?php
/**
** The template part for displaying single posts **/
$img_logo_facebook_black = get_theme_mod( 'img_logo_facebook_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-facebook-black.svg' ) ); // Logo Facebook Black
$img_logo_twitter_black = get_theme_mod( 'img_logo_twitter_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-twitter-black.svg' ) ); // Logo Twitter Black
$img_logo_linkedin_black = get_theme_mod( 'img_logo_linkedin_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-linkedin-black.svg' ) ); // Logo Linkedin Black ?>

<section class="internal-pages">
	<div id="content">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php twentysixteen_excerpt(); ?>

			<div class="entry-content">
				<?php
				// Social Medias
				include 'social-urls.php';
				echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook_black.'" alt="Facebook" width="13px"></a>';
				echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter_black.'" alt="Twitter" width="27px"></a>';
				echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin_black.'" alt="Linkedin" width="24px"></a>'; ?>

				<?php the_content();	?>
			</div><!-- .entry-content -->

		</article><!-- #post-## -->
	</div>
</section>
