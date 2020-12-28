<?php
	
/**
*click call admin setting option  
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.
class ClickCall_Admin_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new ClickCall_Settings_API();

        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->clickcall_get_settings_sections() );
        $this->settings_api->set_fields( $this->clickcall_admin_fields_settings() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    // Plugins menu Register
    function admin_menu() {

        add_menu_page(
			__('HT Click to Call','ht-click-call'), 
			__('HT Click to Call','ht-click-call'),
			'manage_options',
			'ht-click-call-setting-page',
			array($this,'plugin_page'),
			'dashicons-phone',
			66
		);

		add_submenu_page(
	        'ht-click-call-setting-page',
	      	__( 'Settings', 'ht-click-call' ),
	        __( 'Settings', 'ht-click-call' ),
	        'manage_options',
	        'ht-click-call-setting-page',
	        array($this,'plugin_page')
	    );

    }

	// Options page Section register
    function clickcall_get_settings_sections() {
        $sections = array(

            array(
                'id'    => 'clickcall_general_tab',
                'title' => esc_html__( 'General', 'ht-click-call' )
            ),

            array(
                'id'    => 'clickcall_style_tab',
                'title' => esc_html__( 'Style', 'ht-click-call' )
            ),
            
        );

        return $sections;
    }

    protected function clickcall_admin_fields_settings() {
    	$settings_fields = array(

    		'clickcall_general_tab'=>array(

    			array(
                    'name'    => 'btn_enable_disable',
                    'label'   => __( 'Click to Call Button Enable', 'ht-click-call' ),
                    'type'    => 'checkbox',
                    'default' => 'on',
                ),

                array(
                    'name'    => 'person_info_disable',
                    'label'   => __( 'Person Information Enable', 'ht-click-call' ),
                    'type'    => 'checkbox',
                    'default' => 'off',
                    'class'	  =>'person-info-enable',
                ),

                array(
                    'name'    => 'falg_image_disable',
                    'label'   => __( 'Country Flag Image Enable', 'ht-click-call' ),
                    'type'    => 'checkbox',
                    'default' => 'off',
                    'class'	  =>'flag-info-enable',
                ),

                array(
                    'name'    => 'call_title_disable',
                    'label'   => __( 'Call Now Title Enable', 'ht-click-call' ),
                    'type'    => 'checkbox',
                    'default' => 'on',
                    'class'	  =>'call-title-enable',
                ),

                array(
                    'name'    => 'call_message_disable',
                    'label'   => __( 'Call Now Message Enable', 'ht-click-call' ),
                    'type'    => 'checkbox',
                    'default' => 'off',
                    'class'	  =>'call-message-enable',
                ),

                array(
                    'name'    => 'nunber_icon_disable',
                    'label'   => __( 'Call Number Icon Enable', 'ht-click-call' ),
                    'type'    => 'checkbox',
                    'default' => 'off',
                    'class'	  =>'call-number-icon-enable',
                ),

    			array(
                    'name'    => 'number',
                    'label'   => __( 'Phoen Number', 'ht-click-call' ),
                    'desc'    => __( 'Give your phone number', 'ht-click-call' ),
                    'type'    => 'text',
                    'default' => '(325)23352233699',
                    'sanitize_callback' => 'sanitize_text_field',
                ),

                array(
                    'name'    => 'country_code',
                    'label'   => __( 'Country Code', 'ht-click-call' ),
                    'desc'    => __( 'Give your country code', 'ht-click-call' ),
                    'default' => '+01',
                    'type'    => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                ),

                array(
                    'name'    => 'person_name',
                    'label'   => __( 'Person Name', 'ht-click-call' ),
                    'desc'    => __( 'Give person name who receive tha call form user', 'ht-click-call' ),
                    'default' => 'Jonathon doe',
                    'type'    => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'class'	  =>'ht-click-call-person-info',
                ),

                array(
                    'name'    => 'person_position',
                    'label'   => __( 'Person Designation', 'ht-click-call' ),
                    'desc'    => __( 'Give person position who receive tha call form user', 'ht-click-call' ),
                    'default' => 'Customer service manager',
                    'type'    => 'text',
                    'sanitize_callback' => 'sanitize_text_field',
                    'class'	  =>'ht-click-call-person-info',
                ),

                array(
                    'name'    => 'call_text',
                    'label'   => __( 'Call Now Title', 'ht-click-call' ),
                    'desc'    => __( 'Give a calling text', 'ht-click-call' ),
                    'type'    => 'text',
                    'default' => 'Call Us',
                    'sanitize_callback' => 'sanitize_text_field',
                    'class'	  =>'ht-click-call-title',
                ),

                array(
                    'name'    => 'calling_message',
                    'label'   => __( 'Call Now Message', 'ht-click-call' ),
                    'desc'    => __( 'Tell the user to call with a sweet message' ),
                    'type'    => 'textarea',
                    'default' => 'HEY THERE. ❤️ NEED HELP? I\' M HERE FOR YOU, SO JUST GIVE ME A CALL',
                    'sanitize_callback' => 'sanitize_text_field',
                    'class'	  =>'ht-click-call-message',
                ),

                array(
                    'name'    => 'person_image',
                    'label'   => __( 'Person Image', 'ht-click-call' ),
                    'desc'    => __( 'Give person image who recive the call from user', 'ht-click-call' ),
                    'default' => CLICK_CALL_PL_URL. 'assets/images/author/author-1.png',
                    'type'    => 'file',
                    'class'	  =>'ht-click-call-person-info img-container',
                ),

                array(
                    'name'    => 'icon',
                    'label'   => __( 'Add Click Call Button Icon', 'ht-click-call' ),
                    'desc'    => __( 'Add a call icon here', 'ht-click-call' ),
                    'default' => CLICK_CALL_PL_URL. 'assets/images/icons/white-call-icon.png',
                    'type'    => 'file',
                    'class'	  =>'ht-click-call-icon img-container',
                ),

                array(
                    'name'    => 'clling_number_icon',
                    'label'   => __( 'Add Call Number Icon', 'ht-click-call' ),
                    'desc'    => __( 'Add a call icon in calling number left side', 'ht-click-call' ),
                    'default' => CLICK_CALL_PL_URL. 'assets/images/icons/icon-call.png',
                    'type'    => 'file',
                    'class'	  =>'ht-click-call-number-icon img-container',
                ),

                array(
                    'name'    => 'flag_image',
                    'label'   => __( 'Country Flag Image', 'ht-click-call' ),
                    'desc'    => __( 'Give country flag image', 'ht-click-call' ),
                    'default' => CLICK_CALL_PL_URL. 'assets/images/icons/flag-1.png',
                    'type'    => 'file',
                    'class'	  =>'ht-click-call-flag-info img-container',
                ),

    		),

    		'clickcall_style_tab'=>array(

    			array(
                    'name'    	  => 'area_paddings',
                    'label'   	  => __( 'Area paddings', 'ht-click-call' ),
                    'desc'    	  => __( 'Give margin top-bottom and left-right of Area. Use unit px.<br>Default 35px 20px','ht-click-call'),
                    'textFieldNo' => 2,
                    'placeholder' => array('35px','20px'),
                    'size'        => 'quater',
                    'type'        => 'multitext',
                ),

                array(
                    'name'    	  => 'number_area_padding',
                    'label'   	  => __( 'Number Area Padding', 'ht-click-call' ),
                    'desc'    	  => __( 'Give padding top, right, bottom, left of Number Area. Use unit px.<br>Default 12px 25px 12px 10px','ht-click-call'),
                    'textFieldNo' => 4,
                    'placeholder' => array('12px','25px','12px','10px'),
                    'size'        => 'quater',
                    'type'        => 'multitext',
                ),

    			array(
                    'name'    	  => 'number_mergin',
                    'label'   	  => __( 'Call Number Margin', 'ht-click-call' ),
                    'desc'    	  => __( 'Use unit px','ht-click-call'),
                    'textFieldNo' => 4,
                    'placeholder' => array('0px','0px','0px','5px'),
                    'desc'    	  => __( 'Give margin top, right, bottom, left of call number. Use unit px.<br>Default 0px 0px 0px 5px','ht-click-call'),
                    'size'        => 'quater',
                    'type'        => 'multitext',
                ),

                array(
                    'name'    	  => 'call_title_margin',
                    'label'   	  => __( 'Call Title Margin', 'ht-click-call' ),
                    'desc'    	  => __( 'Give margin top, right, bottom, left of call title. Use unit px.<br>Default 0px 0px 10px 0px','ht-click-call'),
                    'textFieldNo' => 4,
                    'placeholder' => array('0px','0px','10px','0px'),
                    'size'        => 'quater',
                    'type'        => 'multitext',
                ),

                array(
                    'name'    	  => 'call_message_margin',
                    'label'   	  => __( 'Call Now Message Margin', 'ht-click-call' ),
                    'desc'    	  => __( 'Give margin top, right, bottom, left of call now message. Use unit px.<br>Default 0px 0px 16px 0px','ht-click-call'),
                    'textFieldNo' => 4,
                    'placeholder' => array('0px','0px','16px','0px'),
                    'size'        => 'quater',
                    'type'        => 'multitext',
                ),

                array(
                    'name'    	  => 'number_font',
                    'label'   	  => __( 'Call Number Font Size', 'ht-click-call' ),
                    'desc'    	  => __( 'Default 16px. Use unit px','ht-click-call'),
                    'placeholder' => '16px',
                    'size'        => 'quater',
                    'type'    	  => 'text',
                ),

                array(
                    'name'    	  => 'call_now_title_font',
                    'label'   	  => __( 'Call Now Title Font Size', 'ht-click-call' ),
                    'desc'    	  => __( 'Default 28px. Use unit px','ht-click-call'),
                    'placeholder' => '28px',
                    'size'    	  => 'quater',
                    'type'        => 'text',
                ),

                array(
                    'name'    	  => 'call_now_msg_font',
                    'label'   	  => __( 'Call Now Message Font Size', 'ht-click-call' ),
                    'desc'    	  => __( 'Default 15px. Use unit px','ht-click-call'),
                    'placeholder' => '15px',
                    'size'    	  => 'quater',
                    'type'    	  => 'text',
                ),

                array(
                    'name'    	  => 'person_name_font',
                    'label'   	  => __( 'Person Name Font Size', 'ht-click-call' ),
                    'desc'    	  => __( 'Default 28px. Use unit px','ht-click-call'),
                    'placeholder' => '28px',
                    'size'    	  => 'quater',
                    'type'    	  => 'text',
                ),

                array(
                    'name'    	  => 'person_desig_font',
                    'label'   	  => __( 'Person Designation Font Size', 'ht-click-call' ),
                    'desc'    	  => __( 'Default 18px. Use unit px','ht-click-call'),
                    'placeholder' => '18px',
                    'size'    	  => 'quater',
                    'type'    	  => 'text',
                ),

                array(
                    'name'    => 'button_bg_color',
                    'label'   => __( 'Call Button Bcackground Color', 'ht-click-call' ),
                    'type'    => 'color',
                ),

    			array(
                    'name'    => 'area_bg_color',
                    'label'   => __( 'Area Background Color', 'ht-click-call' ),
                    'type'    => 'color',
                ),

                array(
                    'name'    => 'call_now_title_color',
                    'label'   => __( 'Call Now Title Color', 'ht-click-call' ),
                    'type'    => 'color',
                ),

                array(
                    'name'    => 'call_now_message_color',
                    'label'   => __( 'Call Now Message Color', 'ht-click-call' ),
                    'type'    => 'color',
                ),

                array(
                    'name'    => 'number_color',
                    'label'   => __( 'Call Number Color', 'ht-click-call' ),
                    'type'    => 'color',
                ),

                array(
                    'name'    => 'number_area_bg_color',
                    'label'   => __( 'Call Number Area Background', 'ht-click-call' ),
                    'type'    => 'color',
                ),

                array(
                    'name'    => 'person_name_color',
                    'label'   => __( 'Person Name Color', 'ht-click-call' ),
                    'type'    => 'color',
                ),

                array(
                    'name'    => 'person_desig_color',
                    'label'   => __( 'Person Designation Color', 'ht-click-call' ),
                    'type'    => 'color',
                ),

                array(
                    'name'    => 'area_bg_img',
                    'label'   => __( 'Area Background Image', 'ht-click-call' ),
                    'type'    => 'file',
                ),

                array(
                    'name'    => 'chustom_css',
                    'label'   => __( 'Click Call Custom Css', 'ht-click-call' ),
                    'desc'    => __( 'Make your won design with your custom css' ),
                    'type'    => 'textarea',
                    'sanitize_callback' => 'sanitize_text_field',
                ),


    		)

    	);

    	return $settings_fields;
    }

    function plugin_page() {

        echo '<div class="wrap">';
            echo '<h2>'.esc_html__( 'Click To Call Option Settings','ht-click-call' ).'</h2>';
            $this->save_message();
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
        echo '</div>';

    }

    function save_message() {
        if( isset($_GET['settings-updated']) ) { ?>
            <div class="updated notice is-dismissible"> 
                <p><strong><?php esc_html_e('Successfully Settings Saved.', 'ht-click-call') ?></strong></p>
            </div>
            
            <?php
        }
    }
}

new ClickCall_Admin_Settings();

?>