<?php
    $maison_key = $maison_value['rpt'];
		
		if($maison_key['feature_row'] == 1){
      $maison_feature_row = 'col-sm-6 col-md-4 col-lg-12';
    }else if($maison_key['feature_row'] == 2){
      $maison_feature_row = 'col-sm-6 col-md-6 col-lg-6';
    }else if($maison_key['feature_row'] == 3){
      $maison_feature_row = 'col-xs-12 col-sm-6 col-md-4 col-lg-4';
    }else if($maison_key['feature_row'] == 4){
      $maison_feature_row = 'col-sm-6 col-md-3 col-lg-3';
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
            if($maison_key['title_zone'] !== false){
         ?> 
      
          <div class="col-md-12">
            <div class="titles">
              <h1><?php echo $maison_key['title_zone']?></h1>
            </div>
          </div>
              
        <?php
          }
        ?>
              
        <div class="services">
          <?php
            foreach($maison_key['data'] as $maison_data){       
          ?>
        
          <div class="<?php echo $maison_feature_row; ?>">
              <h3>
                <a href="<?php echo $maison_data['link']?>">
                  <?php echo $maison_data['title']?>
                </a>
              </h3>
              
              <div class="item_service">
                  <div class="image_service">
                      <i class="<?php echo $maison_data['icon'];?>"></i>
                  </div>
                  
                  <div class="info_service">
                      <p><?php echo $maison_data['description']?></p>
                  </div>
                	<div class="clearfix"></div>
              </div>
     			</div>
        <?php
            }     
        ?>
    </div>
      
 			
    <?php
      echo ($maison_key['div_line'] == 'botton')?'<div class="col-md-12"><div class="divisor divisor-bottom"><div class="circle_left"></div><div class="circle_right"></div></div></div>':'';
    ?>
  
  </div>
</div>