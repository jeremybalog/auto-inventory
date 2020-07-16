<?php

function sanitize_output($buffer) {
    $replace = [
        '/[\r\n]/' => '',
        '/\>[^\S ]+/s' => '>',
        '/[^\S ]+\</s' => '<',
        '/(\s)+/s' => '\\1',
        '/<!--(.|\s)*?-->/' => ''
    ];

    $buffer = preg_replace(array_keys($replace), array_values($replace), $buffer);

    return $buffer;
}

ob_start("sanitize_output");

function _require_all($dir)
{
    $scan = glob("$dir/*");

    foreach ($scan as $path) {
        if (preg_match('/\.php$/', $path)) {
            require_once $path;
        } elseif (is_dir($path)) {
            _require_all($path);
        }
    }
}
try {
  _require_all('../app/Kernel');
  _require_all('../app/Models');
  _require_all('../app/Http/Controllers');
  _require_all('../app/Http/Routes');
} catch (Exception $e) {
    http_response_code(404);
    echo '<h1>Oops! Something went wrong!';
    echo '<pre>';
    echo 'Caught exception: ',  $e->getMessage(), "\n";
    echo '</pre>';
}


?>
