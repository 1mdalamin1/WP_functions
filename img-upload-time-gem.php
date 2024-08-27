<?php

/******FILE UPLOAD*****************/
function upload_file_in_wp_media( $file = array() ) {    
    require_once( ABSPATH . 'wp-admin/includes/admin.php' );
    $file_return = wp_handle_upload( $file, array('test_form' => false ) );
    if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
        return false;
    } else {
        $filename = $file_return['file'];
        $attachment = array(
            'post_mime_type' => $file_return['type'],
            'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
            'post_content' => '',
            'post_status' => 'inherit',
            'guid' => $file_return['url']
        );
        $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
        wp_update_attachment_metadata( $attachment_id, $attachment_data );
        if( 0 < intval( $attachment_id ) ) {
          return $attachment_id;
        }
    }
    return false;
}

// echo 'tanvir hasan ';
add_action('wp_footer', 'upload_img_script');
function upload_img_script(){
?>

<input type="file" id="image" name="image" onchange="profile_img()" class="img-hidden">
<input type="file" id="img_charity" name="img_charity" onchange="imgcharity()" class="img-hidden">
<input type="file" id="own_bg_img" name="own_bg_img" onchange="ownBgImgage()" class="img-hidden">
<input accept=".jpg,.JPG,.png,.gif" type="file" multiple id="images_gallery" name="images_gallery[]" class="img-hidden">

<script>
    // Profile img upload
    function profile_img(){

        let maxFileSize = 500000; // 500kb in bytes 500000
        let fileSize = jQuery('#image')[0].files[0].size; // Get the size of the selected file
        if (fileSize > maxFileSize) {
            alert('File size exceeds the maximum limit of 500kb.');
            // Clear the file input field
            jQuery('#image').val('');
            return false;
        }

        let timeGemId = jQuery("input[name=id]" ).val();
        let oldImg = jQuery("#profileShowImg img" ).attr('data-old-img');
        var formData = new FormData();
        formData.append( "image", jQuery('#image')[0].files[0]);
        formData.append( "action", 'profile_img_upload'); 
        formData.append( "old-img", oldImg);
        formData.append( "id", timeGemId);
        

        jQuery('#profileShowImg').html(`Uploading ... `);
        jQuery('#smsProfile').html(`Uploading ... `);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo admin_url( 'admin-ajax.php' )?>", //  /wp-admin/admin-ajax.php
            data: formData,
            processData: false,
            contentType: false, // multipart/form-data
            success: function(response) {
                
                jQuery('#profileShowImg').html(` `);
                jQuery('#smsProfile').html(` `);
                const res = JSON.parse(response);

                // console.log(res); // response.url
                if (res.status == 'ok') { 
                    jQuery('#profileShowImg').html(`<img src="${res.url}" width="200" data-old-img="${res.attachId}">`); 

                    jQuery("#profileBtn").css('background-image', 'url(' + res.url + ')');

                } else { 
                    jQuery('#profileShowImg').html(`<p class='error'>Some problam</p>`);
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // console.log(jqXHR, textStatus, errorThrown);
                alert("There was an error updoading img.");
            }
        });
    }

    // Charity img upload
    function imgcharity(){

        let maxFileSize = 500000; // 500kb in bytes
        let fileSize = jQuery('#img_charity')[0].files[0].size;
        if (fileSize > maxFileSize) {
            alert('File size exceeds the maximum limit of 500kb.');
            // Clear the file input field
            jQuery('#img_charity').val('');
            return false;
        }

        let timeGemId = jQuery("input[name=id]" ).val();
        let oldImg = jQuery("#charityShowImg img" ).attr('data-old-img');
        var formData = new FormData();
        formData.append( "image", jQuery('#img_charity')[0].files[0]);
        formData.append( "action", 'charity_img_upload'); 
        formData.append( "old-img", oldImg);
        formData.append( "id", timeGemId);
        
        // console.log('old img url '+oldImg);
        
        jQuery('#charityShowImg').html(`Uploading ... `);
        jQuery('#smsCharity').html(`Uploading ... `);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo admin_url( 'admin-ajax.php' )?>", //  /wp-admin/admin-ajax.php
            data: formData,
            processData: false,
            contentType: false, // multipart/form-data
            success: function(response) {
                
                jQuery('#charityShowImg').html(` `);
                jQuery('#smsCharity').html(` `);
                const res = JSON.parse(response);

                // console.log(res); // response.url
                if (res.status == 'ok') { 
                    jQuery('#charityShowImg').html(`<img src="${res.url}" width="200" data-old-img="${res.attachId}">`); 

                    jQuery("#charityBtn").css('background-image', 'url(' + res.url + ')');

                } else { 
                    jQuery('#charityShowImg').html(`<p class='error'>Some problam</p>`);
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // console.log(jqXHR, textStatus, errorThrown);
                alert("There was an error updoading img.");
            }
        });
    }

    // Own Background img upload
    function ownBgImgage(){

        let maxFileSize = 500000; // 500kb in bytes
        let fileSize = jQuery('#own_bg_img')[0].files[0].size;
        if (fileSize > maxFileSize) {
            alert('File size exceeds the maximum limit of 500KB.');
            // Clear the file input field
            jQuery('#own_bg_img').val('');
            return false;
        }

        let timeGemId = jQuery("input[name=id]" ).val();
        let oldImg = jQuery("#ownbgShowImg img" ).attr('data-old-img');
        var formData = new FormData();
        formData.append( "image", jQuery('#own_bg_img')[0].files[0]);
        formData.append( "action", 'ownbg_img_upload'); 
        formData.append( "old-img", oldImg);
        formData.append( "id", timeGemId);
        
        // console.log('old img url '+oldImg);
        

        jQuery('#ownbgShowImg').html(`Uploading ... `);
        jQuery('#smsOwnBg').html(`Uploading ... `);
        jQuery.ajax({
            type: "POST",
            url: "<?php echo admin_url( 'admin-ajax.php' )?>", //  /wp-admin/admin-ajax.php
            data: formData,
            processData: false,
            contentType: false, // multipart/form-data
            success: function(response) {
                
                jQuery('#ownbgShowImg').html(` `);
                jQuery('#smsOwnBg').html(` `);
                const res = JSON.parse(response);

                // console.log(res); // response.url
                if (res.status == 'ok') { 
                    jQuery('#ownbgShowImg').html(`<img src="${res.url}" width="200" data-old-img="${res.attachId}">`); 

                    jQuery("#bgOwnBtn").css('background-image', 'url(' + res.url + ')');

                } else { 
                    jQuery('#ownbgShowImg').html(`<p class='error'>Some problam</p>`);
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // console.log(jqXHR, textStatus, errorThrown);
                alert("There was an error updoading img.");
            }
        });
    }
  
    // Gallery Images img upload
    jQuery("input#images_gallery").change(function() {

        let timeGemId = jQuery("input[name=id]" ).val();
        let maxFileSizePerImage = 500 * 1024; // 500KB in bytes
        let maxTotalFileSize = 5 * 1024 * 1024; // 5MB in bytes

        let fileInput = this;
        let totalFileSize = 0;

        if (fileInput.files.length > 0) {
            let invalid_img = 0;
            let valid_img   = 0;
            let process = false;

            let formData = new FormData();
            let totalfiles = document.getElementById('images_gallery').files.length;

            for (let index = 0; index < totalfiles; index++) {
            
                let fileSize = document.getElementById('images_gallery').files[index].size; // Read selected files
                // fileInput.files[index].size;
                if(fileSize > maxFileSizePerImage){

                    invalid_img += 1;

                } else {

                    totalFileSize += fileSize;
                    valid_img   += 1;
                    formData.append("image[]", document.getElementById('images_gallery').files[index]);
                    // fileInput.files[index];

                }
            }

            if (totalFileSize > maxTotalFileSize) {
                alert('Total file size exceeds the maximum limit of 5MB.');
                // Clear the file input field
                jQuery(fileInput).val('');
                process = false;
                return false;
            }

            if(valid_img>0 && invalid_img>0){   
                let text = "Files "+ invalid_img + " exceeded max upload file size limit. Would you like to upload without those?";
                if (confirm(text) == true) {
                    process = true;
                } else {
                    // Clear the file input field
                    jQuery(fileInput).val('');
                    process = false;
                    return false; // Stop further processing
                }
            } else if(valid_img>0 && invalid_img==0) {

                process = true;

            }else if(invalid_img>0 && valid_img==0) {

                alert('No valid image found.');
                process = false;

            }

            

            if(process){

                formData.append( "action", 'gallery_img_upload'); 
                formData.append( "id", timeGemId);
                jQuery('#galleryShowImg').html(`Uploading ... `);
                jQuery('#smsGalleryImages').html(`Uploading ... `);
                
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo admin_url( 'admin-ajax.php' )?>", //  /wp-admin/admin-ajax.php
                    data: formData,
                    processData: false,
                    contentType: false, // multipart/form-data
                    success: function(response) {
                        
                        jQuery('#galleryShowImg').html(` `);
                        jQuery('#smsGalleryImages').html(` `);
                        const res = JSON.parse(response);
                        // console.log(res); // response.url

                        if (res.status == 'ok') {

                            let images = "";

                            for (let i = 0; i < res.attachId.length; i++) {
                                let img = `
                                    <div class='time-gem-single-attachement'>
                                        <img src='${res.url[i]}'>
                                        
                                        <button type='button' onclick='woox_remove_selected_img(this)'><i class='fas fa-times-circle'></i></button>

                                        <input type='hidden' name='attachments[]' value='${res.attachId[i]}'>
                                    </div>`;
                                
                                images += img;
                            }

                            jQuery('#attachement_images').append(`${images}`); 

                            // jQuery("#galleryBtn").css('background-image', 'url(' +  + ')');

                        } else { 
                            jQuery('#galleryShowImg').html(`<p class='error'>Some problam</p>`);
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // console.log(jqXHR, textStatus, errorThrown);
                        alert("There was an error updoading img.");
                    }
                });
            }
        }
    }); 



    // Gallery image delete ajax call.
    function woox_remove_selected_img(data){
        
        let timeGemId = jQuery("input[name=id]" ).val();
        let selectDel = jQuery(data).parent();
        
        let selectDelId = selectDel.find('input[type=hidden]').val();

        // WP Ajax Call with click function
        selectDel.find('button').html(`<b>...</b> `);
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo admin_url('admin-ajax.php')?>',
            data: {
                action: 'gallery_img_delete',
                id: timeGemId,
                sid: selectDelId
            },
            success: function(response) { 
                if ( ! response || response.error ) return;
                selectDel.find('button').html(`x`);

                if (response.status == 'ok') { 
                    selectDel.find('button').html(`${response.message}`);
                    jQuery(data).parent().remove();

                } else { 
                    selectDel.find('button').html(`<p class='error'>Some problam</p>`);
                }
        
            }
        });
    }


</script>

<?php 
}

// AJAX process profile attached image file
function profile_img_upload() {
    /*print_r($_POST);
    echo'<hr>';
    print_r($_FILES);*/
    
    $time_gem_id  = $_POST["id"]; // 
    $oldImgAttachmentId  = $_POST["old-img"]; // 
    $image     = $_FILES["image"]; // UploadFile
    
    // $attachment_id=224641; 
    $attachment_id= upload_file_in_wp_media($image); 
    $fileURL      = wp_get_attachment_url( $attachment_id );
    
    // Delete the attachment
    $result = wp_delete_attachment($oldImgAttachmentId); 

    if ($result === false) {
        // Failed to delete attachment
    } else {
        // Attachment deleted successfully
    }

    if($attachment_id){
        update_post_meta($time_gem_id,'profile_image', $attachment_id);
    }else{
        update_post_meta($time_gem_id,'profile_image', '');
    }


    $sms = 'Image upload done';
    echo json_encode(['status'=>'ok', 'message' => $sms, 'url' => $fileURL, 'attachId' => $attachment_id ]);

    exit(); // wp_die();
}
add_action("wp_ajax_profile_img_upload", "profile_img_upload");
add_action("wp_ajax_nopriv_profile_img_upload", "profile_img_upload");


// AJAX process charity attached image file
function charity_img_upload() {
    /*print_r($_POST);
    echo'<hr>';
    print_r($_FILES);*/
    
    $time_gem_id  = $_POST["id"]; // 
    $oldImgAttachmentId  = $_POST["old-img"]; // 
    $image     = $_FILES["image"]; // UploadFile
    
    // $attachment_id=224641; 
    $attachment_id= upload_file_in_wp_media($image); 
    $fileURL      = wp_get_attachment_url( $attachment_id );
    
    // Delete the attachment
    $result = wp_delete_attachment($oldImgAttachmentId); 

    if ($result === false) {
        // Failed to delete attachment
    } else {
        // Attachment deleted successfully
    }

    if($attachment_id){
        update_post_meta($time_gem_id,'charity_image', $attachment_id);
    }else{
        update_post_meta($time_gem_id,'charity_image', '');
    }


    $sms = 'Charity Image upload done';
    echo json_encode(['status'=>'ok', 'message' => $sms, 'url' => $fileURL, 'attachId' => $attachment_id ]);

    exit(); // wp_die();
}
add_action("wp_ajax_charity_img_upload", "charity_img_upload");
add_action("wp_ajax_nopriv_charity_img_upload", "charity_img_upload");


// AJAX process own background image file
function ownbg_img_upload() {
    /*print_r($_POST);
    echo'<hr>';
    print_r($_FILES);
    exit();*/
    $time_gem_id  = $_POST["id"]; // 
    $oldImgAttachmentId  = $_POST["old-img"]; // 
    $image     = $_FILES["image"]; // UploadFile
    
    // $attachment_id=224641;
    $attachment_id= upload_file_in_wp_media($image); 
    $fileURL      = wp_get_attachment_url( $attachment_id );
    
    // Delete the attachment
    $result = wp_delete_attachment($oldImgAttachmentId); 

    if ($result === false) {
        // Failed to delete attachment
    } else {
        // Attachment deleted successfully
    }

    if($attachment_id){
        update_post_meta($time_gem_id,'time_gem_bg_image', $attachment_id);
    }else{
        update_post_meta($time_gem_id,'time_gem_bg_image', '');
    }


    $sms = 'Own background image upload done';
    echo json_encode(['status'=>'ok', 'message' => $sms, 'url' => $fileURL, 'attachId' => $attachment_id ]);

    exit(); // wp_die();
}
add_action("wp_ajax_ownbg_img_upload", "ownbg_img_upload");
add_action("wp_ajax_nopriv_ownbg_img_upload", "ownbg_img_upload");


// AJAX process gallery image file
function gallery_img_upload() {
    
    $time_gem_id= $_POST["id"]; // 
    $images    = $_FILES["image"]; // UploadFile

    $oldImgIds = get_post_meta( $time_gem_id, 'attachments', true );
    
    $attIds    = $oldImgIds ? $oldImgIds : [];
    $urls      = [];
  $newAttIds = [];
    foreach ($images['name'] as $key => $img) {
        $image=array
        (
            'name' => $img,
            'type' => $images['type'][$key],
            'tmp_name' => $images['tmp_name'][$key],
            'error' => $images['error'][$key],
            'size' => $images['size'][$key]
        );
        $attId = upload_file_in_wp_media($image); 
        $attIds[] = $attId; 
        $newAttIds[] = $attId;
        $urls[]   = wp_get_attachment_image_url( $attId ,'thumbnail');
    }

    if($attIds){
        update_post_meta($time_gem_id,'attachments', $attIds);
    } else {
        update_post_meta($time_gem_id,'attachments', '');
    }

    $sms = 'Gallery image upload done';
    echo json_encode(['status'=>'ok', 'message' => $sms, 'url' => $urls, 'attachId' => $newAttIds ]);

    exit(); // wp_die();
}
add_action("wp_ajax_gallery_img_upload", "gallery_img_upload");
add_action("wp_ajax_nopriv_gallery_img_upload", "gallery_img_upload");


// AJAX process gallery image file delete
function gallery_img_delete() {
    
    $time_gem_id = $_POST["id"]; 
    $delet_img_id= $_POST["sid"]; 

    $oldImgIds = get_post_meta( $time_gem_id, 'attachments', true );
    
    $attIds    = $oldImgIds ? $oldImgIds : [];
  
    $index = array_search($delet_img_id, $attIds);

    if ($index !== false) {
        unset($attIds[$index]);
    }

    // Re-index the array after deletion
    $attIds = array_values($attIds);

    if($attIds){
        update_post_meta($time_gem_id,'attachments', $attIds);
    } else {
        update_post_meta($time_gem_id,'attachments', '');
    }

    $sms = 'Gallery image deleted.';
    echo json_encode(['status'=>'ok', 'message' => $sms, 'url' => $urls, 'attachId' => $attIds ]);

    exit(); // wp_die();
}
add_action("wp_ajax_gallery_img_delete", "gallery_img_delete");
add_action("wp_ajax_nopriv_gallery_img_delete", "gallery_img_delete");
































