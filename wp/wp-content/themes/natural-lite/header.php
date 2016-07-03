<?php
/**
 * The Header for our theme.
 * Displays all of the <head> section and everything up till <div id="wrap">
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<?php get_template_part( 'style', 'options' ); ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php echo esc_url( bloginfo( 'pingback_url' ) ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- BEGIN #wrap -->
<div id="wrap">

	<!-- BEGIN .container -->
	<div class="container">

		<!-- BEGIN #header -->
		<div id="header" class="radius-full">

			<!-- BEGIN .row -->
			<div class="row">

				<?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) { ?>

					<div id="custom-header" class="radius-top">

						<div class="header-img background-cover" <?php if ( ! empty( $header_image ) ) { ?> style="background-image: url(<?php header_image(); ?>);"<?php } ?>>

							<?php natural_lite_custom_logo(); ?>

							<div class="hide-img"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo esc_attr( get_bloginfo() ); ?>" /></div>

						</div>

					</div>

				<?php } else { ?>

					<div id="custom-header">

						<?php natural_lite_custom_logo(); ?>

					</div>

				<?php } ?>

			<!-- END .row -->
			</div>

			<!-- BEGIN .row -->
			<div class="row">

				<!-- BEGIN #navigation -->
				<nav id="navigation" class="navigation-main <?php if ( ! empty( $header_image ) ) { ?>radius-bottom<?php } else { ?>radius-full<?php } ?>" role="navigation">

					<h1 class="menu-toggle"><?php esc_html_e( 'Menu', 'natural-lite' ); ?></h1>

					<?php if ( has_nav_menu( 'header-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'header-menu',
							'title_li' => '',
							'depth' => 4,
							'container_class' => '',
							'menu_class'      => 'menu',
							)
						);
					} else { ?>
						<ul class="menu"><?php wp_list_pages( 'title_li=&depth=4' ); ?></ul>
					<?php } ?>

				<!-- END #navigation -->
				</nav>

			<!-- END .row -->
			</div>

		<!-- END #header -->
		</div>
