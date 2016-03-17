<?php
/*
 * Template Name: Three-top
 */

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_action( 'genesis_before_content_sidebar_wrap', 'faf_add_three_top' );
function faf_add_three_top() {
    echo '<div class="three-top-wrap">
        <div class="three-top-img-div">
            <img src="'. get_home_url() . genesis_get_custom_field( 'Image_1_url' ) .'" alt="'. genesis_get_custom_field( 'Image_1_alt' ) .'">
        </div>

        <div class="three-top-img-div">
            <img src="'. get_home_url() . genesis_get_custom_field( 'Image_2_url' ) .'" alt="'. genesis_get_custom_field( 'Image_2_alt' ) .'">
            <div class="dark-box-group">
                <div class="dark-box-content-wrap">
                <h1>'. get_the_title() .'</h1>
                </div>
            </div>
        </div>

        <div class="three-top-img-div">
            <img src="'. get_home_url() . genesis_get_custom_field( 'Image_3_url' ) .'" alt="'. genesis_get_custom_field( 'Image_3_alt' ) .'">
        </div>
    </div>';
}



genesis();
