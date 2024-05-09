<?php
# C:\xampp\htdocs\wp\wp-content\themes\astra-child\woocommerce\single-product\add-to-cart\variation-add-to-cart-button.php

add_action('wp_footer', 'get_fetch_price_script');
function get_fetch_price_script(){
?>
<style>
    #attendeeInput tr:nth-child(n) {
        background-color: #e8f2ec;
    }
    #attendeeInput tr:nth-child(2n+1) {
        background-color: #ffffff;
    }
    .loding{ 
        animation: rotetSpin 3s linear infinite; 
        display: inline-block; 
        font-size: 18px; 
        line-height: 0; 
    }
    @keyframes rotetSpin { 
        0%{ transform: rotate(360deg); } 
        100%{ transform: rotate(0deg); } 
    }
    .error {
        color: red;
    }
</style>
<select name="wt_number_adult">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select>
<script>

    // add your javaScript here
    let table_tr = `
    <tr>
        <td class="a_kt_f">
            <input type="text" name="attendee_kt[]" placeholder="Kennitala" required class="attendee_kt">
        </td>
        <td>
            <input type="text" name="attendee_name[]" placeholder="Fullt nafn" required class="attendee_name">
        </td>
        <td>
            <input type="email" name="attendee_email[]" placeholder="Netfang" required >
        </td>
        <td>
            <input type="text" name="attendee_phone[]" placeholder="Sími" required >
        </td>
    </tr>
    `;

    jQuery(document).on('change','select[name=wt_number_adult]',function() {
        // Get the selected value
        let qtyVal = jQuery(this).val();
        
        jQuery('#attendeeInput').html('');
        for(let i = 0; i < qtyVal; i++){
            jQuery('#attendeeInput').append(table_tr);
        }
    });

// Form submit function onclick='singleCheckout()'
// jQuery("form.variations_form.cart.exdpk-initialized").submit(function(event) {
//     event.preventDefault();
function singleCheckout(){
    let pid= jQuery('input[name=wt_tourid]').val().trim();
    let tourDate= jQuery('input[name=wt_date_submit]').val().trim();
    let room    = jQuery('select[name=attribute_herbergi]').val().trim();
    let payment = jQuery('input[name=payment_method]:checked').val().trim();
    let coupon  = jQuery('input[name=coupon_code]').val().trim();
    let note    = jQuery('textarea[name=customer_note_to_kvan]').val().trim();
    
    jQuery('.error').remove(); // Reset any previous error messages
    
    // validation ;
    let isValid = true;
    if(!tourDate){
        jQuery('input[name=wt_date_submit]').css('border','1px solid red');
        jQuery('input[name=wt_date_submit]').focus();
        jQuery('input[name=wt_date_submit]').after(`<p class='error'>Date is required</p>`);
        isValid = false;
    }else{
        jQuery('input[name=wt_date_submit]').css('border','0px solid red');
        jQuery('input[name=wt_date_submit]').after(` `);
    }
    
    if(!room){
        jQuery('select[name=attribute_herbergi]').css('border','1px solid red');
        jQuery('select[name=attribute_herbergi]').focus();
        jQuery('select[name=attribute_herbergi]').after(`<p class='error'>Room is required</p>`);
        isValid = false;
    }else{
        jQuery('select[name=attribute_herbergi]').css('border','0px solid red');
        jQuery('select[name=attribute_herbergi]').after(` `);
    }
    
    // Iterate through each row in the table body
    jQuery('#attendeeInput tr').each(function() {
        // Get input fields in the current row
        let kt = jQuery(this).find('.attendee_kt').val().trim();
        let name = jQuery(this).find('.attendee_name').val().trim();
        let email = jQuery(this).find('[name="attendee_email[]"]').val().trim();
        let phone = jQuery(this).find('[name="attendee_phone[]"]').val().trim();

        // Perform validation
        if (kt === '' || name === '' || email === '' || phone === '') {
            isValid = false;
            alert('Please fill out all fields in the attendee information section.');
        }
    });
    

    // isValid = false;
    if(isValid){

        jQuery('#sms').html(`<b>Wait..</b> <span class='loding'>&#10044;</span>`);
        // ajax call 

        let attendeeData = [];
        jQuery('#attendeeInput tr').each(function() {
            let attendee = {
                kt: jQuery(this).find('.attendee_kt').val().trim(),
                name: jQuery(this).find('.attendee_name').val().trim(),
                email: jQuery(this).find('[name="attendee_email[]"]').val().trim(),
                phone: jQuery(this).find('[name="attendee_phone[]"]').val().trim()
            };
            attendeeData.push(attendee);
        });

        let allAttendee = JSON.stringify(attendeeData);

    
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo admin_url('admin-ajax.php')?>',
            data: {
                action: 'get_single_checkout_data',
                pid: pid,
                room: room,
                payment: payment,
                coupon: coupon,
                note: note,
                tdate: tourDate,
                attendee: allAttendee
            },
            success: function(response) {
                if ( ! response || response.error ) return;
                jQuery('#sms').html(` `);

                if (response.status == 'ok') {
                    jQuery('#sms').html(`${response.sms}`);
                } else { 
                    jQuery('#sms').html(`<p class='error'>Some problam</p>`);
                }
            }
        });
    }

}
    

</script>
<?php 
}
function kvantravel_check_if_coupon_is_valid($coupon_code) {
    // Try to get the coupon ID by code
    $coupon_id = wc_get_coupon_id_by_code($coupon_code);

    // If there's no such coupon, return false
    if (empty($coupon_id)) {
        return false;
    }

    // Instantiate the coupon object
    $coupon = new WC_Coupon($coupon_id);

    // Check if the coupon exists
    if (!$coupon->get_id()) {
        return false;
    }

    // Check if the coupon is expired
    if ($coupon->get_date_expires() && $coupon->get_date_expires()->getTimestamp() < time()) {
        return false;
    }

    // Check usage limit
    if ($coupon->get_usage_limit() > 0 && $coupon->get_usage_count() >= $coupon->get_usage_limit()) {
        return false;
    }

    // Additional checks can be added here (e.g., user usage limit, product/category restrictions, etc.)

    // If all checks pass, the coupon is valid
    return true;
}
// Form data ajax process & Email Send
function get_single_checkout_data() {
    
    $room       = sanitize_text_field($_POST['room']);
    $couponCode = sanitize_text_field($_POST['coupon']);
    $product_id = sanitize_text_field($_POST['pid']);
    $paymentM   = sanitize_text_field($_POST['payment']);
    $cNote      = sanitize_text_field($_POST['note']);
    $tdate      = sanitize_text_field($_POST['tdate']);
    $quantity   = 1;

    $cart     = WC()->cart;

    WC()->cart->add_to_cart( $product_id, $quantity );
    // apply coupon
    if($couponCode && kvantravel_check_if_coupon_is_valid($couponCode)){
        
        // Apply the coupon
        WC()->cart->apply_coupon($couponCode);
        WC()->cart->calculate_totals();

    } 
    
    $checkout = WC()->checkout();


    $customer   = stripslashes($_POST['attendee']);

    $attendees = json_decode($customer, true); 
    foreach ($attendees as $atte) {
        $kt = $atte['kt'];
        $name = $atte['name'];
        $email = $atte['email'];
        $phone = $atte['phone'];
    }

    $bKt    = sanitize_text_field($attendees[0]['kt']);
    $bName  = sanitize_text_field($attendees[0]['name']);
    $bEmail = sanitize_email($attendees[0]['email']);
    $bPhone = sanitize_text_field($attendees[0]['phone']);


    $data = array(
        'terms'                              => 1,
        'terms-field'                        => 1,
        'createaccount'                      => false ,
        'shipping_method'                    => '',
        'ship_to_different_address'          => 0,

        'billing_first_name'                 => $bName, 
        'billing_last_name'                  => $bKt, 
        'billing_country'                    => 'IS', // Replace with actual country code
        'billing_phone'                      => $bPhone,
        'billing_email'                      => $bEmail, 
        'order_comments'                     => $cNote,
        'woocommerce_checkout_update_totals' => true,
    );


    $cart_total=$cart->total;

    if( $cart_total > 0){
        $data['payment_method']=$paymentM; 
    }
    
    $order_id = $checkout->create_order($data);
    $order = wc_get_order( $order_id );
    $order->calculate_totals();
    // $order->add_order_note( $cNote, (int)$order->get_customer_id(), $order->get_user_id());
    $order->add_order_note( $cNote);

    if($cart_total>0){

    }else{
        $order->set_status('completed');
    }

    $order->calculate_totals();
    $order->save();
    
    $cart->empty_cart();

    if($cart_total>0){
        $payment_url = $order->get_checkout_payment_url(true);
    }else{
        $payment_url = $order->get_checkout_order_received_url();
    }

    echo json_encode(['status'=>'ok', 'url' => $payment_url, 'message'=>'done']);

    exit();

}

add_action('wp_ajax_get_single_checkout_data', 'get_single_checkout_data');
add_action('wp_ajax_nopriv_get_single_checkout_data', 'get_single_checkout_data');