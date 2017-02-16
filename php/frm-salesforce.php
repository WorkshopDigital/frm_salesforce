<?php
/*
Plugin Name: Formidable Forms Salesforce Integration
Description: Connect Formidable Forms to SalesForce's REST API
Version: 2.0
Author URI: https://workshopdigital.com
Author: Matthew Rosenberg ( Workshop Digital )
*/

namespace FRMSF;
use \FB as FB;

class FRM_Sales_Force {

	public function __construct() {

		define( 'FRMSF_DIR', dirname( __file__ ) );
		define( 'FRMSF_URL', \plugins_url( 'assets', __file__ ) );

		require FRMSF_DIR . '/lib/class-options-page.php';

		add_action( 'frm_registered_form_actions', array( $this, 'register_salesforce_action' ) );	
	}
	

	public function register_salesforce_action( $actions ) {

	  $actions[ 'salesforce' ] = 'FRMSF\Lib\FrmSalesForceAction';
    include_once dirname(__file__) . '/lib/class-action-form.php' ;

		return $actions;
	}
}
new FRM_Sales_Force;