<?php
/**
*** The template part for socials urls **/

$img_logo_facebook = get_theme_mod( 'img_logo_facebook', esc_url( get_template_directory_uri() . '/img/svg/lnk-facebook.svg' ) ); // Logo Facebook
$img_logo_twitter = get_theme_mod( 'img_logo_twitter', esc_url( get_template_directory_uri() . '/img/svg/lnk-twitter.svg' ) ); // Logo Twitter
$img_logo_linkedin = get_theme_mod( '$img_logo_linkedin', esc_url( get_template_directory_uri() . '/img/svg/lnk-linkedin.svg' ) ); // Logo Linkedin
$img_logo_facebook_black = get_theme_mod( 'img_logo_facebook_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-facebook-black.svg' ) ); // Logo Facebook Black
$img_logo_twitter_black = get_theme_mod( 'img_logo_twitter_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-twitter-black.svg' ) ); // Logo Twiiter Black
$img_logo_linkedin_black = get_theme_mod( 'img_logo_linkedin_black', esc_url( get_template_directory_uri() . '/img/svg/lnk-linkedin-black.svg' ) ); // Logo Linkedin Black ?>

<?php	// Social urls
	$urlencoded_siteurl = get_site_url();
	$urlencoded_pageurl = urlencode(get_permalink());
	$urlencoded_title = urlencode(get_the_title());
	$urlencoded_title_and_site = get_the_title().' | '.get_bloginfo( 'name', 'display' );
	$urlencoded_title_and_site = urlencode(html_entity_decode($urlencoded_title_and_site));
	$urlencoded_excerpt = urlencode(html_entity_decode(get_the_excerpt()));
	if (strlen($urlencoded_excerpt) > 252) {
		$urlencoded_excerpt = substr($urlencoded_excerpt, 0, 252).'...';
	}
	$hash_tag = get_field('twitter_hashtag');
	if (!$hash_tag) { // Hashtags Twitter
		$post_tags = get_the_tags();
		$hash_tag = isset($post_tags) && isset($post_tags[0]) ? $post_tags[0]->slug : '';
	}
	$hash_tag = urlencode(str_replace(' ', '', $hash_tag));
	// Link Share Twitter
	$facebook_link_atts = '
		rel="nofollow"
		target="_blank"
		class="facebook"
		title="Share article on Facebook"
		href="https://www.facebook.com/dialog/share?app_id=1219998328070399&amp;display=page&amp;href='.$urlencoded_pageurl.'&amp;redirect_uri=https%3A%2F%2Ffacebook.com"
	';
	$twitter_link_atts = '
		rel="nofollow"
		target="_blank"
		class="twitter"
		title="Share article'. ($hash_tag ? ' and #'.$hash_tag : '').' on Twitter"
		href="https://twitter.com/share?url='.$urlencoded_pageurl
				.'&via=ContentHub&related=ContentHub'
				.($hash_tag ? '&hashtags='.$hash_tag : '')
				.'&text='.$urlencoded_title.'"
	';
	$linkedin_link_atts = '
		rel="nofollow"
		target="_blank"
		class="linkedin"
		title="Share article on LinkedIn"
		href="https://www.linkedin.com/shareArticle?mini=true&url='.$urlencoded_pageurl
				.'&title='.substr($urlencoded_title_and_site, 0, 200)
				.'&summary='.$urlencoded_excerpt
				.'&source='.$urlencoded_siteurl.'"
	';
