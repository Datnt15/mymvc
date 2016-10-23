<?php
// Define base url
define('base_url', 'http://nguyendangdungha.com/mymvc/');
session_start();

require 'libs/bootstrap.php';
require 'libs/controller.php';
require 'libs/db.php';
require 'libs/model.php';
require 'libs/view.php';
require 'libs/session.php';
require 'libs/cookie.php';
require 'libs/input.php';

$app = new Bootstrap();



