<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
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
	</footer><!-- .site-footer -->
</div><!-- .site-content -->
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

<?php wp_footer(); ?>
</body>
</html>
