<?php
//* Reposition Breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_content', 'genesis_do_breadcrumbs' );
//* Remove the entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_content', 'sk_show_featured_image_single_item_pages', 9 );
/**
 * Display Featured Image floated to the right in single Posts.
 *
 * @author Sridhar Katakam
 * @link   http://sridharkatakam.com/how-to-display-featured-image-in-single-posts-in-genesis/
 */
function sk_show_featured_image_single_item_pages() {
	$image_args = array(
		'size' => 'medium',
		'attr' => array(
			'class' => 'alignleft',
		),
	);
	genesis_image( $image_args );
}
add_action( 'genesis_before_sidebar_widget_area', 'sk_display_custom_fields' );
/**
 * One line description with a period at the end.
 *
 * @author Sridhar Katakam
 * @link   http://sridharkatakam.com/
 */
add_action( 'genesis_entry_content', 'sk_add_buy_button' );
function sk_add_buy_button() {
	if ( get_field( 'item_number' ) ) {
		echo '<a href="' . get_field( 'item_number' ) . '" class="button">Get Directions</a>';
	}
}
//* Previous and Next Post navigation
add_action('genesis_after_content_sidebar_wrap', 'sk_custom_post_nav');
function sk_custom_post_nav() {
	echo '<div class="prev-next-post-links">';
		previous_post_link('<div class="previous-post-link">&laquo; %link</div>', '<strong>%title</strong>' );
		next_post_link('<div class="next-post-link">%link &raquo;</div>', '<strong>%title</strong>' );
	echo '</div>';
}
add_action( 'genesis_after_header', 'sk_change_genesis_primary_sidebar' );
/**
 * Show custom Primary sidebar in Primary Sidebar location.
 *
 * @author Sridhar Katakam
 * @link   http://sridharkatakam.com/
 */
function sk_change_genesis_primary_sidebar() {
	if( is_active_sidebar( 'primary-sidebar-item' ) ) {
		// Remove the Primary Sidebar from the Primary Sidebar area.
		remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
		add_action( 'genesis_sidebar', 'sk_do_sidebar' );
	}
}
function sk_do_sidebar() {
	dynamic_sidebar( 'primary-sidebar-item' );
}
//* To remove empty markup, '<p class="entry-meta"></p>' for entries that have not been assigned to any Genre
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
add_action( 'genesis_entry_footer', 'sk_custom_post_meta' );
genesis();