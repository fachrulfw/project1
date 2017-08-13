<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/project/data/init.php';
  if(!cs_is_logged_in()){
    cs_login_error_redirect();
  }
  if(!cs_has_permission()){
    cs_permission_error_redirect('login.php');
  }
  include 'include/head.php';
  include 'include/navigator.php';
  include 'include/fullheader.php';
  include 'include/leftsidebar.php';
  $owner = sanitize($cs_data['id']);
  if($owner != ''){
    $cartQ = ("SELECT * FROM carts WHERE owner = '$owner'");
    $result = $db->query($cartQ);
  }
?>
<section class="container-right col-md-10">
  <div class="row">
    <h2 class="text-center">My Chart</h2><hr>
    <?php if($owner == ''):?>
      <div class="bg-danger">
        <p class="text-center text-danger">Your shopping cart is empty.</p>
      </div>
    <?php else: ?>
      <table class="table table-bordered table-condensed table-striped">
        <thead><th></th><th>Item</th><th>Price</th><th>Quantity</th><th>Sub Total</th><th></th></thead>
        <tbody>
          <?php while($cart = mysqli_fetch_assoc($result)):
            $items = $cart['items'];
            $prdct = ("SELECT * FROM produk WHERE id = '$items'");
            $prdct_result = $db->query($prdct);
            $cartP = mysqli_fetch_assoc($prdct_result);
            $i = 1;
            $sub_total = 0;
            $item_count = 0;
            ?>
          <tr>
            <td><a href="add_cart.php?delete=<?= $cart['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a></td>
            <td><?= $cartP['title']; ?></td>
            <td><?= $cartP['price']; ?></td>
            <td><?=$cart['quantity'];?></td>
            <td><?php $sub_total = $cartP['price'] * $cart['quantity']; echo rp($sub_total);?></td>
            <td>
              <?php if($cart['paid'] == 0):?>
                <button type="button" class="btn btn-primary btn-xs btn-default" onclick="detailsbuy(<?= $cart['id'];?>)">Buy this item</button>
              <?php else: ?>
                <button type="button" class="btn btn-success btn-xs btn-default" onclick="detailsbuy(<?= $cart['id'];?>)">Process</button>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</section>
<?php
  include 'include/rightsidebar.php';
  include 'include/footer.php';
?>
<script>
function detailsbuy(id){
  var data = {"id" : id};
  jQuery.ajax({
    url: '/project/detailsbuy.php',
    method: "post",
    data: data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#details-buy').modal('toggle');
    },
    error: function(){
      alert("Something went wrong!");
    }
  });
}
</script>
