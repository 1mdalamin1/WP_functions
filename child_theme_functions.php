<?php  

// remove updated widgets style
function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );


// /////////////  Show Category by Post //////////

add_shortcode('category_show','category_show_fun');
function category_show_fun(){
	ob_start(); ?>

<!-- Category:  -->
<style>
ul.cat-style {
    list-style: none;
}
ul.cat-style li.categories {
    display: flex;
    align-items: center;
    align-content: center;
    justify-content: center;
	flex-direction: column;
}

ul.cat-style li.categories ul {
    list-style: none;
    display: flex;
    align-content: center;
    justify-content: center;
    align-items: center;
    padding: 0;
	flex-wrap: wrap;
}

ul.cat-style li.categories ul li {
    margin: 8px 3px;
}

ul.cat-style li.categories b {
	margin: 15px 0;
    font-size: 32px;
    color: #148541;
}
ul.cat-style li.categories ul li a {
    padding: 8px 16px;
    background: #070707;
    color: #fff;
    transition: .4s;
}
ul.cat-style li.categories ul li:hover a{
    background: #148541;
}

</style>
<ul class="cat-style">
    <?php wp_list_categories( array(
        'orderby'    => 'name',
		'order'   => 'ASC',
		'exclude_tree' => 41, // remove a catagori
		'title_li' => '<b>' . __( 'Categories', 'textdomain' ) . '</b>',
    ) ); ?> 
</ul>
	
	<?php
	return ob_get_clean();
}

// /////////////  Show Category by Post //////////

add_shortcode('category_show','category_show_fun');
function category_show_fun(){
	ob_start(); ?>

<ul class="cat-style">
    <?php wp_list_categories( array(
        'orderby'    => 'name',
		'order'   => 'ASC',
		'exclude_tree' => 41,
		'title_li' => '<b>' . __( 'Categories', 'textdomain' ) . '</b>',
    ) ); ?> 
</ul>
	
	<?php
	return ob_get_clean();
}

