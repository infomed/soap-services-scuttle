<?php
ini_set('display_errors', '0');
ini_set('soap.wsdl_cache_enabled', '0'); // disabling WSDL cache

require_once('../servicefactory.php');
require_once('../../config.inc.php');
require_once('../../functions.inc.php');
require_once('common.php');

$server = new SoapServer($root.'index.php?wsdl');
$server->addFunction('search');
$server->handle();

function search($expression = NULL, $from = 0, $count = 10, $tags = NULL, $user = NULL, $startdate = NULL, $enddate = NULL, $orderby = NULL) {

  if ($count == 0) $count = 10;
  
  if ($user != NULL) {
  	  $userservice =& ServiceFactory::getServiceInstance('UserService');
      $userinfo = $userservice->getUserByUsername($user);
	  $user = $userinfo['uId'];
  }
  
  $bookmarkservice =& ServiceFactory::getServiceInstance('BookmarkService');
  if(!$orderby)
    $orderby = getSortOrder();
  
  $result = & $bookmarkservice->getBookmarks($from, $count, $user, $tags, $expression, $orderby, NULL, $startdate, $enddate, NULL);
  
  return $result;
}

?>
