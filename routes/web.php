<?php

require "../bootstrap.php";

// Rotas de autenticação
$app->get('/login', 'app\controllers\LoginController:index')->setName('login');
$app->post('/login', 'app\controllers\LoginController:login');
$app->get('/logout', 'app\controllers\LoginController:logout');

// Rota principal (protegida)
$app->get('', 'app\controllers\OverviewController:index')->add($middleware->logged());

// Rota de teste
$app->get('/teste', 'app\controllers\TesteController:show');

// Grupo de rotas administrativas
$app->group('/admin', function (Slim\Routing\RouteCollectorProxy $group) {
	// Rotas de usuários
	$group->group('/users', function (Slim\Routing\RouteCollectorProxy $group) {
    	$group->get('', 'app\controllers\UserController:show');
    	$group->get('/create', 'app\controllers\UserController:create');
    	$group->post('/create', 'app\controllers\UserController:save');
    	$group->get('/edit/{id:[0-9]+}', 'app\controllers\UserController:edit');
    	$group->post('/edit/{id:[0-9]+}', 'app\controllers\UserController:update');
    	$group->get('/delete/{id:[0-9]+}', 'app\controllers\UserController:delete');
	});
})->add($middleware->logged());

// Grupo de rotas LMS - Usuários
$app->group('/lms/users', function (Slim\Routing\RouteCollectorProxy $group) {
	// Rotas de listagem e visualização
	$group->get('', 'app\controllers\lms\UserController:show');
	$group->get('/{id:[0-9]+}', 'app\controllers\lms\UserController:edit');
	$group->get('/{id:[0-9]+}/profile', 'app\controllers\lms\UserController:profile');

	// Rotas de criação
	$group->get('/create', 'app\controllers\lms\UserController:create');
	$group->post('/create', 'app\controllers\lms\UserController:save');

	// Rotas de atualização
	$group->post('/update', 'app\controllers\lms\UserController:update');
	$group->post('/{id:[0-9]+}/reset-password', 'app\controllers\lms\UserController:resetPassword');

	// Rotas de ações do usuário
	$group->get('/{id:[0-9]+}/suspend', 'app\controllers\lms\UserController:suspend');
	$group->get('/{id:[0-9]+}/unsuspend', 'app\controllers\lms\UserController:unsuspend');
	$group->get('/{id:[0-9]+}/delete', 'app\controllers\lms\UserController:delete');
})->add($middleware->logged());

// Grupo de rotas LMS - Cursos
$app->group('/lms/courses', function (Slim\Routing\RouteCollectorProxy $group) {
	// Listagem de cursos
	$group->get('', 'app\controllers\lms\CourseController:show');

	// Rotas de criação de cursos
	$group->get('/create', 'app\controllers\lms\CourseController:create');
	$group->post('/create', 'app\controllers\lms\CourseController:save');

	// Rotas de edição de cursos
	$group->get('/{id:[0-9]+}/edit', 'app\controllers\lms\CourseController:edit');
	$group->post('/{id:[0-9]+}/edit', 'app\controllers\lms\CourseController:update');

	// Rotas de exclusão de cursos
	$group->get('/{id:[0-9]+}/delete', 'app\controllers\lms\CourseController:delete');
})->add($middleware->logged());

// Grupo de rotas LMS - Categorias de Cursos
$app->group('/lms/categories', function (Slim\Routing\RouteCollectorProxy $group) {
	// Listagem de categorias
	$group->get('', 'app\controllers\lms\CourseCategoryController:show');

	// Rotas de criação de categorias
	$group->get('/create', 'app\controllers\lms\CourseCategoryController:create');
	$group->post('/create', 'app\controllers\lms\CourseCategoryController:save');

	// Rotas de edição de categorias
	$group->get('/{id:[0-9]+}/edit', 'app\controllers\lms\CourseCategoryController:edit');
	$group->post('/{id:[0-9]+}/edit', 'app\controllers\lms\CourseCategoryController:update');

	// Rotas de exclusão de categorias
	$group->get('/{id:[0-9]+}/delete', 'app\controllers\lms\CourseCategoryController:delete');
})->add($middleware->logged());
