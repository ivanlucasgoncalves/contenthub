<?php
/**
 * The template part for displaying content header for single pages
 *
 */
 
 // Get the url from thumbnail
 $thumb_id = get_post_thumbnail_id();
 $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
 $thumb_url = $thumb_url_array[0]; ?>

<div class="internal-header" role="banner" style="background-image:url(<?php echo $thumb_url ?>);">
	<div class="content-header">
		<?php
		// Category link
		if ( 'post' === get_post_type() ) {
			$categorie_first = get_the_category();
			echo '<p class="category-title">'.$categorie_first[0]->name.'</p>';
		}

    // Title
		the_title( '<h1 class="entry-title">', '</h1>' );

    // Estimated Reading Time
		echo '<i class="estimated-time">'.do_shortcode("[est_time]").' read</i>';

    // Avatar Author
		if ( 'post' === get_post_type() ) {
			$author_avatar_size = apply_filters( 'twentysixteen_author_avatar_size', 49 );
			printf( '<span class="author vcard">%1$s</span>',
				get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
				_x( '', 'Used before post author name.', 'twentysixteen' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}

    // Info from the Post | Name and Date
		if ( 'post' === get_post_type() ) {
			$post_date = get_the_date( 'F j, Y' );
			$post_author = get_the_author();
			echo '<p class="internal-postedby">by <b>'.$post_author.'</b> on <b>'.$post_date.'</b></p>';
		}
		?>
	</div>
	<div class="gradient"></div>
</div><!-- .entry-header -->

<div class="progress-container" style="top: 0px;">
	<div class="progressBar"></div>
</div><!-- .progressive.bar -->
