<?php
// Custom Download function
function auto_wc_product_export(){
    
    include_once WC_ABSPATH . 'includes/export/class-wc-product-csv-exporter.php';

    $step     = isset( $_POST['step'] ) ? absint( $_POST['step'] ) : 1; // WPCS: input var ok, sanitization ok.
    $exporter = new WC_Product_CSV_Exporter();

    $exporter->set_page( $step );
    $exporter->generate_file();

    // die('lllllllssssssss');

    $query_args = apply_filters(
        'woocommerce_export_get_ajax_query_args',
        array(
            'nonce'    => wp_create_nonce( 'product-csv' ),
            'action'   => 'download_product_csv',
            'filename' => $exporter->get_filename(),
        )
    );

    if ( 100 === $exporter->get_percent_complete() ) {
		$exporter->export();
    }

}

// add_action('init', 'run_product_export_on_footer');
function run_product_export_on_footer() {
    
   $re = auto_wc_product_export();
   exit();
}

