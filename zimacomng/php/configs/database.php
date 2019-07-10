<?php
require('env.php');
switch(EVIRONMENT){
   case 'development':
      define('DB_TYPE', 'mysql');
      define('DB_HOST', 'localhost');
      define('DB_NAME', 'zimacomng_db');
      define('DB_USER', 'root');
      define('DB_PASS', '');
   break;
   case 'production':
      define('DB_TYPE', 'mysql');
      define('DB_HOST', 'localhost');
      define('DB_NAME', 'zimacomn_db');
      define('DB_USER', 'zimacomn_db');
      define('DB_PASS', 'Zimacomn_db');
   break;
}

// MAP
define('MAP_API_KEY', 'AIzaSyAPQu0vPwT-QXD6NZM7Sx_M4wgeC74v7Fo');