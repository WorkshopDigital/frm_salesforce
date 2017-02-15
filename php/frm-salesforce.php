<?php
/*
Plugin Name: Formidable Forms Salesforce Integration
Description: Connect Formidable Forms to SalesForce's REST API
Version: 1.0
Author URI: https://workshopdigital.com
Author: Matthew Rosenberg ( Workshop Digital )
*/

namespace FRMSF;

class FRM_Sales_Force {


	public function __construct() {

		require 'lib/class-options-page.php';

		add_action( 'frm_registered_form_actions', array( $this, 'register_salesforce_action' ) );		
	}


	public function register_salesforce_action( $actions ) {

	  $actions[ 'salesforce' ] = 'FRMSF\Lib\FrmSalesForceAction';
    include_once dirname(__file__) . '/lib/class-action-form.php' ;

		return $actions;
	}
}

new FRM_Sales_Force;