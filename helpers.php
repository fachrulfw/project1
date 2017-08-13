<?php
  function display_errors($errors){
    $display = '<ul class="bg-danger">';
    foreach ($errors as $error) {
      $display .='<li class="text-danger">'.$error.'</li>';
    }
    $display .= '</ul>';
    return $display;
  }

function sanitize($dirty){
  return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function rp($number){
  return 'Rp '.number_format($number,2);
}

function login($user_id){
  $_SESSION['SBUser'] = $user_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE users SET last_login = '$date' WHERE id ='$user_id'");
  $_SESSION['success_flash'] = 'You are now logged in';
  header ('Location: index.php');
}

function login_cs($cs_id){
  $_SESSION['Costumer'] = $cs_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $born = date("Y-m-d");
  $db->query("UPDATE costumers SET last_login = '$date' WHERE id='$cs_id'");
  header('Location: index.php');
}

function is_logged_in(){
  if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0){
    return true;
  }
  return false;
}

function cs_is_logged_in(){
  if(isset($_SESSION['Costumer']) && $_SESSION['Costumer'] > 0){
    return true;
  }
  return false;
}


function login_error_redirect($url = 'login.php'){
  $_SESSION['error_flash'] = 'You must be logged in to access that page';
  header('Location: '.$url);
}

function cs_login_error_redirect($url = 'login.php'){
  header('Location: '.$url);
}

function permission_error_redirect($url = 'login.php'){
  $_SESSION['error_flash'] = 'You do not have permission to access that page';
  header('Location: '.$url);
}

function cs_permission_error_redirect($url = 'login.php'){
  header('Location: '.$url);
}


function has_permission( $permission =  'admin' ){
  global $user_data;
  $permissions = explode(',', $user_data['permissions']);
  if(in_array($permission, $permissions, true)){
    return true;
  }
  return false;
}

function cs_has_permission( $permission =  'costumer' ){
  global $cs_data;
  $permissions = explode(',', $cs_data['permissions']);
  if(in_array($permission, $permissions, true)){
    return true;
  }
  return false;
}

function pretty_date($date){
  return date("M d, Y h:i A", strtotime($date));
}
