<?php

require "../bootstrap.php";

$app->get('/login', 'app\controllers\LoginController:index');
$app->post('/login', 'app\controllers\LoginController:login');

$app->get('', 'app\controllers\OverviewController:index');
$app->get('/teste', 'app\controllers\TesteController:show');

$app->group('/admin', function (Slim\Routing\RouteCollectorProxy $group) {

	$group->get('/users', 'app\controllers\UserController:show');
	$group->get('/users/create', 'app\controllers\UserController:create');
	$group->get('/users/edit/{id:[0-9]+}', 'app\controllers\UserController:edit');
	$group->get('/users/delete/{id:[0-9]+}', 'app\controllers\UserController:delete');

	$group->post('/users/create', 'app\controllers\UserController:save');
	$group->post('/users/edit/{id:[0-9]+}', 'app\controllers\UserController:update');

});

$app->group('/lms/users', function (Slim\Routing\RouteCollectorProxy $group) {

	$group->get('', 'app\controllers\lms\UserController:show');
	$group->get('/{id:[0-9]+}', 'app\controllers\lms\UserController:edit');	
	$group->get('/create', 'app\controllers\lms\UserController:create');	
	$group->get('/{id:[0-9]+}/profile', 'app\controllers\lms\UserController:profile');	
	$group->get('/{id:[0-9]+}/suspend', 'app\controllers\lms\UserController:suspend');
	$group->get('/{id:[0-9]+}/unsuspend', 'app\controllers\lms\UserController:unsuspend');
	$group->get('/{id:[0-9]+}/delete', 'app\controllers\lms\UserController:delete');

	$group->post('/update', 'app\controllers\lms\UserController:update');
	$group->post('/create', 'app\controllers\lms\UserController:save');
	$group->post('/{id:[0-9]+}/reset-password', 'app\controllers\lms\UserController:resetPassword');

});

$app->group('lms/courses', function (Slim\Routing\RouteCollectorProxy $course_group) {

	$course_group->get('', 'app\controllers\lms\CourseController:show');

	$course_group->group('lms/categories', function (Slim\Routing\RouteCollectorProxy $category_group) {

		$category_group->get('', 'app\controllers\lms\CourseCategoryController:show');
		$category_group->get('/create', 'app\controllers\lms\CourseCategoryController:create');	
		$category_group->post('/create', 'app\controllers\lms\CourseCategoryController:save');		

	});
});

$app->run();