<?php

function dd($data){
	echo "<pre>"; print_r($data); echo "</pre>";
	die();
}

function path() {
	$vendorDir = dirname(dirname(__FILE__));
	return dirname($vendorDir); 	
}

function flash($index, $message) {
	app\src\Flash::add($index, $message);
}

function internalError($message) {
	echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #ccc;">'.$message.'</div>';
	exit();
}

function error($message) {
	return '<div class="alert alert-danger mt-1" role="alert"><strong>'.$message.'</strong></div>';
}

function success($message){
	return '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>'.$message.'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}

function back(){
	app\src\Redirect::back();
	exit;
}

function redirect($target){
	app\src\Redirect::redirect(app\Config::BASE_DIR . $target);
	exit;
}

function setCookieForm(array $formData)
{
	foreach ($formData as $key => $value) {
		setcookie($key, $value, time() + 1);
	}
}
