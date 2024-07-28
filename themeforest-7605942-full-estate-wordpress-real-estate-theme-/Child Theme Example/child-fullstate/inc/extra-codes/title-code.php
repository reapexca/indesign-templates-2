<?php
    $maison_custom_str = substr(get_post_meta( get_the_ID(), 'custom-zones-actives', true ),1);
    if(isset($post)){
        if($post->page_template == null){
            if(function_exists('get_field')){
                $maison_img = (get_field('image_header') !== false)?get_field('image_header'):get_template_directory_uri().'/img/default.jpg';
            }else{
               $maison_img = get_template_directory_uri().'/img/default.jpg'; 
            }
            $maison_title = $post->post_title;     
            if(get_query_var('cat') != ''){
                $maison_cat_name = get_category(get_query_var('cat'));
                $maison_title = (function_exists('of_get_option'))?of_get_option('cat_text').' '.$maison_cat_name->name:'Category :'.$maison_cat_name->name;
                $maison_img = (function_exists('of_get_option'))?of_get_option('cat_img'):get_template_directory_uri().'/img/default.jpg'; 
            }else if(get_query_var('tag') != ''){              
                $maison_tag_name = get_tags(array('slug' => get_query_var('tag')));
                $maison_title = (function_exists('of_get_option'))?of_get_option('tag_text').' '.$maison_tag_name[0]->name:'Tag :'.$maison_tag_name[0]->name;
                $maison_img = (function_exists('of_get_option'))?of_get_option('tag_img'):get_template_directory_uri().'/img/default.jpg'; 
            }else if(get_query_var('s') != ''){
                $maison_title = (function_exists('of_get_option'))?of_get_option('s_text'):'Search';
                $maison_img = (function_exists('of_get_option'))?of_get_option('s_img'):get_template_directory_uri().'/img/default.jpg'; 
            }else if(get_query_var('m') != ''){
                $maison_img = (function_exists('of_get_option'))?of_get_option('arch_img'):get_template_directory_uri().'/img/default.jpg'; 
                if ( is_day() ) 
                    $maison_title = 'Daily Archives: '. get_the_date();
                else if( is_month() )
                    $maison_title = 'Monthly Archives: '. get_the_date('F Y');
                elseif ( is_year() )
                    $maison_title = 'Yearly Archives: '. get_the_date('Y');
            } 
            else if(is_404())$maison_title = (function_exists('of_get_option'))?of_get_option('banner_title'):'404 Page';
      	?>
          <div class="section_title" style="background-image: url('<?php echo $maison_img;?>');">
              <div class="container">
                  <div class="row"> 
                      <div class="col-md-9" style="width: auto !important;">
                          <h1><?php echo $maison_title;?>
                              <?php if(get_the_title() !== 'HOME'){?>
                              <span><a href="<?php echo get_home_url();?>">Home </a> / <?php echo get_the_title() !== ''?get_the_title() : '404';?></span>
                              <?php }?>
                          </h1>
                      </div>                    
                  </div>
              </div>            
          </div>
      <?php
        }
        else if(!stripos(get_post_meta( get_the_ID(), 'custom-zones-actives', true ),'include-slider') && $post->page_template != 'template-contact.php'){
            if(function_exists('get_field')){
                $maison_img = isset($_REQUEST['post_img'])?$_REQUEST['post_img']:get_field('image_header');
            }else{
               $maison_img = get_template_directory_uri().'/img/default.jpg'; 
            }
            if (!isset($maison_img)) 
                $maison_img = (function_exists('of_get_option'))?of_get_option('404_ban_img'):get_template_directory_uri().'/img/default.jpg';
    	?>
            <div class="section_title" style="background-image: url('<?php echo $maison_img;?>');">
                <div class="container">
                    <div class="row"> 
                        <div class="col-md-12" style="width: auto !important;">
                            <h1><?php echo get_the_title() !== ''?get_the_title():'404';?>
                                <?php if(get_the_title() !== 'HOME'){?>
                                <span><a href="<?php echo get_home_url();?>">Home </a> / <?php echo get_the_title() !== ''?get_the_title() : '404';?></span>
                                <?php }?>
                            </h1>
                        </div>                    
                    </div>
                </div>            
            </div>
        <?php  }
        		else if( stripos($maison_custom_str,'acf_include-slider') !== false){   
		    ?>
        <header> 
             <?php
                global $maison_filter_style;
                $maison_header_style = (function_exists('get_field'))?get_field('header_style'):'';
                $maison_filter_style = (function_exists('get_field'))?get_field('filter_style'):'';
                $maison_slide_name = (function_exists('get_field'))?get_field('slide_name'):'';
                $maison_map_shortcode = (function_exists('get_field'))?get_field('map_shortcode'):'';
              	$top_position_filter = (function_exists('get_field'))?get_field('top_position_filter'):'';
                
                $maison_filters = (function_exists('get_field'))?get_field('filter_tabs1'):'';
                global $maison_filter_form;
                $maison_filter_form = null;
                if($maison_filters !== false && $maison_filters !== ''){
                    foreach($maison_filters as $maison_f){
                        $maison_filter_form[] = $maison_f; 
                    }
                }else{$maison_filter_form = array();}
                
                //FILTER OPTIONS
                if($maison_header_style == 'sfilter' || $maison_header_style == 'mfilter' || $maison_header_style == 'ifilter'){
                    if($maison_filter_style !== 'filter3'){
                        echo ($maison_filter_style == 'filter1')?'<div class="filter-horizontal" style="top:'.$top_position_filter.' !important;">':'';
                        echo ($maison_filter_style == 'filter2')?'<div class="filter-box" style="top:'.$top_position_filter.' !important;">':'';
                           get_template_part('inc/filter/filter_form');

                      	echo "</div>";   
                    }
                }
                
                echo ($maison_header_style == 'map' || $maison_header_style == 'mfilter')?'<div class="map_area">':($maison_header_style == 'slide' || $maison_header_style == 'sfilter')?'<div class="slider" id="slide">':'';
                //SLIDE OR MAP
                if($maison_header_style == 'map' || $maison_header_style == 'mfilter'){
                    echo do_shortcode($maison_map_shortcode);
                    wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'Chester' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );                 
                }else if($maison_header_style == 'slide' || $maison_header_style == 'sfilter') 
                    if(function_exists('putRevSlider')){
                        putRevSlider($maison_slide_name);
                    }
                ?>                
            </header>
           
            <?php
        }
        else if(stripos($post->page_template,'template') !== false){
            if(function_exists('get_field')){
                $maison_img = (get_field('image_header') !== false)?get_field('image_header'):get_template_directory_uri().'/img/default.jpg';
            }else{
               $maison_img = get_template_directory_uri().'/img/default.jpg'; 
            }
     ?>
       <div class="section_title about" style="background-image: url('<?php echo $maison_img;?>');">
            <div class="container">
                <div class="row"> 
                    <div class="col-md-9" style="width: auto !important;">
                        <h1><?php echo get_the_title();?>
                            <?php if(get_the_title() !== 'HOME'){?>
                            <span><a href="<?php echo get_home_url();?>">Home </a> / <?php echo get_the_title() !== ''?get_the_title() : '404';?></span>
                            <?php }?>
                        </h1>
                    </div>                    
                </div>
            </div>            
        </div>
 <?php
        }
    }
 ?>