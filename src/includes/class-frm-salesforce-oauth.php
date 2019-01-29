<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://workshopdigital.com
 * @since      1.0.0
 *
 * @package    Frm_Salesforce
 * @subpackage Frm_Salesforce/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Frm_Salesforce
 * @subpackage Frm_Salesforce/includes
 * @author     Matthew Rosenberg <matt@workshopdigital.com>
 */
class Frm_Salesforce_Oauth {

	/**
	 * Formidalbe Salesforce integration options
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $options    Formidable Salesforce options retrieved from the database.
	 */
  private $options;	

	/**
	 * The string name of the option to retrieve from the database.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $option_group    The corresponding option_name to retrieve from teh WP option table.
	 */  
	private $option_group = 'frmsf';

	/**
	 * Url query param key to check for the nonce.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $auth_nonce_key    The url param to check for security nonce.
	 */	
	private $auth_nonce_key = 'gf-salesforce-auth';

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */	
	private $exchange_nonce = 'gf-salesforce-exchange';	


	public function ready_to_authorize() {
		return $this->options[ 'client_id' ] && $this->options[ 'client_secret' ];
	}	

	public function get_tokens() {

		if( isset( $_REQUEST[ 'code' ] ) 
			&& isset( $_REQUEST[ 'state' ] ) 
			&& wp_verify_nonce( $_REQUEST[ 'state' ], $this->auth_nonce_key ) ) : 

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

	public function __construct() {
		$this->options      = get_option( $this->option_group );		
		$this->redirect_uri = admin_url( 'admin.php?page=' . $this->page );
	}		


}