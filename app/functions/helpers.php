<?php

use app\src\Flash;

function dd($data){
	echo "<pre>"; print_r($data); echo "</pre>";

	die();
}

function path(){
	$vendorDir = dirname(dirname(__FILE__));
	return dirname($vendorDir); 	
}

function Flash($index, $message){
	Flash::add($index, $message);
}

function error($message){

}

function success($message){
	
}
