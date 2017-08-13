<?php
  $sql = "SELECT * FROM produk WHERE featured=1";
  $featured = $db->query($sql);
?>
<!-- Main Side Bar-->
<section class="container-main content-hotlist-container col-md-10">
<!-- Anak -->
<div class="row">
    <div class="row-fluid mt-50">
      <h2 class="text-center">Anak</h2><br><br>
      <?php $produk = mysqli_fetch_assoc($featured); ?>
      <?php
        $sqlank = "SELECT * FROM produk WHERE categories = 4 AND featured = 1";
        $ankquery = $db->query($sqlank);
      ?>
      <div class="row-fluid mb-20">
        <?php while ($anak = mysqli_fetch_assoc($ankquery)) : ?>
        <div class="col-md-3  hotlist-item mt-20">
          <h4><?= $anak['title'];?></h4>
          <img src="<?= $anak['image'];?>" alt="<?= $anak['title'];?>" class="img-tumb" />
          <p class="list-price text-danger">List Price: <s><?= rp($anak['list_price']);?></s></p>
          <p class="price">Our Price: <?= rp($anak['price']);?></p>
          <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $anak['id'];?>)">
            Details</button>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</div>
