<?php
/**
** The template for displaying pages **/
get_header(); ?>

<?php // Include the header inside internal pages.
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/content', 'header' );
	endwhile;
?> <!-- .header-internal -->

<main id="main" class="site-main" role="main">
	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();

		// Include the page content template.
		get_template_part( 'template-parts/content', 'page' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

		// End of the loop.
	endwhile;
	?>

</main><!-- .site-main -->

<?php get_footer(); ?>
