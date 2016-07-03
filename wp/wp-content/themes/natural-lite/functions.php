<?php

/*
-----------------------------------------------------------------------------------------------------
Theme Setup
-----------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'natural_lite_setup' ) ) :

	function natural_lite_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'natural-lite' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add title tag.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails.
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'natural-lite-featured-large', 2400, 1800, true ); // Large Featured Image.
		add_image_size( 'natural-lite-featured-medium', 1800, 1200, true ); // Medium Featured Image.
		add_image_size( 'natural-lite-featured-small', 640, 640 ); // Small Featured Image.

		// Create Menus.
		register_nav_menus( array(
			'header-menu' => esc_html__( 'Header Menu', 'natural-lite' ),
			'social-menu' => esc_html__( 'Social Menu', 'natural-lite' ),
		));

		/*
		* Enable support for custom logo.
		*/
		add_theme_support( 'custom-logo', array(
			'height'      => 180,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title' ),
		) );

		// Custom Header.
		register_default_headers( array(
			'default' => array(
			'url'   => get_template_directory_uri() . '/images/default-header.jpg',
			'thumbnail_url' => get_template_directory_uri() . '/images/default-header.jpg',
			'description'   => esc_html__( 'Default Custom Header', 'natural-lite' ),
			),
		));
		$defaults = array(
			'width'                 => 1600,
			'height'                => 480,
			'default-image'			=> get_template_directory_uri() . '/images/default-header.jpg',
			'flex-height'           => true,
			'flex-width'            => true,
			'default-text-color'    => 'ffffff',
			'header-text'           => true,
			'uploads'               => true,
		);
		add_theme_support( 'custom-header', $defaults );

		// Custom Background.
		$defaults = array(
		'default-color'			=> '827768',
		'default-image'         => get_template_directory_uri() . '/images/default-pattern.png',
		'wp-head-callback'      => '_custom_background_cb',
		'admin-head-callback'   => '',
		'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-background', $defaults );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

	}

endif; // End natural_lite_setup.
add_action( 'after_setup_theme', 'natural_lite_setup' );

/*
-----------------------------------------------------------------------------------------------------
Admin Notice
-----------------------------------------------------------------------------------------------------
*/

/** Function natural_lite_admin_notice */
function natural_lite_admin_notice() {
	global $current_user ;
	$user_id = $current_user->ID;
	if ( ! get_user_meta( $user_id, 'natural_lite_ignore_notice' ) ) {
		echo '<div class="notice updated is-dismissible"><p>';
		printf( __( 'Enjoying Natural Lite? <a href="%1$s" target="_blank">Upgrade to the premium Natural Theme</a> for more options, page templates, shortcodes, support and additional features. <a class="notice-dismiss" type="button" href="%2$s"><span class="screen-reader-text">Hide Notice</span></a>', 'natural-lite' ), 'http://organicthemes.com/theme/natural-theme/', '?natural_lite_nag_ignore=0' );
		echo '</p></div>';
	}
}
add_action( 'admin_notices', 'natural_lite_admin_notice' );

/** Function natural_lite_nag_ignore */
function natural_lite_nag_ignore() {
	global $current_user;
	$user_id = $current_user->ID;
	if ( isset( $_GET['natural_lite_nag_ignore'] ) && '0' == $_GET['natural_lite_nag_ignore'] ) {
		 add_user_meta( $user_id, 'natural_lite_ignore_notice', 'true', true );
	}
}
add_action( 'admin_init', 'natural_lite_nag_ignore' );

/*
-------------------------------------------------------------------------------------------------------
	Custom Logo
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'natural_lite_custom_logo' ) ) {

	function natural_lite_custom_logo() {

		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			if ( is_front_page() && is_home() ) {
				?>
					<h1 class="site-logo"><?php the_custom_logo(); ?></h1>
				<?php
			} else {
				?>
					<p class="site-logo"><?php the_custom_logo(); ?></p>
				<?php
			}
		} else {
			if ( is_front_page() && is_home() ) {
				?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></a>
					</h1>
				<?php
			} else {
				?>
					<p class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></a>
					</p>
				<?php
			}
		}
	}
}

/*
-------------------------------------------------------------------------------------------------------
Add Stylesheet To Visual Editor
-------------------------------------------------------------------------------------------------------
*/

add_action( 'widgets_init', 'natural_lite_add_editor_styles' );
/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function natural_lite_add_editor_styles() {
	add_editor_style( 'css/style-editor.css' );
}

/*
-------------------------------------------------------------------------------------------------------
Category ID to Name
-------------------------------------------------------------------------------------------------------
*/

function natural_lite_cat_id_to_name( $id ) {
	$term = get_term( $id, 'category' );
	if ( is_wp_error( $term ) ) {
		return false; }
	return $name = $term->name;
}

/*
------------------------------------------------------------------------------------------------------
Pagination Fix For Home Page Query
------------------------------------------------------------------------------------------------------
*/

function natural_lite_home_post_count_queries( $news ) {
	if ( ! is_admin() && $news->is_main_query() ) {
		if ( is_home() ) {
			$news->set( 'posts_per_page', 1 );
		}
	}
}
add_action( 'pre_get_posts', 'natural_lite_home_post_count_queries' );

/*
-------------------------------------------------------------------------------------------------------
Register Scripts
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'natural_lite_enqueue_scripts' ) ) {

	function natural_lite_enqueue_scripts() {

		// Enqueue Styles.
		wp_enqueue_style( 'natural-style', get_stylesheet_uri() );
		wp_enqueue_style( 'natural-style-mobile', get_template_directory_uri() . '/css/style-mobile.css', array( 'natural-style' ), '1.0' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( 'natural-style' ), '1.0' );

		// Resgister Scripts.
		wp_register_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'hover', get_template_directory_uri() . '/js/hoverIntent.js', array( 'jquery' ), '20130729' );
		wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery', 'hover' ), '20130729' );

		// Enqueue Scripts.
		wp_enqueue_script( 'natural-custom', get_template_directory_uri() . '/js/jquery.custom.js', array( 'jquery', 'superfish', 'fitvids' ), '20130729', true );
		wp_enqueue_script( 'natural-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20130729', true );

		// Load Flexslider on front page and slideshow page template.
		if ( is_home() ) {
			wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), '20130729' );
		}

		// Load single scripts only on single pages.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'natural_lite_enqueue_scripts' );
}

/*
-------------------------------------------------------------------------------------------------------
Register Sidebars
-------------------------------------------------------------------------------------------------------
*/

function natural_lite_widgets_init() {
	register_sidebar(array(
		'name' => esc_html__( 'Default Sidebar', 'natural-lite' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));
	register_sidebar(array(
		'name' => esc_html__( 'Left Sidebar', 'natural-lite' ),
		'id' => 'left-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));
	register_sidebar(array(
		'name' => esc_html__( 'Footer Widgets', 'natural-lite' ),
		'id' => 'footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer-widget">',
		'after_widget' => '</div></div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	));
}
add_action( 'widgets_init', 'natural_lite_widgets_init' );

/*
------------------------------------------------------------------------------------------------------
Content Width
------------------------------------------------------------------------------------------------------
*/

if ( ! isset( $content_width ) ) {
	$content_width = 640; }

/**
 * Adjust content_width value based on the presence of widgets
 */
function natural_lite_content_width() {
	if ( ! is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'natural_lite_content_width' );

/*
-------------------------------------------------------------------------------------------------------
Comments Function
-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'natural_lite_comment' ) ) :
	function natural_lite_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'natural-lite' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'natural-lite' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
		break;
			default :
		?>
		<li <?php comment_class(); ?> id="<?php echo esc_attr( 'li-comment-' . get_comment_ID() ); ?>">

		<article id="<?php echo esc_attr( 'comment-' . get_comment_ID() ); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 72;
					if ( '0' != $comment->comment_parent ) {
						$avatar_size = 48; }

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <br/> %2$s <br/>', 'natural-lite' ),
							sprintf( '<span class="fn">%s</span>', wp_kses_post( get_comment_author_link() ) ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( esc_html__( '%1$s', 'natural-lite' ), get_comment_date(), get_comment_time() )
							)
						);
						?>
					</div><!-- .comment-author .vcard -->
				</footer>

				<div class="comment-content">
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'natural-lite' ); ?></em>
					<br />
				<?php endif; ?>
					<?php comment_text(); ?>
					<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'natural-lite' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
					<?php edit_comment_link( esc_html__( 'Edit', 'natural-lite' ), '<span class="edit-link">', '</span>' ); ?>
				</div>

			</article><!-- #comment-## -->

		<?php
		break;
		endswitch;
	}
endif; // Ends check for natural_lite_comment().

/*
-------------------------------------------------------------------------------------------------------
Custom Excerpt Length
-------------------------------------------------------------------------------------------------------
*/

function natural_lite_excerpt_length( $length ) {
	return 44;
}
add_filter( 'excerpt_length', 'natural_lite_excerpt_length', 999 );

function natural_lite_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'natural_lite_excerpt_more' );

/*
-------------------------------------------------------------------------------------------------------
Custom Excerpt
-------------------------------------------------------------------------------------------------------
*/

function natural_lite_excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( ' ',$excerpt ).'...';
	} else {
		$excerpt = implode( ' ',$excerpt );
	}
	$excerpt = preg_replace( '`[[^]]*]`','',$excerpt );
	return $excerpt;
}

function natural_lite_content( $limit ) {
	$content = explode( ' ', get_the_content(), $limit );
	if ( count( $content ) >= $limit ) {
		array_pop( $content );
		$content = implode( ' ',$content ).'...';
	} else {
		$content = implode( ' ',$content );
	}
	$content = preg_replace( '/[.+]/','', $content );
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	return $content;
}

/*
-------------------------------------------------------------------------------------------------------
Pagination Function
-------------------------------------------------------------------------------------------------------
*/

function natural_lite_get_pagination_links() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'prev_text' => esc_html__( '&laquo;', 'natural-lite' ),
		'next_text' => esc_html__( '&raquo;', 'natural-lite' ),
		'total' => $wp_query->max_num_pages,
	) );
}

/*
-------------------------------------------------------------------------------------------------------
Custom Page Links
-------------------------------------------------------------------------------------------------------
*/

function natural_lite_wp_link_pages_args_prevnext_add( $args ) {
	global $page, $numpages, $more, $pagenow;

	if ( ! $args['next_or_number'] == 'next_and_number' ) {
		return $args; }

	$args['next_or_number'] = 'number'; // Keep numbering for the main part.
	if ( ! $more ) {
		return $args; }

	if ( $page -1 ) { // There is a previous page.
		$args['before'] .= _wp_link_page( $page -1 )
			. $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'; }

	if ( $page < $numpages ) { // There is a next page.
		$args['after'] = _wp_link_page( $page + 1 )
			. $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
			. $args['after']; }

	return $args;
}

add_filter( 'wp_link_pages_args', 'natural_lite_wp_link_pages_args_prevnext_add' );

/*
-------------------------------------------------------------------------------------------------------
Body Class
-------------------------------------------------------------------------------------------------------
*/

function natural_lite_body_class( $classes ) {

	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
		$classes[] = 'natural-header-active'; }

	if ( empty( $header_image ) ) {
		$classes[] = 'natural-header-inactive'; }

	if ( is_singular() ) {
		$classes[] = 'natural-singular'; }

	if ( is_active_sidebar( 'right-sidebar' ) ) {
		$classes[] = 'natural-right-sidebar'; }

	if ( '' != get_theme_mod( 'background_image' ) ) {
		// This class will render when a background image is set
		// regardless of whether the user has set a color as well.
		$classes[] = 'natural-background-image';
	} else if ( ! in_array( get_background_color(), array( '', get_theme_support( 'custom-background', 'default-color' ) ) ) ) {
		// This class will render when a background color is set
		// but no image is set. In the case the content text will
		// Adjust relative to the background color.
		$classes[] = 'natural-relative-text';
	}

	return $classes;
}
add_action( 'body_class', 'natural_lite_body_class' );

/*
-------------------------------------------------------------------------------------------------------
First Featured Video
-------------------------------------------------------------------------------------------------------
*/

function natural_lite_first_embed_media() {
	global $post, $posts;
	$first_vid = '';
	$content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
	$embeds = get_media_embedded_in_content( $content );

	if ( ! empty( $embeds ) ) {
		foreach ( $embeds as $embed ) {
			if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) ) {
				return $embed;
			}
		}
	} else {
		return false;
	}
}

/*
-----------------------------------------------------------------------------------------------------//
Includes
-------------------------------------------------------------------------------------------------------
*/

require_once( get_template_directory() . '/includes/customizer.php' );
require_once( get_template_directory() . '/includes/typefaces.php' );
