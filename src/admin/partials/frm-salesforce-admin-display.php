<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://workshopdigital.com
 * @since      1.0.0
 *
 * @package    Frm_Salesforce
 * @subpackage Frm_Salesforce/admin/partials
 */
?>

<div class="wrap">
	<h1><?php echo get_admin_page_title(); ?></h1>
	<?php settings_errors(); ?>
	<?php $props = $this->serialize_props(); ?>

	<div id="poststuff">
		<div id="post-body-content" 
			data-endpoint="<?php echo $props['endpoint'] ?>" 
			data-redirect-url="<?php echo $props['redirect_url'] ?>" 
			data-wp-rest-nonce="<?php echo $props['wp_rest_nonce'] ?>"
			data-sf-state-nonce="<?php echo $props['sf_state_nonce'] ?>"
			data-client-id="<?php echo $props['data']['client_id'] ?>"			
			data-client-secret="<?php echo $props['data']['client_secret'] ?>"						
		>
			<noscript>
				<p>This plugin requires javascript.</p>
			</noscript>				
		</div><!--.post-body-content-->
	</div><!--#poststuff-->
</div><!--.wrap-->