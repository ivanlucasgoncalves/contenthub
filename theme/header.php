<?php
/**
 * The template for displaying the header
 * Displays all of the head element and everything up until the "site-content" div.
 */
 $img_logo = get_theme_mod( 'img_logo', esc_url( get_template_directory_uri() . '/img/logo.png' ) ); // Logo
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
  <div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '1219998328070399',
        xfbml      : true,
        version    : 'v2.8'
      });
    };
    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>
</head>
<body <?php body_class(); ?>>

<header id="masthead">
	<div class="site-header-main">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $img_logo ); ?>" alt="Logo ContentHub"></a>
		</div><!-- .site-branding -->
    <div class="blk-menu-search">
  		<?php if ( has_nav_menu( 'primary' ) ) : ?>
  				<?php if ( has_nav_menu( 'primary' ) ) : ?>
  					<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
  						<?php
  							wp_nav_menu( array(
  								'theme_location' => 'primary',
  								'menu_class'     => 'primary-menu',
  							 )); ?>
  					</nav><!-- .main-navigation -->
  				<?php endif; ?>
  		<?php endif; ?>
      <div class="search">
  			<div class="searchIcon"></div>
  		</div>
      <div class="user">
  			<div class="userIcon">Log In</div>
  		</div>
      <button id="showRightPush" class="tcon tcon-menu--xcross hidden-desktop" aria-label="toggle menu">
        <span class="tcon-menu__lines" aria-hidden="true"></span>
        <span class="tcon-visuallyhidden">Show Menu</span>
      </button>
    </div>
	</div><!-- .site-header-main -->
</header><!-- .site-header -->
