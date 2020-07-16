<?php

namespace App\Http\Controllers;

use App\Kernel\ViewController;

class AuthController extends ViewController
{
    public static function index()
    {
        $params = [
          'title' => 'Login',
          'canonical' => '/login',
          'metaDesc' => 'Login and search hundreds of high quality cars.',
          'main' => ''
        ];

        $params['main'] = self::renderView('partials/login');

        self::render($params);
    }
}

?>
