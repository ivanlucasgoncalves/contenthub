<?php
/**
* A Simple Category Template
*/

get_header(); ?>


<main id="main" class="site-main" role="main">
  <div id="content">
<header class="header-category">
  <?php
    // Check if there are any posts to display
    $categories = get_the_category();
    if ( ! empty( $categories ) ) {
        echo '<h1>' . esc_html( $categories[0]->name ) . '</h1>';
    }
    // Social Medias
    include 'template-parts/social-urls.php';
    echo '<div class="blk-share">';
    echo '<a '.$facebook_link_atts.' ><img src="'.$img_logo_facebook_black.'" alt="Facebook" width="13px"></a>';
    echo '<a '.$twitter_link_atts.' ><img src="'.$img_logo_twitter_black.'" alt="Twitter" width="27px"></a>';
    echo '<a '.$linkedin_link_atts.' ><img src="'.$img_logo_linkedin_black.'" alt="Linkedin" width="24px"></a>';
    echo '</div>'; ?>
</header>

<section class="home-highlights"> <!--.It's not the best approach for sure but I didn't have time to look at. I will do it later.-->
  <?php
    // Check if there are any posts to display
    if ( have_posts() ) : ?>
    <?php
        $i=0; // Counting articles
          while(have_posts()) : the_post();
            $categories = get_the_category();
            // Social Medias
            include 'template-parts/social-urls.php';
            foreach ($categories as $categorie) {
              $categorie = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
              $category_id = get_cat_ID( 'highlights' );
              $category_link = get_category_link( $category_id );
            }
            if($i==0 || $i==1 || $i==2) {
            echo '<article class="blk_'. $i .'" style="background-image:url(' .  esc_url( $categorie[0] ) . ')">';
            echo '<div class="article-info">';
            echo '<a href="'.get_permalink().'" class="lnk-post" title="'.get_the_title().'">';
            echo '<div class="blk-info">';
            echo '<p class="category">'. esc_html( $categories[0]->name ) .'</p>';
            echo '<h2 class="title">'.get_the_title().'</h2>';
            echo '<p class="posted">' . esc_html( time_ago() ) . ' | <span>by '.get_the_author_meta( "display_name" ).'</span></p>';
            echo '</div>';
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
         } $i++;
       endwhile;?>
       <?php endif; ?>
</section>


<section id="primary" class="site-content">
  <?php
    // Check if there are any posts to display
    if ( have_posts() ) : ?>
    <?php
    $i=1; // Counting articles
    echo '<section class="content-post_category">';
    //$post = get_post();
      while( have_posts()) : the_post();
        $categorie_third = get_the_category();
        // Social Medias
        include 'template-parts/social-urls.php';
        foreach ($categorie_third as $categorie) {
          $categorie = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
          $timeago = esc_html( time_ago() );
        }
        if($i==1 || $i==2 || $i==3) {}
        elseif($i==4 || $i==5 || $i==6) {
          echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $categorie[0] ) . ')">';
          echo '<a class="lnk-content-post" href="'.get_permalink($post->ID).'" title="' . get_the_title() . '">';
          echo '<div class="blk-info">';
          echo '<p class="post-format format-' . esc_html( get_post_format() ). '">' . esc_html( get_post_format() ). '</p>';
          echo '<h3>'.get_the_title().'</h3>';
          echo '<p class="posted-by">' . esc_html( time_ago() ) . ' | <span>by '.get_the_author_meta( "display_name" ).'</span></p>';
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
          echo '<a href="'.get_permalink($post_first_cat->ID).'" title="' . get_the_title() . '">';
          echo '<img src="' .  esc_url( $categorie[0] ) . '" alt="' . get_the_title() . '" />';
          echo '<div class="secondary-info">';
          echo '<p class="posted-by">' . esc_html( time_ago() ) . '</span></p>';
          echo '<h4>'.get_the_title().'</h4>';
          echo '</div>';
          echo '</a>';
          echo '</article>';
        }
        // if multiple of 3 close div and open a new div
        if($i % 3 == 0) { echo '</section><section class="content-post_category">'; }
        $i++;
      endwhile; ?>
    <?php endif;
    echo '</section>'; ?>
</section>

</div>
</main>

<?php get_footer(); ?>
