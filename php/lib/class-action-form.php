<?php

namespace FRMSF\Lib;
use \FrmFormAction as FrmFormAction;
use \FB as FB;


class FrmSalesForceAction extends FrmFormAction {


	private $sf_fields = array( 
		'Address' => array( 'type' => 'string' ), 
		'AnnualRevenue' => array( 'type' => 'currency' ), 
		'City' => array( 'type' => 'string' ), 
		'CleanStatus' => array( 'type' => 'picklist' ),
		'Company' => array( 'type' => 'string' ), 
		'CompanyDunsNumber' => array( 'type' => 'string' ), 
		'ConnectionReceivedId' => array( 'type' => 'reference' ),
 		'ConnectionSentId' => array( 'type' => 'reference' ),
 		'ConvertedAccountId' => array( 'type' => 'string' ), 
 		'ConvertedContactId	' => array( 'type' => 'string' ), 
		'ConvertedDate	' => array( 'type' => 'string' ), 
		'ConvertedOpportunityId	' => array( 'type' => 'string' ), 
		'Country	' => array( 'type' => 'string' ), 
		'CountryCode	' => array( 'type' => 'string' ), 
		'CurrencyIsoCode	' => array( 'type' => 'string' ), 
		'Description	' => array( 'type' => 'string' ), 
		'Division	' => array( 'type' => 'string' ), 
		'Email	' => array( 'type' => 'string' ), 
		'EmailBouncedDate	' => array( 'type' => 'string' ), 
		'EmailBouncedReason	' => array( 'type' => 'string' ), 
		'Fax' => array( 'type' => 'string' ), 	
		'FirstName' => array( 'type' => 'string' ), 	
		'HasOptedOutOfEmail' => array( 'type' => 'string' ), 	
		'GeocodeAccuracy' => array( 'type' => 'string' ), 	
		'Industry' => array( 'type' => 'string' ), 	
		'IsConverted' => array( 'type' => 'string' ), 	
		'IsDeleted' => array( 'type' => 'string' ), 	
		'IsUnreadByOwner' => array( 'type' => 'string' ), 	
		'Jigsaw' => array( 'type' => 'string' ), 	
		'LastActivityDate' => array( 'type' => 'string' ), 	
		'LastName' => array( 'type' => 'string' ), 	
		'LastReferencedDate' => array( 'type' => 'string' ), 	
		'LastViewedDate' => array( 'type' => 'string' ), 	
		'Latitude' => array( 'type' => 'string' ), 	
		'Longitude' => array( 'type' => 'string' ), 	
		'LeadSource' => array( 'type' => 'string' ), 	
		'MasterRecordId' => array( 'type' => 'string' ), 	
		'MiddleName' => array( 'type' => 'string' ), 	
		'MobilePhone' => array( 'type' => 'string' ), 	
		'Name' => array( 'type' => 'string' ), 	
		'NumberOfEmployees' => array( 'type' => 'string' ), 	
		'OwnerId' => array( 'type' => 'string' ), 	
		'PartnerAccountId' => array( 'type' => 'string' ), 
		'Phone' => array( 'type' => 'string' ), 	
		'PhotoUrl' => array( 'type' => 'string' ), 	
		'PostalCode' => array( 'type' => 'string' ), 	
		'Rating' => array( 'type' => 'string' ), 	
		'RecordTypeId' => array( 'type' => 'string' ), 	
		'Salutation' => array( 'type' => 'string' ), 	
		'ScoreIntelligenceId' => array( 'type' => 'string' ), 	
		'State' => array( 'type' => 'string' ), 	
		'StateCode' => array( 'type' => 'string' ), 	
		'Status' => array( 'type' => 'string' ), 	
		'Street' => array( 'type' => 'string' ), 	
		'Suffix' => array( 'type' => 'string' ), 	
		'Title' => array( 'type' => 'string' ), 	
		'Website' => array( 'type' => 'string' )
	);


	private $frm_exclusions = array( 
		'Captcha'
	);

	function __construct() {

		$action_ops = array(
		    'classes'   => 'dashicons dashicons-chart-line',
		    'limit'     => 99,
		    'active'    => true,
		    'priority'  => 50,
		);
		
	  $this->FrmFormAction( 'salesforce', __( 'Sales Force', 'formidable' ), $action_ops );
	}


	function form( $form_action, $args = array() ) {
    extract( $args );
    $action_control = $this;

    $html  = '<h3>Field Mappings</h3>';
    $html .= '<table class="form-table">';
    $html .= '<thead><tr>';
    $html .= '<th>Form Field</th><th>Salesforce Field</th><th>Options</th>';
    $html .= '</tr></thead>';
    $html .= '<tbody>';

    foreach( $args[ 'values' ][ 'fields' ] as $field ) :

    	if( in_array( $field[ 'name' ], $this->frm_exclusions ) ) continue;

    	$html .= '<tr>';

    	$html .= sprintf( 
    		'<td><label for="%s">%s</label></td>',
    		$field[ 'id'],
    		$field[ 'name' ]
  		);

  		$html .= sprintf(
  			'<td><select name="%s" id="%s">',
  			'temp',
    		$field[ 'id']
  		);
  		
  		foreach( $this->sf_fields as $k => $v ) :

				$html .= sprintf(
					'<option value="%s">%s</option>',
					$k,
					$k
				); 

  		endforeach; 

  		$html .= '</select></td>';

  		$html .= '<td></td>';

    	$html .= '</tr>';

  	endforeach;

    $html .= '</tbody>';
    $html .= '</table>';

	  echo $html;
	}
}