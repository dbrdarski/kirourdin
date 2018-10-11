<?php

namespace App;

class Nothing {

  function __construct(){
    // echo '<br>hello darkness</br>';
  }

  public function orElse($fn){
    return $fn();
  }

  public function isNothing(){
    return true;
  }

  public function isSome(){
    return false;
  }

  public function isSomething(){
    return false;
  }

  public function then() {
    return new Nothing;
  }

  public function __get($i) {
    return new Nothing;
  }
}

?>
