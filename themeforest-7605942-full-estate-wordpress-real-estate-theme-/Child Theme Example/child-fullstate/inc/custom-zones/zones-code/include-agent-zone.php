<?php
    $maison_key = $maison_value['rpt'];    
    $maison_post_names = array();
    $maison_title_zone = $maison_key['title'];
    $maison_subtitle_zone = $maison_key['subtitle'];
    if ($maison_key['agent_to_show'] !== false)
        foreach($maison_key['agent_to_show'] as $maison_key_v){
            $maison_post_names[] = $maison_key_v->post_title;
        } 
    $maison_args = array();
    $maison_args=array(
      'post_type' => 'agent',
      'post_status' => 'publish',
      'posts_per_page' => -1,
    );
    $maison_my_query = null;
    $maison_my_query = new WP_Query($maison_args);
    $maison_team = array();
    
    while ($maison_my_query->have_posts()) {
        $maison_my_query->the_post();
        $maison_team[] = array(
            'title' => get_the_title(),
            'name' => get_field('name'),
            'ocupation' => get_field('ocupation'),
            'image' => get_field('image'),
          	'description' => get_field('description'),
            'social_link' => get_field('social_link'),
        );
    }
		if($maison_key['agent_row'] == 1){
      $maison_agent_row = 'col-sm-6 col-md-offset-4 col-md-4 col-lg-4';
    }else if($maison_key['agent_row'] == 2){
      $maison_agent_row = 'col-sm-6 col-md-6 col-lg-6';
    }else if($maison_key['agent_row'] == 3){
      $maison_agent_row = 'col-sm-6 col-md-4 col-lg-4';
    }else if($maison_key['agent_row'] == 4){
      $maison_agent_row = 'col-xs-12 col-sm-6 col-md-4 col-lg-3';
    }else if($maison_key['agent_row'] == 5){
      $maison_agent_row = 'col-sm-6 col-md-2 col-lg-2';
    }
?>
<div class="container">
  <div class="row">
       <?php
          echo ($maison_key['div_line'] == 'top')?'
          <div class="col-md-12">
            <div class="divisor divisor-top">
              <div class="circle_left"></div>
              <div class="circle_right"></div> 
            </div>
          </div>':'';
       ?>
 
      <?php
          echo (!empty($maison_title_zone) || !empty($maison_subtitle_zone))?'<div class="col-md-12"><div class="titles">':'';
          echo (!empty($maison_title_zone))?'<span>'.$maison_title_zone.'</span><br>':'';
          echo (!empty($maison_subtitle_zone))?'<h1>'.$maison_subtitle_zone.'</h1>':'';
          echo (!empty($maison_title_zone) || !empty($maison_subtitle_zone))?'</div></div>':'';
      ?>	
	
      <?php	
          $maison_c = 0;   
          foreach($maison_team as $maison_key){
              if(array_search($maison_key['title'],$maison_post_names) !== false){
      ?>
       <!-- Item Teams Member-->
       <div class="<?php echo  $maison_agent_row ; ?>">
          <div class="item_team">
              <div class="image_team">                        
                  <img src="<?php echo $maison_key['image']?>" alt="<?php echo $maison_key['name']?>">
                  <span class="arrow_team_white"></span>
              </div>
              <div class="info_team">
                  <h4><?php echo $maison_key['name']?>
                    <span><?php echo $maison_key['ocupation']?></span>
                  </h4>
                	<?php echo $maison_key['description']?>
                  <ul class="social">
                    <?php
                       foreach($maison_key['social_link'] as $maison_key_v){
                    ?>
                    <li data-toggle="tooltip" title data-original-title="<?php echo $maison_key_v['title']?>">
                      <a href="<?php echo $maison_key_v['link']?>" target="<?php echo $maison_key_v['target_social_agent']?>">
                        <i class="<?php echo $maison_key_v['icon']?>"></i>
                      </a>
                    </li>
                    <?php
                       }
                    ?>
                  </ul>
              </div>
          </div>
       </div>
       <!-- Item Teams Member-->
        <?php 
            } } 
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