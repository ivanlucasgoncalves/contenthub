<?php
/**
 * The template for the sidebar containing the main widget area
 *
 */
?>

<?php if ( is_active_sidebar( 'sidebar-4' )  ) : ?>
		<?php dynamic_sidebar( 'sidebar-4' ); ?><!-- .sidebar .widget-area -->
<?php endif; ?>
