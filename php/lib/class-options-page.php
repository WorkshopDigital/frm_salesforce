<?php 

namespace FRMSF\Lib;
use \FB as FB;

class FRMSF_Admin_Options {

  private $options;	
	private $redirect_uri;  
	private $logo_url;
  private $page           = 'frm_sales_force'; 
	private $option_group   = 'frmsf';
	private $auth_nonce     = 'gf-salesforce-auth';
	private $exchange_nonce = 'gf-salesforce-exchange';


	public function __construct() {

		$this->options      = get_option( $this->option_group );		
		$this->redirect_uri = admin_url( 'admin.php?page=' . $this->page );
		$this->logo_url     = FRMSF_URL . '/images/salesforce-logo.svg';

		add_action( 'admin_menu',        array( $this, 'add_submenu_item'  ) );
		add_action( 'admin_init',        array( $this, 'register_settings' ) );	
		add_action( 'admin_init',        array( $this, 'get_tokens'        ) );
		add_filter( 'whitelist_options', array( $this, 'whitelist_options' ), 11 );
	}


	public function tab_url( $tab_id ) {

		return esc_html( $this->redirect_uri . '&tab=' . $tab_id );
	}


	public function tab_class( $tab_id ) {
		$base_class   = 'nav-tab';
		$active_class = 'nav-tab-active';
		$current_tab  = $_REQUEST[ 'tab' ];

		return isset( $current_tab ) && $tab_id === $current_tab ? $base_class . ' ' . $active_class : $base_class;
	}


	public function is_active_tab( $tab_id ) {

		return ( isset( $_REQUEST[ 'tab' ]  ) && $tab_id === $_REQUEST[ 'tab' ] );
	}


	public function ready_to_authorize() {

		return $this->options[ 'client_id' ] && $this->options[ 'client_secret' ];
	}


	public function get_tokens() {

		if( isset( $_REQUEST[ 'code' ] ) 
			&& isset( $_REQUEST[ 'state' ] ) 
			&& wp_verify_nonce( $_REQUEST[ 'state' ], $this->auth_nonce ) ) : 

			$url_base  = 'https://login.salesforce.com/services/oauth2/token';
			$auth_code = $_REQUEST[ 'code' ];
			$params    = array(
				'redirect_uri'  =>  $this->redirect_uri,
				'grant_type'    => 'authorization_code',
				'code'          => $auth_code,
				'client_id'     => $this->options[ 'client_id' ],
				'client_secret' => $this->options[ 'client_secret' ]
			);

			$url     = $url_base . '?' . http_build_query( $params, '&' );
			$results = wp_remote_post( $url );
			$data    = json_decode( $results[ 'body' ] );

			if( !$data->error ) {

				$this->options[ 'access_token' ]  = $data->access_token;
				$this->options[ 'refresh_token' ] = $data->refresh_token;
				$this->options[ 'instance_url' ]  = $data->instance_url;
				$this->options[ 'issued_at' ]     = $data->issued_at;
				$this->options[ 'scope' ]         = $data->scope;
				$this->options[ 'signature' ]     = $data->signature;
				$this->options[ 'token_type' ]    = $data->token_type;

				set_transient( "{$this->option_group}_token", $data->access_token, 3600 );
				update_option( $this->option_group, $this->options );
			}

			wp_redirect( $this->redirect_uri );
			exit;

		endif;
	}


	public function whitelist_options( $whitelist_options ) {

		$whitelist_options[ $this->page ] = array( $this->option_group );
		return $whitelist_options;
	}


	public function add_submenu_item() {

		add_submenu_page( 
			'formidable', 
			'Salesforce', 
			'Salesforce', 
			'frm_view_forms', 
			$this->page, 
			array( $this, 'options_page_output' )		
		);
	}


	public function register_settings() {

		register_setting( 
			$this->page,
			$this->option_group,
			array( $this, 'settings_validate' )			
		);

    add_settings_section(
	    $this->option_group, 
	    null,
	    null,
			$this->page	     
    );  		

	  add_settings_field(
	    'client_id',
	    esc_html__( 'Client ID', 'frmsf' ),
	    array( $this, 'client_id_callback' ),
	    $this->page, 
	    $this->option_group 
	  );    

	  add_settings_field(
	    'client_secret', 
	    esc_html__( 'Client Secret', 'frmsf' ),
	    array( $this, 'client_secret_callback' ), 
	    $this->page,  
	    $this->option_group
	  );    	  
	}


	public function settings_validate( $args ) {

		if( empty( $args[ 'client_id' ] ) ) {
			add_settings_error( $this->page, 'client_id', 'Please enter a Client ID' );
		}

		if( empty( $args[ 'client_secret' ] ) ) {
			add_settings_error( $this->page, 'client_secret', 'Please enter a Client Secret' );
		}

		return $args;
	}


	public function client_id_callback() {
		printf(
		  '<input type="text" class="widefat" id="client_id" name="%s[client_id]" value="%s" />',
		  $this->option_group,
		  isset( $this->options[ 'client_id' ] ) ? esc_attr( $this->options[ 'client_id' ] ) : ''
		);
	}


	public function client_secret_callback() {
		printf(
		  '<input type="password" class="widefat" id="client_secret" name="%s[client_secret]" value="%s" />',
		  $this->option_group,
		  isset( $this->options[ 'client_secret' ] ) ? esc_attr( $this->options[ 'client_secret' ] ) : ''
		);
	}


	public function options_page_output() {

		require_once __DIR__ . '/../views/admin-option-page.php';
	}

}
new FRMSF_Admin_Options;

