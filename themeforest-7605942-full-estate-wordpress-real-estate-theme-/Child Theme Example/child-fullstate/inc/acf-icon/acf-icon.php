<?php
/*
Plugin Name: Advanced Custom Fields: Repeater Field
Plugin URI: http://www.advancedcustomfields.com/
Description: Adds the repeater field
Version: 1.0.1
Author: Elliot Condon
Author URI: http://www.elliotcondon.com/
License: GPL
Copyright: Elliot Condon
*/


class acf_icon_plugin
{
	var $settings;
	
	
	/*
	*  Constructor
	*
	*  @description: 
	*  @since 1.0.0
	*  @created: 23/06/12
	*/
	
	function __construct()
	{
		// vars
		$settings = array(
			'version' => '0.5.a',
			'basename' => plugin_basename(__FILE__)
		);
		
		
		// create remote update
		
		// actions
		add_action('acf/register_fields', array($this, 'register_fields'));
	}
	
	
	/*
	*  register_fields
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 31/01/13
	*/
	
	function register_fields()
	{
		include_once('icon.php');
	}
		
}

new acf_icon_plugin();

?>