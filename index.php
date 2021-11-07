<?php 
if(!defined('ROOT')) exit('No direct script access allowed');

include_once __DIR__."/api.php";

$slug=_slug("?/src/type");

if(strlen($slug['src'])<=0) {
	echo "<h3 class='errormsg text-center'>Sorry, Preform Source not defined</h3>";
	return;
}

if(strlen($slug['type'])<=0) $slug['type'] = "report";

if(!in_array($slug['type'], getPreformTypes())) {
	echo "<h3 class='errormsg text-center'>Sorry, Preform Capabilities not found for given type</h3>";
	return;
}

printPreform($slug['src'], $slug['type']);

//printArray($slug);
?>
