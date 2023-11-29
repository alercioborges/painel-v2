<?php

function dd($data){
	echo "<pre>"; print_r($data); echo "</pre>";

	die();
}

function path(){
	$vendorDir = dirname(dirname(__FILE__));
	return dirname($vendorDir); 	
}

function flash($index, $message){
	app\src\Flash::add($index, $message);
}

function error($message){
	return "<span class='error-message'>{$message}</span>";
}

function success($message){
	return "<span class='success-message'>{$message}</span>";
}

function back(){
	app\src\Redirect::back();
	exit;
}

function setCookieForm(array $formData)
{
	foreach ($formData as $key => $value) {
		setcookie($key, $value, time() + 1);
	}
}
