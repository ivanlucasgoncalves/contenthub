<?php
/**
 * The template for displaying all single posts and attachments
 *
 */
get_header(); ?>

<?php // Include the header inside internal pages.

// Start the loop.
while ( have_posts() ) : the_post();

	// Include the single post content template.
	get_template_part( 'template-parts/content', 'header' );

	// End of the loop.
endwhile;
?>

<main id="main" class="site-main" role="main">

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();

		// Include the single post content template.
		get_template_part( 'template-parts/content', 'single' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

		// End of the loop.
	endwhile;
	?>
</main><!-- .site-main -->

<?php get_sidebar( 'content-bottom' ); ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
