<?php 
    $maison_key = $maison_value['rpt'];
    $maison_property_name = array();
    if($maison_key['properties'] !== false){
        foreach($maison_key['properties'] as $maison_key_v){
            $maison_property_name[] = $maison_key_v->post_title;
        } 
    }else{
        $maison_property_name[] = array();
    }
    if (isset($_REQUEST['action'])) {
        $_COOKIE['form'] = $_REQUEST;
    }
    $maison_layout = isset($_REQUEST['layout']) ? $_REQUEST['layout'] : $maison_key['style_property'];
    $_COOKIE['layout'] = (isset($_GET['layout'])) ? $_GET['layout'] : $maison_layout;
        $post = get_post();
        if(!empty($post->post_content)){
            echo '<section class="section_area paddings">
                    <div class="container">
                        <div class="row">
														<div class="col-md-12">';
                    						echo $post->post_content;
		                  echo '</div>
												</div>
                    </div>
                </section>';
        }
      	$maison_btn = $maison_key['btn_title'];
        $maison_btn_link = $maison_key['btn_link'];
        $maison_title = $maison_key['title'];
        $maison_subtitle = $maison_key['subtitle'];
?>

<div class="container">
  
  	<!-- Divisor Top-->
    <?php
    	echo ($maison_key['div_line'] == 'top')?'
			<div class="row">
        <div class="col-md-12">
					<div class="divisor divisor-top">
						<div class="circle_left"></div>
						<div class="circle_right"></div>
					</div>
			</div>
    </div>':'';
    ?>  
  	<!-- End Divisor Top-->

  
    <?php
        echo (!empty($maison_title) || !empty($maison_subtitle))?'<div class="titles">':'';
        echo (!empty($maison_title))?'<span>'.$maison_title.'</span><br>':'';
        echo (!empty($maison_subtitle))?'<h1>'.$maison_subtitle.'</h1>':'';
        echo (!empty($maison_title) || !empty($maison_subtitle))?'</div':'';
    ?>
  
    <!-- Bar properties-->
    <div id="bar" class="bar_properties">
        <div class="row">
            <div class="col-md-5">
              	<strong><?php echo of_get_option('filter_title'); ?></strong>
                <ul>
                  	<li class="active f-type" data-type="all"><a href="#"><?php echo of_get_option('filter_all'); ?></a></li>
                    <li class="f-type" data-type="sale"><a href="#"><?php echo of_get_option('filter_sale'); ?></a></li>
                    <li class="f-type" data-type="rent"><a href="#"><?php echo of_get_option('filter_rent'); ?></a></li>
                    <li class="f-type" data-type="offer"><a href="#"><?php echo of_get_option('filter_offer'); ?></a></li>                            
                </ul>
            </div>
            <div class="col-md-5">
                <strong><?php echo of_get_option('order_bar'); ?></strong>
                <ul class="tooltip_hover">                            
                    <li>
                        <a href="#"><?php echo of_get_option('order_recent'); ?></a>
                        <a href="#" data-toggle="tooltip" title="<?php echo of_get_option('sort_a'); ?>" class="btn_order"  data-order="asc" data-type="date">
                          	<i class="icon-caret-up"></i>
                      	</a>
                        <a href="#" data-toggle="tooltip" title="<?php echo of_get_option('sort_d'); ?>" class="btn_order" data-order="desc" data-type="date">
                          	<i class="icon-caret-down"></i>
                      	</a>
                    </li>
                    <li>
                      <a href="#"><?php echo of_get_option('order_prices'); ?></a>
                      <a href="#" data-toggle="tooltip" title="<?php echo of_get_option('sort_a'); ?>" class="btn_order" data-order="asc" data-type="price">
                        	<i class="icon-caret-up"></i>
                      </a>
                      <a href="#" data-toggle="tooltip" title="<?php echo of_get_option('sort_d'); ?>" class="btn_order" data-order="desc" data-type="price">
                        	<i class="icon-caret-down"></i>
                      </a>
                    </li>                            
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="text_right tooltip_hover">
                    <li title="<?php echo of_get_option('grid_layout_bar'); ?>" data-toggle="tooltip" class="<?php echo (($maison_layout == 'box') ? 'active' : '') ?>">
                      <a href="<?php echo add_query_arg(array('layout' => 'box')) ?>">
                        <i class="icon-th-large"></i>
                      </a>
                  	</li>
                    <li title="<?php echo of_get_option('list_layout_bar'); ?>" data-toggle="tooltip" class="<?php echo (($maison_layout == 'list') ? 'active' : '') ?>">
                      <a href="<?php echo add_query_arg(array('layout' => 'list')) ?>">
                        <i class="icon-list"></i>
                      </a>
                  	</li> 
                </ul>
            </div>
        </div>
    </div>
    <!-- End Bar properties-->
    
    <?php
        $maison_args = array();
        $maison_args=array(
            'post_type' => 'property',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );
        $maison_my_query = null;
        $maison_my_query = new WP_Query($maison_args);
        $maison_property = array();
        
        while ($maison_my_query->have_posts()) {
            $maison_my_query->the_post();
            $maison_property[] = array(
                'ptitle' => get_the_title(),
                'images' => get_field('images'),
                'type' => get_field('type'),
                'area' => get_field('area'),
                'location' => get_field('location'),
                'desc' => get_field('description'),
				'desc_list' => get_field('description_list_style'),				
                'date' => get_the_time('Ymd'),
                'full_price' => get_field('price_unit').get_field('price'),
                'price' => get_field('price'),
                'permalink' => get_permalink(get_the_ID()),
                'generals' => get_field('general_prop'),
            );
        }
        $maison_c = 0;
        foreach($maison_property as $maison_value){
            if(array_search($maison_value['ptitle'],$maison_property_name) !== false){
                $maison_c++;
                
                if($maison_layout == 'box'){
                    if($maison_c==1){
                        echo '<div class="row padding_top_mini order-container " data-layout="home">';
                    }
                    
                 echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 order" data-price="'.$maison_value['price'].'" data-date="'.$maison_value['date'].'" data-type="'.$maison_value['type'].'">';
                    echo '<div class="item_property">
                             <div class="head_property">';
                                    echo '<a href="'.$maison_value['permalink'].'">';
                                        echo '<div class="title '.strtolower($maison_value['type']).'"></div>';
                                        echo ($maison_value['images'] !== null)?'<img src="'.$maison_value['images'][0]['url'].'" alt="Image">':'<img src="" alt="Not Image">';
                                        echo '<h5>'.$maison_value['ptitle'].'</h5>';
                                    echo '</a>
                              </div>                        
                              <div class="info_property">                                  
                                  <ul>';
                                  if(!empty($maison_value['generals']))
                                    foreach($maison_value['generals'] as $k=>$g){
                                        echo ($k%2 == 0)?'<li class="resalt"><strong>'.$g['title'].'</strong><span>'.$g['value'].'</span></li>':'<li><strong>'.$g['title'].' </strong><span>'.$g['value'].'</span></li>';
                                    }
                                    //  <li><strong>'.of_get_option('title_price_description').':</strong><span> '.$maison_value['full_price'].'  </span></li>
                                    //  <li><strong>'.of_get_option('title_location_description').':</strong><span> '.$maison_value['location'].' </span></li>
                              echo '</ul>                                 
                              </div>
                          </div>
                      </div>';
                    
                    
                }else if($maison_layout == 'list'){
                    if($maison_c==1){
                        echo '<div class="row"><div class="col-md-12 order-container " data-layout="home-list">';
                    }

                    echo '<article class="item_property_h order" data-price="'.$maison_value['price'].'" data-date="'.$maison_value['date'].'" data-type="'.$maison_value['type'].'">';
                        echo '<div class="col-md-4">
                                <div class="image_property_h">                            
                                    <div class="hover_property_h">';
                                          echo ($maison_value['images'] !== null)?'<img src="'.$maison_value['images'][0]['url'].'" alt="Image">':'<img src="" alt="Not Image">';
                                          echo '<a href="'.$maison_value['permalink'].'" class="info_hover_property_h">';
                                          echo '<span class="listing-cover-plus">+</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="info_property_h">';
                                    echo '<h4><a href="'.$maison_value['permalink'].'">'.$maison_value['ptitle'].'</a><span> '.$maison_value['location'].' </span></h4> ';
                                    echo '<p>'.wp_trim_words($maison_value['desc_list'],58,'...').'</p>';
                                    echo '</div>
                           			 </div>';
                       		 echo '<div class="line_property"><span>'.$maison_value['full_price'].'</span>For '.$maison_value['type'].'</div>';
                    echo '</article>';
             	} 
          }
       }  
			
			
       if(!empty($maison_btn)){
          echo '<div class="row center padding_top">
									<div class="col-md-12">
		                  <a href="'.$maison_btn_link.'" class="button">'.$maison_btn.'</a>
									</div>
              </div>';
       }

       if(!empty($maison_key['title_zone']) || !empty($maison_key['subtitle_zone'])){
    ?>
       <div class="titles">
            <?php if(!empty($maison_key['subtitle_zone'])){?>
            <span><?php echo $maison_key['subtitle_zone']?></span>
            <br>
            <?php }if(!empty($maison_key['title_zone'])){?>
            <h1><?php echo $maison_key['title_zone']?></h1>
            <?php }?>
       </div>
    <?php
        }
    ?>
    <!-- End Button-->
  
  		<?php
         	if($maison_layout == 'list'){
             echo '</div>';
         }   
     	?>
   	
  		<!-- Divisor Bottom-->
      <?php
        echo ($maison_key['div_line'] == 'botton')?'
          <div class="col-md-12">
            <div class="divisor divisor-bottom">
              <div class="circle_left"></div>
              <div class="circle_right"></div>
            </div>
      	</div>':'';
      ?>  
      <!-- End Divisor Bottom -->
  
  		
   </div>
</div>