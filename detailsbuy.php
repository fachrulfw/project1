<?php
  require_once '/data/init.php';
  $id = $_POST['id'];
  $id = (int)$id;
  $sql = "SELECT * FROM carts WHERE id = '$id'";
  $result = $db->query($sql);
  $item = mysqli_fetch_assoc($result);
  $produkId = $item['items'];
  $sqlProduk = "SELECT * FROM produk WHERE id = '$produkId'";
  $resultProduk = $db->query($sqlProduk);
  $produk = mysqli_fetch_assoc($resultProduk);
  $nama_pembeli = ((isset($_POST['nama_pembeli']))?sanitize($_POST['nama_pembeli']):$item['nama']);
  $email_pembeli = ((isset($_POST['email_pembeli']))?sanitize($_POST['email_pembeli']):$item['email']);
  $no_telp = ((isset($_POST['no_telp']))?sanitize($_POST['no_telp']):$item['telp']);
  $alamat = ((isset($_POST['alamat']))?sanitize($_POST['alamat']):$item['address']);
  $errors = array();
?>
<?php ob_start(); ?>

<?php
  if($_POST){
    if(empty($_POST['nama_pembeli'])||empty($_POST['email_pembeli'])||empty($_POST['no_telp'])||empty($_POST['alamat'])){
      $errors[] = 'You must fill out all fields.';
    }
  }
?>


<div class="modal fade details-1" id="details-buy" tabindex="-1" role="dialog"
 aria-labelledby="details-1" aria-hidden="true">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
         <button class="close" type="button" onclick="closeModal()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-tittle text-center"><?=$produk['title'];?></h4>
       </div>
       <div class="modal-body">
         <div class="container-fluid">
           <div class="row">
             <span id="modal_errors" class="bg-danger"></span>
             <div class="col-sm-6" style="border-right: 1px solid #d3d3d3;">
               <div class="center-block">
                 <img src="<?= $produk['image'];?>" alt="<?=$produk['title'];?>" class="details img-responsive">
               </div>
             </div>
             <div class="col-sm-6">
               <div class="container-fluid">
                 <div class="row">
                   <form action="detailsbuy.php" method="post" id="buy_item">
                     <div class="form-group">
                       <label for="nama_pembeli">Nama Pembeli</label>
                       <input type="text" maxlength="30" name="nama_pembeli" id="nama_pembeli" class="form-control" value="<?=$nama_pembeli;?>">
                     </div>
                     <div class="form-group">
                       <label for="email_pembeli">Email Pembeli</label>
                       <input type="email" maxlength="30" name="email_pembeli" id="email_pembeli" class="form-control" value="<?=$email_pembeli?>">
                     </div>
                     <div class="form-group">
                       <label for="no_telp">Nomor Telepon/Handphone</label>
                       <input type="text" maxlength="14" name="no_telp" id="no_telp" class="form-control" value="<?=$no_telp;?>">
                     </div>
                     <div class="form-group">
                       <label for="alamat">Alamat</label>
                       <textarea name="alamat" id="alamat" class="form-control" rows="4"><?=$alamat;?></textarea>
                     </div>
                     <?php if ($item['paid'] == 1): ?>
                       <div class="form-group">
                         <label for="payment">Payment</label>
                         <input type="file" name="payment" id="payment" class="form-control" value="">
                       </div>
                     <?php endif; ?>
                   </form>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="modal-footer">
         <a href="add_cart.php" onclick="closeModal()" class="btn btn-default">Cancel</a>
         <?php if($item['paid']==0): ?>
           <input type="submit" value="Process" class="btn btn-primary" onclick="buy(); return false">
         <?php else: ?>
           <?php if($item['process'] == 0): ?>
             <input type="submit" value="Process" class="btn btn-success" onclick="buy(); return false">
           <?php endif ?>
         <?php endif; ?>
       </div>
     </div>
   </div>
</div>
<script>
  function closeModal() {
    jQuery('#details-modal').modal('hide');
    setTimeout(function(){
      jQuery('#details-buy').remove();
      jQuery('.modal-backdrop').remove();
    },500);
  }
</script>
<?php echo ob_get_clean(); ?>
