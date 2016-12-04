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


 $img_facebook = get_theme_mod( 'img_facebook', esc_url( get_template_directory_uri() . '/img/svg/facebookWhite.svg' ) ); // Logo Facebook
 $img_twitter = get_theme_mod( 'img_twitter', esc_url( get_template_directory_uri() . '/img/svg/twitterWhite.svg' ) ); // Logo Twitter
 $img_google = get_theme_mod( 'img_google', esc_url( get_template_directory_uri() . '/img/svg/googleWhite.svg' ) ); // Logo Google+
 $img_likedin = get_theme_mod( 'img_likedin', esc_url( get_template_directory_uri() . '/img/svg/linkedinWhite.svg' ) ); // Logo Linkedin
?>

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
  		<a class="comment">
  		<span>COMMENT</span>
  	</a>
  	<div class="share">
  		<span>SHARE</span>
  	</div>
  	</div>
  </div>
<?php endif; ?>
<div class="overlay overlay-contentscale">
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

<?php wp_footer(); ?>
</body>
</html>
