<?php
/**
 * This file adds the Home Page to the Form and Function theme.
 */

add_action( 'genesis_meta', 'author_front_page_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */

add_action( 'genesis_before_content_sidebar_wrap', 'faf_home_add_hero' );
function faf_home_add_hero() {
	echo '<div id="home-hero">
			<div id="home-hero-image"><img src="'. get_home_url() .'/wp-content/uploads/2016/03/home1-Chartreuse-Traditional-Industrial-Dining-Room.jpg" alt="Chartreuse Traditional Dining Room" /></div>

			<div class="dark-box-group" id="hero-dark-box-group"><p>Real&nbsp;people live&nbsp;here.</p><h1>Interior Design and Unique Home Furnishings for the Greater&nbsp;Raleigh&nbsp;Area</h1><a href="'. get_home_url() .'/interior-design" class="button">Interior Design Services</a><a href="'. get_home_url() .'/home-decor" class="button button-light">The Shop</a></div></div>';
}

add_action( 'genesis_entry_footer', 'faf_home_add_cta_imgs' );
function faf_home_add_cta_imgs() {
	echo '<div id="home-cta-imgs">
			<div class="home-cta-img">
				<img src="'. get_home_url() .'/wp-content/uploads/2016/03/home2-Rustic-Industrial-Kitchen.jpg" alt="Rustic-Industrial Kitchen Design" />
			<div class="dark-box-group">
				<div class="dark-box-content-wrap">
					<p>Custom Diy</p>
					<a href="'. get_home_url() .'/interior-design#services-diy" class="button">Learn More</a>
				</div>
			</div>
			</div>
			<div class="home-cta-img">
				<img src="'. get_home_url() .'/wp-content/uploads/2016/03/home3-Living-Room-Coffee-Table.jpg" alt="Living Room Design Raleigh NC" />
			<div class="dark-box-group">
				<div class="dark-box-content-wrap">
					<p>Redesign</p>
					<a href="'. get_home_url() .'/interior-design#services-redesign" class="button">Learn More</a>
				</div>
			</div>
			</div>
			<div class="home-cta-img">
				<img src="'. get_home_url() .'/wp-content/uploads/2016/03/home4-master-bedroom-statement-wall-grasscloth-wallpaper-linen-drum-shade-pendant.jpg" alt="Master Bedroom Design with Grasscloth Wallpaper" />
			<div class="dark-box-group">
				<div class="dark-box-content-wrap">
					<p>The Works</p>
					<a href="'. get_home_url() .'/interior-design#services-works" class="button">Learn More</a>
				</div>
			</div>
			</div>
		</div>';
}

/* add the press image widget area */
add_action( 'genesis_after_content', 'faf_home_add_press_sb' );
function faf_home_add_press_sb() {
	genesis_widget_area ('presswidget', array(
        'before' => '<div class="presswidget"><div class="wrap-images">',
        'after' => '</div></div>',
	) );
}


// This stuff all came with the theme. The front page breaks without it //
function author_front_page_genesis_meta() {

	if ( is_active_sidebar( 'front-page-1' ) || is_active_sidebar( 'front-page-2' ) || is_active_sidebar( 'front-page-3' ) || is_active_sidebar( 'front-page-4' ) || is_active_sidebar( 'front-page-5' ) ) {

		//* Add front-page body class
		add_filter( 'body_class', 'author_body_class' );
		function author_body_class( $classes ) {

   			$classes[] = 'front-page';
  			return $classes;

		}

		//* Force full width content layout
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add front page 1 widget
		add_action( 'genesis_after_header', 'author_front_page_1_widget', 5 );

		//* Add the rest of front page widgets
		add_action( 'genesis_loop', 'author_front_page_widgets' );

	}

}

//* Add markup for front page widgets
function author_front_page_1_widget() {

	genesis_widget_area( 'front-page-1', array(
		'before' => '<div class="featured-widget-area"><div class="wrap"><div id="front-page-1" class="front-page-1"><div class="flexible-widgets widget-area' . author_widget_area_class( 'front-page-1' ) . '">',
		'after'  => '</div></div></div></div>',
	) );

}

function author_front_page_widgets() {

	genesis_widget_area( 'front-page-2', array(
		'before' => '<div id="front-page-2" class="front-page-2"><div class="flexible-widgets widget-area' . author_widget_area_class( 'front-page-2' ) . '">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'front-page-3', array(
		'before' => '<div id="front-page-3" class="front-page-3"><div class="flexible-widgets widget-area' . author_widget_area_class( 'front-page-3' ) . '">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'front-page-4', array(
		'before' => '<div id="front-page-4" class="front-page-4"><div class="flexible-widgets widget-area' . author_widget_area_class( 'front-page-4' ) . '">',
		'after'  => '</div></div>',
	) );

	genesis_widget_area( 'front-page-5', array(
		'before' => '<div id="front-page-5" class="front-page-5"><div class="flexible-widgets widget-area' . author_widget_area_class( 'front-page-5' ) . '">',
		'after'  => '</div></div>',
	) );

}

genesis();
