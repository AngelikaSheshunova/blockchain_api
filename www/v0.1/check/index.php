<?php

require_once("../../../../core/vchain.inc.php");

header('Access-Control-Allow-Origin: *');

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-type: application/json");

$input = json_decode(file_get_contents('php://input'), true);

$ip = null;
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$key = "";
if (is_array($input) && isset($input["key"]))
{
	$key = $input["key"];
}
unset($input["key"]);

$result = VChainIdentity::check($input, $key, $ip);

echo json_encode($result, true);

?>
