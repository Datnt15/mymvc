<?php
// Define base url
define('BASE_URL', 'http://localhost/mymvc/');
session_start();

require 'libs/bootstrap.php';
require 'libs/controller.php';
require 'libs/db.php';
require 'libs/model.php';
require 'libs/view.php';
require 'libs/session.php';
require 'libs/cookie.php';
require 'libs/input.php';
require 'libs/config.php';
require 'libs/user.php';
require 'libs/gallery.php';
require 'libs/validation.php';

$app = new Bootstrap();



