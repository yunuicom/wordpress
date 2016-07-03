<?php get_header(); ?>
<header>
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
				<h1><?php bloginfo('name'); ?></h1>
				<div id="excerpt"><?php bloginfo('description'); ?></div>
			</div>
		</div>
	</div>
</header>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="time"><span><?php the_time('Y年m月d日'); ?></span><?php the_category(' '); ?></p>
				<?php the_content(); ?>
			</section>
			<?php endwhile; endif; ?>
			<ul id="pagenav" class="pagination">
				<?php par_pagenavi(9); ?>
			</ul>
		</div>
	</div>
</div>
<?php get_footer(); ?>