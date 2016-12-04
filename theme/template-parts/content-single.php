<?php
/**
 * The template part for displaying single posts
 *
 */
?>

<section class="internal-pages">
	<div id="content">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php twentysixteen_excerpt(); ?>

			<div class="entry-content">
				<?php the_content();	?>
			</div><!-- .entry-content -->

		</article><!-- #post-## -->
	</div>
</section>
