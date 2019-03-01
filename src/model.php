<?php
class Model {
  public $username;
  public $list;
  public $error;

  public function __construct() {
    $this->username = "";
    $this->error = "";
    $this->list = array();
  }
}
