<?php
ini_set('display_errors', '0');
require_once('nusoap.php');

// Create the server instance
$server = new soap_server();

// Initialize WSDL support
$server->configureWSDL('BookmarkService', 'urn:bookmarkService');

// Register the method to expose
$server->register('search',							// method name
	array(
	     'expression' => 'xsd:string',
		 'from' => 'xsd:int',
		 'count' => 'xsd:int',
	     'tags' => 'xsd:string',
		 'user' => 'xsd:string',
		 'startdate' => 'xsd:string',
		 'enddate' => 'xsd:string',
		 'orderby' => 'xsd:string'
		 ),	                                        // input parameters
	array('return' => 'xsd:array'),				    // output parameters
	'urn:BOOKMARK_Service',							// namespace
	'urn:BOOKMARK_Service#search',					// soapaction
	'rpc',											// style
	'encoded',										// use
	'Search Bookmark'						        // documentation
);

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>