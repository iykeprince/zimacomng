<?php
// define('APPROOT', dirname(dirname(__FILE__)).'/' );
define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('SLASH','/');
switch (ENVIRONMENT) {
    case 'development':
        define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER . SLASH);
        break;
    case 'production':
        define('URL', URL_PROTOCOL . URL_DOMAIN . SLASH);
        break;
    }
