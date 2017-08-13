<?php
  $sql = "SELECT * FROM produk WHERE featured=1";
  $featured = $db->query($sql);
?>
<!-- Main Side Bar-->
<section class="container-main content-hotlist-container col-md-10">
<!-- Remaja -->
<div class="row">
  <div class="row-fluid mt-50">
      <h2 class="text-center">Remaja</h2>
      <div class="span12 mb-20">
      </div><br><br>
      <?php $produk = mysqli_fetch_assoc($featured); ?>
      <?php
        $sqlrmj = "SELECT * FROM produk WHERE categories = 5 AND featured = 1";
        $rmjquery = $db->query($sqlrmj);

      ?>
      <div class="row-fluid mb-20">
        <?php while ($remaja = mysqli_fetch_assoc($rmjquery)) : ?>
        <div class="col-md-3  hotlist-item mt-20">
          <h4><?= $remaja['title'];?></h4>
          <img src="<?= $remaja['image'];?>" alt="<?= $remaja['title'];?>" class="img-tumb" />
          <p class="list-price text-danger">List Price: <s><?= rp($remaja['list_price']);?></s></p>
          <p class="price">Our Price: <?= rp($remaja['price']);?></p>
          <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $remaja['id'];?>)">
            Details</button>
        </div>
        <?php  endwhile; ?>
      </div>
  </div>
</div>
