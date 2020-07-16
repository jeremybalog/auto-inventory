<?php

namespace App\Http\Controllers;

use App\Kernel\ViewController;

class AuthController extends ViewController
{
    public static function index()
    {
        $params = [
          'title' => 'Login',
          'head' => '',
          'main' => ''
        ];

        $params['main'] = self::renderView('partials/login');

        self::render($params);
    }
}

?>
