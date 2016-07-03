<?php
/**
 * This template controls the style options.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

get_header(); ?>

<style type="text/css" media="screen">

	<?php $header_text_color = get_header_textcolor(); ?>

	.container .site-title a {
		color: #<?php echo esc_html( $header_text_color ); ?> ;
	}

	<?php if ( 'center' == get_theme_mod( 'title_align', 'center' ) ) { ?>
	.site-logo, .site-title, #navigation {
		text-align: center;
	}
	<?php } ?>

	<?php if ( 'center' == get_theme_mod( 'title_align', 'center' ) ) { ?>
	.natural-header-active .container .site-logo,
	.natural-header-active .container .site-title {
		left: 50%;
		-webkit-transform: translateX(-50%) translateY(-50%);
		-ms-transform: translateX(-50%) translateY(-50%);
		transform: translateX(-50%) translateY(-50%);
	}
	<?php } ?>

	<?php if ( 'right' == get_theme_mod( 'title_align', 'center' ) ) { ?>
	.site-logo, .site-title, #navigation {
		right: 0;
		text-align: right;
	}
	<?php } ?>

	<?php if ( 'right' == get_theme_mod( 'title_align', 'center' ) ) { ?>
	.natural-header-active .container .site-logo,
	.natural-header-active .container .site-title {
		right: 48px;
	}
	<?php } ?>

	<?php if ( 'left' == get_theme_mod( 'title_align', 'center' ) ) { ?>
	.site-logo, .site-title, #navigation {
		left: 0;
		text-align: left;
	}
	<?php } ?>

	<?php if ( 'left' == get_theme_mod( 'title_align', 'center' ) ) { ?>
	.natural-header-active .container .site-logo,
	.natural-header-active .container .site-title {
		left: 48px;
	}
	<?php } ?>

</style>
