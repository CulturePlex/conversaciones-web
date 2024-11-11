<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
?><!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action( 'thim_before_body' ); ?>

<div id="wrapper-container" <?php thim_wrapper_container_class(); ?>>

	<?php if ( ! is_page_template( 'templates/comingsoon.php' ) ) : ?>

	<?php do_action( 'thim_topbar' ) ?>

	<header id="masthead" class="site-header affix-top<?php thim_header_layout_class(); ?> <?php echo get_theme_mod('size_header','default'); ?>">
		<?php get_template_part( 'templates/header/' . get_theme_mod( 'header_style', 'header_v2' ) ); ?>
	</header><!-- #masthead -->

	<nav class="visible-xs mobile-menu-container mobile-effect" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<?php get_template_part( 'templates/header/mobile-menu' ); ?>
	</nav><!-- nav.mobile-menu-container -->

	<?php endif; ?>
    <?php
        $custom_class_main_content = get_theme_mod('main-content_custom_class');
    ?>
	<div id="main-content" <?php if($custom_class_main_content ): ?> class="<?php echo esc_html($custom_class_main_content) ?>" <?php endif; ?> >


