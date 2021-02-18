<?php
  
  /*
   * model/data-layer.php
   */
  class DataLayer {
    function getMeals(){
      return array("breakfast", "lunch", "dinner");
    }
    function getCondiments(){
      return array("mayonnaise", "ketchup", "mustard", "sriracha");
    }
  }


