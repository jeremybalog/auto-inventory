<?php

namespace App\Kernel;

class ViewController
{
    public static function render($vars = [])
    {
        $vars['company'] = 'Generic Car Dealer';
        $vars['baseUrl'] = 'https://dealer.com';

        echo self::renderView('template', $vars);

        exit();
    }

    public static function renderView($view, $vars = [])
    {
        extract((array)$vars);

        ob_start();
        include(dirname(__FILE__)."/../../resources/views/{$view}.php");
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}

?>
