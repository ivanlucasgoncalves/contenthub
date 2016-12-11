<?php
/**
 * The template part for displaying results in search pages
 *
 */// Get the url from thumbnail
 $thumb_id = get_post_thumbnail_id();
 $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
 $thumb_url = $thumb_url_array[0]; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php echo get_the_title(); ?>">
    <img src="<?php echo $thumb_url ?>" alt="<?php echo get_the_title(); ?>"><!-- .post.image -->
    <div class="entry-content">
      <?php $categories = get_the_category();
      echo '<h5>'. esc_html( $categories[0]->name ) .'</h5>' ?>
      <h4><?php the_title(); ?></h4>
      <?php echo '<i class="posted-by">' . esc_html( time_ago() ) . ' | <span>by '.get_the_author_meta( "display_name" ).'</span> - <span class="estimated-time">'.do_shortcode("[est_time]").' read</span></i>'; ?>
    </div><!-- .entry-content -->
  </a>
</article><!-- #post-## -->
