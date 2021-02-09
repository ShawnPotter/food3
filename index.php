<?php
  //The Controller

  //turn on error reporting
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  //Start a session
  session_start();

  //require autoload file
  require_once("vendor/autoload.php");

  //create an instance of the base class
  $f3 = Base::instance();
  $f3->set('DEBUG', 3);

  //Define a default route (home page)
  $f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
  });

  //Define a order route
  $f3->route('GET /order', function(){
    $view = new Template();
    echo $view->render('views/form1.html');
  });

  //Define order 2 route
  $f3->route('POST /order2', function(){
    //add data form form1 to Session Array
    //var_dump($_POST);
    if(isset($_POST['food'])){
      $_SESSION['food'] = $_POST['food'];
    }
    if(isset($_POST['meal'])){
      $_SESSION['meal'] = $_POST['meal'];
    }
    $view = new Template();
    echo $view->render('views/form2.html');
  });

  //Define a summary route
  $f3->route('POST /summary', function(){
//    echo "<p>POST:</p>";
//    var_dump($_POST);
//
//    echo "<p>SESSION:</p>";
//    var_dump($_SESSION);

    //add data from form2 to Session Array
    //var_dump($_POST);
    if(isset($_POST['conds'])){
      $_SESSION['conds'] = implode(", ", $_POST['conds']);
    }

    $view = new Template();
    echo $view->render('views/summary.html');
  });

  //run fat free
  $f3->run();
