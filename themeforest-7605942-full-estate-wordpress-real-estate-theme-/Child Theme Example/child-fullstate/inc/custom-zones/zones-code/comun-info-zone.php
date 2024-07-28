<?php
    $maison_key = $maison_value['rpt'];
    $maison_title = $maison_key['title'];
    $maison_subtitle = $maison_key['subtitle'];
 ?>

<div class="container">
		<div class="row">
      	<div class="col-md-12">
         <?php
            echo ($maison_key['div_line'] == 'top')?'<div class="divisor divisor-top"><div class="circle_left"></div><div class="circle_right"></div></div>':'';
         ?>
         </div>
      
         <div class="col-md-12">
          <?php
               echo (!empty($maison_title) || !empty($maison_subtitle))?'<div class="titles">':'';
               echo (!empty($maison_title))?'<span>'.$maison_title.'</span><br>':'';
               echo (!empty($maison_subtitle))?'<h1>'.$maison_subtitle.'</h1>':'';
               echo (!empty($maison_title) || !empty($maison_subtitle))?'</div':'';
           ?>
          <p class="lead"><?php echo $maison_key['description'];?></p>     
        </div>
				
       <div class="col-md-12">
       <?php
          echo ($maison_key['div_line'] == 'botton')?'<div class="divisor divisor-bottom"><div class="circle_left"></div><div class="circle_right"></div></div>':'';
       ?>
       </div>
   </div>
</div>