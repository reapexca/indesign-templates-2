<?php
    global $maison_page_template;
    $maison_ok = null;
    $maison_ntemplate = (function_exists('of_get_option'))?of_get_option('news_template'):false;
    if($maison_ntemplate !== false){                                                
        $maison_temp = of_get_option('news_template');         
        if($post->post_type !== 'page')
            $maison_page_template = ($post->post_type == 'post')?'single':'single-property';
        if(array_key_exists(strtolower($maison_page_template),$maison_temp))        
            if($maison_temp[$maison_page_template] == '1'){   
            
        /*$maison_temp = array_keys(of_get_option('news_template'));
        if(!function_exists('template_alter')){
            function template_alter(&$maison_e,$maison_k){
                 $maison_e = 'template-'.$maison_e.'.php';
            }
        }
        array_walk($maison_temp,'template_alter');
        $maison_template = array_combine($maison_temp,of_get_option('news_template'));
        if(!function_exists('template_filter')){
            function template_filter($maison_e){
                return($maison_e!='0');
            }
        }
        $maison_template = array_filter($maison_template,'template_filter');
        $maison_ok = $post->page_template != 'default' ? $post->page_template == ''? true : array_key_exists($post->page_template,$maison_template) : true;
        if($maison_ok && of_get_option('show_news')){       */
?>    
				<!-- Newsletter Box -->
        <div class="newsletter_box">
					<div class="container">
						<div class="row">
							<div class="col-md-8">
                <h3>
                  <?php echo of_get_option('news_title');?>
                  <span><?php echo of_get_option('news_subtitle');?></span>
                </h3>                    
							</div>
							
              <div class="col-md-4">
                <?php
                  $GLOBALS['sidebar_news'] = (of_get_option('news_form') !== false && of_get_option('news_form') !== '') ? of_get_option('news_form') : 'sidebar-newsletter';
                  get_sidebar($GLOBALS['sidebar_news']);
                ?>
							</div>
						</div>	
					</div>
       </div>
			<!-- End Newsletter Box -->
<?php
       }
    }
 ?>