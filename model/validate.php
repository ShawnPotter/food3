<?php


  class Validate {
    private $_data;

    function __construct() {
      $this->_data = new DataLayer();

    }

    /** validFood() returns true if food is not empty and contains only letters
     * @param String $food
     * @return boolean
     */
    function validFood($food){
      $food = trim($food);
      return !empty($food) && ctype_alpha($food);
    }

    /** validMeal() returns true if the selected meal is in the list of valid options
     * @param String $meal
     * @return boolean
     */
    function validMeal($meal){
      $validMeals = $this->_data->getMeals();
      return in_array($meal, $validMeals);
    }

    /**
     * @param String $conds
     * @return bool
     */
    function validConds($conds){
      foreach ($conds as $cond) {
        if (!in_array($cond, $this->_data->getCondiments())){
          return false;
        }
      }
      return true;
    }
  }
  

