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
				wp_enqueue_script( 'ht-click-call-admin-script', CLICK_CALL_PL_URL.'admin/assets/js/main.js', array('jquery'), '', true);
				$pesoninfo_enable  	 = clickcall_get_option('person_info_disable','clickcall_general_tab','off');
				$flag_image_enable 	 = clickcall_get_option('falg_image_disable','clickcall_general_tab','off');
				$call_title_enable 	 = clickcall_get_option('call_title_disable','clickcall_general_tab','on');
				$call_now_msg_enable = clickcall_get_option('call_message_disable','clickcall_general_tab','off');
				$call_num_icon_enable= clickcall_get_option('nunber_icon_disable','clickcall_general_tab','off');

				$ht_click_localiaze = [
					'person_info_disable' => $pesoninfo_enable,
					'flag_info_disable'   => $flag_image_enable,
					'call_title_enable'   => $call_title_enable,
					'call_now_msg_enable' => $call_now_msg_enable,
					'call_num_icon_enable'=> $call_num_icon_enable,
				];

				wp_localize_script( 'ht-click-call-admin-script', 'ht_click_data', $ht_click_localiaze);
			}

		}

		
	}

	new Click_Call_Admin_Setting();

?>
