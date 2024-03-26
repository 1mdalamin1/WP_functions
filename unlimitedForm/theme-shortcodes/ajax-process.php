<?php
// ajax process
function form_process(){



    $post_type = "dealer-order";
    $post_title = 'order - '.uniqid();
    $post_content = json_encode($_POST);

    $new_post = array(
          'post_author' => get_current_user_id(), 
          'post_content' => $post_content, 
          'post_title' => $post_title,
          'post_type' => $post_type,
          'post_status'=>'draft'
        );

    $post_id = wp_insert_post($new_post);
    // email to admin

 $rows=$_POST['rows'];
//  $order_id_email=$_POST['id'];
//  print_r($rows);
 if(count($rows)>0){
    $html='';
    $html.='<h4>Order No: '.$post_id.'</h4>
    <table style="border-collapse: collapse;">';

        $th = '
        <tr>
            <th style="border: 1px solid #4b4a4a;padding: 6px;">Product type</th>
            <th style="border: 1px solid #4b4a4a;">Heater</th>
            <th style="border: 1px solid #4b4a4a;">Model (Qty)</th>
            <th style="border: 1px solid #4b4a4a;">Flue Kit(Qty)</th>
            <th style="border: 1px solid #4b4a4a;">Thermostat(Qty)</th>
            <th style="border: 1px solid #4b4a4a;">Accessory(Qty)</th>
        </tr>
        ';
        $ths = '
        <tr>
            <th style="border: 1px solid #4b4a4a;padding: 6px;">Product type</th>
            <th style="border: 1px solid #4b4a4a;">Class</th>
            <th style="border: 1px solid #4b4a4a;">Model</th>
            <th style="border: 1px solid #4b4a4a;">Color</th>
            <th style="border: 1px solid #4b4a4a;">Qty</th>
            <th style="border: 1px solid #4b4a4a;">Accessory(Qty)</th>
        </tr>
        ';
    

 $last_type = '';
    foreach ($rows as $key => $value) { // class
        if (!$last_type) {
            $last_type = $value['type'];

            if ($value['type'] == 'Heating') {
                $html.=$th ;
            }
            if ($value['type'] == 'Cooling') {
                $html.=$ths ;
            }

        }

        if($last_type != $value['type']){

            if ($value['type'] == 'Heating') {
                $html.=$th ;
            }
            if ($value['type'] == 'Cooling') {
                $html.=$ths ;
            }
        }

        $html.=' 
        <tr>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">'.$value['type'].'</td>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">'.$value['heater'].$value['class'].'</td>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">'.$value['model'];
                $models=$value['models'];
                foreach ($models as $mkey => $mv){
                    $html.= '
                <p>'.$mv['model'].' <br> <b>Qty</b>: '.$mv['qty'].'</p>';

                };
            $html.= '
            </td>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">'.$value['color'];
                $fule_kits=$value['fule_kits'];
                foreach ($fule_kits as $fkey => $kit){
                    $html.= '
                <p>'.$kit['kit'].' <br> <b>Qty</b>: '.$kit['qty'].'</p>';

                };
            $html.= '
            </td>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">'.$value['qty'];
                $thermostats=$value['thermostats'];
                foreach ($thermostats as $tkey => $thermostat){
                    $html.= '
                <p>'.$thermostat['thermostat'].'  <br> <b>Qty</b>: '.$thermostat['qty'].'</p>';

                };
            $html.= '
            </td>
            <td style="border: 1px solid #4b4a4a;padding: 6px;">';
                $accessories=$value['cooler_accessories'];
                foreach ($accessories as $ckey => $acc){
                    $html.= '
                <p>'.$acc['accessories'].' <br> <b>Qty</b>: '.$acc['qty'].'</p>';

                };
                $h_accessories=$value['heater_accessories'];
                foreach ($h_accessories as $hkey => $acc){
                    $html.= '
                <p>'.$acc['accessories'].'  <br> <b>Qty</b>: '.$acc['qty'].'</p>';

                };
            $html.= '
            </td>
        </tr>';
        $last_type = $value['type'];
     }// end foreach

     $html.='</tbody>
</table>';
    $to = 'tanvirmdalamint@gmail.com';

    // $to=get_bloginfo('admin_email');
    $subject = 'New product order from the dealer.';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail( $to, $subject, $html, $headers );
    }
    echo 'ok';

    exit();
}

add_action("wp_ajax_form_process", "form_process");
add_action("wp_ajax_nopriv_form_process", "form_process");




// Details data ajax prosses & Email Send

function get_data() {
    $order_id=$_POST['id'];
    $content_post = get_post($order_id);
    $content = $content_post->post_content;
   
    $data = json_decode($content,true);
    $rows=$data['rows'];
   
   //  print_r($rows);
    if(count($rows)>0){
   ?>
   <h4>Order No: <?= $order_id;?></h4>
   <table>
       <thead>
           <?php 
           $th = '
           <tr>
               <th>Product type</th>
               <th>Heater</th>
               <th>Model (Qty)</th>
               <th>Flue Kit(Qty)</th>
               <th>Thermostat(Qty)</th>
               <th>Accessory(Qty)</th>
           </tr>
           ';
           $ths = '
           <tr>
               <th>Product type</th>
               <th>Class</th>
               <th>Model</th>
               <th>Color</th>
               <th>Qty</th>
               <th>Accessory(Qty)</th>
           </tr>
           ';
           ?>
       </thead>
       <tbody>
   <?php
    $last_type = '';
       foreach ($rows as $key => $value) { // class
           if (!$last_type) {
               $last_type = $value['type'];
   
               if ($value['type'] == 'Heating') {
                   echo $th ;
               }
               if ($value['type'] == 'Cooling') {
                   echo $ths ;
               }
   
           }
   
           if($last_type != $value['type']){
   
               if ($value['type'] == 'Heating') {
                   echo $th ;
               }
               if ($value['type'] == 'Cooling') {
                   echo $ths ;
               }
           }
   
           echo ' 
           <tr>
               <td>'.$value['type'].'</td>
               <td>'.$value['heater'].$value['class'].'</td>
               <td>'.$value['model'];
                   $models=$value['models'];
                   foreach ($models as $mkey => $mv){
                       echo '
                   <p>'.$mv['model'].' <br><b>Qty</b>: '.$mv['qty'].'</p>';
   
                   };
               echo '
               </td>
               <td>'.$value['color'];
                   $fule_kits=$value['fule_kits'];
                   foreach ($fule_kits as $fkey => $kit){
                       echo '
                   <p>'.$kit['kit'].' <br><b>Qty</b>: '.$kit['qty'].'</p>';
   
                   };
               echo '
               </td>
               <td>'.$value['qty'];
                   $thermostats=$value['thermostats'];
                   foreach ($thermostats as $tkey => $thermostat){
                       echo '
                   <p>'.$thermostat['thermostat'].' <br> <b>Qty</b>: '.$thermostat['qty'].'</p>';
   
                   };
               echo '
               </td>
               <td>';
                   $accessories=$value['cooler_accessories'];
                   foreach ($accessories as $ckey => $acc){
                       echo '
                   <p>'.$acc['accessories'].' <br> <b>Qty</b>: '.$acc['qty'].'</p>';
   
                   };
                   $h_accessories=$value['heater_accessories'];
                   foreach ($h_accessories as $hkey => $acc){
                       echo '
                   <p>'.$acc['accessories'].' <br> <b>Qty</b>: '.$acc['qty'].'</p>';
   
                   };
               echo '
               </td>
           </tr>';
           $last_type = $value['type'];
        }
   
        ?>
        
       </tbody>
   </table>
        <?php
    }
   
       exit();
   }
   
   add_action("wp_ajax_get_data", "get_data");
   add_action("wp_ajax_nopriv_get_data", "get_data");