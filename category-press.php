<?php
/**
 * Genesis Framework.
 *
 */
//* Template Name: Press


    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

//* no sidebar for press page *//
remove_action( 'get_header', 'child_sidebar_logic' );


genesis();
