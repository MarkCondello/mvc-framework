<?php 
//Load config
require_once 'config/config.php';
//autoload core libraries, class name needs to be the same as the filename to load
spl_autoload_register(function($className){
    require_once 'libraries/'.$className.'.php';
});