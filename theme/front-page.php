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
				<?php
						$i=0; // Counting articles
	          wp_reset_query();
						$sticky = get_option( 'sticky_posts' );
						$args = array('category_name' => 'highlights',
							'orderby' => 'name',
							'posts_per_page' => 3,
							'post__in'  => $sticky
						);
	           $loop = new WP_Query($args);
	           if( isset($sticky[0]) ) {
	            while($loop->have_posts()) : $loop->the_post();
								$categories = get_the_category();
								// Social Medias
								include 'template-parts/social-urls.php';
								foreach ($categories as $categorie) {
									$categorie = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->ID ), 'large' );
							    $category_id = get_cat_ID( 'highlights' );
							    $category_link = get_category_link( $category_id );
								}
	              echo '<article class="blk_'. $i .'" style="background-image:url(' .  esc_url( $categorie[0] ) . ')">';
	              echo '<div class="article-info">';
	              echo '<a class="category" href="' . esc_url( $category_link ) . '" title="'. esc_html( $categories[0]->name ) .'">'. esc_html( $categories[0]->name ) .'</a>';
	              echo '<a href="'.get_permalink().'" class="lnk-post" title="'.get_the_title().'">';
	              echo '<h2 class="title">'.get_the_title().'</h2>';
	              echo '<p class="posted">' . esc_html( time_ago() ) . ' | <span>by '.get_the_author_meta( "display_name" ).'</span></p>';
	              echo '</a>';
								echo '<div class="share">';
								echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook.'" alt="Facebook" width="13px"></a>';
								echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter.'" alt="Twitter" width="27px"></a>';
								echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin.'" alt="Linkedin" width="24px"></a>';
	              echo '</div>';
								echo '</div>';
	              echo '<div class="gradient"></div>';
	              echo '<div class="bottomBlue"></div>';
	              echo '</article>';
								$i++;
	            endwhile;
	           } ?>
			</div>
    </section>
    <section class="quotes-day">
      <h3>#quoteoftheday</h3>
      <?php $quotes_day = new WP_Query( array(
        'post_type' => 'quote_of_the_day',
        'posts_per_page' => 1,	)); ?>
      <?php while ( $quotes_day->have_posts() ) : $quotes_day->the_post();
				// Social urls
				$urlencoded_pageurl = urlencode(get_permalink());
				$urlencoded_title = urlencode(get_the_title());
				$hash_tag = get_field('twitter_hashtag');
				if (!$hash_tag) { // Hashtags Twitter
					$post_tags = get_the_tags();
					$hash_tag = isset($post_tags) && isset($post_tags[0]) ? $post_tags[0]->slug : '';
				}
				$hash_tag = urlencode(str_replace(' ', '', $hash_tag));
				// Link Share Twitter
				$facebook_link_atts = '
					rel="nofollow"
					target="_blank"
					class="facebook"
					title="Share article on Facebook"
					href="https://www.facebook.com/dialog/share?app_id=1219998328070399&amp;display=page&amp;href='.$urlencoded_pageurl.'&amp;redirect_uri=https%3A%2F%2Ffacebook.com"
				';
				$twitter_link_atts = '
					rel="nofollow"
					target="_blank"
					class="twitter"
					title="Share article'. ($hash_tag ? ' and #'.$hash_tag : '').' on Twitter"
					href="https://twitter.com/share?via='.'ContentHub&related=ContentHub'
							.($hash_tag ? '&hashtags='.$hash_tag : '')
							.'&text='.$urlencoded_title.'"
				'; ?>
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
