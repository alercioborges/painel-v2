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

$app->get('/course-categories', 'app\controllers\CourseCategoryController:show');
$app->get('/course-categories/create', 'app\controllers\CourseCategoryController:create');

$app->get('/teste', 'app\controllers\TesteController:show');


$app->run();