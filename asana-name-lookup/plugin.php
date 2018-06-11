<?php
/*
Plugin Name: Asana Data Import
Plugin URI: https://github.com/CaelanBorowiec/YOURLS-Asana-Details-Lookup/
Description: Load url details from Asana
Version: 0.2
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

  if ($asana->hasError()) {
      echo 'Error while trying to connect to Asana, response code: ' . $asana->responseCode;
  }
  if (isset($result->id))
    echo($result->name);
}


// Hook our custom function into the 'shunt_add_new_link' filter
yourls_add_filter( 'shunt_get_remote_title', 'asanalookup_get_title');

function asanalookup_get_title($false, $url)
{
	if (preg_match("/http.:\/\/app\.asana\.com\/.\/([0-9]{1,})\/([0-9]{1,})/", $url, $matches))
  {
    // $matches[0] = input, $matches[1] = project, $matches[2] = task,
		return getAsanaTaskTitle($matches[2]);
	}
	return false;
}

function getAsanaTaskTitle($taskID) {
  require_once('asana-api-php-class/asana.php');

  // Set up Asana connection
  global $asanaPAT;
  $asana = new Asana([
      'personalAccessToken' => $asanaPAT
  ]);

  $asana->getTask($taskID);

  $result = $asana->getData();

  if ($asana->hasError()) {
      echo 'Error while trying to connect to Asana, response code: ' . $asana->responseCode;
  }
  if (isset($result->id))
    return $result->name;

  return false;
}
