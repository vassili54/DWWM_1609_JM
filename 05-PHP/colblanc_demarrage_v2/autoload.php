<?php
// autoload.php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/dao/' . $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
});