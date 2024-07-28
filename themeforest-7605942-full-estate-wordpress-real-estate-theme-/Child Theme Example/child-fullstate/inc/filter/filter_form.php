<?php
    global $maison_filter_form;
    global $maison_filter_style;
    $maison_key = array();
    $maison_key = $maison_filter_form;
?>

<div class="container">  
   <div class="row">  
         <div class="<?php echo ($maison_filter_style == 'filter2')?'col-md-3':'col-md-12';?>">
             <?php echo ($maison_filter_style == 'filter2')?'<div class="header-filter-box">':'<div class="header-filter-horizontal">'; ?>
                  
                  <ul class="tabs_services">
                      <?php
                         $maison_c = 0;
                         foreach($maison_key as $maison_f){
                            $maison_c++;
                            echo '<li><a id="'.$maison_c.'" class="switcher set2">'.$maison_f['tab_form_titles'].'</a></li>';
                         }
                      ?>
                  </ul>
                  
                  <?php echo ($maison_filter_style == 'filter2')?'<div class="clearfix"></div>':''; ?>
                  <div class="switcher-panel"></div>
                  
                  <?php 
                    $maison_c = 0;
                    foreach($maison_key as $maison_f){
                        $maison_c++;
                        $maison_show = ($maison_c == 1)?'show':'';    
                        echo '<div id="'.$maison_c.'-content" class="switcher-content set2 '.$maison_show.'">
                                	<div class="search_box">';
                                			do_shortcode($maison_f['shortcode_filter']);
                       			echo '</div>
														 </div>';
                      }
                  ?>
             </div> 
        </div> 
   </div> 
</div>   