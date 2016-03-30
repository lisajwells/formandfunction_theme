<?php
/**
 * Genesis Framework.
 */
//* Template Name: Blog

        remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
        add_action( 'genesis_sidebar', 'child_get_blog_sidebar' );



//* The blog page loop logic is located in lib/structure/loops.php
genesis();
