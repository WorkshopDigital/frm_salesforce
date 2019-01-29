<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://workshopdigital.com
 * @since      1.0.0
 *
 * @package    Frm_Salesforce
 * @subpackage Frm_Salesforce/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Frm_Salesforce
 * @subpackage Frm_Salesforce/includes
 * @author     Matthew Rosenberg <matt@workshopdigital.com>
 */
class Frm_Salesforce_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'frm-salesforce',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
