
<?php    
// funnel_landing_page
/*add_filter('cpsw_exclude_frontend_scripts',function($returnVal){
    return false;
},10,1);*/

echo "55555555555555555555555555555555";

add_action('wp_head', 'funnel_landing_page_style');
function funnel_landing_page_style(){
?>
<style>
/* .popup-model-main  */
    .single_entry_popup {
        text-align: center;
        overflow: hidden;
        position: fixed;
        top: 10px;
        right: 0;
        bottom: 0;
        left: 0;
        -webkit-overflow-scrolling: touch;
        outline: 0;
        opacity: 0;
        -webkit-transition: opacity 0.15s linear,z-index .15;
        -o-transition: opacity 0.15s linear,z-index .15;
        transition: opacity 0.15s linear,z-index .15;
        z-index: -1;
        overflow-x: hidden;
        overflow-y: auto;
    }
    .single_entry_popup .item-select {
        display: none;
    }
    .singleEntry, .popup-btn button  {
        cursor: pointer;
    }
    .popup-model-inner .cpsw-stripe-elements-form {
        margin-bottom: 18px;
    }


    /*popup css Start now*/
    .popup-wrap {

        width: 300px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        /*   height:100vh; */
    }
    .error{
        color:red;
    }
    .Click-here {
        cursor: pointer;
        transition: background-image 3s ease-in-out;
    }

    .popup-model-main {
        text-align: center;
        overflow: hidden;
        position: fixed;
        top: 10px;
        right: 0;
        bottom: 0;
        left: 0;
        -webkit-overflow-scrolling: touch;
        outline: 0;
        opacity: 0;
        -webkit-transition: opacity 0.15s linear, z-index 0.15;
        -o-transition: opacity 0.15s linear, z-index 0.15;
        transition: opacity 0.15s linear, z-index 0.15;
        z-index: -1;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .model-open {
        z-index: 99999;
        opacity: 1;
        overflow: hidden;
    }

    .popup-model-inner {
        -webkit-transform: translate(0, -25%);
        -ms-transform: translate(0, -25%);
        transform: translate(0, -25%);
        -webkit-transition: -webkit-transform 0.3s ease-out;
        -o-transition: -o-transform 0.3s ease-out;
        transition: -webkit-transform 0.3s ease-out;
        -o-transition: transform 0.3s ease-out;
        transition: transform 0.3s ease-out;
        transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
        display: inline-block;
        vertical-align: middle;
        width: 450px;
        margin: 30px auto;
        max-width: 97%;
    }

    .popup-model-wrap {
        display: block;
        width: 100%;
        position: relative;
        background-color: #fff;
        border: 1px solid #999;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
        box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
        background-clip: padding-box;
        outline: 0;
        text-align: left;
        padding: 20px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        max-height: calc(100vh - 70px);
        overflow-y: auto;
    }

    .pop-up-content-wrap p,
    .pop-up-content-wrap ol li {
        color: #000000;
        font-style: normal;
        text-transform: none;
        /* font-family: 'Lato'; */
        font-weight: 400;
        letter-spacing: normal;
        vertical-align: baseline;
        word-spacing: 0px;
        font-size: 16px;
        line-height: 24px;
        margin-bottom: 0.5em;
    }

    .pop-up-content-wrap h3 {
        font-size: 24px;
        /* line-height: 1.28205em;
        margin-top: 1.28205em;
        margin-bottom: 1.28205em; */
    }

    .model-open .popup-model-inner {
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        transform: translate(0, 0);
        position: relative;
        z-index: 999;
    }

    .model-open .bg-overlay {
        background: #000000;
        z-index: 99;
        opacity: 0.85;
    }

    .bg-overlay {
        background: rgba(0, 0, 0, 0);
        height: 100vh;
        width: 100%;
        position: fixed;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        -webkit-transition: background 0.15s linear;
        -o-transition: background 0.15s linear;
        transition: background 0.15s linear;
    }

    .close-btn {
        position: absolute;
        right: -6px;
        top: -18px;
        cursor: pointer;
        z-index: 99;
        font-size: 25px;
        color: #ffffff;
        background: black;
        border: 2px solid #fff;
        padding: 4px 9px;
        border-radius: 20px;
        font-weight: bold;
    }

    /*popup css The end*/

    /* popup open innerContent On */
    .logo-popup {
        text-align: center;
        margin-bottom: 16px;
    }

    .popup-inner-content {}

    .popup-inner-content .title_pop {
        text-align: center;
        margin-bottom: 20px;
    }

    .input-fild input {
        width: 100%;
        margin-bottom: 18px;
        border-radius: 4px;
        padding: 6px 10px;
        font-size: 14px;
        border: 0;
        box-shadow: 2px 3px 4px #eae5e5;
    }

    .popup-inner-content tbody tr th {
        padding: 14px;
        text-align: center;
    }

    .popup-btn button {
        display: block;
        width: 100%;
        border: 0;
        margin: 16px 0;
        padding: 8px;
        color: #fff;
        background: #b28a54;
    }

    .popup-inner-content tr td {
        font-size: 14px;
    }

    .popup-inner-content tr td label {
        cursor: pointer;
    }
    .containerInner img {
        border: 0;
        box-shadow: none;
    }
    .woox_popup_modal .cpsw-stripe-info {
        display: none;
    }
    .woox_popup_modal .cpsw-stripe-elements-form {
        border: 1px solid #ddd;
    }
    /* popup open innerContent Off */


    .gift_loding{
        animation: rotetSpin 3s linear infinite;
        display: inline-block;
        font-size: 18px;
        line-height: 0;
    }

    @keyframes rotetSpin {
        0%{
            transform: rotate(0deg);
        }
        100%{
            transform: rotate(360deg);
        }
    }

</style>

<?php 
}



add_action('wp_footer', 'funnel_landing_page_script',999);
function funnel_landing_page_script(){
?>

<div class="popup-wrap">

    <!-- <div class="Click-here">Click button</div> -->
    <div class="popup-model-main">
        <div class="popup-model-inner">
            <div class="close-btn">×</div>
            <div class="popup-model-wrap">
                <div class="pop-up-content-wrap">

                    <div class="containerInner" style="">
                        <div class="logo-popup">
                            <img src="https://eminentaustralia.com/wp-content/uploads/2022/07/Artboard-3.svg" width="50">
                        </div>

                        <div class="popup-inner-content">
                            <div class="title_pop">
                                <h3><b>Become a VIP with Eminent Australia</b></h3>
                                <b>Join Now! to Gain Instant Access to Membership Perks and Entries.</b>
                            </div>
                            
                            <div class="input-fild">
                                <?php 
                                
                                    $user_id = get_current_user_id(); 

                                    $user_data = get_userdata($user_id);

                                    if ($user_data) {
                                        $username = $user_data->user_login;
                                        $user_email = $user_data->user_email;
                                        $display_name = $user_data->display_name;

                                        $billing_address = get_user_meta($user_id, 'billing_city', true);
                                        $billing_postcode = get_user_meta($user_id, 'billing_postcode', true);
                                        $phone_number = get_user_meta($user_id, 'billing_phone', true);


                                    } else{
                                        $username = "";
                                        $user_email = "";
                                        $display_name = "";

                                        $billing_address = "";
                                        $billing_postcode = "";
                                        $phone_number = "";
                                    }
                                
                                ?>
                                <input type="text" placeholder="Your Full Name" value="<?php echo $display_name; ?>" name="name">
                                <input type="number" placeholder="Your Phone Number Here" value="<?php echo $phone_number; ?>" name="phone">
                                <input type="text" placeholder="Your Billing Address" value="<?php echo $billing_address; ?>" name="address">
                                <input type="text" placeholder="Your Billing Postcode" value="<?php echo $billing_postcode; ?>" name="zip">
                                <input type="email" placeholder="Your Email Address" value="<?php echo $user_email; ?>" name="email">
                            </div>

                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td class="" width="70%"><b>Item</b></td>
                                        <th width="30%"><b>Price</b></th>
                                    </tr>
                                    <!-- checked -->
                                    <?php
                                        $membership_items=array(
                                            1770,
                                            1772,
                                            1773
                                        );
                                        $i=1;
                                        foreach($membership_items as $item){
                                            $_product=wc_get_product($item);
                                            $id=$_product->get_id();
                                            $name=$_product->get_name();
                                            $price=$_product->get_price();
                                            $price_html=$_product->get_price_html();
                                            echo'<tr>
                                                <td><input type="radio" id="purchase'.$id.'" name="purchase" '.($i===1?'checked':'').' value="'.$id.'"> <label for="purchase'.$id.'">'.$name.'</label></td>
                                                <td>'.$price_html.'</td>
                                            </tr>';
                                            $i++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                             
                            <?php
                            
                                $gateways = WC()->payment_gateways->get_available_payment_gateways();
                                foreach($gateways as $gateway){
                                    if($gateway->id==='cpsw_stripe'){
                                    echo'<div class="input_group woox_popup_modal">
                                            <div style="display:none;">
                                            <input type="radio" id="payment_method_'.$gateway->id.'" value="'.$gateway->id.'" name="payment_method" '.($i==0?'checked':'').' data-title="'.__($gateway->title,'woocommerce').'"/>
                                            </div>
                                            <label for="'.$gateway->id.'"><b>';
                                            echo $gateway->title;
                                            echo' *:</b></label>';

                                            if ( $gateway->has_fields()){
                                                echo $gateway->payment_fields();
                                            }
                                            
                                        echo'</div>';
                                    }
                                            
                                }
                            
                            ?>
                            <table width="100%" style="display: table;">
                                <tbody>
                                    <tr>
                                        <td class="" width="70%"><b>Item</b></td>
                                        <th width="30%"><b>Amount</b></th>
                                    </tr>
                                    <tr id="selectProductPrice">
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table> 



                            <div id="sms"></div>
                            <div class="popup-btn" id="popup-submit-btn">
                                <button type="button" onclick="checkOutSubmit()">SUBMIT</button>
                            </div>
                            <div class="popup-payment-img">
                                <img src="//lmctgiveaway.com/hosted/images/87/0be13470a6448195aa9777557100e5/secure-stripe-payment-logo-amex-master-visa.png"
                                    style="width:100%;">
                            </div>
                        </div>

                    </div>




                </div>
            </div>
        </div>
        <div class="bg-overlay"></div>
    </div>

    <!-- <div class="singleEntry">Click button</div> -->
    <div class="single_entry_popup">
        <div class="popup-model-inner">
            <div class="close-btn">×</div>
            <div class="popup-model-wrap">
                <div class="pop-up-content-wrap">

                    <div class="containerInner" style="">
                        <div class="logo-popup">
                            <img src="https://eminentaustralia.com/wp-content/uploads/2022/07/Artboard-3.svg" width="50">
                        </div>

                        <div class="popup-inner-content">
                            <div class="title_pop">
                                <h3><b>Become a VIP with Eminent Australia</b></h3>
                                <b>Join Now! to Gain Instant Access to Membership Perks and Entries.</b>
                            </div>
                            <div class="input-fild">
                                <?php 
                                
                                    $user_id = get_current_user_id(); 
                                    $user_data = get_userdata($user_id);

                                    if ($user_data) {
                                        $username = $user_data->user_login;
                                        $user_email = $user_data->user_email;
                                        $display_name = $user_data->display_name;

                                        $billing_address = get_user_meta($user_id, 'billing_city', true);
                                        $billing_postcode = get_user_meta($user_id, 'billing_postcode', true);
                                        $phone_number = get_user_meta($user_id, 'billing_phone', true);

                                    } else{
                                        $username = "";
                                        $user_email = "";
                                        $display_name = "";

                                        $billing_address = "";
                                        $billing_postcode = "";
                                        $phone_number = "";
                                    }
                                
                                ?>
                                <input type="text" placeholder="Your Full Name" value="<?php echo $display_name; ?>" name="name">
                                <input type="number" placeholder="Your Phone Number Here" value="<?php echo $phone_number; ?>" name="phone">
                                <input type="text" placeholder="Your Billing Address" value="<?php echo $billing_address; ?>" name="address">
                                <input type="text" placeholder="Your Billing Postcode" value="<?php echo $billing_postcode; ?>" name="zip">
                                <input type="email" placeholder="Your Email Address" value="<?php echo $user_email; ?>" name="email">
                            </div>

                            <table width="100%">
                                <tbody class="item-select">
                                    <tr>
                                        <td class="" width="70%"><b>Item</b></td>
                                        <th width="30%"><b>Price</b></th>
                                    </tr>
                                    <!-- checked -->
                                    <?php
                                        $membership_items=array(
                                            3351,
                                            3345,
                                            3352
                                        );
                                        $se=1;
                                        foreach($membership_items as $item){
                                            $_product=wc_get_product($item);
                                            $id=$_product->get_id();
                                            $name=$_product->get_name();
                                            $price=$_product->get_price();
                                            $price_html=$_product->get_price_html();
                                            echo'<tr>
                                                <td><input type="radio" id="purchase'.$id.'" name="purchase" '.($se===1?'checked':'').' value="'.$id.'"> <label for="purchase'.$id.'">'.$name.'</label></td>
                                                <td>'.$price_html.'</td>
                                            </tr>';
                                            $se++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                                $gateways = WC()->payment_gateways->get_available_payment_gateways();
                                foreach($gateways as $gateway){
                                    if($gateway->id==='cpsw_stripe'){
                                    echo'<div class="input_group woox_popup_modal2">
                                            <div style="display:none;">
                                            <input type="radio" id="payment_method_'.$gateway->id.'" value="'.$gateway->id.'" name="payment_method" '.($se==0?'checked':'').' data-title="'.__($gateway->title,'woocommerce').'"/>
                                            </div>
                                            <label for="'.$gateway->id.'"><b>';
                                            echo $gateway->title;
                                            echo' *:</b></label>';

                                            if ( $gateway->has_fields()){
                                                echo $gateway->payment_fields();
                                            }
                                            
                                        echo'</div>';
                                    }
                                            
                                }

                            ?>
                            <table width="100%" style="display: table;">
                                <tbody>
                                    <tr>
                                        <td class="" width="70%"><b>Item</b></td>
                                        <th width="30%"><b>Amount</b></th>
                                    </tr>
                                    <tr id="selectProductPrice">
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table> 



                            <div id="single-entry-sms"></div>
                            <!-- single_entry -->
                            <div class="popup-btn" id="single-entry-submit-btn">
                                <button type="button" onclick="singleEntyCheckOutSubmit()">SUBMIT</button>
                            </div>
                            <div class="popup-payment-img">
                                <img src="//lmctgiveaway.com/hosted/images/87/0be13470a6448195aa9777557100e5/secure-stripe-payment-logo-amex-master-visa.png"
                                    style="width:100%;">
                            </div>
                        </div>

                    </div>




                </div>
            </div>
        </div>
        <div class="bg-overlay"></div>
    </div>





</div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>

        // console.log('jjjjjjjjjjjjjjjjjj');
        
        var pstripe=Stripe("pk_test_51KHPYGEMvPCzTTxbd6Wtz7sWdJGeCSeDXxMJBGB8XtIUYUWlnrhmCDjp5BOuh61h1zYHx1sbDDqQGwFlexLlPDyx00o3VJyrpq"),
		  pelements=pstripe.elements(),
		  pstyle={base:{fontSize:"16px",color:"#32325d"}},
		  pcard=pelements.create("card",{hidePostalCode: true,style:pstyle});
          pcard.mount( '.woox_popup_modal .cpsw-stripe-elements-form .cpsw-cc' );

          var pstripe2=Stripe("pk_test_51KHPYGEMvPCzTTxbd6Wtz7sWdJGeCSeDXxMJBGB8XtIUYUWlnrhmCDjp5BOuh61h1zYHx1sbDDqQGwFlexLlPDyx00o3VJyrpq"),
		  pelements2=pstripe2.elements(),
		  pstyle={base:{fontSize:"16px",color:"#32325d"}},
		  pcard2=pelements2.create("card",{hidePostalCode: true,style:pstyle});
          pcard2.mount( '.woox_popup_modal2 .cpsw-stripe-elements-form .cpsw-cc' );

          jQuery( '.woox_popup_modal .cpsw-stripe-elements-form div' ).css( { backgroundColor: '#fff', padding: '1em' } );

          //jQuery("#wc-footy_stripe-cc-form").show();
        jQuery(document).ready(function() {

            jQuery('.containerInner input[type="number"]').on('wheel', function(event){
                event.preventDefault();
            });

            jQuery(".selectPrice, .singleEntry").on('click', function(){

                let dataId = jQuery(this).attr("data-id");

                let checkBox = jQuery("input[name=purchase]:checked").prop('checked', false);
                // Find the radio button with the matching value
                let radioBtn = jQuery("input[name=purchase][value='" + dataId + "']");

                // If the radio button exists, check it
                if (radioBtn.length > 0) {
                    radioBtn.prop("checked", true);
                } 

                var selectedText = radioBtn.next('label').text();
                var selectedPrice = radioBtn.parent().next('td').text();
                jQuery('#selectProductPrice td:first-child').text(selectedText);

                let price = selectedPrice.split('/');
                jQuery('#selectProductPrice td:last-child').text(selectedPrice);
                //jQuery('#totalPrice').text(price[0]);

                jQuery(".popup-model-main").addClass('model-open');
            });

            jQuery(".Click-here, .sing-me-up-btn").on('click', function () {
                jQuery(".popup-model-main").addClass('model-open');
            });

            jQuery(".singleEntry").on('click', function () {
                jQuery(".single_entry_popup").addClass('model-open');
            });

            jQuery(".close-btn, .bg-overlay").click(function () {
                jQuery(".popup-model-main, .single_entry_popup").removeClass('model-open');
            });
            // jQuery('.woocommerce-checkout button[name="woocommerce_checkout_place_order"]').text('ENTER NOW'); 
            jQuery('input[name="purchase"]').change(function() {
                var selectedText = jQuery('input[name="purchase"]:checked').next('label').text();
                var selectedPrice = jQuery('input[name="purchase"]:checked').parent().next('td').text();
                jQuery('#selectProductPrice td:first-child').text(selectedText);

                let price = selectedPrice.split('/');
                jQuery('#selectProductPrice td:last-child').text(selectedPrice);
                //jQuery('#totalPrice').text(price[0]);
            });

            
            
        });
        

        // Form submit function onclick='checkOutSubmit()'
        function checkOutSubmit() {
            let popupName    = jQuery('.popup-inner-content').find("input[name=name]").val().trim();
            let popupPhone   = jQuery('.popup-inner-content').find("input[name=phone]").val().trim();
            let popupEmail   = jQuery('.popup-inner-content').find("input[name=email]").val().trim();
            let popupAddress = jQuery('.popup-inner-content').find("input[name=address]").val().trim();
            let popupZip     = jQuery('.popup-inner-content').find("input[name=zip]").val().trim();
            let stoken = '';
            let product_id = jQuery('.popup-inner-content').find("input[name=purchase]:checked").val();
            // validation 
            let isValid = true;

            // Reset any previous error messages
            jQuery('.popup-inner-content').find(".error").remove();

            // Validate item
            if (product_id === "") {
                alert('Membership package not selected!');
                isValid = false;
            }
            // Validate Full Name
            if (popupName === "") {
                jQuery("input[name='name']").after("<span class='error'>Please enter your full name</span>");
                isValid = false;
            }

            // Validate Phone Number
            if (popupPhone === "") {
                jQuery("input[name='phone']").after("<span class='error'>Please enter your phone number</span>");
                isValid = false;
            }

            // Validate Billing Address
            if (popupAddress === "") {
                jQuery("input[name='address']").after("<span class='error'>Please enter your billing address</span>");
                isValid = false;
            }

            // Validate Billing Postcode
            if (popupZip === "") {
                jQuery("input[name='zip']").after("<span class='error'>Please enter your billing postcode</span>");
                isValid = false;
            }

            // Validate Email Address
            if (popupEmail === "" || !isEmail(popupEmail)) {
                jQuery("input[name='email']").after("<span class='error'>Please enter your email address</span>");
                isValid = false;
            }


            //let isSepaSaveCardChosen=
            
            
            if(isValid){
                pstripe.createToken(pcard).then(function(result) {
                    if (result.error) {
                        // show error message
                        alert('error: '+result.error);
                    }else{
                        stoken=result.token.id;
                        
                        let selectedPrice= jQuery('.popup-inner-content').find("input[name=purchase]:checked").parent().next('td').text();
                        let price = selectedPrice.split('/');
                        let totalPrice   = price[0];

                        // WP Ajax Call with submit function
                        jQuery('#sms').html(`<b>Wait we are processing...</b>  `);
                        jQuery('#popup-submit-btn').html(`<button type="button" >SUBMIT <span class="gift_loding">&#10044;</spa> </button>`);
                        jQuery.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: '<?php echo admin_url('admin-ajax.php')?>',
                            data: {
                                action: 'popup_order_data',
                                name: popupName,
                                phone: popupPhone,
                                email: popupEmail,
                                address: popupAddress,
                                total: totalPrice,
                                zip: popupZip,
                                stoken:stoken,
                                product_id:product_id
                            },
                            success: function(response) { 
                                if ( ! response || response.error ) return;
                                jQuery('#sms').html(` `);
                                if(response.status == 'ok') {
                                    jQuery('#sms').html(`${response.message}`);
                                    jQuery('#popup-submit-btn').html(`<button type="button" onclick="checkOutSubmit()">SUBMIT</button>`);
                                    window.location.replace(response.redirect);
                                } else {
                                    jQuery('#popup-submit-btn').html(`<button type="button" onclick="checkOutSubmit()">SUBMIT</button>`);
                                    jQuery('#sms').html(`<p class='error'>Some problam</p>`);
                                }
                            
                            
                            }
                        });
                        
                    }
                });
            }

        }

        // Form submit function onclick='singleEntyCheckOutSubmit()'
        function singleEntyCheckOutSubmit() {
            let popupName    = jQuery('.popup-inner-content').find("input[name=name]").val().trim();
            let popupPhone   = jQuery('.popup-inner-content').find("input[name=phone]").val().trim();
            let popupEmail   = jQuery('.popup-inner-content').find("input[name=email]").val().trim();
            let popupAddress = jQuery('.popup-inner-content').find("input[name=address]").val().trim();
            let popupZip     = jQuery('.popup-inner-content').find("input[name=zip]").val().trim();
            let stoken = '';
            let product_id = jQuery('.popup-inner-content').find("input[name=purchase]:checked").val();
            // validation 
            let isValid = true;

            // Reset any previous error messages
            jQuery('.popup-inner-content').find(".error").remove();

            // Validate item
            if (product_id === "") {
                alert('Membership package not selected!');
                isValid = false;
            }
            // Validate Full Name
            if (popupName === "") {
                jQuery("input[name='name']").after("<span class='error'>Please enter your full name</span>");
                isValid = false;
            }

            // Validate Phone Number
            if (popupPhone === "") {
                jQuery("input[name='phone']").after("<span class='error'>Please enter your phone number</span>");
                isValid = false;
            }

            // Validate Billing Address
            if (popupAddress === "") {
                jQuery("input[name='address']").after("<span class='error'>Please enter your billing address</span>");
                isValid = false;
            }

            // Validate Billing Postcode
            if (popupZip === "") {
                jQuery("input[name='zip']").after("<span class='error'>Please enter your billing postcode</span>");
                isValid = false;
            }

            // Validate Email Address
            if (popupEmail === "" || !isEmail(popupEmail)) {
                jQuery("input[name='email']").after("<span class='error'>Please enter your email address</span>");
                isValid = false;
            }


            //let isSepaSaveCardChosen=
            
            
            if(isValid){
                pstripe2.createToken(pcard2).then(function(result) {
                    if (result.error) {
                        // show error message
                        alert('error: '+result.error);
                    }else{
                        stoken=result.token.id;
                        
                        let selectedPrice= jQuery('.popup-inner-content').find("input[name=purchase]:checked").parent().next('td').text();
                        let price = selectedPrice.split('/');
                        let totalPrice   = price[0];

                        // WP Ajax Call with submit function
                        jQuery('#single-entry-sms').html(`<b>Wait we are processing...</b>  `);
                        jQuery('#single-entry-submit-btn').html(`<button type="button" >SUBMIT <span class="gift_loding">&#10044;</spa> </button>`);
                        jQuery.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: '<?php echo admin_url('admin-ajax.php')?>',
                            data: {
                                action: 'popup_order_data',
                                name: popupName,
                                phone: popupPhone,
                                email: popupEmail,
                                address: popupAddress,
                                total: totalPrice,
                                zip: popupZip,
                                stoken:stoken,
                                product_id:product_id
                            },
                            success: function(response) { 
                                if ( ! response || response.error ) return;
                                jQuery('#single-entry-sms').html(` `);
                                if(response.status == 'ok') {
                                    jQuery('#single-entry-sms').html(`${response.message}`);
                                    jQuery('#single-entry-submit-btn').html(`<button type="button" onclick="singleEntyCheckOutSubmit()">SUBMIT</button>`);
                                    window.location.replace(response.redirect);
                                } else {
                                    jQuery('#single-entry-submit-btn').html(`<button type="button" onclick="singleEntyCheckOutSubmit()">SUBMIT</button>`);
                                    jQuery('#single-entry-sms').html(`<p class='error'>Some problam</p>`);
                                }
                            
                            
                            }
                        });
                        
                    }
                });
            }

        }

        // validation email
        function isEmail(email) {
            let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);

        }

    </script>
    <?php 
}

// add_filter( 'woocommerce_order_button_text', 'btcwc_order_button_text' ); 
// function btcwc_order_button_text() {
//     return __( 'ENTER NOW', 'woocommerce' ); 
// }

function split_name($name) {
    $name = trim($name);
    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
    return array($first_name, $last_name);
}
// Form data ajax process & Email Send
function popup_order_data() {

    $name   = sanitize_text_field($_POST['name']);
    $phone  = sanitize_text_field($_POST['phone']);
    $email  = sanitize_email($_POST['email']);
    $address= sanitize_text_field($_POST['address']);
    $zip    = sanitize_text_field($_POST['zip']);
    $total  = sanitize_text_field($_POST['total']);
    $stoken=sanitize_text_field($_POST['stoken']);
    $product_id=sanitize_text_field($_POST['product_id']);

    $bnameData=split_name($name);

    $address = array(
        'first_name' => $bnameData[0],
        'last_name'  => $bnameData[1],
        'email'      => $email,
        'phone'      => $phone,
        'address_1' => $address,
        'city'      => '',
        'postcode'  => $zip,
        'country'   => WC()->countries->get_base_country()
    );


    global $woocommerce;

    // Now we create the order
    $order = wc_create_order();

    if(is_user_logged_in()){
        $currentUser=wp_get_current_user();
        $order->set_customer_id( $currentUser->ID );
    }

    $order->add_product(wc_get_product($product_id) , 1);
    $order->set_address( $address, 'billing' );
    $order->calculate_totals();
    WC()->session->order_awaiting_payment = $order->id;
    $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
    $payment_method_id='cpsw_stripe';
    //update_post_meta( $order->id, '_payment_method', 'cpsw_stripe' );
    //update_post_meta( $order->id, '_payment_method_title', $available_gateways['cpsw_stripe']->title );
    $payment_method     = isset( $available_gateways[ $payment_method_id ] ) ? $available_gateways[ $payment_method_id ] : false;
    $order->set_payment_method( $payment_method );
    $order->save();

    require_once 'st_vendor/autoload.php';
    \Stripe\Stripe::setApiKey('sk_test_51KHPYGEMvPCzTTxbiMqAbuCFuYMxK3MEMsmTBhzTSu5epL9mvWY8xNlVr2GlcrqnvtBWAVSjXoHuPazF5nMoctB000rMhhwQQZ');
    
    $api_error='';
    $orderTotal=$order->get_total();
    // charge to customer
    try { 
        $charge = \Stripe\Charge::create([ 
            'amount' => ($orderTotal*100),
            'currency' => 'aud',
            'description' => 'Popup order',
            'source' => $stoken
        ]);
        update_post_meta( $order->id, '_transaction_id', $charge->id );
        $order->update_status( 'wc-wcf-main-order' );
        $return_url = $order->get_checkout_order_received_url();

        // Add a subscription to the order
        $subscriptions='';

        $product = wc_get_product($product_id);
        $product_type = $product->get_type();

        if($product_type==="subscription"){
            try {
                $transaction = new WCS_SQL_Transaction();
                $transaction->start();
                $args=array(
                    'order_id' => $order->get_id(),
                    'billing_period'=>'month',
                    'billing_interval'=>1,
                    'status'=>'active'
                );

                $subscriptions = wcs_create_subscription($args);
                $next_payment_date = date('Y-m-d H:i:s',strtotime("+1 month"));
                $subscriptions = wcs_copy_order_address( $order, $subscriptions );
                $subscriptions->update_dates(
                    array(
                        'next_payment' => $next_payment_date
                    )
                );
                $subscriptions->set_payment_method( $payment_method );

                $subscriptions->add_product(wc_get_product($product_id), 1);
                // Calculate subscription totals
                $subscriptions->calculate_totals();
                wcs_copy_order_meta( $order, $subscriptions, 'subscription' );
                // Save the subscription
                $subscriptions->save();
                $transaction->commit();
            }catch ( Exception $e ) {
                // There was an error adding the subscription
                $transaction->rollback();
                $subscriptions=new WP_Error( 'checkout-error', $e->getMessage() );
            }
        }


        if(!is_wp_error($subscriptions)){
            $sms = 'Order Received Done!';
            echo json_encode(['status'=>'ok', 'message' => $sms,'redirect'=>$return_url]);
            exit(); // wp_die();
        }else{
            $api_error='';
            $errors = $subscriptions->get_error_messages();
            foreach ($errors as $error) {
                $api_error.=$error.'<br/>';
            }
            echo json_encode(['status'=>'not-ok', 'message' => $api_error,'redirect'=>'']);
            exit(); // wp_die();
        }

    }catch(Exception $e) {  
        $api_error = $e->getMessage();  
        
    }
    
    if(!empty($api_error)){
        $sms = 'Order Received Done!';
        echo json_encode(['status'=>'not-ok', 'message' => $api_error,'redirect'=>'']);
        exit(); // wp_die();
    }
    

   
}
add_action('wp_ajax_popup_order_data', 'popup_order_data');
add_action('wp_ajax_nopriv_popup_order_data', 'popup_order_data');
