<?php
add_action('wp_head', 'file_email_css');
function file_email_css(){
?>
<style>
    #my-form{
        margin: 60px 0;
    }
</style>
<?php 
}
// https://acmerevival.com/file-email/
// add from Short code
add_shortcode('fileEmail','file_email_fun');
function file_email_fun($jekono){ 
$result = shortcode_atts(array( 
   'title' =>'',
),$jekono);
extract($result);
ob_start();
?>
<!-- Start html code here enctype="multipart/form-data" -->
<form id="my-form" enctype="multipart/form-data">
  <label for="name">Name:</label>
  <input type="text" id="name" name="name">

  <!-- <input type="hidden" name="action" value="send_email"> -->

  <label for="email">Email:</label>
  <input type="email" id="email" name="email">
  <label for="image">Image:</label>
  <input type="file" id="image" name="image">
  <button type="submit">Submit</button>
</form>

<!-- End html code here  -->
<?php
return ob_get_clean();
}

add_action('wp_footer', 'file_email_javaScript');
function file_email_javaScript(){
 ?>
  <script>
    // add your javaScript here
    jQuery("#my-form").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        
        formData.append( "image", jQuery('#image')[0].files[0]);
        formData.append( "action", 'send_email'); 

        jQuery.ajax({
            type: "POST",
            url: "<?=admin_url( 'admin-ajax.php' )?>", //  /wp-admin/admin-ajax.php
            data: formData,
            processData: false,
            contentType: false, // multipart/form-data
            success: function(response) {
            alert("Email sent successfully!");
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
            alert("There was an error sending the email.");
            }
        });
    });
                    
  </script>
 <?php 
}


/*****************FILE UPLOAD*****************/
function upload_users_file( $file = array() ) {    
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


// AJAX process and send the email with the attached image file
function send_email() {
    /*print_r($_POST);
    echo'<hr>';
    print_r($_FILES);*/
    $name    = sanitize_text_field($_POST["name"]);
    $email   = sanitize_email($_POST["email"]);
    $image   = $_FILES["image"]; // UploadFile
    
    $to      = "tanvirmdalamint@gmail.com"; 
    $subject = "New email with image attachment";
    $message = "Name: $name\nEmail: $email";
    /*
    // Set the email headers
    $headers = array(
        'From: Your Name <tanvir@wooxperto.com>',
        'Content-Type: text/html; charset=UTF-8',
    ); */
    $headers      = array('Content-Type: text/html; charset=UTF-8');
    
    // $attachment_id=224641; 
    $attachment_id= upload_users_file($image); 
    $fileURL      = wp_get_attachment_url( $attachment_id );
    // $fileURL   = "https://acmerevival.com/wp-content/uploads/2023/03/loadingSpinner-2.png";
    
    $url          = explode("/",$fileURL);
    $file_path    = "/".$url[4]."/".$url[5]."/".$url[6]."/".$url[7];

    $attachments  = array(
        // WP_CONTENT_DIR . '/uploads/2023/03/loadingSpinner-2.png',
        WP_CONTENT_DIR . $file_path,
    );
    /*
    $attachments  = array();
    if ($image["error"] == UPLOAD_ERR_OK) {
        $attachments[] = $image["tmp_name"];
    }
    print_r($attachments);
    echo $file_path." id = ".$attachment_id;
    */
    $sent = wp_mail($to, $subject, $message, $headers, $attachments);
    
    if ($sent) {
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }

    /*
    
    // Delete the attachment
    $result = wp_delete_attachment($attachment_id);

    if ($result === false) {
        // Failed to delete attachment
    } else {
        // Attachment deleted successfully
    }


    // Define the URL of the file you want to delete
    // $file_url = 'https://acmerevival.com/wp-content/uploads/2023/03/loadingSpinner-2.png';
    $file_url = $fileURL;

    // Get the path of the file from the URL
    $file_path = parse_url($file_url, PHP_URL_PATH);

    // Use the wp_delete_file() function to delete the file
    if (file_exists($file_path)) {
    $deleted = wp_delete_file($file_path);
    if (!$deleted) {
        // Handle the error if the file couldn't be deleted
        }
    }
    */

  exit();
}
add_action("wp_ajax_send_email", "send_email");
add_action("wp_ajax_nopriv_send_email", "send_email");

/*****************FILE UPLOAD*****************/
// AJAX process profile attached image file
function profile_img_upload() {
    /*print_r($_POST);
    echo'<hr>';
    print_r($_FILES);*/
    
    $time_gem_id  = $_POST["id"]; // 
    $oldImgAttachmentId  = $_POST["old-img"]; // 
    $image     = $_FILES["image"]; // UploadFile
    
    // $attachment_id=224641; 
    $attachment_id= upload_users_file($image); 
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

?>
<input type="file" id="image" name="image" onchange="profile_img()" class="img-hidden">
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
</script>
