<?php

use app\controllers\IndexController;

// Initial route
$app->get('', [IndexController::class, 'index'])->add($middleware->logged());
