<?php
ini_set('display_errors', '1');
ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache

require_once('common.php');

$fp = fopen($root.'index.php?wsdl', "r");
if($fp)
  $client = new SoapClient($root.'index.php?wsdl', array('trace' => 1, 'exceptions' => 0));
else{
  echo 'error';
  exit;
}
$expression = NULL;    // 'sida'
$from       = 0;
$count      = 10;
$tags       = utf8_encode('openid').'+'.utf8_encode('desarrollo');
$user       = NULL;    // 'test'
$startdate  = NULL;    // "2007-08-07 00:00:00"
$enddate    = NULL;    // "2007-09-08 00:00:00"
$orderby    = utf8_encode('title_asc');    

try
{
	$result = $client->search($expression, $from, $count, $tags, $user, $startdate, $enddate, $orderby);
	
	if (isset($_GET['debug'])) {
	    print "<pre>\n";
		print "Request :\n".htmlspecialchars($client->__getLastRequest()) ."\n";
		print "Response:\n".htmlspecialchars($client->__getLastResponse())."\n";
		print "Headers:\n".htmlspecialchars($client->__getLastRequestHeaders())."\n";
		print "</pre>";
		
		print_r($result); exit;
	}
	foreach ($result["bookmarks"] as $value)
	{
	    print '<a href="'.$value['bAddress'].'">'.utf8_decode($value['bTitle']).'</a><br>';
	}
}
catch (SoapFault $exception)
{
	echo 'EXCEPTION='.$exception;
}
?> 
