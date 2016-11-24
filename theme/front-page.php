<?php
/**
 * The main template front page
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

    <section class="home-highlights">
      <?php $custom_terms = get_terms('categories');
        $i=0; // Count how many post is gonna appear at home page
        foreach($custom_terms as $custom_term) {
          if($i==3) break;
          $term_link = get_term_link( $custom_term ); // The $term is an object, so we don't need to specify the $taxonomy.
          wp_reset_query();
          $args = array('post_type' => 'page',
            'orderby' => 'name',
            'posts_per_page' => 1,
            'tax_query' => array(
              array(
                  'taxonomy' => 'categories',
                  'field' => 'slug',
                  'terms' => $custom_term->slug,
              ),
            ),
           );
           $loop = new WP_Query($args);
           if( $loop->have_posts() ) {
            while($loop->have_posts()) : $loop->the_post();
              $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_term->ID ), 'large' ); // Set image as a background
              echo '<article class="blk_'. $i .'" style="background-image:url(' . esc_url( $large_image_url[0] ) . ')">';
              echo '<div class="article-info">';
              echo '<a class="category" href="' . esc_url( $term_link ) . '" title="'.$custom_term->name.'">'.$custom_term->name.'</a>';
              echo '<a href="'.get_permalink().'" class="lnk-post" title="'.get_the_title().'">';
              echo '<h2 class="title">'.get_the_title().'</h2>';
              echo '<p class="posted">' . esc_html( time_ago() ) . ' | by '.get_the_author_meta( "display_name" ).'</p>';
              echo '</a>';
              echo '</div>';
              echo '<div class="gradient"></div>';
              echo '<div class="bottomBlue"></div>';
              echo '</article>';
            endwhile;
           } $i++;
        } ?>
    </section>
    <section class="quotes-day">
      <h3>#quoteoftheday</h3>
      <?php $quotes_day = new WP_Query( array(
        'post_type' => 'quote_of_the_day',
        'posts_per_page' => 1,	)); ?>
      <?php while ( $quotes_day->have_posts() ) : $quotes_day->the_post(); ?>
        <p><?php the_title(); ?></p>
      <?php endwhile; ?>
    </section>
    <section class="post-categories">
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
					//$post = get_post();
						echo '<article class="blk_categories">';
					    while($post_first_cat->have_posts()) : $post_first_cat->the_post();
								if($i==0) {
									$categorie_first = get_the_category();
									echo '<h2><a href="' . esc_url( get_category_link( $categorie_first[0]->term_id ) ) . '" title="'. $categorie_first[0]->name .'">'. $categorie_first[0]->name .'</a></h2>';
									$image_url_first = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
					        echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $image_url_first[0] ) . ')">';
									echo '<a href="'.get_permalink($post->ID).'" title="'.get_the_title().'">';
									echo '<div class="blk-info">';
					        echo '<h3>'.get_the_title().'</h3>';
									echo '<p class="posted-by">' . esc_html( time_ago() ) . ' | by '.get_the_author_meta( "display_name" ).'</p>';
									echo '</div>';
									echo '</a>';
									echo '<div class="gradient"></div><div class="bottomBlue"></div>';
									echo '</article>';
								} else {
									echo '<article class="article-bottom blk_'. $i .'">';
					        echo '<a href="'.get_permalink($post->ID).'">';
									echo '<img src="' .  esc_url( $image_url_first[0] ) . '" alt="' . get_the_title() . '" />';
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
 								if($i==0) {
 									$categorie_second = get_the_category();
 									echo '<h2><a href="' . esc_url( get_category_link( $categorie_second[0]->term_id ) ) . '" title="'. $categorie_second[0]->name .'">'. $categorie_second[0]->name .'</a></h2>';
 									$image_url_second = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
 					        echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $image_url_second[0] ) . ')">';
 									echo '<a href="'.get_permalink($post->ID).'">';
									echo '<div class="blk-info">';
					        echo '<h3>'.get_the_title().'</h3>';
									echo '<p class="posted-by">' . esc_html( time_ago() ) . ' | by '.get_the_author_meta( "display_name" ).'</p>';
									echo '</div>';
 									echo '</a>';
									echo '<div class="gradient"></div><div class="bottomBlue"></div>';
 									echo '</article>';
 								} else {
 									echo '<article class="article-bottom blk_'. $i .'">';
 					        echo '<a href="'.get_permalink($post->ID).'">';
									echo '<img src="' .  esc_url( $image_url_second[0] ) . '" alt="' . get_the_title() . '" />';
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
									if($i==0) {
										$categorie_third = get_the_category();
										echo '<h2><a href="' . esc_url( get_category_link( $categorie_third[0]->term_id ) ) . '" title="'. $categorie_third[0]->name .'">'. $categorie_third[0]->name .'</a></h2>';
										$image_url_third = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
						        echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $image_url_third[0] ) . ')">';
										echo '<a href="'.get_permalink($post->ID).'">';
										echo '<div class="blk-info">';
						        echo '<h3>'.get_the_title().'</h3>';
										echo '<p class="posted-by">' . esc_html( time_ago() ) . ' | by '.get_the_author_meta( "display_name" ).'</p>';
										echo '</div>';
										echo '</a>';
										echo '<div class="gradient"></div><div class="bottomBlue"></div>';
										echo '</article>';
									} else {
										echo '<article class="article-bottom blk_'. $i .'">';
						        echo '<a href="'.get_permalink($post->ID).'">';
										echo '<img src="' .  esc_url( $image_url_third[0] ) . '" alt="' . get_the_title() . '" />';
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
    </section>
		<section class="featured">
			<section>
				<h1>iRecruit Educational</h1>
				<p>Genuine content to inspire your team in order to get better results.</p>
			</section>
			<section>

			</section>
			<section>
				<?php
						$i=0; // Counting articles
						wp_reset_query();
						$sticky_third = get_option( 'sticky_posts' );
						$query_third_cat = array('category_name' => 'trending',
							'orderby' => 'name',
							'posts_per_page' => 3,
							'post__in'  => get_option( 'sticky_posts' )
						);
						$post_third_cat = new WP_Query( $query_third_cat );
						if( isset($sticky_third[0]) ) {
						//$post = get_post();
							echo '<article class="blk_categories">';
						    while($post_third_cat->have_posts()) : $post_third_cat->the_post();
									if($i==0) {
										$categorie_third = get_the_category();
										$image_url_third = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
						        echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $image_url_third[0] ) . ')">';
										echo '<a href="'.get_permalink($post->ID).'">';
										echo '<div class="blk-info">';
						        echo '<h3>'.get_the_title().'</h3>';
										echo '<p class="posted-by">' . esc_html( time_ago() ) . ' | by '.get_the_author_meta( "display_name" ).'</p>';
										echo '</div>';
										echo '</a>';
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
		</section>

  </main>
</div>

<?php get_footer(); ?>
