<?php

get_header();

global $maison_filter_form;
if(isset($_SESSION['FILTER_FORM']))
    foreach($_SESSION['FILTER_FORM'] as $f)        
        $maison_filter_form = $_SESSION['FILTER_FORM'];    
  
//global $post;
$current_ID = get_the_ID();

$maison_layout = isset($_REQUEST['layout']) ? $_REQUEST['layout'] : 'box';
$_COOKIE['layout'] = (isset($_GET['layout'])) ? $_GET['layout'] : $maison_layout;

if(function_exists('get_field')){
    $GLOBALS['sidebar_name'] = (get_field('sidebar_name') !== '')?get_field('sidebar_name'):'filter';
    $maison_pos = (get_field('position') !== false)?get_field('position'):'3';
    $maison_number_properties = (get_field('num_properties') !== false)?get_field('num_properties'):'3';
    $maison_acor = (get_field('rpt-acordion') !== false)?get_field('rpt-acordion'):array();
}
if(!function_exists('get_field')){
$maison_post = get_post();
    if(!empty($maison_post->post_content)){
        echo '<section class="section_area">
                <div class="container">
                    <div class="row">';
                echo $maison_post->post_content;
                echo '</div>
                </div>
            </section>';
    }
}else{
    ?>
<div class="container">
  <div class="row paddings">
        <?php
            if($maison_pos == '1'){
                echo '<div class="col-md-3"><aside';
                    get_sidebar(); 
                echo '</aside>';
            }
         ?>
        <div class="<?php echo ($maison_pos != '2')?'col-md-9':'row'; echo ($maison_layout == 'box')?' properties_two':'';?> counter-page" data-count="<?php echo $maison_number_properties;?>">
            <!-- Bar Filter properties-->
            <div class="bar_properties">
                <div class="row">
                    <div class="<?php echo ($maison_pos == '2')?'col-md-5':'col-md-8';?>">
                        <strong>Order By:</strong>
                        <ul class="tooltip_hover">                            
                            <li>
                                <a href="#">Recent ads</a>
                                <a href="#" data-toggle="tooltip" title data-original-title="Sort Ascending" class="btn_order"  data-order="asc" data-type="date"><i class="fa fa-caret-up"></i></a>
                                <a href="#" data-toggle="tooltip" title data-original-title="Sort Descending" class="btn_order" data-order="desc" data-type="date"><i class="fa fa-caret-down"></i></a>
                            </li>
                            <li>
                              <a href="#">Price</a>
                              <a href="#" data-toggle="tooltip" title data-original-title="Sort Ascending" class="btn_order" data-order="asc" data-type="price"><i class="fa fa-caret-up"></i></a>
                              <a href="#" data-toggle="tooltip" title data-original-title="Sort Ascending" class="btn_order" data-order="desc" data-type="price"><i class="fa fa-caret-down"></i></a>
                            </li>                            
                        </ul>
                    </div>
                    <div class="<?php echo ($maison_pos == '2')?'col-md-3':'col-md-4';?>">
                      <ul class="text_right tooltip_hover">
                          <li title="Box" data-toggle="tooltip" data-original-title="Box" class=" <?php echo (($maison_layout == 'box') ? 'active' : '') ?>"><a href="<?php echo add_query_arg(array('layout' => 'box')) ?>"><i class="icon-th-large"></i></a></li>
                          <li title="List" data-toggle="tooltip" data-original-title="List" class="active <?php echo (($maison_layout == 'list') ? 'active' : '') ?>"><a href="<?php echo add_query_arg(array('layout' => 'list')) ?>"><i class="icon-list"></i></a></li> 
                      </ul>
                    </div>
                </div>
            </div>
            <!-- End Bar Filter properties-->
            <?php
                    $maison_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    
                    $maison_args=array(
                            'post_type' => 'property',
                            'post_status' => 'publish',
                            'paged' => $maison_paged,
                            'posts_per_page' => -1,
                            'order' => 'ASC',
                    );
                    $maison_my_query = null;
                    $maison_my_query = new WP_Query($maison_args);
                    $maison_request = array();
                    
                    while ($maison_my_query->have_posts()) {
                        $maison_my_query->the_post();
                        $maison_request[] = array(
                            'ID' => get_the_ID(),
                        );
                    }
                    $maison_property = array();
                    if($GLOBALS['wp_query']->posts !== null){
                        if($current_ID !== $GLOBALS['wp_query']->posts[0]->ID){
                            $maison_property = $GLOBALS['wp_query']->posts;
                        }else{
                            foreach($maison_request as $r) $maison_property[] = $r;
                        }
                    }else{
                        foreach($maison_request as $r) $maison_property[] = $r;
                    }
                    
                    $maison_c = 0;
                    $maison_count = 0;
                    echo ($maison_layout == 'box')?'<div class="row"><div class="order-container" data-cprop="'.count($maison_property).'" data-layout="box">':'<div class="row order-container" data-cprop="'.count($maison_property).'" data-layout="home-list"><div class="col-md-12">';
                    foreach($maison_property as $maison_val){
                        if(is_object($maison_val))
                            $post = get_post($maison_val->ID);
                        else
                            $post = get_post($maison_val['ID']);
                        setup_postdata($post);    
                        $maison_value = array(
                            'ptitle' => get_the_title(),
                            'images' => get_field('images'),
                            'type' => get_field('type'),
                            'area' => get_field('area'),
                            'location' => get_field('location'),
                            'desc' => get_field('description'),
                            'date' => get_the_time('Ymd'),
                            'full_price' => get_field('price_unit').get_field('price'),
                            'price' => get_field('price'),
                            'permalink' => get_permalink(get_the_ID()),
                            'generals' => get_field('general_prop'),
                        );
                        $maison_aux = $maison_number_properties;
                        $maison_count = ($maison_c%$maison_aux == 0)?$maison_count+1:$maison_count;
                        $maison_c++;
                        if($maison_layout == 'box'){
                            $maison_style_box = ($maison_pos == '3')?'col-md-3':'col-xs-12 col-sm-6 col-md-6 col-lg-4';
                            echo '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 order show'.$maison_count.'" data-price="'.$maison_value['price'].'" data-date="'.$maison_value['date'].'" data-type="'.$maison_value['type'].'">';
                                echo '<div class="item_property">
                                        <div class="head_property">';
                                        echo '<a href="'.$maison_value['permalink'].'">';
                                            echo '<div class="title '.strtolower($maison_value['type']).'"></div>';
                                            echo ($maison_value['images'] !== null)?'<img src="'.$maison_value['images'][0]['url'].'" alt="Image">':'<img src="" alt="Not Image">';
                                            echo '<h5>'.$maison_value['ptitle'].'</h5>';
                                        echo '</a>
                                        </div>                        
                                        <div class="info_property">                                  
                                          <ul>';
                                          if(!empty($maison_value['generals']))
                                            foreach($maison_value['generals'] as $k=>$g){
                                                echo ($k%2 == 0)?'<li class="resalt"><strong>'.$g['title'].'</strong><span>'.$g['value'].'</span></li>':'<li><strong>'.$g['title'].' </strong><span>'.$g['value'].'</span></li>';
                                            }                                                       
                                        echo '</ul>                                 
                                        </div>';
                                echo '</div>';
                            echo '</div>';
                        }

                    }
                    echo ($maison_layout == 'box')?'</div></div>':'</div></div>';
            ?>
            <!-- Pagination-->
            <ul class="pagination page-my">
            <?php
                for($i=1; $i<=ceil(count($maison_property)/$maison_number_properties); $i++){
                    echo ($i == 1)?'<li data-in="'.$i.'" class="active"><a href="#">'.$i.'</a></li>':'<li data-in="'.$i.'"><a href="#">'.$i.'</a></li>';
                }    
            ?>
            </ul>
            <!-- End Pagination-->
        </div>
<?php
        if($maison_pos == '3'){
            echo '<div class="col-md-3"><aside';
                get_sidebar();
            echo '</aside></div>';
        }

}
?>
    </div>
    </div>
<?php
    get_footer();
?>