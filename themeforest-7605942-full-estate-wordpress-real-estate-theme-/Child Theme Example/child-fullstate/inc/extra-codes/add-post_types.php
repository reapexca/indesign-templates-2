<?php

//ADD AGENT
add_action( 'init', 'maison_create_agent' );
if( !function_exists( 'maison_create_agent' ) ) {
    function maison_create_agent() {
      $labels = array(
        'name' => __('Agents', 'post type general name','acf'),
        'singular_name' => __('Agent', 'post type singular name','acf'),
        'add_new' => __('Add Agent', 'Team Member','acf'),
        'add_new_item' => __('Add new Agent','acf'),
        'edit_item' => __('Edit Agent','acf'),
        'new_item' => __('New Agent','acf'),
        'view_item' => __('See Agent','acf'),
        'search_items' => __('Search Agents','acf'),
        'not_found' =>  __('Agent Not found','acf'),
        'not_found_in_trash' => __('Not found Agents into clipboard','acf'),
        'parent_item_colon' => '',
        
      );

      $supports = array(
        'title',
        'custom-fields'
      );

      register_post_type( 'agent',
        array(
          'labels' => $labels,
          'public' => true,
          'menu_position' => 20,
          'supports' => $supports,
          'menu_icon' => 'dashicons-businessman'
        )
      );
    } 
}

//PLANS
add_action( 'init', 'maison_crear_plan_sistem' );
if( !function_exists( 'maison_crear_plan_sistem' ) ) {
    function maison_crear_plan_sistem() {
      $labels = array(
        'name' => __('Pricing Tables', 'post type general name','acf'),
        'singular_name' => __('Plan', 'post type singular name','acf'),
        'add_new' => __('Add Plan', 'Team Member','acf'),
        'add_new_item' => __('Add new Plan','acf'),
        'edit_item' => __('Edit Plan','acf'),
        'new_item' => __('New Plan','acf'),
        'view_item' => __('See Plan','acf'),
        'search_items' => __('Search Plan','acf'),
        'not_found' =>  __('Not found Planes','acf'),
        'not_found_in_trash' => __('Not found Planes into clipboard','acf'),
        'parent_item_colon' => '',
        
      );

      $supports = array(
        'title',
        'editor',
        'custom-fields'
      );

      register_post_type( 'plan_sistem',
        array(
          'labels' => $labels,
          'public' => true,
          'menu_position' => 20,
          'supports' => $supports
          ,'menu_icon' => 'dashicons-welcome-write-blog',
          'taxonomies' => array('category')
        )
      );
	}
}

//ADD PROPERTY
add_action( 'init', 'maison_create_property' );
if( !function_exists( 'maison_create_property' ) ) {
    function maison_create_property() {
      $labels = array(
        'name' => __('Properties', 'post type general name','acf'),
        'singular_name' => __('Property', 'post type singular name','acf'),
        'add_new' => __('Add Property', 'Team Member','acf'),
        'add_new_item' => __('Add new Property','acf'),
        'edit_item' => __('Edit Property','acf'),
        'new_item' => __('New Property','acf'),
        'view_item' => __('See Property','acf'),
        'search_items' => __('Search Properties','acf'),
        'not_found' =>  __('Property Not found','acf'),
        'not_found_in_trash' => __('Not found Properties into clipboard','acf'),
        'parent_item_colon' => '',
        
      );

      $supports = array(
        'title',
        'custom-fields',
        'comments'
      );

      register_post_type( 'property',
        array(
          'labels' => $labels,
          'public' => true,
          'menu_position' => 20,
          'supports' => $supports,
          'menu_icon' => 'dashicons-admin-home',
          'taxonomies' => array('category')
        )
      );
    } 
}