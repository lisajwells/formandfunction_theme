<?php
/**
 * Genesis Framework.
 *
 */
//* Template Name: Press

/* no real post title to show */
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

/* no need to show post author and date */
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

/* add featured image (press logo) */
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
// add_action( 'genesis_entry_header', 'faf_press_do_post_image', 8 );

// function faf_press_do_post_image() {

//     if ( ! is_singular() && genesis_get_option( 'content_archive_thumbnail' ) ) {
//         $img = genesis_get_image( array(
//             'format'  => 'html',
//             'size'    => genesis_get_option( 'image_size' ),
//             'context' => 'archive',
//             'attr'    => genesis_parse_attr( 'entry-image', array ( 'alt' => get_the_title() ) ),
//         ) );

//         if ( ! empty( $img ) )
//             printf( '<a href="%s" aria-hidden="true">%s</a>', get_permalink(), $img );
//     }

// }
//* Add post image in Entry Content above Excerpt
add_action( 'genesis_entry_content', 'sk_display_featured_image', 9 );
function sk_display_featured_image() {
    $image_args = array(
        'size' => 'medium',
        'attr' => array(
            'class' => 'press_image',
        ),
    );
    $image = genesis_get_image( $image_args );
    if ( $image ) {
        echo $image;
    }
}


//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );

//* no sidebar for press page *//
remove_action( 'get_header', 'child_sidebar_logic' );


genesis();
