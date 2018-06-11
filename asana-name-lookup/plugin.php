<?php
/*
Plugin Name: Asana Data Import
Plugin URI: none yet
Description: Load url details from Asana
Version: 0.1
Author: Caelan Borowiec
Author URI: https://github.com/CaelanBorowiec
*/

// No direct load
if ( !defined ('YOURLS_ABSPATH') ) { die(); }

// Register a page
yourls_add_action( 'plugins_loaded', 'asanalookup_add_page' );

function asanalookup_add_page() {
    yourls_register_plugin_page( 'asanalookup', 'Import Asana Details', 'asanalookup_display_page' );
}

function asanalookup_display_page() {
  require_once('asana-api-php-class/asana.php');

  // Set up Asana connection
  global $asanaPAT;
  $asana = new Asana([
      'personalAccessToken' => $asanaPAT
  ]);

  $asana->getTask("687756245553309");

  $result = $asana->getData();

  // As Asana API documentation says, when a task is created, 201 response code is sent back so...
  if ($asana->hasError()) {
      echo 'Error while trying to connect to Asana, response code: ' . $asana->responseCode;
  }
  if (isset($result->id))
    echo($result->name);
}
