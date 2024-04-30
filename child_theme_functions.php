<?php  
// for ubuntu os wordpress localhost asking for ftp
// define('FS_METHOD', 'direct');
// upload squl file in database from terminal
# mysql -u root -p lb_dev < database file-path/squl.sql



// remove updated widgets style
function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );

add_filter('use_block_editor_for_post', '__return_false', 10); // user old post editor
add_filter( 'use_widgets_block_editor', '__return_false' ); // user for old widgets panel


add_filter( 'site_transient_update_plugins', 'remove_update_notifications' );
function remove_update_notifications( $value ) {

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ 'elementor-pro/elementor-pro.php' ] );
    }

    return $value;
}






// add code for Text Slider now 

add_action('wp_head', 'get_custom_script_init');
function get_custom_script_init(){
	?>
<style>
    .spin {
        text-align: center;
        height: 320px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .spin img {
        animation: rotet 3s linear infinite;
        width: 150px;
        height: 150px;
    }
    @keyframes rotet {
        0%{
            transform: rotate(360deg);
        }
        100%{
            transform: rotate(0deg);
        }
    }
</style>
    	<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
    	<script>
			jQuery(document).ready(function () {
				document.querySelector('.hero_title h2 span').textContent = '';

				var typed = new Typed('.hero_title h2 span', {
					strings: ["Be Smart","Be Safe","Be Connected", "SEO", "PPC", "Web Design", "Social Media", "Content"],
					typeSpeed: 70,
					startDelay: 0,
					backSpeed: 60,
					backDelay: 1400,
					loop: true,
					showCursor: true,
					cursorChar: '',
					autoInsertCss: false
				});

				//mobile
			});
		</script>
    <?php
}
// add javaScript hook for footer 
add_action('wp_footer', 'get_footer_custom_script');
function get_footer_custom_script(){
  ?>
<style>
    .empty_btn {
        font-family: "Poppins", Sans-serif;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        fill: #333232;
        color: #333232;
        background-color: #FFD529;
        padding: 8px 16px;
        border-radius: 3px;
        margin-top: 20px;
        display: inline-block;
    }
</style>
<script>
	
    let title_js = "";
    let dec_js = "";
    window.wp.media.editor.insert( '[ short_code'+ '  '+'title="' + title_js + '"'+' '+ 'dec="' + dec_js + '" ]');



    const el = document.createElement("div");
    el.innerHTML = `<a href="https://svens.is/collections/frontpage/" class="empty_btn">Fara í vefverslun</a>`;
    const box = document.getElementsByClassName("woocommerce-mini-cart__empty-message");
    // const boxId = document.getElementsById("IdName");
    // boxId.appendChild(el);
    box[0].appendChild(el);


    // class add Or remove relation with focus
    
    //  onfocus="addF()"
    document.getElementById("amount").addEventListener("focus", addF);
    function addF() {
        let element = document.getElementById("amount-icon");
        element.classList.add("carrancy");
    }
    
    // onfocusout="removeF()"
    document.getElementById("amount").addEventListener("focusout", removeF);
    function removeF() {
        let element = document.getElementById("amount-icon");
        element.classList.remove("carrancy");
    }


</script>

  <script src='https://cloneona.com/wp-includes/js/jquery/jquery.min.js?ver=3.6.1' id='jquery-core-js'></script>
<script>
	jQuery(document).ready(function () {

		// add code here 
	});
</script>

<?php
}

// add notification_bar Short Code
add_shortcode('multi_step_form','multi_step_fun');
function multi_step_fun(){
	ob_start(); ?>

<div>Notification</div>

<?php
    return ob_get_clean();
}

// WooCommerc hook My Account page 
add_action( 'woocommerce_before_customer_login_form', 'notification_add');
function notification_add() {

    // echo do_shortcode('[notification_bar]');
    // if(isset($_GET['abcd'])){  url ?abcd dea hit korta hoba
    //     echo do_shortcode('[notification_bar]');
    // }

}


// Redirect Woocommerce to a custom page after checkout
add_action('woocommerce_thankyou', 'redirect_after_checkout');
function redirect_after_checkout($order_id) {
    $order = wc_get_order($order_id);
    $cname = $order->get_billing_first_name();
    $user = base64_encode($cname);
    $url = 'Your url link /?thanks='.$user;
    if(!$order->has_status('failed')) {
        wp_safe_redirect($url);
        exit;
    }
}

// add notification home Or Thanks page Short Code
add_shortcode('notification_thanks','n_thanks_fun');
function n_thanks_fun(){
	ob_start(); ?>
<?php if(isset($_GET['thanks'])) {
    $username = base64_decode($_GET['thanks']);
    // $websiteAddress="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    // $end = end(explode('/', $websiteAddress));
    echo '
    <div class="n_left">
        <h2>Takk fyrir viðskiptin, ('.$username.').</h2>
        <p>Nú tökum við saman pöntunina. Má bjóða þér að skoða eitthvað fleira?</p>
    </div>
    ';
}; ?>
    

<?php
    return ob_get_clean();
}

// backend from validation with phone & Email

    // validation logic here
    $g_name=trim($_POST["gift_card_recipient_name"]);
    $g_sms=trim($_POST["gift_card_custome_message"]);
    $g_email=trim($_POST["gift_card_recipient_email"]);
    $g_phone=trim($_POST["gift_card_phone"]);

    if (empty($g_name)) {
        wc_add_notice( __( 'Viðtakanda Nafn Áskilið.', 'woocommerce' ), 'error' );
        $passed = false;
    }elseif(empty($g_email)){
        wc_add_notice( __( 'Viðtakanda Netfang Áskilið.', 'woocommerce' ), 'error' );
        $passed = false;
    }elseif(!$g_email){
        wc_add_notice( __( 'Email is requerd.', 'woocommerce' ), 'error' );
        $passed = false;
    }elseif (!$g_email || !is_email($g_email)) {
        wc_add_notice( sprintf( 'Viðtakanda Netfang not valid.'), 'error' );
        $passed = false; // don't add the new product to the cart
        
    }elseif(empty($g_phone)){
        wc_add_notice( __( 'Viðtakanda Símanúmer Áskilið.', 'woocommerce' ), 'error' );
        $passed = false;
    }elseif(strlen($g_phone)!=7 || !is_numeric($g_phone)){
        wc_add_notice( sprintf( 'Viðtakanda Símanúmer Áskilið'), 'error' );
        $passed = false; // don't add the new product to the cart
        // break;
    }elseif(empty($g_sms)){
        wc_add_notice( __( 'Viðtakanda Skilaboð Áskilið.', 'woocommerce' ), 'error' );
        $passed = false;
    }else{
        $passed = true;
    }


// check login user with relation redirect page url
add_action('init', 'check_login_function');
function check_login_function() {
	
	$postID = url_to_postid( $_SERVER['REQUEST_URI'] , '_wpg_def_keyword', true ); 
	if(in_array($postID,[5218,5285,5286]) && !is_user_logged_in()){
		wp_safe_redirect('https://www.convair.net.au/user');
		exit();
	}

	if(in_array($postID,[5339,5202]) && is_user_logged_in()){
		wp_safe_redirect('https://www.convair.net.au/userprofile');
		// wp_safe_redirect(get_permalink( wc_get_page_id( 'myaccount' ) )); // my account page
		exit();
	}
	
}

// redirect page url
add_action( 'template_redirect', 'redirect_to_other_page' );
function redirect_to_other_page() {
    if (is_shop()) { // is_page( 143 )
	    wp_redirect( '"'.home_url().'"', 301 );
    exit;
    }
}


// category link by product id 

// global $product;
// $product_id = $product->get_id();
$product_id = get_the_ID();
$_product = wc_get_product($product_id);
// echo "<pre>";
// print_r($_product);
// echo "</pre>";

$cats = $_product->get_category_ids();
foreach ($cats as $key => $value) {
	$catLink = get_category_link($value);
	?>

	<a class="back-to-all" href="<?php echo $catLink ?>">&#8592; back to all devices</a><br>

	<?php
}
 # another way to cat link id, name
    //   echo "Category ID: " . $category_id;
	//   $category = get_queried_object(); // find url to id 
	//   echo $category->term_id;

  	$taxonomy = 'place';
    $args = array(
      'taxonomy' => $taxonomy, // Use "product_cat" for WooCommerce product categories
      'hide_empty' => false, // Show even empty categories
      'orderby' => 'name', // Order by category name
      'order' => 'ASC', // Sort in ascending order
    );
    $categories = get_terms( $args );
	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ){
		foreach ( $categories as $category ) {
            // get_term($category);
		    echo '<li><a href="'. get_term_link( $category ).'">'.$category->name.'</a></li>';
		}
	}

// wooCommerce my-account 

add_filter( 'woocommerce_account_menu_items', 'my_account_menu_order_label', 999 );

function my_account_menu_order_label( $items ) {

    $items['orders'] = __( 'My entries/orders', 'woocommerce' );

    return $items;
}


add_filter( 'woocommerce_before_account_orders', 'order_page_title');
function order_page_title() {

    echo 'My entries/orders <br>';
    // echo get_post_meta( 3292, 'total_tickets', true); | test post meta

}
/*
add_filter( 'woocommerce_my_account_my_orders_columns', 'add_entrie_column_in_orders' );
function add_entrie_column_in_orders( $columns ) {
    $columns['entries_column'] = __( 'Entries', 'woocommerce' ); // number_of_tickets
    return $columns;
}
*/

# url Redirect
add_action( 'template_redirect', 'custom_redirects' );
function custom_redirects() {
   if ( function_exists( 'wp_redirect' ) ) {
       $redirects = array(
           '/dev/gjafakaup.is/shop/' => 'https://leikbreytir.com/dev/gjafakaup.is/kaupa/',
         //   '/old-post-slug' => 'https://example.com/new-post-slug',
           // Add more redirection rules here
       );

       foreach ( $redirects as $old_url => $new_url ) {
           if ( $_SERVER['REQUEST_URI'] == $old_url ) {
               wp_redirect( $new_url, 301 );
               exit();
           }
       }
   }
}

// add order table th 
add_filter( 'woocommerce_my_account_my_orders_columns', 'rearrange_my_account_orders_column' );
function rearrange_my_account_orders_column( $columns ) {

    $new_columns = array();

    foreach ( $columns as $key => $name ) {

        $new_columns[ $key ] = $name;

        // add ship-to after order status column
        if ( 'order-total' === $key ) {  //this is the line!
            $new_columns['entries_column'] = __( 'Entries', 'woocommerce' );
        }
    }

    return $new_columns;
}

// add order table td with value from get_post_meta 
add_filter( 'woocommerce_my_account_my_orders_column_entries_column', 'add_entries_data_to_my_account_orders' );
function add_entries_data_to_my_account_orders( $order ) {
    // return $order->get_order_number();

    // echo get_post_meta( $order_id, 'total_tickets', true);
    if ( $value = $order->get_meta( 'total_tickets' ) ) {
        echo esc_html( $value );
    }
}



// use wp default text editor
    $content = $id ? $r->popup : "Enter your popup text";
    // html_entity_decode(stripcslashes($content));
    // wp_editor( $content, $editor_id, $settings );
    wp_editor( $content, 'popup', array(
        'wpautop'       => true,
        'media_buttons' => false, // true | false
        'textarea_name' => 'popup',
        'editor_class'  => 'tpdm-input',
        'textarea_rows' => 10
    ) );


add_filter( 'gettext', 'wpdocs_translate_text', 10, 3 );
function wpdocs_translate_text( $translated_text, $untranslated_text, $domain ) {

	switch ( $translated_text ) {

		case '[Remove]' :

			$translated_text = '[Fjarlægja]';
			break;

		case 'Coupon has been removed.' :

			$translated_text = 'Afsláttarkóðinn hefur verið fjarlægt';
			break;

	}


    return $translated_text;
}


// allowed to upload .jfif file type
add_filter('mime_types', 'add_support_jfif_files');
function add_support_jfif_files($mimes){
    $mimes['svg'] = "image/jpeg";
    return $mimes;
}


// Gift Card cart page

if($values['wdm_user_custom_data_value']['gift_card_time']!='00:00:00'){
    $return_string .= "<tr><td>Dagsetning: " . $values['wdm_user_custom_data_value']['gift_card_date'] . " @ " . $values['wdm_user_custom_data_value']['gift_card_time'] . "</td></tr>";
}else{
    $return_string .= "<tr><td>Dagsetning: " . $values['wdm_user_custom_data_value']['gift_card_date'] . "</td></tr>";
}

// wp Pagenation
$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;

$limit = 10; // number of rows in page
$offset = ( $pagenum - 1 ) * $limit;
$total = $wpdb->get_var( "SELECT COUNT(`id`) FROM {$wpdb->prefix}books" );
$num_of_pages = ceil( $total / $limit );
$entries = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}books LIMIT $offset, $limit" );




$page_links = paginate_links( array(
    'base' => add_query_arg( 'pagenum', '%#%' ),
    'format' => '',
    'prev_text' => __( '&laquo;', 'text-domain' ),
    'next_text' => __( '&raquo;', 'text-domain' ),
    'total' => $num_of_pages,
    'current' => $pagenum
) );

if ( $page_links ) {
    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
}

/*
// Tanvir test 
https://tastewp.com/#!

Site name: Bear Knowledge
URL: https://bearknowledge.s3-tastewp.com
Username: admin
Password: KnX8NABsvRM


*/
// <input value="" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="gift_card_phone" maxlength="7" minlength="7">



# textDomain=button-text-changer-wc | prefix=btcwc_
add_filter('woocommerce_settings_tabs_array', 'btcwc_add_fild', 50);
function btcwc_add_fild($settings_tab) {
    $settings_tab['btcwc_fild'] = __('btnTextChange', 'button-text-changer-wc');
    return $settings_tab;
}

// add new fild in wc setting
add_action('woocommerce_settings_tabs_btcwc_fild', 'btcwc_add_fild_settings');
function btcwc_add_fild_settings() {
    woocommerce_admin_fields(get_btcwc_fild_settings());
}

// upload data in option table
add_action('woocommerce_update_options_btcwc_fild', 'btcwc_update_options_fild_settings');
function btcwc_update_options_fild_settings() {
    woocommerce_update_options(get_btcwc_fild_settings());
}



function get_btcwc_fild_settings() {
    $settings = array(
        'section_title' => array(
            'id' => 'btcwc_fild_settings_title',
            'desc' => 'You can control btcwc course',
            'type' => 'title',
            'name' => __('wooCommerce Button Text Change Settings', 'button-text-changer-wc'),
        ),
        'btcwc_add_to_cart' => array(
            'id' => 'btcwc_fild_btcwc_add_to_cart',
            'desc' => __('Now you can set add to cart button text. Default it show Add to cart.', 'button-text-changer-wc'),
            'type' => 'text',
            'desc_tip' => true,
            'name' => __('Add to Cart button', 'button-text-changer-wc'),
        ),
    );

    return apply_filters('filter_btcwc_fild_settings', $settings);
}





// Cron job Start

// 60 seconds interval schedules
add_filter( 'cron_schedules', 'add_sixty_second_interval' );
function add_sixty_second_interval( $schedules ) {
    $schedules['sixty_seconds'] = array(
        'interval' => 60,
        'display' => __( 'Every 60 seconds' )
    );
    return $schedules;
}

register_activation_hook( __FILE__, 'gtw_activation' );
function gtw_activation() {
	
	if (! wp_next_scheduled ( 'gtw_sms_send_corn' )) {
    	wp_schedule_event( time(), 'sixty_seconds', 'gtw_sms_send_corn' ); // sixty_seconds | hourly | daily
    }
}

register_deactivation_hook( __FILE__, 'gtw_deactivation' );
function gtw_deactivation() {
    wp_clear_scheduled_hook( 'gtw_sms_send_corn' );
}


add_action('gtw_sms_send_corn', 'gtw_sms_send_corn_every_minit');
function gtw_sms_send_corn_every_minit(){
    gtw_send_cron(); // this corn will be run every minute
}
// Cron job The end



// custom table create and insert data
// create database table name dealer_orders_address // Register Database Table 
function dealer_orders_address_save(){
    global $wpdb;
    $table_name = $wpdb->prefix.'dealer_orders_address';
    $sql = "CREATE TABLE {$table_name} (
        id BIGINT NOT NULL AUTO_INCREMENT,
        user_id BIGINT,
        order_id BIGINT,
        delivery_address VARCHAR(250),
        add_edit_date_time DATETIME,
        PRIMARY KEY (id)
    );";
    require_once (ABSPATH."wp-admin/includes/upgrade.php");
    dbDelta($sql);

    // Update Database Table
    if(get_option("tpdm_version")!=VERSION){
        $sql = "CREATE TABLE {$table_name} (
            id INT NOT NULL AUTO_INCREMENT,
            row_no INT(11),
            col_no INT(11),
            popup text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            popup_t6 text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            popup_t14 text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            user_id INT(11),
            add_edit_date_time DATETIME,
            
            PRIMARY KEY (id)
        );";
        dbDelta($sql);
        update_option("tpdm_version",VERSION);
    }

}
// Hook the function to run when the theme is activated
add_action('after_setup_theme', 'dealer_orders_address_save'); // for child theme in function.php
register_activation_hook(__FILE__, "dealer_orders_address_save"); // for Plugin 



// insert address in my custom table "dealer_orders_address"
global $wpdb;
$table_name = $wpdb->prefix . 'dealer_orders_address';
// Prepare data for insertion
$data = array(
    'user_id' => $userId, // $item_id
    'order_id' => $post_id,
    'delivery_address' => $deliveryAdd,   
);
// Insert the data into the custom table
$wpdb->insert($table_name, $data);

// Show single row in db Query
  global $wpdb;
$category_id = 564;
$r  	 = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}place WHERE cat_id='{$category_id}'");
$placeId = $r->place_id_name;

// Show all row in db Query
  global $wpdb;
$place_data = $wpdb->get_results("SELECT id, cat_id, place_id_name FROM {$wpdb->prefix}place ORDER BY id DESC", ARRAY_A);
$placeId = $place_data->place_id_name;


// .product-price table.wdm_options_table tbody tr td:before, tr.cart-subtotal {
//     display: none !important;
// }
// table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents tbody tr:nth-last-child(1) {
    // display: none;
// }
// add_action( 'template_redirect', 'redirect_url_to_other_page' );
// function redirect_url_to_other_page() {
//     if (is_shop()) { // is_page( 143 )
// 	    wp_redirect( '"'.home_url().'"', 301 );
//     exit;
//     }
// }


// For replase text
// add_filter( 'gettext', 'wpdocs_translate_text', 10, 3 );
// function wpdocs_translate_text( $translated_text, $untranslated_text, $domain ) {

// 	switch ( $translated_text ) {

// 		case 'Millisamtala' :

// 			$translated_text = 'Samtals';
// 			break;

// 		// case 'Coupon has been removed.' :

// 		// 	$translated_text = 'Afsláttarkóðinn hefur verið fjarlægt';
// 		// 	break;

// 	}

add_action('wp_footer', 'get_fetch_price_script');
function get_fetch_price_script(){
?>
<script>
 // add your javaScript here
 

// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy
// https://fedingo.com/how-to-listen-to-variable-changes-in-javascript/

// This function works as like vue watcher | now it only work gift_card_create_new_tab_panel()
var img_tabs_data = new Proxy(targetProxy, {
        
    set: function (target, key, value) {
        //console.log(`${key} set to ${value}`);
        target[key] = value;

        // set target input value here
        const jsonString = JSON.stringify(targetProxy);
        jQuery(".imgStyleTabs input[name=wodgc_tab_images]").val(jsonString);

        return true;
    },
    get: function (target, key) {
        console.log("Update virza === "+targetProxy);  
        return target[key];
    }

});



// WordPress Media Libray select when click button

jQuery(document).ready(function(){

function wodgc_tab_img_upload(button_class) {
    
    jQuery('body').on('click', button_class, function(e) {

        let button     = jQuery(this).attr('id');
        let tabContent = jQuery(this).parent();
        let tabConId   = jQuery(tabContent).attr('id');
        
        wp.media.editor.send.attachment = function(props, attachment){

            let galleryContainer = jQuery(tabContent).find('#wodgcTabImgShow');

            galleryContainer.append(`<span class="tab-img" id="imgAttchId_${attachment.id}" ><span class="tab-img-remove" onclick="removeTabImg('${tabConId}', ${attachment.id})" >×</span> <img src="${attachment.url}" style="max-height:100px;" /></span>`);

            /*
                jQuery(tabContent).find('#wodgcTabImgShow').html(`<span class="tab-img" id="imgAttchId_${attachment.id}" ><span class="tab-img-remove" onclick="removeTabImg('${tabConId}', ${attachment.id})" >×</span> <img src="${attachment.url}" style="max-height:100px;" /></span>`);
            */
            
        }

        wp.media.editor.open(button, {
            multiple: true // Enable multiple image selection
        })
        return false;
    });
}
wodgc_tab_img_upload('.wodgc-tab-img-upload-btn'); 

});

// validation email
function isEmail(email) {
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

// email validation in php and phone number validation

function emailOk($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}

// Form submit function onclick='userLoginFormSubmit()'
function userLoginFormSubmit() {
    let user_phone = jQuery('input[name=user_phone]').val().trim();
    let user_email=jQuery('input[name=user_email]').val().trim();
    
    jQuery('.error').remove(); // Reset any previous error messages

    // validation 
    let isValid = true;

    if(!user_email){
        jQuery('input[name=user_email]').css('border','1px solid red');
        jQuery('input[name=user_email]').focus();
        jQuery('input[name=user_email]').after(`<p class='error'>Sláðu inn netfangið þitt</p>`);
        isValid = false;
    }else{
        if(!emailOk(user_email) && user_email){
            jQuery('input[name=user_email]').css('border','1px solid red');
            jQuery('input[name=user_email]').focus();
            jQuery('input[name=user_email]').after(`<p class='error'>Sláðu inn netfangið þitt</p>`);
            isValid = false;
        }else{
            jQuery('input[name=user_email]').css('border','0px solid red');
            jQuery('input[name=user_email]').after(` `);
            
        }
        
    }

    if(!user_phone){
        jQuery('input[name=user_phone]').css('border','1px solid red');
        jQuery('input[name=user_phone]').focus();
        jQuery('input[name=user_phone]').after(`<p class='error'>Sláðu inn farsímanúmer</p>`);
        isValid = false;
    }else{
        if(user_phone.length!=7 && user_phone){
            jQuery('input[name=user_phone]').css('border','1px solid red');
            jQuery('input[name=user_phone]').focus();
            jQuery('input[name=user_phone]').after(`<p class='error'>Sláðu inn farsímanúmer</p>`);
            isValid = false;
        }else{
            jQuery('input[name=user_phone]').css('border','0px solid red');
            jQuery('input[name=user_phone]').after(` `);
            
        }
        
    }

   
    if(isValid){
        // ajax call 
    }


}

jQuery(document).ready(function() {
    jQuery('.menu-item-has-children .sub-menu').hide();
    jQuery('.menu-item-has-children').click(function() {
        // Toggle the submenu
        jQuery(this).children('.sub-menu').toggle();

        // Toggle active class
        jQuery(this).toggleClass('active');
    });
});

// alternative 
$(".Click-here").on('click', function () {
    $(".menu-item-has-children").addClass('active');
});
$(".close-btn, .bg-overlay").click(function () {
    $(".menu-item-has-children").removeClass('active');
});

</script>
<?php 
}


// 10 & 11 validation
$value = trim($_POST['billing_kennitala']);
$kt_length = strlen($value);
if( $kt_length<10 || $kt_length>11 ){  
    wc_add_notice(sprintf('Sláðu inn gilda kennitölu'), 'error');
    $passed=false; // don't add the new product to the cart
}



// === >>>> Dashboard Left side menu <<<< === \\
add_action("admin_menu", "wp_dashboard_tpdm_menu_reg");
function wp_dashboard_tpdm_menu_reg() {
    add_menu_page(
        __('Popup Data Manage','tpdm'), // page title <?=__('','tpdm')?
        __('Popup Data Manage','tpdm'), // menu title
        'manage_options', // capability
        'tpdm', // sluge
        'popup_data_manage_fun', // function
        'dashicons-welcome-widgets-menus', // plugins_url('/img/icon.png',__DIR__) // icon url
        10
    );

    //add submenu 2
    add_submenu_page(
        'tpdm', // parent menu slug
        __('CSV inportExport','tpdm'), // Page title
        'CSV ImporExport', // Menu title
        'manage_options',  // Capability
        'emport_export', // sub menu slug
        'tpdm_emport_export_db_fun' // sub meun funciton for page
    );
}


add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}



// only for admin | payment | https://wordpress.org/plugins/woocommerce-other-payment-gateway/
    add_action('woocommerce_checkout_order_processed','check_if_order_processed_by_admin',10,1);
    function check_if_order_processed_by_admin($order_id){
        if(current_user_can('administrator')){
            $order = wc_get_order( $order_id );
            if($order->get_payment_method()==='other_payment'){
                gtw_item_order_payment_complete( $order_id );
            }
        }
    
    }

// Dashboard notice
    if( !function_exists('atsew_wx_teachable_notice')){
        function atsew_wx_teachable_notice() {
            ?>
            <div class="notice notice-error is-dismissible">
                <p><?php esc_html_e("Please Insert Teachable API KEY","wx-teachable");?> <a href="<?php echo admin_url( 'admin.php?page=wc-settings&tab=teachable_fild' ); ?>"> <?php esc_html_e('Click Here.','wx-teachable');?></a></p>
            </div>
            <?php
        }
    }
    
    $woo_settings_page = admin_url( 'admin.php?page=wc-settings&tab=teachable_fild' );
    
    $current_page_url = admin_url(basename($_SERVER['REQUEST_URI']));
    
    if(!ATSEW_TEACHABLEAPIKEY && $current_page_url !== $woo_settings_page ){
        add_action( 'admin_notices', 'atsew_wx_teachable_notice' );
    }

/**
* Add a login/logout shortcode button
*/
add_shortcode( 'login_logout', 'wooxperto_login_logout_shortcode_callback' );
function wooxperto_login_logout_shortcode_callback() {
    ob_start();
    if (is_user_logged_in()) :
        
    ?>
        <a role="button" href="<?php echo wp_logout_url('/login-user/'); ?>" class="log-out-user">Log Out</a>

        <?php
        else :
        ?>
        <!-- <a role="button" href="<?php // echo wp_login_url(get_permalink()); ?>">Innskráning</span></a> -->
        <a role="button" href="/login-user/" class="log-in-user">Innskráning</span></a>

    <?php
    endif;

return ob_get_clean();
}


function show_subcat_by_id($id){
	// $term = get_queried_object();

	$subcats = get_terms(array(
		'taxonomy' => 'product_cat',
		'parent' => $id,
		// 'child_of' => $term->term_id,
		'hide_empty' => true,
		'orderby' => 'name',
		'order' => 'ASC'
	));
	$listHtml = '';
	foreach ($subcats as $catItem) {
		$listHtml .= '<li><a href="' . get_term_link($catItem) . '">' . $catItem->name . '</a></li>';

	}
	$html = '<ul>'.$listHtml.'</ul>';
	return $html;

}


//     return $translated_text;
// }