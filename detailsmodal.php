<?php
  require_once '../data/init.php';
  $id = $_POST['id'];
  $id = (int)$id;
  $sql = "SELECT * FROM produk WHERE id = '$id'";
  $result = $db->query($sql);
  $produk = mysqli_fetch_assoc($result);
  $brand_id = $produk['brand'];
  $sql = "SELECT brand FROM brand WHERE id = '$brand_id'";
  $brand_query = $db->query($sql);
  $brand = mysqli_fetch_assoc($brand_query);
?>

<!-- Details Modal -->
<?php ob_start(); ?>
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog"
 aria-labelledby="details-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" onclick="closeModal()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-tittle text-center"><?= $produk['title']; ?></h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <span id="modal_errors" class="bg-danger"></span>
            <div class="col-sm-6" style="border-right: 1px solid #d3d3d3;">
              <div class="center-block"><img src="<?= $produk['image']; ?>" alt="<?= ($produk['title']); ?>" class="details img-responsive"/>
              </div>
            </div>
            <div class="col-sm-6">
              <h4>Details</h4>
              <p class="text-justify" style="width:420px; height: 200px; overflow-y: scroll"><?= nl2br($produk['description']); ?></p>
              <hr>
              <p>Price: <?= rp($produk['price']); ?></p>
              <p>Brand: <?= $brand['brand']; ?></p>
              <form action="/project/Admin/index.php" method="post" id="add_product_form">
                <input type="hidden" name="product_id" value="<?=$id;?>">
                <div class="form-group">
                  <p>Available: <?= $produk['quantity']; ?></p>
                  <div class="col-xs-3"><label for="quantity">Quantity: </label>
                    <input type="number" min="1" max="<?= $produk['quantity']; ?>" name="quantity" class="form-control" id="quantity">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" onclick="closeModal()">Close</button>
        <button class="btn btn-warning" onclick="add_to_cart(); return false;"><span class="glyphicon glyphicon-shopping-cart"></span>Add To Chart</button>
      </div>
    </div>
  </div>
</div>
<script>
  function closeModal() {
    jQuery('#details-modal').modal('hide');
    setTimeout(function(){
      jQuery('#details-modal').remove();
      jQuery('.modal-backdrop').remove();
    },500);
  }
</script>
<?php echo ob_get_clean(); ?>
