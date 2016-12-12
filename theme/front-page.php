<?php
/**
 * The main template front page
 */
/*$terms = get_the_terms( get_the_ID(), 'post_formats');
foreach($terms as $term) {
	$term = array_pop($terms);
	$custom_field = get_field('svg_image', $term );
	echo $custom_field;
	echo $term->name;
}*/
get_header(); ?>

	<main id="main" class="site-main" role="main">
    <section class="home-highlights">
			<div id="content">
				<!--/** Show Categories at the Front Page at the Post Highlights Position
				It can be changed the workflow into the function.php **/-->
				<?php get_sidebar('post-highlights'); ?>
			</div>
    </section>
    <section class="quotes-day">
      <h3>#quoteoftheday</h3>
      <?php $quotes_day = new WP_Query( array(
        'post_type' => 'quote_of_the_day',
        'posts_per_page' => 1,	)); ?>
      <?php while ( $quotes_day->have_posts() ) : $quotes_day->the_post();
				// Social Medias
				include 'template-parts/social-urls.php'; ?>
        <p><?php the_title(); ?></p>
				<?php
				echo '<div class="blk-share">';
				echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook_black.'" alt="Facebook" width="13px"></a>';
				echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter_black.'" alt="Twitter" width="27px"></a>';
				echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin_black.'" alt="Linkedin" width="24px"></a>';
				echo '</div>';?>
      <?php endwhile; ?>
    </section>
    <section class="post-categories">
			<div id="content">
				<!--/** Show Categories at the Front Page at the Post Categories Position
				It can be changed the workflow into the function.php **/-->
				<?php get_sidebar('post-categories'); ?>
			</div>
    </section>
		<section class="featured">
			<div id="content">
				<section class="message-title">
					<h1>iRecruit Educational</h1>
					<p>Genuine content to inspire your team in order to get better results.</p>
				</section>
				<section class="featured-highpost">
					<!--/** Show Categories at the Front Page at the Featured HighPost Position
					It can be changed the workflow into the function.php **/-->
					<?php get_sidebar('featured-highpost'); ?>
				</section>
				<section class="featured-posts">
					<!--/** Show Categories at the Front Page at the Featured Post Position
					It can be changed the workflow into the function.php **/-->
					<?php get_sidebar('featured-posts'); ?>
				</section>
			</div>
		</section>

  </main>

<?php get_footer(); ?>
