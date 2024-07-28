<div class="container">
<?php
    $maison_key = $maison_value['rpt'];
    $maison_property_name = array();
    if($maison_key['prop_carousel'] !== false){
        foreach($maison_key['prop_carousel'] as $maison_key_v){
            $maison_property_name[] = $maison_key_v->post_title;
        } 
    }else{
        $maison_property_name[] = array();
    }
 ?>
  
	  <!-- Divisor Bottom-->
    <?php
    echo ($maison_key['div_line'] == 'top')?'
			<div class="row">
    			<div class="col-md-12">
							<div class="divisor divisor-top">
								<div class="circle_left"></div>
								<div class="circle_right">
							</div>
					</div>
          </div>
      </div>':'';
    ?>  
  	<!-- End Divisor Bottom-->
  
		<div class="content-carousel">
        <div class="row">
            <div class="col-md-12">
                <!-- Title-->
                <?php
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
                <!-- End Title-->
            </div>
        </div>
  
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
                'image' => get_field('images'),
                'type' => get_field('type'),
                'location' => get_field('location'),
                'price' => get_field('price_unit').get_field('price'),
                'permalink' => get_permalink(get_the_ID()),
            );
        }     
        ?>
        <!-- Carousel Properties -->
        <div id="properties-carousel" class="properties-carousel">
        <?php
         foreach($maison_property as $maison_value){
            if(array_search($maison_value['ptitle'],$maison_property_name) !== false){
        ?>
            <!-- Item Property-->
            <div class="item_property">
                <div class="head_property">
                  <a href="<?php echo $maison_value['permalink']?>">
                    <div class="title <?php echo $maison_value['type']?>"></div>
                    <img src="<?php echo ($maison_value['image'] !== '')?$maison_value['image'][0]['url']:'' ?>" alt="Image">
                    <h5><?php echo $maison_value['ptitle']?></h5>
                  </a>
                </div>                        
                <div class="info_property">                                  
                    <ul>
                        <li><strong><?php echo of_get_option('title_place_carousel'); ?>:</strong><span><?php echo $maison_value['location']?></span></li>
                        <li><strong><?php echo of_get_option('title_price_carousel'); ?>:</strong><span><?php echo $maison_value['price']?></span></li>
                    </ul>                                 
                </div>
            </div>
            <!-- Item Property-->
        <?php
            }
         }
        ?>

        </div>
        <!-- End Carousel Properties -->

      
      	<!-- Divisor Bottom-->
        <?php
        echo ($maison_key['div_line'] == 'botton')?'
          <div class="row">
              <div class="col-md-12">
                  <div class="divisor divisor-bottom">
                    <div class="circle_left"></div>
                    <div class="circle_right">
                  </div>
              </div>
              </div>
          </div>':'';
        ?>  
        <!-- End Divisor Bottom-->
  
  	</div>
</div>