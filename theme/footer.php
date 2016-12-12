<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 */
 /*require 'vendor/autoload.php';

 $fb = new Facebook\Facebook([
   'app_id' => '371815733162514', // Replace {app-id} with your app id
   'app_secret' => '6154d076858cce732dbda0f3f7aeb6dd',
   'default_graph_version' => 'v2.2',
   ]);

 $helper = $fb->getRedirectLoginHelper();

 $permissions = ['email']; // Optional permissions
 $loginUrl = $helper->getLoginUrl('http://10.1.1.54:8789/contentHub/theme/social-logins/fb-callback.php', $permissions);*/

$img_logo_hub = get_theme_mod( 'img_logo_hub', esc_url( get_template_directory_uri() . '/img/logo-hub.jpg' ) ); // Logo ContentHub
$img_facebook = get_theme_mod( 'img_facebook', esc_url( get_template_directory_uri() . '/img/svg/facebookWhite.svg' ) ); // Logo Facebook
$img_twitter = get_theme_mod( 'img_twitter', esc_url( get_template_directory_uri() . '/img/svg/twitterWhite.svg' ) ); // Logo Twitter
$img_google = get_theme_mod( 'img_google', esc_url( get_template_directory_uri() . '/img/svg/googleWhite.svg' ) ); // Logo Google+
$img_likedin = get_theme_mod( 'img_likedin', esc_url( get_template_directory_uri() . '/img/svg/linkedinWhite.svg' ) ); // Logo Linkedin ?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="content">
		<div class="logo"></div>
		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					) );
				?>
			</nav><!-- .social-navigation -->
		<?php endif; ?>
	</div>
</footer><!-- .site-footer -->
<?php if(!(is_home() && is_front_page())) :?>
  <div class="postActionsNav navDisappear">
  	<div class="centralize">
      <a class="comment" href="#comments" title="Comment article">
        <span>Comment</span>
      </a>
  	<div class="lnk-share">
      <a href="#social-shares" title="Share article">
        <span>Share</span>
      </a>
  	</div>
  	</div>
  </div>
<?php endif; ?>
<div class="overlay-menu overlay-contentscale">
	<?php if ( has_nav_menu( 'secondary' ) ) : ?>
			<?php if ( has_nav_menu( 'secondary' ) ) : ?>
				<nav id="site-navigation" class="secondary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Secondary Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'secondary',
							'menu_class'     => 'secondary-menu',
						 )); ?>
				</nav><!-- .nav.secondary-navigation -->
			<?php endif; ?>
	<?php endif; ?>
	<a href="#" class="logoOverlay"></a>
	<a href="#" class="textOverlay"><span class="content">CONTENT</span><span class="thicker">HUB</span></a>
</div><!-- .Secondary Navigation -->
<div class="overlay-login contentscale-login">
	<div class="blk-social-logins">
    <?php /*echo do_shortcode("[wpoa_login_form design='CustomDesign1']"); */?>
		<div class="sign-facebook"><a href="<?php echo htmlspecialchars($loginUrl); ?>"><figure><img src="<?php echo esc_url( $img_facebook ); ?>" alt="Logo Facebook"></figure><span>Sign in with <b>Facebook</b></span></a></div>
		<div class="sign-twitter"><a href="#"><figure><img src="<?php echo esc_url( $img_twitter ); ?>" alt="Logo Twitter"></figure><span>Sign in with <b>Twitter</b></span></a></div>
		<div class="sign-google"><a href="#"><figure><img src="<?php echo esc_url( $img_google ); ?>" alt="Logo Google+"></figure><span>Sign in with <b>Google+</b></span></a></div>
		<div class="sign-linkedin"><a href="#"><figure><img src="<?php echo esc_url( $img_likedin ); ?>" alt="Logo Linkedin"></figure><span>Sign in with <b>Linkedin</b></span></a></div>
	</div>
</div><!-- .Login -->
<div class="overlay-search contentscale-search">
	<div class="blk-search">
    <figure class="logo_hub"><img src="<?php echo esc_url( $img_logo_hub ); ?>" alt="Logo ContentHub"></figure>
    <a href="javascript:void(0);" class="close-search">X</a>
    <?php get_search_form(); ?>
    <div class="content-categories_searchresults">
      <aside class="side-categories">
        <h4>Categories</h4>
        <ul>
          <?php $categories = get_categories( array(
              'orderby' => 'name',
              'order'   => 'ASC'
          ));
          foreach( $categories as $category ) {
            $category_link = sprintf(
                '<a href="%1$s" title="%2$s">%3$s</a>',
                esc_url( get_category_link( $category->term_id ) ),
                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                esc_html( $category->name )
            );

            echo '<li>' . sprintf( esc_html__( '%s', 'textdomain' ), $category_link ) . '</li> ';} ?>
        </ul>
      </aside>
      <section class="content-search">
        <div id="content-search_results">
          <div id="loader" class="la-ball-spin-rotate la-2x">
            <div></div>
            <div></div>
          </div>
        </div>
      </section>
    </div>
	</div>
</div><!-- .Search -->

<?php wp_footer(); ?>
</body>
</html>
