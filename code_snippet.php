<?php

// add from Short code
add_shortcode('tanvir','short_code_fun');
function short_code_fun($jekono){ 
    $result = shortcode_atts(array( 
        'title' =>'',
    ),$jekono);
    extract($result);
    ob_start();
    ?>
    <!-- Start html code here  -->
    <style>
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
    </style>
    <form action="#">
        <label for="user_phone">Phone:</label><br>
        <input type="text" id="user_phone" name="user_phone" value="01795815660"><br>
        <label for="Email">Email:</label><br>
        <input type="email" id="Email" name="user_email" value="example@email.com"><br><br>
        <button type="button" onclick='formSubmit()' >Submit</button>

        <h4 id="sms"></h4>
    </form>
    <!-- End html code here  -->
    <?php
    return ob_get_clean();
}

add_action('wp_footer', 'get_fetch_price_script');
function get_fetch_price_script(){
    ?>
  <script>

    // Form submit function onclick='formSubmit()'
    function formSubmit() {
        let user_phone = jQuery('input[name=user_phone]').val().trim();
        let user_email=jQuery('input[name=user_email]').val().trim();
        
        jQuery('.error').remove(); // Reset any previous error messages
        
        // validation ;
        let isValid = true;
        if(!user_email){
            jQuery('input[name=user_email]').css('border','1px solid red');
            jQuery('input[name=user_email]').focus();
            jQuery('input[name=user_email]').after(`<p class='error'>A email number is required</p>`);
            isValid = false;
        }else{
            if(!isValidEmail(user_email) && user_email){
                jQuery('input[name=user_email]').css('border','1px solid red');
                jQuery('input[name=user_email]').focus();
                jQuery('input[name=user_email]').after(`<p class='error'>Enter a valid email address</p>`);
                isValid = false;
            }else{
                jQuery('input[name=user_email]').css('border','0px solid red');
                jQuery('input[name=user_email]').after(` `);
            }
        }
        
        if(!user_phone){
            jQuery('input[name=user_phone]').css('border','1px solid red');
            jQuery('input[name=user_phone]').focus();
            jQuery('input[name=user_phone]').after(`<p class='error'>A phone number is required</p>`);
            isValid = false;
        }else{
            if(user_phone.length!=7 && user_phone){
                jQuery('input[name=user_phone]').css('border','1px solid red');
                jQuery('input[name=user_phone]').focus();
                jQuery('input[name=user_phone]').after(`<p class='error'>Enter a valid phone number</p>`);
                isValid = false;
            }else{
                jQuery('input[name=user_phone]').css('border','0px solid red');
                jQuery('input[name=user_phone]').after(` `);
            }
        }
        
        if(isValid){
            
            jQuery('#sms').html(`<b>Wait..</b> <span class='loding'>&#10044;</span>`);
            // ajax call 
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo admin_url('admin-ajax.php')?>',
                data: {
                    action: 'get_data',
                    email: user_email,
                    name: user_phone
                },
                success: function(response) { 
                    if ( ! response || response.error ) return;
                    jQuery('#sms').html(` `);
                    if (response.status == 'ok') { 
                        jQuery('#sms').html(`${response.message}`);
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

// Form data ajax process & Email Send
function get_data() {
    $email = $_POST['email'];
    $name = sanitize_text_field($_POST['name']);
    $html='';
    $html.='<h4>Your Title</h4>';
    $to = 'tanvirmdalamint@gmail.com';
    // $to=get_bloginfo('admin_email');
    $subject = 'Your email Subject.';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail( $to, $subject, $html, $headers );
    $sms = 'Order Rearrange Done!';


    echo json_encode(['status'=>'ok', 'message' => $sms ]);
    exit(); // wp_die();
}
add_action('wp_ajax_get_data', 'get_data');
add_action('wp_ajax_nopriv_get_data', 'get_data');


