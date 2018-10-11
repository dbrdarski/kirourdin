<?php

namespace App\Either;

class Either{
  function __construct($msg){

  }
  public function orElse($fn){
    return $fn($this->msg);
  }
  public function then(){
    return new Either($this->msg);
  }

  public function isSome(){
    return false;
  }

  public function isSomething(){
    return false;
  }

  private msg;

  public function __get() {
    return new Either($this->msg);
  }
}

?>
