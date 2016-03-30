<?php
echo '<div id="sidebar" class="sidebar widget-area">';
    genesis_structural_wrap( 'sidebar' );
    do_action( 'genesis_before_sidebar_widget_area' );
    dynamic_sidebar('blog-sidebar');
    do_action( 'genesis_after_sidebar_widget_area' );
    genesis_structural_wrap( 'sidebar', 'close' );
echo '</div>';
?>
