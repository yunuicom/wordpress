<?php
/**
 * This template displays single post content.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<!-- BEGIN .row -->
	<div class="row">

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

			<!-- BEGIN .eleven columns -->
			<div class="eleven columns">

				<!-- BEGIN .postarea -->
				<div class="postarea">

					<?php get_template_part( 'loop', 'post' ); ?>

				<!-- END .postarea -->
				</div>

			<!-- END .eleven columns -->
			</div>

			<!-- BEGIN .five columns -->
			<div class="five columns">

				<?php get_sidebar( 'post' ); ?>

			<!-- END .five columns -->
			</div>

		<?php else : ?>

			<!-- BEGIN .sixteen columns -->
			<div class="sixteen columns">

				<!-- BEGIN .postarea full -->
				<div class="postarea full">

					<?php get_template_part( 'loop', 'post' ); ?>

				<!-- END .postarea full -->
				</div>

			<!-- END .sixteen columns -->
			</div>

		<?php endif; ?>

	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>
