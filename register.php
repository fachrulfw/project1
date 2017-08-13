<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/project/data/init.php';
  include 'include/head.php';
  include 'include/navigator.php';
  $name= ((isset($_POST['email']))?sanitize($_POST['name']):'');
  $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
  $email = trim($email);
  $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
  $password = trim($password);
  $confirm = ((isset($_POST['email']))?sanitize($_POST['confirm']):'');
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
      $emailQ = $db->query("SELECT * FROM costumers WHERE email = '$email'");
      $emailcount = mysqli_num_rows($emailQ);

      if($emailcount != 0){
        $errors[] = 'Email already exists. Please enter new email.';
      }
      $required = array('name', 'email', 'password', 'confirm');
      foreach ($required as $f) {
        if(empty($_POST[$f])){
          $errors[] = 'You must fill out all fields.';
          break;
        }
      }
      if(strlen($password)<6 ){
        $errors[] = 'Password must be at least 6 characters.';
      }
      if($password != $confirm){
        $errors[] = 'Password isn\'t match.';
      }
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = 'You must enter a valid email';
      }

      if(!empty($errors)){
        echo display_errors($errors);
      }else{
        //add users
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $db->query("INSERT INTO costumers (full_name,email,password,permissions) VALUES ('$name', '$email', '$hashed', 'costumer')");
        $_SESSIO['success_flash'] = 'New user has been added.';
        header('Location: login.php');
      }
    }
    ?>
  </div>
  <h2 class="text-center">Register</h2><hr>
  <form action="register.php" method="post">
    <div class="form-group">
      <label for="name">Full Name:</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Your full name" value="<?=$name;?>">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Your e-mail address" value="<?=$email;?>">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="Your password" value="<?=$password;?>">
    </div>
    <div class="form-group">
      <label for="confirm">Confirm Password:</label>
      <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Confirm your password" value="<?=$confirm;?>">
    </div>
    <div class="form-group text-right" style="margin-top:25px;">
      <input type="submit" value="Register" class="btn btn-primary">
    </div>
  </form>
</div>
<?php include 'include/footer.php'; ?>
