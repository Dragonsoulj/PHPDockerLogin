<?php
class Controller {
  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  public function login() {
    if(isset($_POST['inputUser']) && !empty($_POST['inputUser']) &&
       isset($_POST['inputPassword']) && !empty($_POST['inputPassword']) ) {
      $this->loginTest($_POST['inputUser'], $_POST['inputPassword']);
    }
  }

  public function loginTest($user, $pass) {
    $pass = hash('sha256', $pass);
    $conn = new mysqli('mysql', 'root', 'SuperSecure', 'phplogin');
    if($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    $sql = 'SELECT username, password FROM `phplogin`.`users`';
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $this->model->list[] = $row['username'];
        if(strtoupper($row['username']) == strtoupper($user) && $row['password'] == $pass) {
          $this->model->username = $user;
        }
      }
    }

    if(empty($this->model->username)) {
      $this->model->error = "Invalid username or password.";
      $this->model->username = "";
      $this->model->list = array();
    }
    $conn->close();
  }
}
