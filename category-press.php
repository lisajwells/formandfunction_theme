<?php
/**
 * Genesis Framework.
 *
 */

//* Template Name: Press

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );


genesis();
