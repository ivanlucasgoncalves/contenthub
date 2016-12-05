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
get_header();
$img_logo_facebook = get_theme_mod( 'img_logo_facebook', esc_url( get_template_directory_uri() . '/img/svg/lnk-facebook.svg' ) ); // Logo Facebook
$img_logo_twitter = get_theme_mod( 'img_logo_twitter', esc_url( get_template_directory_uri() . '/img/svg/lnk-twitter.svg' ) ); // Logo Twitter
$img_logo_linkedin = get_theme_mod( '$img_logo_linkedin', esc_url( get_template_directory_uri() . '/img/svg/lnk-linkedin.svg' ) ); // Logo Linkedin
$img_logo_facebook_black = get_theme_mod( 'img_logo_facebook_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-facebook-black.svg' ) ); // Logo Facebook Black
$img_logo_twitter_black = get_theme_mod( 'img_logo_twitter_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-twitter-black.svg' ) ); // Logo Twiiter Black
$img_logo_linkedin_black = get_theme_mod( 'img_logo_linkedin_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-linkedin-black.svg' ) ); // Logo Linkedin Black ?>

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
				<?php	echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook_black.'" alt="Facebook" width="13px"></a>';
				echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter_black.'" alt="Twitter" width="27px"></a>';
				echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin_black.'" alt="Linkedin" width="24px"></a>'; ?>
      <?php endwhile; ?>
    </section>
    <section class="post-categories">
			<div id="content">
				<?php
						$i=0; // Counting articles
						wp_reset_query();
						$sticky_first = get_option( 'sticky_posts' );
						$query_first_cat = array('category_name' => 'genuine-content',
							'orderby' => 'name',
							'posts_per_page' => 3,
							'post__in'  => $sticky_first
						);
						$post_first_cat = new WP_Query( $query_first_cat );
						if( isset($sticky_first[0]) ) {
							echo '<article class="blk_categories">';
						    while($post_first_cat->have_posts()) : $post_first_cat->the_post();
									$categorie_first = get_the_category();
									// Social Medias
									include 'template-parts/social-urls.php';
									foreach ($categorie_first as $categorie) {
										$categorie = wp_get_attachment_image_src( get_post_thumbnail_id( $post_first_cat->ID ), 'large' );
									}
									if($i==0) {
										echo '<h2><a href="' . esc_url( get_category_link( $categorie_first[0]->term_id ) ) . '" title="'. $categorie_first[0]->name .'">'. $categorie_first[0]->name .'</a></h2>';
						        echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $categorie[0] ) . ')">';
										echo '<a href="'.get_permalink($post_first_cat->ID).'" title="'.get_the_title().'">';
										echo '<div class="blk-info">';
										echo '<p class="post-format format-' . esc_html( get_post_format() ). '">' . esc_html( get_post_format() ). '</p>';
						        echo '<h3>'.get_the_title().'</h3>';
										echo '<p class="posted-by">' . esc_html( time_ago() ) . ' | by '.get_the_author_meta( "display_name" ).'</p>';
										echo '</div>';
										echo '</a>';
										echo '<div class="share">';
										echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook.'" alt="Facebook" width="13px"></a>';
										echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter.'" alt="Twitter" width="27px"></a>';
										echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin.'" alt="Linkedin" width="24px"></a>';
			              echo '</div>';
										echo '<div class="gradient"></div><div class="bottomBlue"></div>';
										echo '</article>';
									} else {
										echo '<article class="article-bottom blk_'. $i .'">';
						        echo '<a href="'.get_permalink($post_first_cat->ID).'">';
										echo '<img src="' .  esc_url( $categorie[0] ) . '" alt="' . get_the_title() . '" />';
										echo '<div class="secondary-info">';
										echo '<h5>'.esc_html( $categorie_first[0]->name ).'</h5>';
										echo '<h4>'.get_the_title().'</h4>';
										echo '</div>';
										echo '</a>';
										echo '</article>';
									} $i++;
						    endwhile;
							echo '</article>';
						}
	       ?>
				 <?php
	 					$i=0; // Counting articles
	 					wp_reset_query();
						$sticky_second = get_option( 'sticky_posts' );
	 					$query_second_cat = array('category_name' => 'thoughts',
	 						'orderby' => 'name',
	 						'posts_per_page' => 3,
							'post__in'  => $sticky_second
	 					);
	 					$post_second_cat = new WP_Query( $query_second_cat );
	 					if( isset($sticky_second[0]) ) {
	 					//$post = get_post();
	 						echo '<article class="blk_categories">';
	 					    while($post_second_cat->have_posts()) : $post_second_cat->the_post();
									$categorie_second = get_the_category();
									// Social Medias
									include 'template-parts/social-urls.php';
									foreach ($categorie_second as $categorie) {
										$categorie = wp_get_attachment_image_src( get_post_thumbnail_id( $post_second_cat->ID ), 'large' );
									}
	 								if($i==0) {
	 									echo '<h2><a href="' . esc_url( get_category_link( $categorie_second[0]->term_id ) ) . '" title="'. $categorie_second[0]->name .'">'. $categorie_second[0]->name .'</a></h2>';
	 					        echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $categorie[0] ) . ')">';
	 									echo '<a href="'.get_permalink($post_second_cat->ID).'" title="'.get_the_title().'">';
										echo '<div class="blk-info">';
										echo '<p class="post-format format-' . esc_html( get_post_format() ). '">' . esc_html( get_post_format() ). '</p>';
						        echo '<h3>'.get_the_title().'</h3>';
										echo '<p class="posted-by">' . esc_html( time_ago() ) . ' | by '.get_the_author_meta( "display_name" ).'</p>';
										echo '</div>';
	 									echo '</a>';
										echo '<div class="share">';
										echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook.'" alt="Facebook" width="13px"></a>';
										echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter.'" alt="Twitter" width="27px"></a>';
										echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin.'" alt="Linkedin" width="24px"></a>';
										echo '</div>';
										echo '<div class="gradient"></div><div class="bottomBlue"></div>';
	 									echo '</article>';
	 								} else {
	 									echo '<article class="article-bottom blk_'. $i .'">';
	 					        echo '<a href="'.get_permalink($post_second_cat->ID).'" title="'.get_the_title().'">';
										echo '<img src="' .  esc_url( $categorie[0] ) . '" alt="' . get_the_title() . '" />';
										echo '<div class="secondary-info">';
	 									echo '<h5>'.esc_html( $categorie_second[0]->name ).'</h5>';
	 									echo '<h4>'.get_the_title().'</h4>';
	 									echo '</div>';
	 									echo '</a>';
	 									echo '</article>';
	 								} $i++;
	 					    endwhile;
	 						echo '</article>';
	 					}
	        ?>
					<?php
							$i=0; // Counting articles
							wp_reset_query();
							$sticky_third = get_option( 'sticky_posts' );
							$query_third_cat = array('category_name' => 'trending',
								'orderby' => 'name',
								'posts_per_page' => 3,
								'post__in'  => $sticky_third
							);
							$post_third_cat = new WP_Query( $query_third_cat );
							if( isset($sticky_third[0]) ) {
							//$post = get_post();
								echo '<article class="blk_categories">';
							    while($post_third_cat->have_posts()) : $post_third_cat->the_post();
										$categorie_third = get_the_category();
										// Social Medias
										include 'template-parts/social-urls.php';
										foreach ($categorie_third as $categorie) {
											$categorie = wp_get_attachment_image_src( get_post_thumbnail_id( $post_third_cat->ID ), 'large' );
										}
										if($i==0) {
											echo '<h2><a href="' . esc_url( get_category_link( $categorie_third[0]->term_id ) ) . '" title="'. $categorie_third[0]->name .'">'. $categorie_third[0]->name .'</a></h2>';
							        echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $categorie[0] ) . ')">';
											echo '<a href="'.get_permalink($post_third_cat->ID).'" title="'.get_the_title().'">';
											echo '<div class="blk-info">';
											echo '<p class="post-format format-' . esc_html( get_post_format() ). '">' . esc_html( get_post_format() ). '</p>';
							        echo '<h3>'.get_the_title().'</h3>';
											echo '<p class="posted-by">' . esc_html( time_ago() ) . ' | by '.get_the_author_meta( "display_name" ).'</p>';
											echo '</div>';
											echo '</a>';
											echo '<div class="share">';
											echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook.'" alt="Facebook" width="13px"></a>';
											echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter.'" alt="Twitter" width="27px"></a>';
											echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin.'" alt="Linkedin" width="24px"></a>';
											echo '</div>';
											echo '<div class="gradient"></div><div class="bottomBlue"></div>';
											echo '</article>';
										} else {
											echo '<article class="article-bottom blk_'. $i .'">';
							        echo '<a href="'.get_permalink($post_third_cat->ID).'" title="'.get_the_title().'">';
											echo '<img src="' .  esc_url( $categorie[0] ) . '" alt="' . get_the_title() . '" />';
											echo '<div class="secondary-info">';
											echo '<h5>'.esc_html( $categorie_third[0]->name ).'</h5>';
											echo '<h4>'.get_the_title().'</h4>';
											echo '</div>';
											echo '</a>';
											echo '</article>';
										} $i++;
							    endwhile;
								echo '</article>';
							}
		       ?>
			</div>
    </section>
		<section class="featured">
			<div id="content">
				<section class="message-title">
					<h1>iRecruit Educational</h1>
					<p>Genuine content to inspire your team in order to get better results.</p>
				</section>
				<section class="featured-highpost">
					<?php
							wp_reset_query();
							$sticky_third = get_option( 'sticky_posts' );
							$query_third_cat = array('category_name' => 'highlights',
								'orderby' => 'name',
								'posts_per_page' => 1,
								'post__in'  => get_option( 'sticky_posts' )
							);
							$post_third_cat = new WP_Query( $query_third_cat );
							if( isset($sticky_third[0]) ) {
							//$post = get_post();
								echo '<article class="blk_categories">';
							    while($post_third_cat->have_posts()) : $post_third_cat->the_post();
										$categorie_third = get_the_category();
										// Social Medias
										include 'template-parts/social-urls.php';
										foreach ($categorie_third as $categorie) {
											$categorie = wp_get_attachment_image_src( get_post_thumbnail_id( $post_third_cat->ID ), 'large' );
										}
						        echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $categorie[0] ) . ')">';
										echo '<a href="'.get_permalink($post->ID).'">';
										echo '<div class="blk-info">';
										echo '<p class="post-format format-' . esc_html( get_post_format() ). '">' . esc_html( get_post_format() ). '</p>';
						        echo '<h3>'.get_the_title().'</h3>';
										echo '<p class="posted-by">' . esc_html( time_ago() ) . ' | by '.get_the_author_meta( "display_name" ).'</p>';
										echo '</div>';
										echo '</a>';
										echo '<div class="share">';
										echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook.'" alt="Facebook" width="13px"></a>';
										echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter.'" alt="Twitter" width="27px"></a>';
										echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin.'" alt="Linkedin" width="24px"></a>';
										echo '</div>';
										echo '<div class="gradient"></div><div class="bottomBlue"></div>';
										echo '</article>';
							    endwhile;
								echo '</article>';
							}
		       ?>
				</section>
				<section class="featured-posts">
					<?php
							$i=0; // Counting articles
							wp_reset_query();
							$sticky_third = get_option( 'sticky_posts' );
							$query_third_cat = array('category_name' => 'trending',
								'orderby' => 'name',
								'posts_per_page' => 5,
								'post__in'  => get_option( 'sticky_posts' )
							);
							$post_third_cat = new WP_Query( $query_third_cat );
							if( isset($sticky_third[0]) ) {
							//$post = get_post();
								echo '<article class="blk_categories">';
							    while($post_third_cat->have_posts()) : $post_third_cat->the_post();
										$categorie_third = get_the_category();
										// Social Medias
										include 'template-parts/social-urls.php';
										foreach ($categorie_third as $categorie) {
											$categorie = wp_get_attachment_image_src( get_post_thumbnail_id( $post_third_cat->ID ), 'large' );
										}
										if($i==0) {
							        echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $categorie[0] ) . ')">';
											echo '<a href="'.get_permalink($post->ID).'">';
											echo '<div class="blk-info">';
											echo '<p class="post-format format-' . esc_html( get_post_format() ). '">' . esc_html( get_post_format() ). '</p>';
							        echo '<h3>'.get_the_title().'</h3>';
											echo '<p class="posted-by">' . esc_html( time_ago() ) . ' | by '.get_the_author_meta( "display_name" ).'</p>';
											echo '</div>';
											echo '</a>';
											echo '<div class="share">';
											echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook.'" alt="Facebook" width="13px"></a>';
											echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter.'" alt="Twitter" width="27px"></a>';
											echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin.'" alt="Linkedin" width="24px"></a>';
											echo '</div>';
											echo '<div class="gradient"></div><div class="bottomBlue"></div>';
											echo '</article>';
										} else {
											echo '<article class="article-bottom blk_'. $i .'">';
							        echo '<a href="'.get_permalink($post->ID).'">';
											echo '<p class="posted-by">' . esc_html( time_ago() ) . '</p>';
											echo '<div class="secondary-info">';
											echo '<h4>'.get_the_title().'</h4>';
											echo '</div>';
											echo '</a>';
											echo '</article>';
										} $i++;
							    endwhile;
								echo '</article>';
							}
		       ?>
				</section>
			</div>
		</section>

  </main>

<?php get_footer(); ?>
