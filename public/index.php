<?php

require "../bootstrap.php";

$app->get('', 'app\controllers\OverviewController:index');


$app->group('/users', function (Slim\Routing\RouteCollectorProxy $group) {

	$group->get('', 'app\controllers\UserController:show');
	$group->get('/{id:[0-9]+}', 'app\controllers\UserController:edit');	
	$group->get('/create', 'app\controllers\UserController:create');	
	$group->get('/{id:[0-9]+}/profile', 'app\controllers\UserController:profile');	
	$group->get('/{id:[0-9]+}/suspend', 'app\controllers\UserController:suspend');
	$group->get('/{id:[0-9]+}/unsuspend', 'app\controllers\UserController:unsuspend');
	$group->get('/{id:[0-9]+}/delete', 'app\controllers\UserController:delete');

	$group->post('/update', 'app\controllers\UserController:update');
	$group->post('/create', 'app\controllers\UserController:save');
	$group->post('/{id:[0-9]+}/reset-password', 'app\controllers\UserController:resetPassword');

});

$app->group('/courses', function (Slim\Routing\RouteCollectorProxy $course_group) {
	$course_group->group('/categories', function (Slim\Routing\RouteCollectorProxy $category_group) {

		$category_group->get('', 'app\controllers\CourseCategoryController:show');
		$category_group->get('/create', 'app\controllers\CourseCategoryController:create');		
	
	});


});

$app->run();