<?php

// Add new menu item in My Account page
function add_fundraising_menu_item( $items ) {
    // Add the new item after "Orders" or wherever you prefer
    $items['my-fundraising'] = __( 'Fundraising', 'your-text-domain' );
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'add_fundraising_menu_item' );

// Add endpoint for the new menu item
function fundraising_menu_item_endpoint() {
    add_rewrite_endpoint( 'my-fundraising', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'add-new-fundraising', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'fundraising_menu_item_endpoint' );

// Flush rewrite rules to make the new endpoint work
function activate_fundraising_endpoint() {
    fundraising_menu_item_endpoint();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'activate_fundraising_endpoint' );

// Remove rewrite rules on deactivation
function deactivate_fundraising_endpoint() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'deactivate_fundraising_endpoint' );

// Display content for the "Fundraising" endpoint
function fundraising_menu_item_content() {

    echo '<h3>Fundraising | <a href="'.get_site_url().'/my-account/add-new-fundraising/" class="button">New Fundrais</a> </h3>';
    echo '<p>Welcome to your fundraising dashboard. Here you can manage your campaigns.</p>';
    // Add more content or functionality here as needed
    
    // Get the current user ID
    $user_id = get_current_user_id();
    
    $campaign_query = new WP_Query( array(
        'post_type'      => 'campaign',
        'author'         => $user_id,
        'posts_per_page' => -1, // Change to a specific number if you want to limit results
        'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')
    ) );
    
    // Check if the user has any campaigns
    if ( $campaign_query->have_posts() ) {
        
        ?>
<table>
    <tr>
        <th><h2>Your Fundraising</h2></th>
    </tr>
    <tr>
        <th>Title</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
        <?php
        // Loop through the campaigns
        while ( $campaign_query->have_posts() ) {
            $campaign_query->the_post();
            $post_id = base64_encode(get_the_ID());
            
            echo '<tr>
                    <td><a href="' . get_permalink() . '">' . get_the_title() . '</a></td>
                    <td>'.get_post_status().'</td>
                    <td><a href="'.get_site_url().'/my-account/add-new-fundraising/?id='.$post_id.'" class="button">Edit</a></td>
                </tr>';
        }
        
        echo '</table>';
    } else {
        echo '<p>' . __( 'You have not created any Fundraising yet.', 'your-text-domain' ) . '</p>';
    }
    
    // Reset the post data after the custom query
    wp_reset_postdata();


}
add_action( 'woocommerce_account_my-fundraising_endpoint', 'fundraising_menu_item_content' );

function new_fundraising_menu_item_content(){

    if(isset($_GET['id'])){
        $id = base64_decode($_GET['id']);
    }else{
        $id = '';
    }
    // wp_get_single_post($id);
    $post = get_post($id);

    $editTitle   = $id?$post->post_title : '';
    $editContent = $id?$post->post_content : '';
    
    $result = get_post_meta( $id, '_campaign_suggested_donations', true );

    // $result = unserialize($btnUpdate);
    $buttons ='';
    if(is_array($result)){

        foreach ($result as $key => $value) {
            $buttons .= $result[$key]['amount']."-".$result[$key]['description'].',';
            // $result[$key]['description'];
        }

    }
    ?>
  

    <style>
        .loding{ animation: rotetSpin 3s linear infinite; display: inline-block; font-size: 18px; line-height: 0; }
        @keyframes rotetSpin { 0%{ transform: rotate(360deg); } 100%{ transform: rotate(0deg); } }
        .required,.error{
            color: red;
        }
        .success{
            color: green;
        }
    </style>
    <h2>New Fund</h2>
<form id="fundrais_form" enctype="multipart/form-data">
    
    <div class="program-details-form">
        <div class="two-col-input">
            <div class="program-details-form-input pdfi50">
                <label for="fundrais_title">Fundrais title <b class="required">*</b></label>
                <input type="text" id="fundrais_title" name="fundrais_title" required value="<?php echo $editTitle; ?>">
            </div>
            <div class="program-details-form-input pdfi50">
                <label for="fundrais_goal">Fundrais goal <b class="required">*</b></label>
                <input type="number" id="fundrais_goal" name="fundrais_goal" required value="<?php echo get_post_meta( $id, '_campaign_goal', true ); ?>">
            </div>
        </div>
        <div class="program-details-form-input pdfi100">
            <label for="fundrais_btns">Fundrais discription</label>
            <textarea id="txtid" name="fundrais_dis" rows="2" cols="" maxlength="200" placeholder="Leave short discription here" style="border-radius: 7px;"><?php echo $editContent; ?></textarea>
        </div>
        <div class="program-details-form-input pdfi100">
            <label for="fundrais_btns">Amounts button <b class="required">*</b></label>
            <input type="text" id="fundrais_btns" name="fundrais_btns" required placeholder="Ex: 5-title, 20-title, 50-title, 100-title" value="<?php echo $buttons; ?>">
        </div>
        <div class="two-col-input">
            <div class="program-details-form-input pdfi50">
                <label for="fundrais_day_left">Day left</label>
                <input type="number" id="fundrais_day_left" name="fundrais_day_left" value="<?php echo get_post_meta( $id, 'day_left', true ); ?>">
            </div>
            <div class="program-details-form-input pdfi50">
                <label for="fundrais_end_date">End date</label>
                <?php 
                if(isset($_GET['id'])){
                    echo '<input type="text" id="fundrais_end_date" name="fundrais_end_date" value="'.get_post_meta( $id, '_campaign_end_date', true ).'">
                    <input type="hidden" name="thumbnail_id" value="'.get_post_meta( $id, '_thumbnail_id', true ).'">
                    <input type="hidden" name="edit_id" value="'.$id.'">
                    ';
                }else{
                    echo '<input type="date" id="fundrais_end_date" name="fundrais_end_date">';
                }
                ?>
                
            </div>
        </div>
        <div class="program-details-form-input pdfi100 resumewrap">
            <input type="file" accept=".jpg,.png,.jpge" id="image" name="image">
            <label for="image">Upload your Thamnail Here</label>
            <div class="uploadedfile"></div>
        </div>
    </div>

    <button type="submit" class="button">Submit</button>

</form>
<h4 id="sms"></h4>

<script>
// add your javaScript here
jQuery("#fundrais_form").submit(function(event) {
    event.preventDefault();

    // validation
    let imageFile = jQuery('#image')[0].files[0];
    if(imageFile){
        let maxFileSize = 500000; // 500kb in bytes 500000
        let fileSize = jQuery('#image')[0].files[0].size; // Get the size of the selected file
        if (fileSize > maxFileSize) {
            alert('File size exceeds the maximum limit of 500kb.');
            // Clear the file input field
            jQuery('#image').val('');
            return false;
        }
    }
    

    let fundrais_title = jQuery('input[name=fundrais_title]').val().trim();
    let fundrais_goal = jQuery('input[name=fundrais_goal]').val().trim();
    let fundrais_btns = jQuery('input[name=fundrais_btns]').val().trim();
    let fundrais_day_left = jQuery('input[name=fundrais_day_left]').val().trim();
    let fundrais_end_date = jQuery('input[name=fundrais_end_date]').val().trim();
    let fundrais_dis = jQuery('textarea[name=fundrais_dis]').val().trim();
     
    jQuery('.error').remove(); // Reset any previous error messages
     
    // validation ;
    let isValid = true;
    
    if(!fundrais_title){
        jQuery('input[name=fundrais_title]').css('border','1px solid red');
        jQuery('input[name=fundrais_title]').focus();
        jQuery('input[name=fundrais_title]').after(`<p class='error'>Title is required</p>`);
        isValid = false;
    }else{
        jQuery('input[name=fundrais_title]').css('border','0px solid red');
        jQuery('input[name=fundrais_title]').after(` `);
    }

    if(!fundrais_goal){
        jQuery('input[name=fundrais_goal]').css('border','1px solid red');
        jQuery('input[name=fundrais_goal]').focus();
        jQuery('input[name=fundrais_goal]').after(`<p class='error'>Fundrais goal is required</p>`);
        isValid = false;
    }else{
        jQuery('input[name=fundrais_goal]').css('border','0px solid red');
        jQuery('input[name=fundrais_goal]').after(` `);
    }
    if(!fundrais_btns){
        jQuery('input[name=fundrais_btns]').css('border','1px solid red');
        jQuery('input[name=fundrais_btns]').focus();
        jQuery('input[name=fundrais_btns]').after(`<p class='error'>Amount button is required</p>`);
        isValid = false;
    }else{
        jQuery('input[name=fundrais_btns]').css('border','0px solid red');
        jQuery('input[name=fundrais_btns]').after(` `);
    }
   

    if(isValid){
        jQuery('#sms').html(`<b>Wait...</b> <span class='loding'>&#10044;</span>`);
        
        var formData = new FormData(this);
        formData.append( "image", jQuery('#image')[0].files[0]);
        formData.append( "action", 'woox_user_create_fundrais_from_my_account');

        // ajax call 
        jQuery.ajax({
            type: "POST",
            url: "<?=admin_url( 'admin-ajax.php' )?>", //  /wp-admin/admin-ajax.php
            data: formData,
            processData: false,
            contentType: false, // multipart/form-data
            success: function(response) {
                jQuery('#sms').html('');
                if ( !response ) return;

                if (response.status == 'ok') { 
                    jQuery('#sms').html(`<span class='success'>${response.message}</span>`);
                } else { 
                    jQuery('#sms').html(`<p class='error'>${response.message}</p>`);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
                alert("There was an error sending the email.");
            }
        });
    }
});

</script>
    <?php
    
}
add_action( 'woocommerce_account_add-new-fundraising_endpoint', 'new_fundraising_menu_item_content' );


// create_fundrais Form data ajax process
function woox_user_create_fundrais_from_my_account() {

    $thumbnail= $_FILES["image"];
    $title   = sanitize_text_field($_POST['fundrais_title']);
    $goal    = sanitize_text_field($_POST['fundrais_goal']);
    $btnS    = sanitize_text_field($_POST['fundrais_btns']);
    $dayLeft = sanitize_text_field($_POST['fundrais_day_left']);
    $endDate = sanitize_text_field($_POST['fundrais_end_date']);
    $details = sanitize_text_field($_POST['fundrais_dis']);
    $oldImgId= sanitize_text_field($_POST['thumbnail_id']);
    $editId  = sanitize_text_field($_POST['edit_id']);

    
    $allBtn = explode(',',$btnS);
    foreach ($allBtn as $key => $val) {
        $couple = explode('-',$val);
        $suggested_donations[]=['amount' => $couple[0], 'description' => $couple[1]];
    }
    // Now, let's sort the array by 'amount' in ascending order
    usort($suggested_donations, function($a, $b) {
        return $a['amount'] <=> $b['amount'];
    });
    $donatDefault = $suggested_donations[0]['amount'];

    // $suggested_donations = unserialize($suggested_donations);


    if(count($suggested_donations)>0 && $title){

        if ( isset( $editId ) && $editId>0 ) {
            // Update the campaign post
            wp_update_post( [
                'ID'           => $editId,
                'post_status'  => 'pending',
                'post_type'    => 'campaign',
                'post_title'   => $title,
                'post_content' => $details,
            ] );
            $post_id = $editId;
            $sms = 'Your fundraising #'.$post_id.' update done. wait for approval.';
        }else{
            // Insert the campaign post
            $post_id = wp_insert_post([
                'post_title'    => $title,
                'post_content'  => $details,
                'post_status'   => 'pending',
                'post_type'     => 'campaign',
            ]);
            $sms = 'Your fundraising #'.$post_id.' created done. wait for approval.';
        }


        if ($post_id) {
            $fdayLeft = intval($dayLeft);
            $fGoal = intval($goal);
            $fDate = $editId?$endDate:$endDate." 23:59:59";
            // Add custom metadata
            update_post_meta($post_id, '_campaign_goal', $fGoal);
            update_post_meta($post_id, '_campaign_end_date', $fDate);
            update_post_meta($post_id, '_campaign_allow_custom_donations', 1);
            update_post_meta($post_id, 'day_left', $fdayLeft);
            
            update_post_meta($post_id, '_campaign_suggested_donations', $suggested_donations);
            update_post_meta($post_id, '_campaign_suggested_donations_default', maybe_serialize([$donatDefault]));

            // Set a featured image (thumbnail)
            if($thumbnail){
                $featured_image_id = woox_upload_file_in_wp_media($thumbnail);
                if ($featured_image_id) {
                    set_post_thumbnail($post_id, $featured_image_id);
                }
            }
            else{
                update_post_meta($post_id, '_thumbnail_id', $oldImgId); 
            }
            
        }

        echo json_encode(['status'=>'ok', 'message' => $sms ]);
        exit();
    }else{
        $sms = 'Your fundraising fail';
        echo json_encode(['status'=>'not-ok', 'message' => $sms ]);
        exit();
    }

}
add_action("wp_ajax_woox_user_create_fundrais_from_my_account", "woox_user_create_fundrais_from_my_account");
add_action("wp_ajax_nopriv_woox_user_create_fundrais_from_my_account", "woox_user_create_fundrais_from_my_account");


