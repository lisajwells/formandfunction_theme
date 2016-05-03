<?php
/**
 * Genesis Framework.
 *
 */
//* Template Name: Press

/* add schedule button */
add_action( 'genesis_before_loop', 'faf_display_schedule_button' );

function faf_display_schedule_button() {
        echo '<a href="http://formandfunctionraleigh.com/contact" id="schedule-consult-button" class="button small">Schedule a Consultation</a>';
}

/* no real post title to show */
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

/* no need to show post author and date */
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

/* add featured image (press logo) */
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'faf_display_featured_image', 8 );

function faf_display_featured_image() {
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

//* Display press_date custom field (if not empty)
add_action( 'genesis_entry_content', 'faf_press_display_date_field', 9 );

function faf_press_display_date_field() {
    $press_date = get_field( 'press_date' );
    if ( $press_date ) {
        echo '<div class="press-date">' . $press_date . '</div>';
    }
}

//* Display button with press_link custom field (if not empty)
add_action( 'genesis_entry_footer', 'faf_press_display_button_field' );

function faf_press_display_button_field() {
    $press_link = get_field( 'press_link' );
    if ( $press_link ) {
        echo '<a class="button small press-link" target="_blank" href="' . $press_link . '">Read More</a>';
    }
}

//* Remove standard post content output
//* Use the full content instead of default-for-archive excerpt
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'faf_press_the_content' );

function faf_press_the_content() {
        the_content();
}


/* no need to show category in entry_footer */
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* no sidebar for press page *//
remove_action( 'get_header', 'child_sidebar_logic' );


genesis();
