<?php

function dd($data){
	echo "<pre>"; print_r($data); echo "</pre>";

	die();
}

function path(){
	$vendorDir = dirname(dirname(__FILE__));
	return dirname($vendorDir); 	
}
