<?php
/**
 * This template is used to display the home page.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

get_header(); ?>

<?php if ( '' != get_theme_mod( 'category_slideshow_home', '0' ) ) { ?>

<!-- BEGIN .row -->
<div class="row">

	<!-- BEGIN .home-slider -->
	<div class="home-slider shadow">

		<?php get_template_part( 'content/slider', 'featured' ); ?>

	<!-- END .home-slider -->
	</div>

<!-- END .row -->
</div>

<?php } ?>

<!-- BEGIN .homepage -->
<div class="homepage">

<?php if ( '0' != get_theme_mod( 'natural_lite_page_left', '0' ) && '0' != get_theme_mod( 'natural_lite_page_mid', '0' ) && '0' != get_theme_mod( 'natural_lite_page_right', '0' ) ) { ?>

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .featured-pages -->
		<div class="featured-pages radius-full">

			<div class="holder third first">
				<?php $recent = new WP_Query( 'page_id='.get_theme_mod( 'natural_lite_page_left', '0' ) );
				while ( $recent->have_posts() ) : $recent->the_post(); ?>
									<?php get_template_part( 'content/home', 'page' ); ?>
								<?php endwhile;
				wp_reset_postdata(); ?>
			</div>

			<div class="holder third">
				<?php $recent = new WP_Query( 'page_id='.get_theme_mod( 'natural_lite_page_mid', '0' ) );
				while ( $recent->have_posts() ) : $recent->the_post(); ?>
									<?php get_template_part( 'content/home', 'page' ); ?>
								<?php endwhile;
				wp_reset_postdata(); ?>
			</div>

			<div class="holder third last">
				<?php $recent = new WP_Query( 'page_id='.get_theme_mod( 'natural_lite_page_right', '0' ) );
				while ( $recent->have_posts() ) : $recent->the_post(); ?>
									<?php get_template_part( 'content/home', 'page' ); ?>
								<?php endwhile;
				wp_reset_postdata(); ?>
			</div>

		<!-- END .featured-pages -->
		</div>

	<!-- END .row -->
	</div>

<?php } ?>

<?php if ( '0' != get_theme_mod( 'natural_lite_category_news', '0' ) ) { ?>

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .featured-posts -->
		<div class="featured-posts">

			<!-- BEGIN .home-news -->
			<div class="home-news radius-full shadow">

				<?php get_template_part( 'content/home', 'post' ); ?>

			<!-- END .home-news -->
			</div>

		<!-- END .featured-posts -->
		</div>

	<!-- END .row -->
	</div>

<?php } ?>

<?php if ( '0' == get_theme_mod( 'natural_lite_page_left', '0' ) && '0' == get_theme_mod( 'natural_lite_page_mid', '0' ) && '0' == get_theme_mod( 'natural_lite_page_right', '0' ) && '0' == get_theme_mod( 'natural_lite_category_news', '0' ) ) { ?>

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .postarea -->
		<div class="postarea full">

			<?php get_template_part( 'content/content', 'none' ); ?>

		<!-- END .postarea -->
		</div>

	<!-- END .row -->
	</div>

<?php } ?>

<!-- END .homepage -->
</div>

<?php get_footer(); ?>
