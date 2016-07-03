<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<header>
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
				<h1><?php the_title(); ?></h1>
				<div id="excerpt"><?php the_excerpt(); ?></div>
			</div>
		</div>
	</div>
</header>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
			<section>
				<p class="time"><span><?php the_time('Y年m月d日'); ?></span><?php the_category(' '); ?></p>
				<?php the_content(); ?>
			</section>
			<div id="comment">
				<?php comments_template(); ?>
			</div>
		</div>
	</div>
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>