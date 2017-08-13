<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/project/data/init.php';
  include 'include/head.php';
  $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
  $email = trim($email);
  $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
  $password = trim($password);
  $errors = array();
?>
<style>
  body{
    background-image: url("/project/image/background/bckgrnd.jpg");
    background-size: 100vw 100vh;
    background-attachment: fixed;
  }
</style>
<div id="login-form">
  <div>
    <?php
      if($_POST){
        //form validation
        if(empty($_POST['email']) || empty($_POST['password'])){
          $errors[] = 'You must provide email and password.';
        }
        //password must be 6 characters
        if(strlen($password) < 6){
          $errors[] = 'Password must be at least 6 characters.';
        }
        //validation users password_admin
        $query = $db->query("SELECT * FROM users WHERE email = '$email'");
        $users = mysqli_fetch_assoc($query);
        $users_count = mysqli_num_rows($query);
        if ($users_count < 1 && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors[] = 'You must enter a valid email or user doesn\'t exist.';
        }

        if(!password_verify($password, $users['password'])){
          $errors[] = 'The password isn\'t match. Please try again.';
        }
        //check an errors
        if(!empty($errors)){
          echo display_errors($errors);
        }else{
          //log user in
          $user_id = $users['id'];
          login($user_id);
        }
      }
    ?>
  </div>
  <h2 class="text-center">Login</h2><hr>
  <form action="login.php" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
    </div>
    <div class="form-group">
      <input type="submit" value="Login" class="btn btn-primary">
    </div>
    <p class="text-right"><a href="/project/index.php" alt="home">Visit Site</a></p>
  </form>
</div>
<?php include 'include/footer.php'; ?>
