<?php
    $maison_key = $maison_value['rpt'];  
    $maison_plans = array();
    if($maison_key['plans_to_show'] !== false){
        foreach($maison_key['plans_to_show'] as $maison_plan){
            $maison_plans[] = get_fields($maison_plan->ID);
        }
    }

    $maison_resalt = ($maison_key['show_resalt_plan'][0] == '1')?'item_table_resalt':'';

    if($maison_key['plan_row'] == 1){
      $maison_plans_row = 'col-sm-6 col-md-offset-4 col-md-4 col-lg-4';
    }else if($maison_key['plan_row'] == 2){
      $maison_plans_row = 'col-sm-6 col-md-6 col-lg-6';
    }else if($maison_key['plan_row'] == 3){
      $maison_plans_row = 'col-sm-6 col-md-4 col-lg-4';
    }else if($maison_key['plan_row'] == 4){
      $maison_plans_row = 'col-sm-6 col-md-3 col-lg-3';
    }else if($maison_key['plan_row'] == 5){
      $maison_plans_row = 'col-sm-6 col-md-2 col-lg-2';
    }
?>

<div class="container">
  <div class="row">
    
    <!-- Divisor Top-->
    <?php
        echo ($maison_key['div_line'] == 'top')?'
          <div class="col-md-12">
            <div class="divisor divisor-top">
              <div class="circle_left"></div>
              <div class="circle_right"></div>
            </div>
          </div>':'';
    ?>
  	<!-- End Divisor Top-->
    
    <div class="col-md-12">
      	<div class="titles">
            <span><?php echo $maison_key['title']?></span>
            <br>
            <h1><?php echo $maison_key['subtitle']?></h1>
        </div>
    </div>

    <?php
        $maison_weightArray = array();
        foreach ($maison_plans as $maison_key => $maison_row)
        {
           $maison_weightArray[$maison_key] = $maison_row['table_position'];
        }
        array_multisort($maison_weightArray, SORT_ASC, $maison_plans);
    
        foreach($maison_plans as $maison_p){
    ?>  
            
    <div class="<?php echo $maison_plans_row; ?>">  
        <div class="item_table <?php echo ($maison_p['resalt'][0]=='1')?$maison_resalt:'';?>">
            <div class="head_table">      
                <h1><?php echo $maison_p['title'];?></h1>
                <h2><?php echo $maison_p['price'];?>  <span> <?php echo $maison_p['frequency'];?></span></h2>
                <h5><?php echo $maison_p['other_price'];?></h5>
            </div>
            <ul>  
                <?php
                    $maison_i=0;
                    foreach($maison_p['rows'] as $maison_plan_v){     
                        $maison_i++;
                        echo $maison_i%2 == 0? '<li class="color">' : '<li>';
                        echo $maison_plan_v['value'].'</li>';
                    }    
                ?>
            </ul> 
            <a href="<?php echo $maison_p['btn_link'];?>" class="button"><?php echo $maison_p['btn_title'];?></a>
        </div>
    </div>

    <?php
         }
    ?>
    
    <!-- Divisor Top-->
    <?php
      echo ($maison_key['div_line'] == 'botton')?'
        <div class="col-md-12">
          <div class="divisor divisor-bottom">
            <div class="circle_left"></div>
            <div class="circle_right"></div>
          </div>
        </div>':'';
    ?>
  	<!-- End Divisor Top-->
    
	</div>
</div>