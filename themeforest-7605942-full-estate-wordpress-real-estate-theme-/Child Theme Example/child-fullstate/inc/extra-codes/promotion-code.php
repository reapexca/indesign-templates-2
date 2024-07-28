<?php
    global $maison_page_template;
    $maison_ok = null;
    $maison_ptemplate = (function_exists('of_get_option'))?of_get_option('show_promotion_pages'):false;
    if($maison_ptemplate !== false){                                                
        $maison_temp = of_get_option('show_promotion_pages');
        if($post->post_type !== 'page' && !array_key_exists(strtolower($maison_page_template),$maison_temp))
            $maison_page_template = ($post->post_type == 'post')?'single':'single-property';
        if(array_key_exists(strtolower($maison_page_template),$maison_temp)){            
            if($maison_temp[strtolower($maison_page_template)] == '1' && of_get_option('show_pub') == '1'){        
?>    
    <footer class="section_area paddings footer_top">
      <div class="container center"> 
        <h1><?php echo (function_exists('of_get_option'))?of_get_option('footer_first_title'):'Get in touch';?></h1>
        <p><?php echo (function_exists('of_get_option'))?maison_insert_br(of_get_option('footer_first_desc')):'Lorem ipsum ea cum congue bonorum, pri no natum clita. His ne vide omnis forensibus. Eum cetero imperdiet et.!:';?></p>
        <a href="<?php echo (function_exists('of_get_option'))?of_get_option('footer_first_btn_link'):'Lorem ipsum ea cum congue bonorum, pri no natum clita. His ne vide omnis forensibus. Eum cetero imperdiet et.!:';?>" class="button">
          <?php echo (function_exists('of_get_option'))?of_get_option('footer_first_btn'):'Demo';?>
        </a>                
        <br><br>
      </div>
    </footer>
<?php
            }
       }
    }
 ?>