<?php

/**
 * Capture URL params on oAuth code authorization flow
 *
 * This file captures url params and saves them to localStorage
 *
 * @link       https://workshopdigital.com
 * @since      1.0.0
 *
 * @package    Frm_Salesforce
 * @subpackage Frm_Salesforce/admin/partials
 */
?>

<script>
    var CURRENT_REQUEST_KEY = '__frmsalesforce_request';
    var pendingRequestKey = window.localStorage.getItem(CURRENT_REQUEST_KEY);
    if (pendingRequestKey) {
    window.localStorage.removeItem(CURRENT_REQUEST_KEY);
    var url = window.location.toString();
    window.localStorage.setItem(pendingRequestKey, url);
    }
    window.close();
</script>