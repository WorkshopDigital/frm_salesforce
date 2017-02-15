<div class="wrap">
	<h1 style="float:left;"><?php echo get_admin_page_title(); ?></h1>

	<?php 
		echo sprintf(
			'<a style="margin:0.5rem;" class="button button-secondary" href="https://login.salesforce.com/services/oauth2/authorize?response_type=code&client_id=%s&redirect_uri=%s&display=touch&state=%s">%s</a>',
			$this->options[ 'client_id' ],
			$this->redirect_uri,
			wp_create_nonce( $this->auth_nonce ),
			'Authorize'
		);	
	?>	

	<form method="post" action="options.php">
		<?php
		  settings_fields( $this->page );
		  do_settings_sections( $this->page );
		  submit_button( 'Save Credentials' );
		?>	
	</form>

</div> <!-- .wrap -->