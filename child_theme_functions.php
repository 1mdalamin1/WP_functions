<?php  

// remove updated widgets style
function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );

// post old editor || default editor
add_filter('use_block_editor_for_post', '__return_false', 10);
