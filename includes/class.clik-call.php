<?php

/**
 * Render click call button
*/
class Ht_Click_Call 
{

	/**
     * [$_instance]
     * @var null
    */
    private static $_instance = null;

    /**
     * [instance] Initializes a singleton instance
     * @return [Click_Call]
    */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
	function __construct()
	{
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'click_call_assets_enqueue' ] );
        add_action( 'wp_head', [ $this, 'click_call_render' ] );
	}

	/**
     * [i18n] Load Text Domain
     * @return [void]
    */
    public function i18n() {
        load_plugin_textdomain( 'ht-click-call', false, dirname( plugin_basename( CLICK_CALL_PL_ROOT ) ) . '/languages/' );
    }

    public function init() {

    	// Plugins Required File
    	$this->includes();

    	//add settings in plugin action
		add_filter('plugin_action_links_'.CLICK_CALL_PLUGIN_BASE,function($links){

			$link = sprintf("<a href='%s'>%s</a>",esc_url(admin_url('admin.php?page=ht-click-call-setting-page')),__('Settings','htwth'));

			array_push($links,$link);

			return $links;

		});

    }

    public function includes() {

    	require_once ( CLICK_CALL_PL_PATH . 'admin/admin-init.php' );

    }

    public function plugin_font_url(){
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		if ( 'off' !== _x('on', 'Titillium Web font: on or off', 'ht-click-call' ) ) {
			$fonts[] = 'Titillium Web:100,100i,200,200i,300,300i,400,400i,500,600,700,800,900';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}

    public function click_call_assets_enqueue(){

    	//enque stype
		//wp_enqueue_style( 'ht-click-call-vendor-style', CLICK_CALL_PL_URL.'assets/css/vendor.min.css');
		wp_enqueue_style( 'ht-click-call-google-font',[ $this, 'plugin_font_url' ]);
		//wp_enqueue_style( 'ht-click-call-google-font','//fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600;700;900&display=swap');
		wp_enqueue_style( 'ht-click-call-style', CLICK_CALL_PL_URL.'assets/css/style.css');

		//enqueue script
		//wp_enqueue_script( 'ht-click-call-vendor-script', CLICK_CALL_PL_URL.'assets/js/modernizr-2.8.3.min.js', array(), '', true);
		wp_enqueue_script( 'ht-click-call-main-script', CLICK_CALL_PL_URL.'assets/js/main.js', array('jquery'), '', true);

    }

    public function margin_padding_process($given_value,$default_value){
    	$default_values = explode(',', $default_value);
	    	if(strlen($given_value[0]) != 0 || strlen($given_value[1]) != 0 || strlen($given_value[2]) != 0 || strlen($given_value[3]) != 0 )
    	{

			$given_value[0] = strlen($given_value[0]) != 0 ? $given_value[0]:$default_values[0];
			$given_value[1] = strlen($given_value[1]) != 0 ? $given_value[1]:$default_values[1];
			$given_value[2] = strlen($given_value[2]) != 0 ? $given_value[2]:$default_values[2];
			$given_value[3] = strlen($given_value[3]) != 0 ? $given_value[3]:$default_values[3];

			return $given_value;
		}
    }

    public function click_call_load_style(){

    	$area_padding 	  = ht_clickcall_get_option('area_paddings','clickcall_style_tab','');
    	$num_area_padding = ht_clickcall_get_option('number_area_padding','clickcall_style_tab','');
    	$c_number_margin  = ht_clickcall_get_option('number_mergin','clickcall_style_tab','');
    	$c_title_margin   = ht_clickcall_get_option('call_title_margin','clickcall_style_tab','');
    	$c_message_margin = ht_clickcall_get_option('call_message_margin','clickcall_style_tab','');
    	$c_number_font	  = ht_clickcall_get_option('number_font','clickcall_style_tab','');
    	$c_title_font	  = ht_clickcall_get_option('call_now_title_font','clickcall_style_tab','');
    	$c_message_font	  = ht_clickcall_get_option('call_now_msg_font','clickcall_style_tab','');
    	$p_name_font	  = ht_clickcall_get_option('person_name_font','clickcall_style_tab','');
    	$p_desig_font	  = ht_clickcall_get_option('person_desig_font','clickcall_style_tab','');

    	$click_call_style = '';

    	if($area_padding && is_array($area_padding)){
    		if(strlen($area_padding[0]) != 0 || strlen($area_padding[1]) != 0){
	    		$area_padding[0] = strlen($area_padding[0]) != 0 ? $area_padding[0]:'35px';
				$area_padding[1] = strlen($area_padding[1]) != 0 ? $area_padding[1]:'20px';
				$click_call_style.='.ht-cta-content-box{padding:'.$area_padding[0].' '.$area_padding[1].';}';
			}
    	}

    	if($num_area_padding && is_array($num_area_padding)){
			$num_area_paddings = $this->margin_padding_process($num_area_padding,'12px,25px,12px,10px');
			$click_call_style.='.ht-cta-content-box .select-country{padding:'.$num_area_paddings[0].' '.$num_area_paddings[1].' '.$num_area_paddings[2].' '.$num_area_paddings[3].';}';
		}

		if($c_number_margin && is_array($c_number_margin)){
			$c_number_margins = $this->margin_padding_process($c_number_margin,'0px,0px,0px,5px');
			$click_call_style.='.ht-cta-content-box .select-country a{margin:'.$c_number_margins[0].' '.$c_number_margins[1].' '.$c_number_margins[2].' '.$c_number_margins[3].';}';
		}

		if($c_title_margin && is_array($c_title_margin)){
			$c_title_margins = $this->margin_padding_process($c_title_margin,'0px,0px,10px,0px');
			$click_call_style.='.ht-cta-content-box .title{margin:'.$c_title_margins[0].' '.$c_title_margins[1].' '.$c_title_margins[2].' '.$c_title_margins[3].';}';
		}

		if($c_message_margin && is_array($c_message_margin)){
			$c_title_margins  = $this->margin_padding_process($c_message_margin,'0px,0px,16px,0px');
			$click_call_style.='.ht-cta-content-box .ht-cta-message{margin:'.$c_title_margins[0].' '.$c_title_margins[1].' '.$c_title_margins[2].' '.$c_title_margins[3].';}';
		}

		if($c_number_font){
			$click_call_style.='.ht-cta-content-box .select-country a{font-size:'.$c_number_font.';}';
		}

		if($c_title_font){
			$click_call_style.='.ht-cta-content-box .title{font-size:'.$c_title_font.';}';
		}

		if($c_message_font){
			$click_call_style.='.ht-cta-content-box .ht-cta-message{font-size:'.$c_message_font.';}';
		}

		if($p_name_font){
			$click_call_style.='.ht-cta-content-box .name{font-size:'.$p_name_font.';}';
		}

		if($p_desig_font){
			$click_call_style.='.ht-cta-content-box p{font-size:'.$p_desig_font.';}';
		}

		if(ht_clickcall_get_option('button_bg_color','clickcall_style_tab','')){
			$callbtn_bg_color = ht_clickcall_get_option('button_bg_color','clickcall_style_tab','');
			$click_call_style.='.ht-cta-button .button-box{background:'.$callbtn_bg_color.';}';
		}

		if(ht_clickcall_get_option('area_bg_color','clickcall_style_tab','')){
			$are_bg_color = ht_clickcall_get_option('area_bg_color','clickcall_style_tab','');
			$click_call_style.='.ht-cta-content-box{background:'.$are_bg_color.';}';
		}

		if(ht_clickcall_get_option('call_now_title_color','clickcall_style_tab','')){
			$call_title_color = ht_clickcall_get_option('call_now_title_color','clickcall_style_tab','');
			$click_call_style.='.ht-cta-content-box .title{color:'.$call_title_color.';}';
		}

		if(ht_clickcall_get_option('call_now_message_color','clickcall_style_tab','')){
			$call_message_color = ht_clickcall_get_option('call_now_message_color','clickcall_style_tab','');
			$click_call_style.='.ht-cta-content-box .ht-cta-message{color:'.$call_message_color.';}';
		}

		if(ht_clickcall_get_option('number_color','clickcall_style_tab','')){
			$call_number_color = ht_clickcall_get_option('number_color','clickcall_style_tab','');
			$click_call_style.='.ht-cta-content-box .select-country a,.ht-cta-content-box .select-country .cuntry-code,.ht-cta-content-box a.ht-simple-call{color:'.$call_number_color.';}';
		}

		if(ht_clickcall_get_option('number_area_bg_color','clickcall_style_tab','')){
			$call_number_bg_color = ht_clickcall_get_option('number_area_bg_color','clickcall_style_tab','');
			$click_call_style.='.ht-cta-content-box .select-country,.ht-cta-content-box a.ht-simple-call{background:'.$call_number_bg_color.';}';
		}

		if(ht_clickcall_get_option('person_name_color','clickcall_style_tab','')){
			$person_name_color = ht_clickcall_get_option('person_name_color','clickcall_style_tab','');
			$click_call_style.='.ht-cta-content-box .name{color:'.$person_name_color.';}';
		}

		if(ht_clickcall_get_option('person_desig_color','clickcall_style_tab','')){
			$person_desig_color = ht_clickcall_get_option('person_desig_color','clickcall_style_tab','');
			$click_call_style.='.ht-cta-content-box p{color:'.$person_desig_color.';}';
		}

		if(ht_clickcall_get_option('area_bg_img','clickcall_style_tab','')){
			$area_bg_img = ht_clickcall_get_option('area_bg_img','clickcall_style_tab','');
			$click_call_style.='.ht-cta-content-box::before{background: url('.$area_bg_img.') -30px -22px;}';
		}

		if(ht_clickcall_get_option('chustom_css','clickcall_style_tab','')){
			$click_call_chustom_css = ht_clickcall_get_option('chustom_css','clickcall_style_tab','');
			$click_call_style.=$click_call_chustom_css;
		}

		if(!empty($click_call_style)){
			$click_call_set_style = '<style type="text/css">'.$click_call_style.'</style>';
			return $click_call_set_style;
		}

		return;

    }

    public function click_call_render(){

    	$click_call_btn_enable = ht_clickcall_get_option('btn_enable_disable','clickcall_general_tab','on');
    	if($click_call_btn_enable == 'on'){

    		$click_call_number   = ht_clickcall_get_option('number','clickcall_general_tab','');
    		$click_call_person   = ht_clickcall_get_option('person_name','clickcall_general_tab','');
    		$click_call_prsn_pos = ht_clickcall_get_option('person_position','clickcall_general_tab','');
    		$click_call_prsn_img = ht_clickcall_get_option('person_image','clickcall_general_tab','');
    		$click_call_text     = ht_clickcall_get_option('call_text','clickcall_general_tab','');
    		$click_call_msg      = ht_clickcall_get_option('calling_message','clickcall_general_tab','');
    		$click_call_icon     = ht_clickcall_get_option('icon','clickcall_general_tab','');
    		$click_call_flag_img = ht_clickcall_get_option('flag_image','clickcall_general_tab','');
    		$click_call_cty_code = ht_clickcall_get_option('country_code','clickcall_general_tab','');
    		$call_num_icon_img 	 = ht_clickcall_get_option('clling_number_icon','clickcall_general_tab','');
    		$person_info_enabel  = ht_clickcall_get_option('person_info_disable','clickcall_general_tab','off');
    		$flag_image_enable   = ht_clickcall_get_option('falg_image_disable','clickcall_general_tab','off');
    		$call_title_enable   = ht_clickcall_get_option('call_title_disable','clickcall_general_tab','on');
    		$call_now_msg_enable = ht_clickcall_get_option('call_message_disable','clickcall_general_tab','off');
    		$call_num_icon_enabel= ht_clickcall_get_option('nunber_icon_disable','clickcall_general_tab','off');

    		require_once ( CLICK_CALL_PL_PATH . 'template/ht-click-call-template.php' );

    		$click_call_style = $this->click_call_load_style();
    		echo $click_call_style;
    	}

    }
}

Ht_Click_Call::instance();
