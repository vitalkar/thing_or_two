<?php
require_once '../inc/shortner.class.php';
header('Access-Control-Allow-Methods: POST, GET');

$action = $_REQUEST['action'];
$result = null;

switch ($action) 
{
    case 'shorten_url' :
        $url = $_REQUEST['url'];
        $shortner = new shortner();
        $result = $shortner->create($url);
        die(json_encode($result));
    case 'read_all' :
        $shortner = new shortner();
        $result = $shortner->read_all();
        die(json_encode($result));
    default:
        die(json_encode(__FILE__ . ": no action matched"));
}