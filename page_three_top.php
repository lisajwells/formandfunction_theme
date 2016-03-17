<?php
/*
 * Template Name: Three-top
 */


add_action( 'genesis_before_content_sidebar_wrap', 'faf_add_three_top' );
function faf_add_three_top() {
    echo '<div class="three-top-wrap">
        <div class="three-top-img-div">
            <img src="'. get_home_url() .'/wp-content/uploads/2016/03/home2-Rustic-Industrial-Kitchen.jpg" alt="Rustic-Industrial Kitchen">
        </div>

        <div class="three-top-img-div">
            <img src="'. get_home_url() .'/wp-content/uploads/2016/03/home2-Rustic-Industrial-Kitchen.jpg" alt="Rustic-Industrial Kitchen">
            <div class="dark-box-group">
                <div class="dark-box-content-wrap">
                <h1>The Title</h1>
                </div>
            </div>
        </div>

        <div class="three-top-img-div">
            <img src="'. get_home_url() .'/wp-content/uploads/2016/03/home2-Rustic-Industrial-Kitchen.jpg" alt="Rustic-Industrial Kitchen">
        </div>
    </div>';
}




genesis();
