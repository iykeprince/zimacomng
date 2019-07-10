<?php
ob_start();
//configurations
require_once 'configs/paths.php';
require_once 'configs/database.php';
require_once 'configs/keys.php';

require_once 'libs/bootstrap.php';
require_once 'libs/controller.php';
require_once 'libs/model.php';
require_once 'libs/view.php';
//core transaction classess
//libraries
require 'libs/database.php';
require 'libs/session.php';
require 'libs/hash.php';
//mail libraries
require 'PHPMailer/PHPMailerAutoload.php';

$app = new Bootstrap();