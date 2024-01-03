<?php

require "../bootstrap.php";

$app->get('', 'app\controllers\OverviewController:index');

$app->get('/users', 'app\controllers\UserController:show');

$app->get('/users/{id:[0-9]+}', 'app\controllers\UserController:edit');

$app->post('/users/update', 'app\controllers\UserController:update');

$app->get('/users/create', 'app\controllers\UserController:create');
$app->post('/users/create', 'app\controllers\UserController:save');


$app->get('/users/{id:[0-9]+}/profile', 'app\controllers\UserController:profile');

$app->post('/users/{id:[0-9]+}/reset-password', 'app\controllers\UserController:resetPassword');



$app->get('/users/{id:[0-9]+}/suspend', 'app\controllers\UserController:suspend');
$app->get('/users/{id:[0-9]+}/unsuspend', 'app\controllers\UserController:unsuspend');

$app->get('/users/{id:[0-9]+}/delete', 'app\controllers\UserController:delete');


$app->get('/course-categories', 'app\controllers\CourseCategoryController:show');
$app->get('/course-categories/create', 'app\controllers\CourseCategoryController:create');

$app->get('/teste', 'app\controllers\TesteController:show');


$app->run();