<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://workshopdigital.com
 * @since      1.0.0
 *
 * @package    Frm_Salesforce
 * @subpackage Frm_Salesforce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Frm_Salesforce
 * @subpackage Frm_Salesforce/admin
 * @author     Matthew Rosenberg <matt@workshopdigital.com>
 */
class Frm_Salesforce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Frm_Salesforce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Frm_Salesforce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/frm-salesforce-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Frm_Salesforce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Frm_Salesforce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/frm-salesforce-admin.js', array(), $this->version, true );
		
	}

	public function get_db_options() {
		return get_option( $this->plugin_name );
	}

	public function set_db_options($settings) {
		print_r($settings);
		update_option( $this->plugin_name, $settings );
	}

	private function create_nonce() {
		return wp_create_nonce( 'wp_rest' );
	}

	private function serialize_props() {
		return [
			'endpoint' => esc_url_raw( rest_url() ),
			'nonce'    => $this->create_nonce(),
			'data'     => $this->get_db_options()
		];
	}

	public function submenu_item() {

		add_submenu_page( 
			'formidable', 
			'Salesforce', 
			'Salesforce', 
			'frm_view_forms', 
			$this->plugin_name, 
			array( $this, 'options_page_output' )		
		);
	}	

	public function register_salesforce_setting() {
		register_setting( 'general', $this->plugin_name,  array(
			'type' => 'object',
			'description' => 'The Salesforce App Info',
			'show_in_rest' => array(
				'schema' => array(
					'properties' => array(
						'client_id' => array(
							'type' => 'string'
						),
						'client_secret' => array(
							'type' => 'string'
						),					
					)
				),
				'default' => array(
					'client_id' => null,
					'client_secret' => null
				)							
			)				
		));	
	}

	public function options_page_output() {
		include_once plugin_dir_path( dirname( __FILE__ ) ) .  'admin/partials/frm-salesforce-admin-display.php';
	}	

}
