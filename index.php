<?php
  require_once '../data/init.php';
  if(!is_logged_in()){
    header('Location: login.php');
  }
  $owner = (int)$cs_data['id'];
  $owner = sanitize($cs_data['id']);
  $product_id = (int)sanitize($_POST['product_id']);
  $quantity = (int)sanitize($_POST['quantity']);
  $produkQ = $db->query("SELECT * FROM produk WHERE id = '$product_id'");
  $produk = mysqli_fetch_assoc($produkQ);
  $cartQ = $db->query("SELECT * FROM carts WHERE owner = '$owner'");
  $cart = mysqli_fetch_assoc($cartQ);
  $_SESSION['success_flash'] = $produk['title'].' was added to your cart.';
  if ( $product_id == $cart['items'] ){
    if( $owner == $cart['owner'] && $cart['paid'] == 0){
      $update_cart = $db->query("SELECT * FROM carts WHERE owner = '$owner' AND items = '$product_id' AND paid = 0");
      $nCart = mysqli_fetch_assoc($update_cart);
      $quantity = $quantity + $nCart['quantity'];
      if( $quantity > $produk['quantity']){
        $quantity = $produk['quantity'];
      }
    }
    $db->query("UPDATE carts SET quantity = '$quantity' WHERE owner = '$owner' AND items = '$product_id' AND paid = 0");
  } else {
    $db->query("INSERT INTO carts (items, quantity, owner) VALUES ('$product_id', '$quantity', '$owner')");
  }
  include 'include/head.php';
  include 'include/navigator.php';
?>
Administrator Home

<?php include 'include/footer.php';?>
