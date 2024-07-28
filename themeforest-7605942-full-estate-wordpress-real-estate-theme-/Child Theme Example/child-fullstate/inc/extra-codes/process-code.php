<?php     
    global $maison_page_template;
    $maison_ok = null;
    $maison_ptemplate = (function_exists('of_get_option'))?of_get_option('pub_template'):false;
    if($maison_ptemplate !== false){    
        $maison_temp = of_get_option('pub_template');
        if($post->post_type !== 'page' && !array_key_exists(strtolower($maison_page_template),$maison_temp))
            $maison_page_template = ($post->post_type == 'post')?'single':'single-property';
        if(array_key_exists(strtolower($maison_page_template),$maison_temp))
            if($maison_temp[strtolower($maison_page_template)] == '1' && of_get_option('show_pub') == '1'){
        /*$maison_temp = array_keys(of_get_option('pub_template'));
        
        if (!function_exists('template_alter')) {
        function template_alter(&$maison_e,$maison_k){$maison_e = 'template-'.$maison_e.'.php';}
        }
        
        array_walk($maison_temp,'template_alter');
        $maison_template = array_combine($maison_temp,of_get_option('pub_template'));
        
        if (!function_exists('template_filter')) {
        function template_filter($maison_e){return($maison_e!='0');}
        }
        
        $maison_template = array_filter($maison_template,'template_filter');
        $maison_ok = $post->page_template != 'default' ? $post->page_template == ''? true : array_key_exists($post->page_template,$maison_template) : true;
        if($maison_ok && of_get_option('show_pub')){  */    
?>	
      <!-- full_info-->
      <section class="full_info">
          <div class="container">
              <div class="row text-center service-process">
              <?php
                  for($maison_i=1; $maison_i<=of_get_option('pub_num'); $maison_i++){                         
              ?>
                  <!-- Step -->
                  <a href="<?php echo of_get_option('pub_link'.$maison_i);?>">
                    <div class="col-md-3">
                        <div class="thumbnail-process">
                          <div class="caption-head">
                            <!--<em class="caption-icon icon-check icon-big"></em> -->
                            <em class="caption-icon"> 
                              <i <?php echo font_awesome_icon_style('pub_ico'.$maison_i);?>></i>
                            </em>   
                            <h2 class="caption-title"><?php echo of_get_option('pub_title'.$maison_i);?></h2>
                          </div>
                        </div>
                    </div>
                  </a>
                  <!-- End Step -->
                <?php
                    }
                ?>
              </div>
          </div>
      </section>
      <!-- End full_info-->
<?php
        }
    }
?>