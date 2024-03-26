<?php 

/*

Plugin Name: UnlimitedForm

Plugin URI: http://vir-za.com/

Description: This is slider with custom post plugin for every WordPress theme.

Version: 1.0.0

Author: WebOneDevs

Author URI: https://www.linkedin.com/in/1mdalamin1/

License: 564.505

Text Domain: unlimited-form

*/

// Exit if accessed directly

if ( ! defined( 'ABSPATH' ) ) {

    exit;

}

// Define

define( 'U_F_ACC_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );

define( 'U_F_ACC_PATH', plugin_dir_path( __FILE__ ) );


// ######## >>>> Custom Post Register <<<< ########




// ######## >>>> Custom Post-taxonomy Register <<<< ########



// print shortcodes in widgets

add_filter('widget_text', 'do_shortcode');

//   require_once( U_F_ACC_PATH . 'theme-shortcodes/project-slid-shortcode.php' );

//   require_once( U_F_ACC_PATH . 'theme-shortcodes/protfolio-slid-shortcode.php' );

  require_once( U_F_ACC_PATH . 'theme-shortcodes/unlimited-form-shortcode.php' );
  require_once( U_F_ACC_PATH . 'theme-shortcodes/ajax-process.php' );


// Registering Project Slider files

function unlinited_form_files() {

    wp_enqueue_style('unlimited-form', plugin_dir_url(__FILE__) . 'assets/style.css');
    // wp_enqueue_style('project-slider', plugin_dir_url(__FILE__) . 'assets/style.css');
    // wp_enqueue_style('font-awesome', plugin_dir_url(__FILE__) . 'assets/font-awesome.min.css');
    // wp_enqueue_style('owl-carousel', plugin_dir_url(__FILE__) . 'assets/owl.carousel.css');



    // wp_enqueue_script('Jquery', plugin_dir_url(__FILE__) . 'assets/jquery-1.12.5.js', array('jquery'), '20120206', true );
    wp_enqueue_script('Jquery', plugin_dir_url(__FILE__) . 'assets/jquery-3.6.1.min.js', array('jquery'), '20120206', true );
    wp_enqueue_script('myJavaScript', plugin_dir_url(__FILE__) . 'assets/myScript.js', array('jquery'), '20120206', true );
    wp_enqueue_script('ajaxJavaScript', plugin_dir_url(__FILE__) . 'assets/ajaxScript.js', array('jquery'), '20120206', true );
    // wp_enqueue_script('owl-carousel', plugin_dir_url(__FILE__) . 'assets/owl.carousel.min.js', array('jquery'), '20120206', true );
    // wp_enqueue_script('custom-slider-active', plugin_dir_url(__FILE__) . 'assets/custom.js', array('jquery'), '20120206', true );

}

add_action('wp_enqueue_scripts', 'unlinited_form_files');









?>