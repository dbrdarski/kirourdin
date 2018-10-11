<?php

namespace App;
use App\Nothing as Nothing;

class Some {

  function __construct($val){
    $this->some = $val;
  }

  private $some;
  public function isNothing() {
    return false;
  }

  public function isSome(){
    return true;
  }

  public function isSomething(){
    return true;
  }

  public function __get($name) {
    $some = $this->some;
    return
      is_object($some) ?
        isset($this->some->{$name}) ?
        new Some( $this->some->{$name} ) :
        new Nothing ()
      :
        isset($this->some[$name]) ?
        new Some( $this->some[$name] ) :
        new Nothing
      ;
  }
  public function __invoke() {
    return $this->some;
  }
}

?>
