<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'author', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'author' ) );

//* Add Color Selection to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Form and Function Theme', 'author' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/author/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'author_enqueue_scripts_styles' );
function author_enqueue_scripts_styles() {

	wp_enqueue_script( 'author-global', get_bloginfo( 'stylesheet_directory' ) . '/js/global.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,300italic,700,700italic|La+Belle+Aurore', array(), CHILD_THEME_VERSION );
}

//* Add new image sizes
add_image_size( 'featured-content', 800, 800, TRUE );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4 ); // changed from 3 to 4 //

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Unregister the header right widget area
unregister_sidebar( 'header-right' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'flex-height'     => true,
	'width'           => 400,
	'height'          => 132,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Rename Primary Menu
add_theme_support ( 'genesis-menus' , array ( 'primary' => __( 'Header Navigation Menu', 'author' ), 'secondary' => __( 'Secondary Navigation Menu', 'author' ) ) );

//* Remove output of primary navigation right extras
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

//* Reposition the navigation
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_subnav' );

//****** Form and Function: Add the tertiary navigation menu for Inventory pages
function register_additional_menu() {
	register_nav_menu( 'tertiary' ,__( 'Third Navigation Menu' ));
}

add_action( 'init', 'register_additional_menu' );
add_action( 'genesis_before_content_sidebar_wrap', 'add_third_nav_genesis' );

function add_third_nav_genesis() {
	genesis_nav_menu( array(
        'theme_location'  => 'tertiary',
        'container'       => 'div',
        'container_class' => 'wrap',
        'menu_class'      => 'menu genesis-nav-menu menu-secondary responsive-menu',
        'depth'           => 1
	) );
}
//* remove secondary menu from all but What We Do page
add_action('template_redirect', 'remove_subnav_specific_pages');
function remove_subnav_specific_pages() {
if ( !is_page('14') )
    remove_action('genesis_before_content_sidebar_wrap', 'genesis_do_subnav');
}

//* remove tertiary menu from all but Inventory pages
add_action('template_redirect', 'remove_tertiary_nav_pages');
function remove_tertiary_nav_pages() {
if ( !is_page (array('inventory', 'decor', 'lighting', 'seating', 'storage', 'tables' ) ) )
    remove_action('genesis_before_content_sidebar_wrap', 'add_third_nav_genesis');
}

//*



//* [Site-wide] Modify the Excerpt read more link
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
	return '... <a class="more-link" href="' . get_permalink() . '">Read More</a>';
}
//* [Dashboard] Add Archive Settings option to Items CPT
add_post_type_support( 'item', 'genesis-cpt-archives-settings' );
/**
 * [Dashboard] Add Genre Taxonomy to columns at http://example.com/wp-admin/edit.php?post_type=books
 * URL: http://make.wordpress.org/core/2012/12/11/wordpress-3-5-admin-columns-for-custom-taxonomies/
 */
add_filter( 'manage_taxonomies_for_item_columns', 'item_columns' );
function books_columns( $taxonomies ) {
	$taxonomies[] = 'groups';
	return $taxonomies;
}
//* [All Item pages] Function to display values of custom fields (if not empty)
//* called in single-item.php
function sk_display_custom_fields() {
	$item_price = get_field( 'item_price' );
	$item_dimensions = get_field( 'item_dimensions' );
	$item_number = get_field( 'item_number' );
	if ( $item_price || $item_dimensions || $item_number ) {
		echo '<div class="item-meta">';
			if ( $item_price ) {
				echo '<p><strong>Price</strong>: $' . $item_price . '</p>';
			}
			if ( $item_dimensions ) {
				echo '<p><strong>Dimensions</strong>: ' . $item_dimensions . '</p>';
			}
			if ( $item_number ) {
				echo '<p><strong>Item Number</strong>: #' . $item_number . '</p>';
			}
		echo '</div>';
	}
}
//* [All Item pages] Show Genre custom taxonomy terms for Items CPT single pages, archive page and Group taxonomy term pages
add_filter( 'genesis_post_meta', 'custom_post_meta' );
function custom_post_meta( $post_meta ) {
	if ( is_singular( 'item' ) || is_post_type_archive( 'item' ) || is_tax( 'groups' ) ) {
		$post_meta = '[post_terms taxonomy="groups" before="Groups: "]';
	}
	return $post_meta;
}
/**
 * [All Item pages] Display Post meta only if the entry has been assigned to any Group term
 * Removes empty markup, '<p class="entry-meta"></p>' for entries that have not been assigned to any Group
 */
//* called in single-item.php
function sk_custom_post_meta() {
	if ( has_term( '', 'groups' ) ) {
		genesis_post_meta();
	}
}
/**
 * [WordPress] Template Redirect
 * Use archive-items.php for Genre taxonomy archives.
 */
add_filter( 'template_include', 'sk_template_redirect' );
function sk_template_redirect( $template ) {
	if ( is_tax( 'groups' ) )
		$template = get_query_template( 'archive-item' );
	return $template;
}
//* [Single Book pages] Custom Primary Sidebar for single Book entries
genesis_register_sidebar( array(
	'id'			=> 'primary-sidebar-item',
	'name'			=> 'Primary Sidebar - Item',
	'description'	=> 'This is the primary sidebar for Item CPT entry'
) );




//* Setup widget counts
function author_count_widgets( $id ) {
	global $sidebars_widgets;

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}
}

function author_widget_area_class( $id ) {
	$count = author_count_widgets( $id );

	$class = '';

	if( $count == 1 ) {
		$class .= ' widget-full';
	} elseif( $count % 3 == 0 ) {
		$class .= ' widget-thirds';
	} elseif( $count % 4 == 0 ) {
		$class .= ' widget-fourths';
	} elseif( $count % 2 == 1 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;
}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'author_remove_comment_form_allowed_tags' );
function author_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'author' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
	$defaults['comment_notes_after'] = '';

	return $defaults;
}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'author' ),
	'description' => __( 'This is the front page 1 section.', 'author' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'author' ),
	'description' => __( 'This is the front page 2 section.', 'author' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'author' ),
	'description' => __( 'This is the front page 3 section.', 'author' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'author' ),
	'description' => __( 'This is the front page 4 section.', 'author' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-5',
	'name'        => __( 'Front Page 5', 'author' ),
	'description' => __( 'This is the front page 5 section.', 'author' ),
) );

//*++++++++++++ Custom for Form and Function +++++++++++++*/

//* Remove the edit link on page
add_filter ( 'genesis_edit_post_link' , '__return_false' );

genesis_register_sidebar( array(
	'id'		=> 'presswidget',
	'name'		=> __( 'Press Widget', 'faf' ),
	'description'	=> __( 'This is the widget area for press image widgets.', 'faf' ),
) );

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'faf_custom_footer' );
function faf_custom_footer() {
	?>
	<p><a href="<?php echo get_home_url(); ?>"><img id="footer-logo" src="<?php get_home_url() ?>/wp-content/uploads/2016/03/FormFunctionLogoMark.png"></a></p>
	<p><a href="#">Privacy Policy</a> | <a href="#">Sitemap</a></p>
	<p>Copyright <?php echo date ( 'Y' ) ?> Form & Function Raleigh. All rights reserved.</p>
	<?php
}

//* from https://www.itsupportguides.com/wordpress/how-to-use-a-non-breaking-space-in-wordpress/
function itsg_allow_nbsp_in_tinymce( $init ) {
    $init['entities'] = '160,nbsp,38,amp,60,lt,62,gt';
    $init['entity_encoding'] = 'named';
    return $init;
}
add_filter( 'tiny_mce_before_init', 'itsg_allow_nbsp_in_tinymce');


//* shortcode with root relative url for sidebar *//
// function myUrl($atts, $address = null) {
//   extract(shortcode_atts(array(
//     "href" => get_home_url() . '/wp-content/'
//   ), $atts));
//   return '<img src="'.$href.$address.'">';
//   // return '<img src="'.$href.'">'.$content.'</a>';
// }
// add_filter('widget_text', 'do_shortcode');
// add_shortcode("url", "myUrl");
// [url address="uploads/2016/03/FormFunctionLogoMark.png"][/url]

//* remove visual form builder css *//
add_filter( 'visual-form-builder-css', '__return_false' );
