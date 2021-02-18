<?php

class Controller {
  private $_f3;

  /**
   * Controller constructor.
   * @param Object $f3 fat-free object
   */
  public function __construct($f3)
  {
    $this -> _f3 = $f3;
  }


  function home()
  {
      //Define a default route (home page)
      $view = new Template();
      echo $view->render('views/home.html');
  }
  function order()
  {
    global $validator;
    global $data;
    global $order;

    //Define a order route
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $userFood = trim($_POST['food']);
      $userMeal = $_POST['meal'];

      //if the data is valid
      if($validator->validFood($userFood)){
        $order->setFood($userFood);
      }
      //data is not valid, set an error in the f3 hive
      else {
        $this->_f3->set("errors['food']", "food can not be blank must contain only characters");
      }
      //if meal is set then store it in session
      if($validator->validMeal($userMeal)){
        $order->setMeal($userMeal);
      } else {
        $this -> _f3->set("errors['meal']", "Please select a meal from the list");
      }
      //if there are no errors then reroute to order2
      if(empty($this -> _f3->get('errors'))){
        $_SESSION['order'] = $order;
        $this -> _f3->reroute('/order2'); //GET method
      }
    }

    $this -> _f3->set("meals", $data->getMeals());
    $this -> _f3->set("userFood", isset($userFood) ? $userFood : "");

    $view = new Template();
    echo $view->render('views/form1.html');
  }
  function order2()
  {
    global $validator;
    global $data;
    global $order;


    if($_SERVER['REQUEST_METHOD']=='POST'){
      $userCondiments = $_POST['conds'];
      if($validator->validConds($userCondiments)){
        $order->setCondiments(implode(", ", $userCondiments));
      }

    } else{
      $this->_f3->set("errors['conds']", "Go away, evildoer!");
    }
    if(empty($this->_f3->get('errors'))){
      //reroute to summary
      $this->_f3->reroute('/summary');
    }
    //var_dump($_POST);

    $this->_f3->set("condiments", $data->getCondiments());

    $view = new Template();
    $_SESSION['order'] = $order;
    echo $view->render('views/form2.html');
  }
  function summary()
  {
    //    echo "<p>POST:</p>";
//    var_dump($_POST);
//
    echo "<p>SESSION:</p>";
    var_dump($_SESSION);

    //add data from form2 to Session Array
    //var_dump($_POST);

    $view = new Template();
    echo $view->render('views/summary.html');

    //clear the Session
    session_destroy();
  }
}