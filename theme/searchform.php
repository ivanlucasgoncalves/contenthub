<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 */
?>
<script type="text/javascript">
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>

<div class="content-form_search">
	<form role="search" method="post" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'What are you looking for?', 'placeholder', 'twentysixteen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s" />
		<!--<input type="submit" class="search-submit" value="submit"/>-->
	</form>
</div>
