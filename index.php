<?php
//The Controller

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require autoload file
require_once("vendor/autoload.php");
/*
  require_once("model/data-layer.php");
  require_once("model/validate.php");
*/ //replaced by adding classes into composer

//Start a session
session_start();

//create an instance of the base class
$f3 = Base::instance();
$validator = new Validate();
$data = new DataLayer();
$order = new Order();
$controller = new Controller($f3);

$f3->set('DEBUG', 3);

//Define a default route (home page)
$f3->route('GET /', function(){
  global $controller;
  $controller -> home();
});

//define route to order
$f3->route('GET|POST /order', function($f3){
  global $controller;
  $controller -> order();
});

//Define route to order2
$f3->route('GET|POST /order2', function($f3){
  global $controller;
  $controller -> order2();
});

//Define route to summary
$f3->route('GET /summary', function(){
  global $controller;
  $controller -> summary();
});

//run fat free
$f3->run();