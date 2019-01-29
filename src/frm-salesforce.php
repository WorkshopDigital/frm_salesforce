<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'FRM_SALESFORCE_VERSION', '%%PLUGIN_VER%%' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-frm-salesforce-activator.php
 */
function activate_frm_salesforce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-frm-salesforce-activator.php';
	Frm_Salesforce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-frm-salesforce-deactivator.php
 */
function deactivate_frm_salesforce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-frm-salesforce-deactivator.php';
	Frm_Salesforce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_frm_salesforce' );
register_deactivation_hook( __FILE__, 'deactivate_frm_salesforce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-frm-salesforce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_frm_salesforce() {

	$plugin = new Frm_Salesforce();
	$plugin->run();

}
run_frm_salesforce();
