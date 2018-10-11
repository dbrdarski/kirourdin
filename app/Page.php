<?php

namespace App\Page;
use App\Either as Either;

class Page {

  public function __get($name) {
    return new Either([
      'type' => 'error',
      'code' => 404,
      'msg' => 'not-found'
    ]])
  }
}

?>
