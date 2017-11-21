<?php

namespace FRMSF\Lib;
use \FrmEntry as FrmEntry;
use \FrmFormAction as FrmFormAction;
use \WP_Error as WP_Error;
use \FB as FB;

class FrmSalesForceAction extends FrmFormAction {


	private $sf_fields = array( 		
		'AnnualRevenue' => array( 
			'type' => 'currency' 
		), 
		'campaign__c' => array(
			'type' => 'string' 			
		),
		'City' => array( 
			'type' => 'string' 
		), 
		'CleanStatus' => array( 
			'type' => 'picklist',
			'options' => array(
				'Matched','Different','Acknowledged','NotFound','Inactive','Pending','SelectMatch','Skipped'
			) 
		),
		'Company' => array( 
			'type' => 'string' 
		), 
		'CompanyDunsNumber' => array( 
			'type' => 'string' 
		), 
		'Country' => array( 
			'type' => 'string' 
		), 
		'CountryCode' => array( 
			'type' => 'picklist',
			'options' => 'http://country.io/names.json' 
		), 
		'CurrencyIsoCode' => array( 
			'type' => 'picklist',
			'options' => 'http://country.io/currency.json'
		), 
		'Description' => array( 
			'type' => 'string' 
		), 	
		'Email' => array( 
			'type' => 'string' 
		), 
		'Fax' => array( 
			'type' => 'phone' 
		), 	
		'FirstName' => array( 
			'type' => 'string' 
		), 	
		'GCLID__c' => array( 
			'type' => 'string' 
		), 			
		'HasOptedOutOfEmail' => array( 
			'type' => 'string' 
		), 	
		'Industry' => array( 
			'type' => 'picklist',
			'options' => '' 
		), 	
		'IsConverted' => array( 
			'type' => 'boolean' 
		), 	
		'IsUnreadByOwner' => array( 
			'type' => 'boolean' 
		), 	
		'Jigsaw' => array( 
			'type' => 'string' 
		), 	
		'medium__c' => array(
			'type' => 'string' 			
		),
		'LastName' => array( 
			'type' => 'string' 
		), 	
		'Latitude' => array( 
			'type' => 'string' 
		), 	
		'Longitude' => array( 
			'type' => 'string' 
		), 	
		'LeadSource' => array( 
			'type' => 'picklist' 
		), 	
		'MiddleName' => array( 
			'type' => 'string' 
		), 	
		'MobilePhone' => array( 
			'type' => 'phone' 
		), 	
		'None' => array( 
			'type' => null 
		), 			
		'NumberOfEmployees' => array( 
			'type' => 'int' 
		), 	
		'OwnerId' => array( 
			'type' => 'reference' 
		), 	
		'Phone' => array( 
			'type' => 'phone' 
		), 	
		'PostalCode' => array( 
			'type' => 'string' 
		), 	
		'Rating' => array( 
			'type' => 'picklist',
			'options' => array( 1, 2, 3, 4, 5 ) 
		), 	
		'RecordTypeId' => array( 
			'type' => 'reference' 
		), 	
		'Salutation' => array( 
			'type' => 'string' 
		), 	
		'source__c' => array(
			'type' => 'string' 			
		),
		'State' => array( 
			'type' => 'string' 
		), 	
		'StateCode' => array( 
			'type' => 'picklist',
			'options' => '' 
		), 	
		'Status' => array( 
			'type' => 'picklist',
			'options' => array( 'Open', 'Qualified', 'Converted' ) 
		), 	
		'Street' => array( 
			'type' => 'textarea' 
		), 	
		'Suffix' => array( 
			'type' => 'string' 
		), 	
		'Title' => array( 
			'type' => 'string' 
		), 	
		'Website' => array( 
			'type' => 'url' 
		)
	);


	private $frm_exclusions = array( 
		'Captcha'
	);


	private $action_name = 'salesforce';


	private $options;


	private $option_group = 'frmsf';


	function __construct() {

		$this->options = get_option( $this->option_group );		

		$action_ops = array(
		    'classes'   => 'frmsf-icon',
		    'limit'     => 99,
		    'active'    => true,
		    'priority'  => 50,
		);

	  $this->FrmFormAction( $this->action_name, __( 'Salesforce', 'formidable' ), $action_ops  );
		add_action( 'admin_head-toplevel_page_formidable',  array( $this, 'form_action_styles' ) );
		add_action( "frm_trigger_{$this->action_name}_create_action", array( $this, 'update_entry' ), 10, 3);		
	}


	public function form_action_styles() {
		$logo = FRMSF_URL . '/images/salesforce-logo.svg';
?>
<style>

.frmsf-icon:before {
	content: 'salesforce';
	text-indent: 100%;
	white-space: nowrap;
	overflow: hidden;
	width:30px;
	height:20px;  
	background-image: url( <?php echo $logo; ?> );
	background-size: contain;
	background-repeat: no-repeat; 
	background-position: center;
	display: inline-block;
}

</style>

<?php		
	}


	public function select_script() {
		$data = json_encode( $this->sf_fields );
?>
<script>
	;(function( $ ) {
		'use strict';


		var option_data = <?php echo $data ?>,
				$table      = $( '#frm-salesforce-options' ),
				$selects    = $table.find( 'select' );

		$selects.on( 'change', function( e ) {
			var $select = $( this ),
					$row    = $select.parents( 'tr' ),
					$type   = $row.find( 'td:last' ),
 					newSel  = $select.val(),
 					option  = option_data[ newSel ].type;

			$type.html( option );
		});
		
	}( jQuery ) );
</script>
<?php		
	}


	function form( $form_action, $args = array() ) {
    extract( $args );
    $action_control = $this;

    $html  = '<h3>Field Mappings</h3>';
    $html .= '<table id="frm-salesforce-options" class="form-table">';
    $html .= '<thead><tr>';
    $html .= '<th>Form Field</th><th>Salesforce Field</th><th>Field Type</th>';
    $html .= '</tr></thead>';
    $html .= '<tbody>';

    foreach( $args[ 'values' ][ 'fields' ] as $field ) :

    	if( in_array( $field[ 'name' ], $this->frm_exclusions ) ) continue;

			$name    = $action_control->get_field_name( $field[ 'id' ] );
			$content = $form_action->post_content[ $field[ 'id' ]  ];
			$value   = $content ? $content : 'None';
			$item    = $this->sf_fields[ $value ];
			$type    = $item[ 'type' ];

    	$html .= '<tr>';

    	$html .= sprintf( 
    		'<td><label for="%s">%s</label></td>',
    		$field[ 'id'],
    		$field[ 'name' ]
  		);

  		$html .= sprintf(
  			'<td><select name="%s" id="%s">',
  			$name,
    		$field[ 'id' ]
  		);
  		
  		foreach( $this->sf_fields as $k => $v ) :

				$html .= sprintf(
					'<option value="%s" %s>%s</option>',
					$k,
					selected( $value, $k, false ),
					$k					
				); 

  		endforeach; 

  		$html .= '</select></td>';

  		$html .= '<td class="field_type">';
  		$html .= $type;
  		$html .= '</td>';

    	$html .= '</tr>';

  	endforeach;

    $html .= '</tbody>';
    $html .= '</table>';

	  echo $html;

		echo $this->select_script();
	}


	private function refresh_token() {
		$opts     = $this->options;
		$url_base = 'https://login.salesforce.com/services/oauth2/token';
		$params   = array(
			'grant_type'    => 'refresh_token',
			'refresh_token' => $opts[ 'refresh_token' ],
			'client_id'     => $opts[ 'client_id' ],
			'client_secret' => $opts[ 'client_secret' ],
			'format'        => 'json'
		);			
		
		$url     = $url_base . '?' . http_build_query( $params, '&' );
		$results = wp_remote_post( $url );
		$data    = json_decode( $results[ 'body' ] );

		if( !$data->error ) {

			$this->options[ 'access_token' ]  = $data->access_token;
			$this->options[ 'instance_url' ]  = $data->instance_url;
			$this->options[ 'issued_at' ]     = $data->issued_at;
			$this->options[ 'scope' ]         = $data->scope;
			$this->options[ 'signature' ]     = $data->signature;
			$this->options[ 'token_type' ]    = $data->token_type;

			set_transient( "{$this->option_group}_token", $data->access_token, 3600 );
			update_option( $this->option_group, $this->options );
		}
	}


	private function send_lead( $action, $entry ) {
		$data = [];		
		$url  = $this->options[ 'instance_url' ] . '/services/data/v39.0/sobjects/Lead/';

		if( false === ( $access_token = get_transient( "{$this->option_group}_token" ) ) ) {
			$this->refresh_token(); 
		}		

		foreach( (array) $entry->metas as $k => $v ) :
			$key = $action->post_content[ $k ];
			if( 'None' === $key || empty( $key ) ) continue;

			$data[ $key ] = $v;

		endforeach;	

		$args = array(
			'method' => 'POST',
			'headers' => array(
				'content-type' => 'application/json',
				'Authorization' => "{$this->options[ 'token_type' ]} {$this->options[ 'access_token' ]}" 
			),
			'body' => json_encode( $data )
		);

		$response = wp_remote_post( $url, $args );

		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			error_log( $error_message );
		}

		$body = wp_remote_retrieve_body( $response );
		$code = wp_remote_retrieve_response_code( $response ); 		

		if( 201 !== $code ) {
			$error = new WP_Error( $code, $body );
			error_log( $body  );			
		}		

		return json_decode( $body );
	}


	private function format_response_entry( $k, $v ) {

		switch( $k ) {
			case 'errorCode':
				$entry = sprintf( '<p><span style="color:red;font-weight:bold;">%s:</span> %s</p>', $k, $v );
				break;
			case 'fields':
				$entry .= sprintf( '<p><strong>%s:</strong> %s</p>', $k, implode( ', ', $v ) );
				break;
			case 'errors':
				$entry .= sprintf( '<p><strong>%s:</strong> %s</p>', $k, implode( ', ', $v ) );
				break;				
			default:
				$entry .= sprintf( '<p><strong>%s:</strong> %s</p>', $k, $v );
		}		

		return $entry;
	}



	private function format_response( $response ) {
		$entries   = is_array( $response ) ? $response : [ $response ];
		$container = '<ul>%s</ul>';
		$items     = [];

		foreach( $entries as $entry ) {

		 $item = ( array ) $entry;

			$html = array_map( 
				array( $this, 'format_response_entry' ), 
				array_keys( $item ), 
				$item 
			);

			$items[] = sprintf( '<li>%s</li>', implode( '', $html ) );
		}

		return sprintf( $container, implode( '', $items ) );
	}


	public function update_entry( $action, $entry, $form ) {
		global $wpdb;

		$description = ( array ) maybe_unserialize( $entry->description );

		$data        = $this->send_lead( $action, $entry );

		if( $data ) {
			$description[ 'salesforce' ] = $this->format_response( $data );
		}

    $result = $wpdb->update($wpdb->prefix .'frm_items',
	    array( 'description' => serialize( $description ) ),
	    array( 'id' => $entry->id )
    );

    return $result;
	}
}