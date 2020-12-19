<?php

	if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

	/**
	 * 
	 */
	class Click_Call_Admin_Setting
	{
		
		function __construct()
		{
			
        	$this->Click_Call_Setting_Admin_Settings_page();
        	add_action( 'admin_enqueue_scripts', [ $this, 'click_call_admin_assets' ] );
		}

		public function Click_Call_Setting_Admin_Settings_page(){
			require_once( 'include/class.settings-api.php');
			require_once( 'include/admin-setting.php' );
			require_once( 'include/license/HTClicktoCall.php' );
		}

		public function click_call_admin_assets($hook){
			//enque stype
			if($hook == 'toplevel_page_ht-click-call-setting-page'){
				wp_enqueue_style( 'ht-click-call-admin-style', CLICK_CALL_PL_URL.'admin/assets/css/ht-click-call-admin-style.css');
			}

		}

		
	}

	new Click_Call_Admin_Setting();

?>
