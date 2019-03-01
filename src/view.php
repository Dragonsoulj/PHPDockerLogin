<?php
class View {
  private $model;
  private $controller;

  public function __construct($controller, $model) {
    $this->controller = $controller;
    $this->model = $model;
  }

  public function output() {
    if(!empty($this->model->username)) {
      $this->outputUserList();
    } else {
      $this->outputLoginBox();
    }
  }

  private function outputLoginBox() {
?>
    <form class="form-signin center-box" action="index.php" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
<?php
    if (!empty($this->model->error)) {
?>
    <div class="alert alert-danger"><?php echo $this->model->error; ?></div>
<?php
    }
?>
      <label for="inputUser" class="sr-only">Email address</label>
      <input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
<?php
  }

  private function outputUserList() {
?>
    <div class="center-box">
      <h1 class="h3 mb-3 font-weight-normal">Welcome, <?php echo $this->model->username; ?>.</h1>
      <h2>User List</h2>
      <ul>
<?php
    foreach ($this->model->list as $user) {
      echo "<li>" . $user . "</li>";
    }
?>
      </ul>
      <a href="index.php">Log Out</a>
    </div>
<?php
  }
}
