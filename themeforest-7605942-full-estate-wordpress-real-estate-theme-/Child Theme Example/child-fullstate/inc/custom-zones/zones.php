<?php
add_action( 'admin_enqueue_scripts', 'custom_zones_script' );
function custom_zones_script(){
    wp_enqueue_script('zones',get_template_directory_uri().'/inc/custom-zones/zones.js', array('jquery'),false, true);
}

add_action( 'admin_head', 'custom_zones_css' );
function custom_zones_css(){
 echo "<style type=\"text/css\">
    .button-zone {
       margin-bottom: 10px !important;
    }
    .preview-zone{
        display: none;
        position:absolute;
        z-index: 100;
        top: -100px ;
        left: -100px;
    }
		.zone-top{
        margin-top: -120px;
				margin-left: -100px;
    }
    .preview-img{                
        width: 400px;
        height: 200px;                                             
        border: 1px solid #e5e5e5;
        border-radius: 5px;
        background-color: rgba(255,255,255,1);
    }
</style>\n"; 
}

function custom_zones_add_form() {
    echo "<input type='hidden' id='custom-zones-actives' name='custom-zones-actives' value='".get_post_meta( get_the_ID(), 'custom-zones-actives', true )."' />"; 
}
add_action('edit_form_after_title', 'custom_zones_add_form');

function custom_zones_populate_forms() {
    global $post, $pagenow, $typenow;
    
    $post_id = $post ? $post->ID : 0;
    
    // get field groups
    $filter = array( 
        'post_id'    => $post_id, 
        'post_type'    => $typenow 
    );
    
    if ($typenow != 'page') 
        return false;
    
    $ids = array();
    $ids = apply_filters( 'acf/location/match_field_groups', $ids, $filter );
        
    $acfs = apply_filters('acf/get_field_groups', array());
    $actives = get_post_meta( get_the_ID(), 'custom-zones-actives', true );
    $actives = explode('|',$actives);
    
    function filter_custom($custom)
    {
        if($custom['id'] != 'acf_page-header' && $custom['id'] != 'acf_portolio' && $custom['id'] != 'acf_contact')
            return($custom);
    }
    $acfs_ = array_map("filter_custom", $acfs);
    
    //IMAGE OF ZONE
    echo '<div class="preview-zone" data-dir="'.get_template_directory_uri().'"><div class="zone-top"><div class="preview-img" style="background-image: url(\''.get_template_directory_uri().'/inc/custom-zones/image-zones/mobile.png\'); background-repeat: no-repeat;"></div></div></div>';    
     
    foreach($acfs_ as $cf) {
        if (in_array($cf['id'], $ids)) {
            if (in_array($cf['id'], $actives))
                echo "<a href=\"#\" class=\"button button-zone button-primary\" data-zone=\"{$cf['id']}\"><span class=\"custom-zones-button-icon\"></span> {$cf['title']}</a><br>";
            else                                  
                echo "<a href=\"#\" class=\"button button-zone\" data-zone=\"{$cf['id']}\"><span class=\"custom-zones-button-icon\"></span> {$cf['title']}</a><br>";
        }
    } 
    
    //echo '<br><br>';
}
function custom_zones_box() {
    
    add_meta_box(
            'custom_zones',
            __( 'Custom Zones', 'custom_zones_textdomain' ),
            'custom_zones_populate_forms',
            null,
            'side'
        );
}

add_action( 'add_meta_boxes', 'custom_zones_box' );

function custom_zones_save_post() {
    $id = (get_the_ID() !== false)?get_the_ID():null;
    update_post_meta( $id, 'custom-zones-actives', $_POST['custom-zones-actives'] );
    //update_post_meta( get_the_ID(), 'custom-zones-actives', $_POST['custom-zones-actives'] );
    //update_option('custom-zones-actives',$_POST['custom-zones-actives']);
    //$new_meta_value = stripslashes( $_POST['second-excerpt'] );

}  
add_action( 'pre_post_update', 'custom_zones_save_post');