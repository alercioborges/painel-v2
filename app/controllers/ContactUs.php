<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;
use app\src\Validate;
use app\src\Email;

class ContactUs extends Controller
{

    public function index(Reques $request, Response $response): Response
    {
        $this->view('pages/contact-us.html', [
            'TITLE' => 'Fale conosco'
        ]);

        return $response;
    }

    public function store(Reques $request, Response $response)
    {
        try {
            $validate = new Validate();

            $data = $validate->validate([
                'name' => 'required',
                'email' => 'email:required',
                'subject' => 'required',
                'message' => 'required'
            ]);

            $email = new Email();
            $email->send($data);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $response;
    }
}
