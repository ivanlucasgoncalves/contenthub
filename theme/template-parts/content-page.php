<?php
/**
** The template used for displaying page content **/ ?>

<section class="internal-pages">
	<div id="content">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php twentysixteen_excerpt(); ?>
			<div class="entry-content">
				<?php // Content
				the_content();	?>

				<?php // Getting tags related in each single post
					$posttags = get_the_tags();
					if ($posttags) {
					  foreach ($posttags as $tag) {
					     $tagnames[count($tagnames)] = $tag->name;
					  }
					  $comma_separated_tagnames = implode(" #", $tagnames);
					  print_r("<p class='p-tags'>#$comma_separated_tagnames</p>");
					}
				?>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	</div>
</section>
