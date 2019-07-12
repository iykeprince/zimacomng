<?php

define('ENVIRONMENT', 'development');

switch (ENVIRONMENT) {
   case 'development':
        define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER . SLASH);
        break;
   
   case 'production':
        define('URL', URL_PROTOCOL . URL_DOMAIN . SLASH);
        break;
}   

