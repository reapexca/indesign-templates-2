<?php
    if (! function_exists('font_awesome_icon') ){
        function font_awesome_icon($nam,$title = '',$class = ''){
            global $google_faces;
            $opt = array();
            $icon = '';
            $opt[] = array(
                'name' => $title,
                'type' => 'info',
                'class' => ' '.$class,
            );
            $opt[] = array(
                'id' => 'fwi_icon_'.$nam,
                'std' => $icon,
                'type' => 'text',
                'class' => 'hidden icon-opt '.$class,
            );            
            $opt[] = array(
                'id' => 'fwi_type_'.$nam,
                'std' => array( 'size' => '36px', 'face' => 'Arial', 'style'=>'normal', 'color'=> '#00bc96'),
                'type' => 'typography',
                'options' => array(
                    'faces' => $google_faces,
                ),
                'class' => ' '.$class
            ); 
            return $opt;
        }
    } 

    if (! function_exists('font_awesome_icon_style') ){
        function font_awesome_icon_style($name,$style=1){
            $imp = ' ';
            $imp .= 'class="'.of_get_option('fwi_icon_'.$name).'" ';
            $style = of_get_option('fwi_type_'.$name);
            $imp .= 'style="color: '.$style['color'].'; font-size: '.$style['size'].';" ';
            return $imp;
        }
    }  
    
    add_action( 'admin_enqueue_scripts', 'input_admin_enqueue_scripts' );
    
    function input_admin_enqueue_scripts(){
          // register theme scripts
          wp_enqueue_script('icon', get_template_directory_uri().'/inc/theme-icon/js/icon-admin.js',array('jquery'), false, true);
          wp_enqueue_style( 'styles-icon', get_template_directory_uri() . '/inc/theme-icon/css/input.css', array());  
          //LOAD ICON-FONT-AWESOME FILES
          wp_enqueue_style( 'styles-icon1', get_template_directory_uri() . '/inc/theme-icon/assets/css/font-awesome.css', array());  
          wp_enqueue_style( 'styles-icon2', get_template_directory_uri() . '/inc/theme-icon/assets/css/font-awesome-corp.css', array());  
          wp_enqueue_style( 'styles-icon3', get_template_directory_uri() . '/inc/theme-icon/assets/css/font-awesome-ext.css', array());  
          wp_enqueue_style( 'styles-icon4', get_template_directory_uri() . '/inc/theme-icon/assets/css/font-awesome-social.css', array());  
          wp_enqueue_style( 'styles-icon5', get_template_directory_uri() . '/inc/theme-icon/assets/css/font-awesome-more-ie7.min.css', array());  
    } 

    /* Loads the file for option backup */
    add_action('init', 'optionsframework_load_backup' );
              
    function optionsframework_load_backup() {
        require_once dirname( __FILE__ ) . '/options-backup.php';
    }