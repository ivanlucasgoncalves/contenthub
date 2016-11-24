<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 */
?>
<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
echo $term->name; // will show the name
echo $term->slug; // will show the slug
?>
