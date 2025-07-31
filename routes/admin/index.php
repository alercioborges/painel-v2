<?php

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
