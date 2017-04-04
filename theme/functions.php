<?php
/**
** iRecruit Theme only works in WordPress 4.4 or later **/
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
function twentysixteen_setup() {

	load_theme_textdomain( 'twentysixteen' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

	/** Enable support for custom logo **/
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/** Enable support for Post Thumbnails on posts and pages **/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	/** This theme uses wp_nav_menu() in two locations **/
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'secondary'  => __( 'Secondary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
	) );

	/** Switch default core markup for search form, comment form, and comments to output valid HTML5 **/
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/** Enable support for Post Formats **/
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'status',
		'audio',
		'chat',
	) );

	/** This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width **/
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );


/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
** Search AJAX Page **/
function load_search_results() {
		$img_logo_hub = get_theme_mod( 'img_logo_hub', esc_url( get_template_directory_uri() . '/img/logo-hub.jpg' ) ); // Logo ContentHub

    $query = $_POST['query'];

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
				'public' => true,
        's' => $query,
    );
    $search = new WP_Query( $args );

    ob_start();

    if ( $search->have_posts() ) : ?>
			<?php
				while ( $search->have_posts() ) : $search->the_post();
					get_template_part( 'template-parts/content', 'search' );
				endwhile;
				echo '<figure class="logofoo-contenthub"><img src="'.$img_logo_hub.'" alt="ContentHub"></fiugre>'; // Logo ContentHub
			else :
			echo '<p>Sorry, It seems we can’t find what you’re looking for.</p>';
		endif;

	$content = ob_get_clean();

	echo $content;
	die();
}
add_action( 'wp_ajax_load_search_results', 'load_search_results' );
add_action( 'wp_ajax_nopriv_load_search_results', 'load_search_results' );

/**
** Registers a widget area **/
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Post Highlights', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears at the front page of the post highlights.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="blk_categories %2$s">',
    'after_widget'  => '</section>',
	) );

	register_sidebar( array(
		'name'          => __( 'Post Categories', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the front page of the post categories.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="blk_categories %2$s">',
    'after_widget'  => '</section>',
	) );

	register_sidebar( array(
		'name'          => __( 'Featured Posts', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the front page of the featured posts.', 'twentysixteen' ),
		'before_widget' => '<article id="%1$s" class="blk_categories %2$s">',
    'after_widget'  => '</article>',
	) );

	register_sidebar( array(
		'name'          => __( 'Featured HighPost', 'twentysixteen' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Appears at the front page of the featured highpost.', 'twentysixteen' ),
		'before_widget' => '<article id="%1$s" class="blk_categories %2$s">',
    'after_widget'  => '</article>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );


/**
** Register Google fonts for Twenty Sixteen.
** Create your own twentysixteen_fonts_url() function to override in a child theme **/
if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :

function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'Heebo font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Heebo:100,300,400,500,700,800,900';
	}
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;
}
endif;


/**
** Create function to author biography **/
function wpb_author_info_box( $content ) {
	global $post;

	// Detect if it is a single post with a post author
	if ( is_single() && isset( $post->post_author ) ) {

		// Get author's display name
		$display_name = get_the_author_meta( 'display_name', $post->post_author );

		// If display name is not available then use nickname as display name
		if ( empty( $display_name ) )
		$display_name = get_the_author_meta( 'nickname', $post->post_author );

		// Get author's biographical information or description
		$user_description = get_the_author_meta( 'user_description', $post->post_author );

		// Get link to the author archive page
		$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));

		if ( ! empty( $display_name ) )

		//$author_details = '<p class="author_name">About ' . $display_name . '</p>';

		if ( ! empty( $user_description ) )
		// Author avatar and bio

		$author_details .= '<section class="author_details">';

		$author_details .= '<div class="author_avatar">' . get_avatar( get_the_author_meta('user_email') , 90 ) . '</div>';

		$author_details .= '<div class="author_content"><h3>About ' . $display_name . '</h3><blockquote class="text_author">' . nl2br( $user_description ). '</blockquote></div></section>';

		// Pass all this info to post content
		$content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
	}
	return $content;
}
// Add our function to the post content filter
add_action( 'the_content', 'wpb_author_info_box' );
// Allow HTML in author bio section
remove_filter('pre_user_description', 'wp_filter_kses');


/**
** Register a Front Page custom **/
function themeslug_filter_front_page( $template ) {
    return is_home() ? '' : $template;
}
add_filter( 'front_page', 'themeslug_filter_front_page' );


/**
** Fix relative links on navs for non-root domains **/
function rel_to_absolute($items){
  foreach($items as $item){
    if (strpos($item->url, '/%') === 0) {
      $item->url = get_bloginfo("url") . $item->url;
    }
  }
  return $items;
}
add_filter('wp_nav_menu_objects', 'rel_to_absolute');


/**
** Function which displays your post date in time ago format **/
function time_ago() {
	return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago' );
}


/*
** Allow WP upload SVG **/
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/**
** Handles JavaScript detection.
** Adds a `js` class to the root `<html>` element when JavaScript is detected **/
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
** Enqueues scripts and styles **/
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Load the html5 shiv.
	if(getenv('DEV_IP')) {
		// Add livereload for local access
		wp_enqueue_script('livereload', 'http://'.getenv('DEV_IP').':35731/livereload.js?snipver=1', null, false, true);
	}

	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_enqueue_script( '', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ), '', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
** Adds custom classes to the array of body classes **/
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( ! is_home() && ! is_category() ) {
		$classes[] = 'internal-pages';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
** Converts a HEX value to RGB
** @param string $color The original color, in 3- or 6-digit hexadecimal form.
** @return array Array containing RGB (red, green, and blue) values for the given
** HEX code, empty array otherwise **/
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
** Custom template tags for this theme **/
require get_template_directory() . '/inc/template-tags.php';

/**
** Customizer additions **/
require get_template_directory() . '/inc/customizer.php';

/**
** Add custom image sizes attribute to enhance responsive image functionality
** for content images
**
** @param string $sizes A source size value for use in a 'sizes' attribute.
** @param array  $size  Image size. Accepts an array of width and height
** values in pixels (in that order).
** @return string A source size value for use in a content image 'sizes' attribute **/
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
** Modifies tag cloud widget arguments to have all tags in the widget same font size **/
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );


/**
** Register Widgets at the Front Page **/
class CategoriesWidgets extends WP_Widget
{
  function CategoriesWidgets()
  {
    $widget_ops = array('description' => 'Positions categories at the front page' );
    $this->WP_Widget('CategoriesWidgets', 'Positioning Categories', $widget_ops);
  }

  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'category' => '' ) );
    $title = $instance['title'];
    $type_category = $instance['category'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('category'); ?>">Category: <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($type_category); ?>" /></label></p>
<?php
  }

  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['category'] = $new_instance['category'];
    return $instance;
  }

  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);

    echo $before_widget;
    //$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    //$tipo2 = $tipo;
    $type_category = empty($instance['category']) ? ' ' : apply_filters('widget_title', $instance['category']);

    if (!empty($title))
      echo $before_title . $title . $after_title;

		if($id=='sidebar-1') {
			$i=0; // Counting articles
			wp_reset_query();
			$sticky = get_option( 'sticky_posts' );
			$args = array('category_name' => $type_category,
				'orderby'        => 'name',
				'posts_per_page' => 3,
				'post__in'       => $sticky
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
					$i++;
				endwhile;
			 }
		}

		if($id=='sidebar-2') {
			// WIDGET CODE GOES HERE
			$i=0; // Counting articles
			wp_reset_query();
			$sticky_first = get_option( 'sticky_posts' );
			$query_first_cat = array('category_name' => $type_category,
				'orderby' => 'name',
				'posts_per_page' => 3,
				'post__in'  => $sticky_first
			);
			$post_first_cat = new WP_Query( $query_first_cat );
			if( isset($sticky_first[0]) ) {
				while($post_first_cat->have_posts()) : $post_first_cat->the_post();
					$categorie_first = get_the_category();
					// Social Medias
					include 'template-parts/social-urls.php';
					$calltoaction = get_field('embed_call-to-action', 'widget_' . $widget_id);
					foreach ($categorie_first as $categorie) {
						$categorie = wp_get_attachment_image_src( get_post_thumbnail_id( $post_first_cat->ID ), 'large' );
					}
					if($i==0) {
						echo '<h2>'.$calltoaction.'</h2>';
						//echo '<h2><a href="' . esc_url( get_category_link( $categorie_first[0]->term_id ) ) . '" title="'. $categorie_first[0]->name .'">'. $categorie_first[0]->name .'</a></h2>';
						echo '<article class="article-top blk_'. $i .'" style="background-image:url(' .  esc_url( $categorie[0] ) . ')">';
						echo '<a class="lnk-content-post" href="'.get_permalink($post_first_cat->ID).'" title="'.get_the_title().'">';
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
						echo '<h5>'.esc_html( $categorie_first[0]->name ).'</h5>';
						echo '<h4>'.get_the_title().'</h4>';
						echo '</div>';
						echo '</a>';
						echo '</article>';
					} $i++;
				endwhile;
			}
		}

		if($id=='sidebar-3') {
			$i=0; // Counting articles
			wp_reset_query();
			$sticky = get_option( 'sticky_posts' );
			$query_third_cat = array('category_name' => $type_category,
				'orderby' => 'name',
				'posts_per_page' => 5,
				'post__in'  => $sticky
			);
			$post_third_cat = new WP_Query( $query_third_cat );
			if( isset($sticky[0]) ) {
			//$post = get_post();
				while($post_third_cat->have_posts()) : $post_third_cat->the_post();
					$categorie_third = get_the_category();
					// Social Medias
					include 'template-parts/social-urls.php';
					foreach ($categorie_third as $categorie) {
						$categorie = wp_get_attachment_image_src( get_post_thumbnail_id( $post_third_cat->ID ), 'large' );
					}
					if($i==0) {
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
						echo '<a href="'.get_permalink($post->ID).'" title="' . get_the_title() . '">';
						echo '<p class="posted-by">' . esc_html( time_ago() ) . '</p>';
						echo '<div class="secondary-info">';
						echo '<h4>'.get_the_title().'</h4>';
						echo '</div>';
						echo '</a>';
						echo '</article>';
					} $i++;
				endwhile;
			}
		}

		if($id=='sidebar-4') {
			wp_reset_query();
			$sticky = get_option( 'sticky_posts' );
			$query_third_cat = array('category_name' => $type_category,
				'orderby' => 'name',
				'posts_per_page' => 1,
				'post__in'  => $sticky
			);
			$post_third_cat = new WP_Query( $query_third_cat );
			if( isset($sticky[0]) ) {
			//$post = get_post();
				while($post_third_cat->have_posts()) : $post_third_cat->the_post();
					$categorie_third = get_the_category();
					// Social Medias
					include 'template-parts/social-urls.php';
					foreach ($categorie_third as $categorie) {
						$categorie = wp_get_attachment_image_src( get_post_thumbnail_id( $post_third_cat->ID ), 'large' );
					}
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
				endwhile;
			}
		}

    echo $after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("CategoriesWidgets");') );
