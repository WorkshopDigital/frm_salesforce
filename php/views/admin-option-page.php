<div class="wrap">
	<h1><?php echo get_admin_page_title(); ?></h1>
	<?php settings_errors(); ?>

	<h2 class="nav-tab-wrapper">
		<a 
			href="<?php echo $this->tab_url( 'configure' ); ?>" 
			class="<?php echo $this->tab_class( 'configure' ); ?>">
			<?php esc_html_e( '1. Configure', 'frmsf' ); ?>
		</a>

		<a 
			href="<?php echo $this->tab_url( 'authorize' ); ?>" 
			class="<?php echo $this->tab_class( 'authorize' ); ?>">
			<?php esc_html_e( '2. Authorize', 'frmsf' ); ?>
		</a>
	</h2>

	<div id="poststuff">

		<?php if( $this->is_active_tab( 'configure' ) ) : ?>

			<div id="post-body" class="metabox-holder">	

				<!-- main content -->
				<div id="post-body-content">

					<div class="meta-box-sortables ui-sortable">

						<div class="postbox">

							<div class="handlediv" title="Click to toggle"><br></div>
							<!-- Toggle -->

							<h2 class="hndle"><span><?php esc_attr_e( 'OAuth Configuration', 'frmsf' ); ?></span></h2>

							<div class="inside">

								<form method="post" action="options.php">

									<?php
									  settings_fields( $this->page );
									  do_settings_sections( $this->page );
									  submit_button( 'Save Client Credentials' );
									?>

								</form>

							</div>
							<!-- .inside -->

						</div>
						<!-- .postbox -->

					</div>
					<!-- .meta-box-sortables .ui-sortable -->

				</div>
				<!-- post-body-content -->

				<!-- sidebar -->
				<div id="postbox-container-1" class="postbox-container">

					<div class="meta-box-sortables">

						<div class="postbox">

							<div class="handlediv" title="Click to toggle"><br></div>
							<!-- Toggle -->

							<h2 class="hndle"><span><?php _e( 'Help', 'frmsf' ); ?></span></h2>

							<div class="inside">
								<p><?php _e( 'Salesforce uses OAuth 2.0 to allow WordPress plugins and other 3rd party websites to securely interact with your salesforce data.', 'frmsf' ); ?></p>
								<p><?php _e( 'To use this plugin, you will need a properly configured authorized <a href="https://help.salesforce.com/articleView?id=connected_app_overview.htm&type=0">Salesforce Connected App</a>.', 'frmsf' ); ?></p>

								<ol>
									<li><?php _e( 'Create a Connected App', 'frmsf' ); ?></li>
									<li><?php _e( 'Enable OAuth Settings', 'frmsf' ); ?></li>
									<li><?php _e( 'Enter your callback url', 'frmsf' ); ?>
										<ul>
											<li><?php printf( '<pre>%s</pre>', $this->redirect_uri ); ?></li>
										</ul>
									</li>
									<li>Add Scopes
										<ul>
											<li><pre>Access and manage your data (api)</pre></li>
											<li><pre>Perform requests on your behalf at any time (refresh_token, offline_access)</pre></li>
										</ul>
									</li>
									<li><?php _e( 'Enable', 'frmsf' ); ?>
										<ul>
											<li><pre>Require Secret for Web Server Flow</pre></li>
										</ul>
									</li>
									<li><?php _e( 'Enter your client id and secret in the OAuth Configuration area', 'frmsf' ); ?></li>
									<li><?php _e( 'Save your credentials', 'frmsf' ); ?></li>
									<li><?php _e( 'Authorize this plugin in the next tab', 'frmsf' ); ?></li>
									<li><?php _e( 'Profit!', 'frmsf' ); ?></li>
								</ol>
							</div>
							<!-- .inside -->

						</div>
						<!-- .postbox -->

					</div>
					<!-- .meta-box-sortables -->

				</div>
				<!-- #postbox-container-1 .postbox-container -->

			</div>
			<!-- #post-body .metabox-holder .columns-2 -->

			<br class="clear">

		<?php endif; ?>


		<?php if( $this->is_active_tab( 'authorize' ) ) : ?>

			<div id="post-body" class="metabox-holder columns-2">	

				<!-- main content -->
				<div id="post-body-content">

					<div class="meta-box-sortables ui-sortable">

						<div class="postbox">

							<div class="handlediv" title="Click to toggle"><br></div>
							<!-- Toggle -->

							<h2 class="hndle"><span><?php _e( 'Authorize with Salesforce', 'frmsf' ); ?></span>
							</h2>

							<div style="text-align:center;" class="inside">

								<?php 

									if( $this->ready_to_authorize() ) :

										printf( 
											'<img style="display:block;width:100px;padding:2rem;margin:0 auto;" src="%s" alt="%s"/>', 
											$this->logo_url,
											__( 'Authorize with Salesforce', 'frmsf' )
										);

										printf(
											'<a class="button button-primary" href="https://login.salesforce.com/services/oauth2/authorize?response_type=code&client_id=%s&redirect_uri=%s&display=touch&state=%s">%s</a>',
											$this->options[ 'client_id' ],
											$this->redirect_uri,
											wp_create_nonce( $this->auth_nonce ),
											__( 'Authorize', 'frmsf' )
										);

										else :

											echo '<h2>' . __( 'Please save your client ID and secret before authorizing this app.', 'frmsf' ) . '</h2>';

										endif;	
								?>	
							</div>
							<!-- .inside -->

						</div>
						<!-- .postbox -->

					</div>
					<!-- .meta-box-sortables .ui-sortable -->

				</div>
				<!-- post-body-content -->

				<!-- sidebar -->
				<div id="postbox-container-1" class="postbox-container">

					<div class="meta-box-sortables">

						<div class="postbox">

							<div class="handlediv" title="Click to toggle"><br></div>
							<!-- Toggle -->

							<h2 class="hndle"><span><?php _e( 'Authorization Status', 'frmsf' ); ?></span></h2>

							<div class="inside">

								<?php if( $this->is_connected() ) : ?>

									<span style="display:block;color:rgb(70, 180, 80);font-size:4rem;width:100%;height:100%;" class="dashicons dashicons-yes"></span>
									<p>You're connected to Salesforce.</p>

								<?php else : ?>

									<span style="display:block;color:rgb(220, 50, 50);font-size:4rem;width:100%;height:100%;" class="dashicons dashicons-no"></span>
									<p>Please check your configuration.</p>									

								<?php endif; ?>

							</div>
							<!-- .inside -->

						</div>
						<!-- .postbox -->

					</div>
					<!-- .meta-box-sortables -->

				</div>
				<!-- #postbox-container-1 .postbox-container -->				

			</div>
			<!-- #post-body .metabox-holder .columns-2 -->

			<br class="clear">

		<?php endif; ?>

	</div>
	<!-- #poststuff -->
</div> <!-- .wrap -->