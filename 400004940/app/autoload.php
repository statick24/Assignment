<?php 
function autoload($class) {
    $filePath = __DIR__ . "/" . "{$class}.php";
    if (file_exists($filePath)) {
        require_once $filePath;
    }
}

spl_autoload_register('autoload');

?>