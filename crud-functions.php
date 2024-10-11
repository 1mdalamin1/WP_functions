<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );
require_once "class.dbdemousers.php";
/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

add_filter( 'site_transient_update_plugins', 'remove_update_notifications' );
function remove_update_notifications( $value ) {

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ 'elementor-pro/elementor-pro.php' ] );
        unset( $value->response[ 'elementor/elementor.php' ] );
    }

    return $value;
}

add_filter('use_block_editor_for_post', '__return_false', 10); // user old post editor
add_filter( 'use_widgets_block_editor', '__return_false' ); // user for old widgets panel



// add javaScript hook for footer 
add_action('wp_footer', 'get_footer_custom_script');
function get_footer_custom_script(){
  ?>
<script src='https://cloneona.com/wp-includes/js/jquery/jquery.min.js?ver=3.6.1' id='jquery-core-js'></script>
<script>
    let active_step = 1;
    let max_step = 4;
    jQuery(document).ready(function () {


    });

    function show_pre() {

        if (active_step != 1) {
            active_step -= 1;
            jQuery(".msf-step-input.active").removeClass("active");
            jQuery("#step" + active_step + "").addClass("active");
        }

        if (active_step == 1) {
            jQuery(".step.pre,#submit_form").removeClass("current");
            jQuery(".step.next").addClass("current");
        }

        if (active_step == 2) {
            jQuery("#submit_form").removeClass("current");
            jQuery(".step.pre,.step.next").addClass("current");
        }

        if (active_step == 3) {
            jQuery("#submit_form").removeClass("current");
            jQuery(".step.pre,.step.next").addClass("current");
        }

        if (active_step == 4) {
            jQuery("#submit_form").addClass("current");
            jQuery(".step.pre").addClass("current");
            jQuery(".step.next").removeClass("current");
        }
    }

    function show_next() {
        jQuery("#message_area").html("");
        if (active_step != 4) {
            // validation
            let progress = true;
            jQuery(".msf-step-input.active .data-input-element").each(function () {
                let required = jQuery(this).attr("required");
                let value = jQuery(this).val().trim();
                if (required && !value) {
                    progress = false;
                    let label = jQuery(this).parent().find("label").text().replace('*', '').replace(':', '');
                    jQuery("#message_area").append(`<p class="error">${label} is required.</p>`);
                }
            })

            if (!progress) {
                return false;
            }

            active_step += 1;
            jQuery(".msf-step-input.active").removeClass("active");
            jQuery("#step" + active_step + "").addClass("active");
        }

        if (active_step == 1) {
            jQuery(".step.pre,#submit_form").removeClass("current");
            jQuery(".step.next").addClass("current");
        }

        if (active_step == 2) {
            jQuery("#submit_form").removeClass("current");
            jQuery(".step.pre,.step.next").addClass("current");
        }

        if (active_step == 3) {
            jQuery("#submit_form").removeClass("current");
            jQuery(".step.pre,.step.next").addClass("current");
        }
        if (active_step == 4) {
            jQuery("#submit_form").addClass("current");
            jQuery(".step.pre").addClass("current");
            jQuery(".step.next").removeClass("current");
        }
    }

    // validation email
    function isEmail(email) {
        let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);

    }

    function msf_submit() {
        jQuery("#message_area").html("");
        if (active_step == 4) {
            // validation
            let progress = true;

            jQuery(".data-input-element").each(function () {
                let required = jQuery(this).attr("required");
                let emailtyp = jQuery(this).attr("type");
                let value = jQuery(this).val().trim();

                if (required && !value) {
                    progress = false;
                    let label = jQuery(this).parent().find("label").text().replace('*', '').replace(':', '');
                    jQuery("#message_area").append(`<p class="error">${label} is required.</p>`);

                }

                if (emailtyp == "email" && value) {
                    if (!isEmail(value)) {
                        progress = false;
                        let label = jQuery(this).parent().find("label").text().replace('*', '').replace(':',
                        '');
                        jQuery("#message_area").append(`<p class="error">${label} is must be valid.</p>`);
                    }
                }

            })

            if (!progress) {
                return false;
            }

            // call ajax
            let data = jQuery(".data-input-element").serialize();
            // console.log(data);
            jQuery("#message_area").html(`<p class="info">Please wait! we are processing...</p>`);
            jQuery.post("<?=admin_url( 'admin-ajax.php' )?>",data,function(result) {
                    let obj = JSON.parse(result);
                    console.log(obj);
                    if (obj.status == 'ok') {
                        window.location.href = obj.url;
                    } else {
                        alert("Something went wrong!");
                    }
                });
        }

    }
</script>

<script>

</script>

<?php 
}

// add Multi Step Form Short Code
add_shortcode('multi_step_form','multi_step_fun');
function multi_step_fun(){
	ob_start(); ?>
<div class="full-width">
    <div class="msf-container">
        <div class="msf-wrap">

            <div class="msf-single-step">
                <div class="msf-step-title">
                    <h2>Multi Step Form</h2>
                    <p>Ajax Practice</p>
                </div>

                <div class="msf-step-input active" id="step1">
                    <h3>Step 1</h3>
                    <input type="hidden" id="formid" name="formid" value="2" class="data-input-element">
                    <input type="hidden" name="action" value="w1d_msf_process" class="data-input-element">
                    <div class="msf-step-input-field flex-column">
                        <label for="name">Name *</label>
                        <input type="text" name="Name" id="name" required="required" class="data-input-element">
                    </div>
                    <div class="msf-step-input-field flex-column">
                        <label for="role">Role *</label>
                        <input type="text" name="Role" id="role" required="required" class="data-input-element">
                    </div>
                </div>

                <div class="msf-step-input" id="step2">
                    <h3>Step 2</h3>
                    <div class="msf-step-input-field flex-column">
                        <label for="class">Class *:</label>
                        <input type="text" name="Class" id="class" required="required" class="data-input-element">
                    </div>
                    <div class="msf-step-input-field flex-column">
                        <label for="subject">Subject *:</label>
                        <input type="text" name="Subject" id="subject" required="required" class="data-input-element">
                    </div>
                </div>

                <div class="msf-step-input" id="step3">
                    <h3>Step 3</h3>
                    <div class="msf-step-input-field flex-column">
                        <label for="age">Age *:</label>
                        <input type="text" name="Age" id="age" required="required" class="data-input-element">
                    </div>
                    <div class="msf-step-input-field flex-column">
                        <label for="phone">Phone *:</label>
                        <input type="text" name="Phone" id="phone" required="required" class="data-input-element">
                    </div>
                </div>

                <div class="msf-step-input" id="step4">
                    <h3>Step 4</h3>
                    <div class="msf-step-input-field flex-column">
                        <label for="comment">Your Comment *:</label>
                        <input type="text" name="Comment" id="comment" required="required" class="data-input-element">
                    </div>
                    <div class="msf-step-input-field flex-column">
                        <label for="email">Your Email *:</label>
                        <input type="email" name="Email" id="email" required="required" class="data-input-element">
                    </div>
                </div>

            </div>
            <div id="message_area"> </div>
            <div class="msf-single-step msf-buttons">
                <button type="button" class="step pre target-btn" onclick="show_pre()">Previous</button>
                <button type="button" class="step next current target-btn" onclick="show_next()">Next</button>
                <button type="button" class="target-btn" id="submit_form" onclick="msf_submit()">Submit</button>
            </div>

        </div>
    </div>
</div>
<?php
return ob_get_clean();
}


// ajax process
function w1d_msf_process(){

    $html='<table>';
        foreach($_POST as $k=>$val){

            if($k=='formid'||$k=='action') continue;

            
                $html.='<tr>
                    <th>'.$k.'</th>
                    <td>:</td>
                    <td>'.$val.'</td>
                </tr>';
            
        }
        
    $html.='</table>';

    $headers = array('Content-Type: text/html;');
    $formid=$_POST["formid"];
    if($formid==1){
        // return form
        $subject='A return request received - Cloneona';
    }
    if($formid==2){
        // return form
        $subject='A file has been claimed - Cloneona';
    }
	
	if($formid==1){
        // return form
        $thanks_url='https://cloneona.com/return-submission-confirmation/';
    }
    if($formid==2){
        // return form
        $thanks_url='https://cloneona.com/warranty-submission-confirmation/';
    }
	

    $to=get_bloginfo('admin_email');
    
    //$to='shahk06@gmail.com';

    wp_mail($to,$subject,$html,$headers);

    echo json_encode(['status'=>'ok','url'=> $thanks_url ]);

    
    $f_id=$_POST["formid"];
    $f_name=$_POST["Name"];
    $f_role=$_POST["Role"];
    $f_class=$_POST["Class"];
    $f_sub=$_POST["Subject"];
    $f_age=$_POST["Age"];
    $f_pho=$_POST["Phone"];
    $f_com=$_POST["Comment"];
    $f_email=$_POST["Email"];

    // $db=new mysqli('localhost','root','','test');
    // $result = mysqli_query($db,"INSERT INTO student (name, role, class, sub, age, pho, com, email, formid) VALUES('$f_name','$f_role','$f_class','$f_sub','$f_age','$f_pho','$f_com','$f_email','$f_id')");

    global $wpdb;
    $sql="INSERT INTO student (name, role, class, sub, age, pho, com, email, formid) VALUES('$f_name','$f_role','$f_class','$f_sub','$f_age','$f_pho','$f_com','$f_email','$f_id')";
    $wpdb->query($sql);

    exit();
}

add_action("wp_ajax_w1d_msf_process", "w1d_msf_process");
add_action("wp_ajax_nopriv_w1d_msf_process", "w1d_msf_process");

//do_action('wp_ajax_'.$_POST["action"]);

// remove updated widgets style
function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}

add_action("admin_menu", "datatable_admin_page");
function datatable_admin_page() {
    add_menu_page(
        __('Data Table', 'tabledata'),
        __('Data Table', 'tabledata'),
        'manage_options',
        'dbdemo',
        'dbdemo_admin_page'
    );
}
function dbdemo_admin_page() { // this funtion show data in admin page

    global $wpdb;
    // nonce checking
    if(isset($_GET['pid'])) {
        if(!isset($_GET['n']) || !wp_verify_nonce($_GET['n'], "dbdemo_edit")){
            wp_die(__("Sorry you are not authorized to do this", "database-demo"));
        }

        if(isset($_GET['action']) && $_GET['action']=='delete'){
            $wpdb->delete("student", ['id'=> sanitize_key($_GET['pid'])]);
            $_GET['pid'] = null;
        }

    }

    global $wpdb;
    echo "<h2>Student</h2>";
    $id = $_GET['pid'] ?? 0;
    $id = sanitize_key($id); // sanitize for protect check

    if ($id) {
        $result = $wpdb->get_row("select * from student WHERE id='{$id}'");
        if($result) {
            echo "Name: {$result->name}<br/>";
            echo "Email: {$result->email}<br/>";
        }
    }
    ?>
    <div class="notice notice-success is-dismissible">
        <p>Some Error Information</p>
    </div>
<div class="form_box">
    <div class="form_box_header">
        <?php _e('Data Form', 'database-demo') ?>
    </div>
    <div class="form_box_content">
        <form action="<?php echo admin_url('admin-post.php'); ?>" method="POST">
            <?php 
            wp_nonce_field('dbdemo', 'nonce');
            ?>
            <input type="hidden" name="action" value="dbdemo_add_record">
            Name: <input type="text" value="<?php if($id) echo $result->name; ?>" name="name"><br/>
            Email: <input type="email" value="<?php if($id) echo $result->email; ?>" name="email"> <br/>
            <?php 
            if ($id) {
                # code...
                echo '<input type="hidden" name="id" value="'.$id.'">';
                submit_button("Update Record");
            }else {
                submit_button("Add Record");
            }
            ?>
        </form>
    </div>
</div>
<div class="form_box">
    <div class="form_box_header">
        <?php _e('Users', 'database-demo') ?>
    </div>
    <div class="form_box_content">
        <?php 
            global $wpdb;
            $dbdemo_users = $wpdb->get_results("SELECT id, name, email FROM student ORDER BY id DESC", ARRAY_A);

            // print_r($dbdemo_users);
            $dbtu = new DBTableUsers($dbdemo_users);
            $dbtu->prepare_items();
            $dbtu->display();
        ?>
    </div>
</div>

    
<?php

}
add_action('admin_post_dbdemo_add_record', function(){

global $wpdb;
$nonce = sanitize_text_field($_POST['nonce']);
if(wp_verify_nonce($nonce, 'dbdemo')) {
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_text_field($_POST['email']);
    $id = sanitize_text_field($_POST['id']);
    
    if ($id) {
        # code...
        $wpdb->update("student", ['name' => $name, 'email' => $email], ['id'=>$id]);
        $nonce = wp_create_nonce("dbdemo_edit");

        wp_redirect(admin_url('admin.php?page=dbdemo&pid='.$id."&n={$nonce}"));
    } else {
        $wpdb->insert("student", ['name' => $name, 'email' => $email]);
        wp_redirect(admin_url('admin.php?page=dbdemo'));

    }
}

});











// ######## >>>> Start Notification <<<< ########
// add notification_bar Short Code
add_shortcode('notification_bar','notification_bar_fun');
function notification_bar_fun(){
	ob_start(); ?>

<style></style>
<div class="notification_bar">
<?php
if ( is_user_logged_in() ) {
    $user = wp_get_current_user();
    $current_user_id = $user->ID;
    $current_user_name = $user->display_name;
    $current_user_f_name = $user->first_name;
    $current_user_l_name = $user->last_name;
	echo '
    <div class="n_wrap">
      <div class="n_left">
        <h2>Halló '.$current_user_name.'!</h2>
        <p>Hvað má bjóða þér í dag?</p>
      </div>
      <div class="n_right">
        <img src="https://svens.is/wp-content/uploads/2022/11/right-man.png" alt="">
      </div>
    </div>
    ';
} else {
	echo '
    <div class="n_wrap">
      <div class="n_left">
        <h2>Fyrst þetta leiðinlegä.</h2>
        <p>En svo verður þetta skemmtilegt. Ég lofa!</p>
      </div>
      <div class="n_right">
        <img src="https://svens.is/wp-content/uploads/2022/11/right-man.png" alt="">
      </div>
    </div>
    ';
}
?>
    


  </div>

<?php
    return ob_get_clean();
}
// ######## >>>> The end Notification <<<< ########


// hooks edit My Account page 
add_action( 'woocommerce_before_customer_login_form', 'notification_add');
function notification_add() {
    echo do_shortcode('[notification_bar]');
    // if(isset($_GET['abcd'])){
    //     echo do_shortcode('[notification_bar]');
    // }
}


// hooks edit My Account page 
add_action( 'woocommerce_before_account_navigation', 'notification_add_dash');
function notification_add_dash() {
    // if(isset($_GET['abcd'])){
    //     echo do_shortcode('[notification_bar]');
    // }
    echo do_shortcode('[notification_bar]');
    
}

// hooks add Checkout Notification page 
add_action( 'woocommerce_before_checkout_form', 'checkout_form_add_notification');
function checkout_form_add_notification() {
    
        echo '
<div class="notification_bar">
    <div class="n_wrap">
    <div class="n_left">
        <h2>Mundu að vistä!.</h2>
        <p>Ef þú vistar kortaupplýsingar þarft þú ekki að setja þær inn næst þegar þú kaupir</p>
    </div>
    <div class="n_right">
        <img src="https://svens.is/wp-content/uploads/2022/11/right-man.png" alt="">
    </div>
    </div>
</div>
        ';
    
}

add_action('wp_head', 'get_custom_script_ini');
function get_custom_script_ini(){

    if ( is_wc_endpoint_url() ) {
        echo '
    	<style>
            .checkout-notification {
                display: none;
            }
        </style>';
    }

}


// Redirect Woocommerce to a custom page after checkout
add_action('woocommerce_thankyou', 'redirect_after_checkout');
function redirect_after_checkout($order_id) {
    $order = wc_get_order($order_id);
    $cname = $order->get_billing_first_name();
    $user = base64_encode($cname);
    $url = 'http://localhost/tanvir/home/?thanks='.$user;
    if(!$order->has_status('failed')) {
        wp_safe_redirect($url);
        exit;
    }
}

// add notification home Or Thanks page Short Code
add_shortcode('notification_thanks','n_thanks_fun');
function n_thanks_fun(){
	ob_start(); 
    
    if(isset($_GET['thanks'])) {
    $username = base64_decode($_GET['thanks']);
    echo '
    <div class="n_left">
        <h2>Takk fyrir viðskiptin, '.$username.'.</h2>
        <p>Nú tökum við saman pöntunina. Má bjóða þér að skoða eitthvað fleira?</p>
    </div>
    ';
    }

    return ob_get_clean();
}


// add javaScript hook for footer 
add_action('wp_footer', 'get_footer_script');
function get_footer_script(){
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
    const el = document.createElement("div");
    el.innerHTML = `<a href="https://svens.is/collections/frontpage/" class="empty_btn">Fara í vefverslun</a>`;
    const box = document.getElementsByClassName("woocommerce-mini-cart__empty-message");
    // const box = document.getElementById('message');
    box[0].appendChild(el);
</script>
<?php
}
// $order_id = 97176;
// $order = wc_get_order( $order_id );
// $items = $order->get_items();

// foreach ( $items as $item ) {
//     $product_name = $item->get_name();
//     $product_id = $item->get_product_id();
//     $product_variation_id = $item->get_variation_id();

//     // echo $product_name." ".$product_id;
// }
// $product = wc_get_product( $product_id );
// $product->get_type();
// echo $product->get_name();




// WooCommerc hook mini cart page woocommerce_after_mini_cart
// add_action( 'woocommerce_after_cart', 'micart_add_btn');
// function micart_add_btn() {

//     echo "Add Button by Tanvir";
//     // if(isset($_GET['abcd'])){  url ?abcd dea hit korta hoba
//     //     echo do_shortcode('[notification_bar]');
//     // }

// }
add_filter( 'woocommerce_add_to_cart_validation', 'allowed_quantity_per_category_in_the_cart', 10, 2 );
function allowed_quantity_per_category_in_the_cart( $passed, $product_id) {}
