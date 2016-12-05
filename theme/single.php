<?php
/**
** The template for displaying all single posts and attachments **/
get_header();
$img_logo_facebook = get_theme_mod( 'img_logo_facebook', esc_url( get_template_directory_uri() . '/img/svg/lnk-facebook.svg' ) ); // Logo Facebook
$img_logo_twitter = get_theme_mod( 'img_logo_twitter', esc_url( get_template_directory_uri() . '/img/svg/lnk-twitter.svg' ) ); // Logo Twitter
$img_logo_linkedin = get_theme_mod( '$img_logo_linkedin', esc_url( get_template_directory_uri() . '/img/svg/lnk-linkedin.svg' ) ); // Logo Linkedin ?>

<?php // Include the header inside internal pages.
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/content', 'header' );
	endwhile;
?> <!-- .header-internal -->

<main id="main" class="site-main" role="main">
	<?php // Include the content inside internal pages.
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'single' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</main> <!-- .site-main -->

<?php // Include the related posts into the internal pages.
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		$first_tag = $tags[0]->term_id;
		$args = array (
			'tag__in' => array( $first_tag ),
			'post__not_in' => array( $post->ID ),
			'posts_per_page'=> 3,
			'caller_get_posts'=> 1
		);
		$my_query = new WP_Query($args);
		if ( $my_query->have_posts() ) : ?>
			<section class="related-posts">
				<div id="content">
					<h2>You may also like:</h2>
					<div class="content-related">
						<?php while ($my_query->have_posts()) : $my_query->the_post();
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $my_query->ID ), 'large' );
							// Social Medias
							include 'template-parts/social-urls.php'; ?>
							<article class="article-top" style="background-image:url(<?php echo esc_url( $image[0] ); ?>)">
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<div class="blk-info">
										<h3><?php the_title(); ?></h3>
										<p class="posted-by"><?php echo time_ago(); ?> | by <?php echo get_the_author_meta( "display_name" ); ?></p>
									</div>
								</a>
								<div class="share">
									<a href="<?php echo $facebook_link_atts ?>" class="facebook" title="Share ContentHub on Facebook"><img src="<?php echo $img_logo_facebook ?>" alt="Facebook" width="16px"></a>
									<a href="<?php echo $twitter_link_atts ?>" class="facebook" title="Share ContentHub on Facebook"><img src="<?php echo $img_logo_twitter ?>" alt="Facebook" width="16px"></a>
									<a href="<?php echo $linkedin_link_atts ?>" class="facebook" title="Share ContentHub on Facebook"><img src="<?php echo $img_logo_linkedin ?>" alt="Facebook" width="16px"></a>
								</div>
								<div class="gradient"></div><div class="bottomBlue"></div>
							</article>
						<?php endwhile; ?>
		<?php endif; ?>
					</div>
				</div>
			</section>
<?php wp_reset_query(); } ?>


<?php get_sidebar( 'content-bottom' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
