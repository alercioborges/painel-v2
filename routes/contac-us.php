<?php

use app\controllers\ContactUs;


// Contact us route 
$app->get('/contact-us', [ContactUs::class, 'index']);
$app->post('/contact-us', [ContactUs::class, 'store']);
