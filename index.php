<?php
// Define base url
define('base_url', 'http://nguyendangdungha.com/mymvc/');
session_start();
ob_start();

require 'libs/bootstrap.php';
require 'libs/controller.php';
require 'libs/db.php';
require 'libs/model.php';
require 'libs/view.php';
require 'libs/session.php';
require 'libs/cookie.php';

$app = new Bootstrap();



