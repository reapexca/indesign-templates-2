<?php
     global $maison_page_template;
    $maison_ok = null;        
    $maison_stemplate = (function_exists('of_get_option'))?of_get_option('sponsor_template'):false;
    if($maison_stemplate !== false){                                            
        $maison_temp = of_get_option('sponsor_template');        
        if($post->post_type !== 'page' && !array_key_exists(strtolower($maison_page_template),$maison_temp))
            $maison_page_template = ($post->post_type == 'post')?'single':'single-property';
        if(array_key_exists(strtolower($maison_page_template),$maison_temp)){                                    
            if($maison_temp[$maison_page_template] == '1' && of_get_option('show_sponsor') == '1'){
                
?>    
    <div class="container">
        <ul class="sponsors">
        <?php
            for($maison_i=1; $maison_i<=of_get_option('sponsor_num'); $maison_i++){    
                echo '<li data-toggle="tooltip" title data-original-title="'.of_get_option('sponsor_title'.$maison_i).'">
                        <a href="'.of_get_option('sponsor_link'.$maison_i).'"><img src="'.of_get_option('sponsor_img'.$maison_i).'" alt="Image">
                        </a>
                </li>';
            }
        ?>
        </ul>
    </div>
<?php
            }
        }
    }
?>