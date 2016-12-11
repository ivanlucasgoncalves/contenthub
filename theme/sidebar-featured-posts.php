<?php
/**
 * The template for the sidebar containing the main widget area
 *
 */
?>

<?php if ( is_active_sidebar( 'sidebar-3' )  ) : ?>
		<?php dynamic_sidebar( 'sidebar-3' ); ?><!-- .sidebar .widget-area -->
<?php endif; ?>
