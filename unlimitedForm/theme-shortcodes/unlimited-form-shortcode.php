<?php 
// add from Short code
add_shortcode('order_form','order_fun');
function order_fun($jekono){
$result = shortcode_atts(array(

    'count' =>'',

),$jekono);
extract($result);
ob_start(); 
?>
<!-- Start html code here  -->

<div class="right-content">
    <h2>New Order</h2>
    <table>
        <!-- <thead>
            <tr>
                <th colspan="4">The table header</th>
            </tr>
        </thead> -->
        <tbody id="tr_container">

            <tr class="table-row" id="first_tr">
                <td>
                    <div class="input-fild">
                        <label class="flabel">
                            <p class="hc">
                                Product type<span class="field_required">*</span>
                            </p>
                            <select name="prouct_type" onchange="show2ndTdElm(this)">
                                <option value="" selected="selected">Choose One</option>
                                <option value="Heating">Heating</option>
                                <option value="Cooling">Cooling</option>
                            </select>
                        </label>
                    </div>
                </td>
                <!-- 1st td end -->
                <td>
                    <div class="2ndtd"></div>
                </td>
                <!-- 2nd td end -->
                <td>
                    <div class="3rdtd column-2"></div>
                </td>
                <!-- 3rd td end -->

                <td>
                    <div class="input-fild add-remove">
                        <label class="flabel">Add/Remove</label>
                        <div class="add-remove-btn">
                            <button onclick="cloneTr()">+</button>
                            <button class="fast-remove-btn" onclick="removeTr(this)">-</button>
                        </div>
                    </div>
                </td>

            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="4">
                    <p class="hcs">product received way.<span class="field_required">*</span></p>
                    <div class="pickup-delivery">
                        <label class="flabel"><input type="radio" name="delivery" value="Pick up"> Pick up</label>
                        <label class="flabel"><input type="radio" name="delivery" value="Delivery"> Delivery</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div id="message_area"></div>
                </td>
            </tr>
            <tr>
                <td colspan="4"><button type="button" onclick="from_submit()"
                        class="submit-btn">Submit</button></td>
            </tr>
        </tfoot>
    </table>

</div>

<!-- End html code here  -->
<?php

return ob_get_clean();

}


// add From view Short code

// View Order Data Short Code
add_shortcode('order-data','order_data_fun');
function order_data_fun(){
ob_start(); 

?>

<table>
    <thead>
        <tr>
            <td>Order No.</td>
            <td>Order Date</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        $args = array(  
            'post_type' => 'dealer-order',
            'posts_per_page' => -1, 
            'orderby' => 'ID', 
            'order' => 'DESC', 
            'post_status'=>'draft'
        );
        
        $loop = new WP_Query( $args ); 
        //    print_r($loop); 
        while ( $loop->have_posts() ) : $loop->the_post(); 
        $current_post_id = get_the_ID();
        // $post_date = get_post_datetime();
        ?>
        <tr>
            <td>#Order-<?php echo $current_post_id; ?></td>
            <td><?=get_the_date('d/m/Y')?><?php // echo $post_date; ?></td>
            <td>
            <button type="button" onclick="details(<?php echo $current_post_id; ?>)" class="Click-here">Details</button>
            </td>
        </tr>
        <?php
    endwhile;
    wp_reset_postdata(); ?>
    </tbody>
</table>

<!-- Add Popup section Start Now-->
<div class="popup-wrap">
	<!-- <div class="Click-here">Details</div> -->
	<div class="popup-model-main">
		<div class="popup-model-inner">
			<div class="close-btn">×</div>
			<div class="popup-model-wrap">
				<div class="pop-up-content-wrap" id="order_details">
					

				</div>
			</div>
		</div>
		<div class="bg-overlay"></div>
	</div>

</div>
<!-- Popup section The end -->
    
<?php
    return ob_get_clean();
}

