<?php
/**
 * Genesis Framework.
 *
 */
//* Template Name: Press

add_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'get_header', 'child_sidebar_logic' );


genesis();
