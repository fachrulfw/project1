<?php
  $sql = "SELECT * FROM produk WHERE featured=1";
  $featured = $db->query($sql);
?>
<!-- Main Side Bar-->
<section class="container-main content-hotlist-container col-md-10">
  <div class="row">
    <!-- Bayi 0 - 6 Bulan-->
    <h2 class="text-center">Bayi 0 - 6 Bulan</h2>
      <div class="row-fluid mt-50 bg-info">
        <?php $produk = mysqli_fetch_assoc($featured); ?>
        <?php
          $sqlbayi_6 = "SELECT * FROM produk WHERE categories = 6 AND featured = 1";
          $byquery_6 = $db->query($sqlbayi_6);
        ?>
        <div class="row-fluid mb-20">
            <?php while ($bayi = mysqli_fetch_assoc($byquery_6)) : ?>
              <div class="col-md-3  hotlist-item mt-20">
                <h4><?= $bayi['title'];?></h4>
                <img src="<?= $bayi['image'];?>" alt="<?= $bayi['title'];?>" class="img-tumb" />
                <p class="list-price text-danger">List Price: <s><?= rp($bayi['list_price']);?></s></p>
                <p class="price">Our Price: Rp <?= rp($bayi['price']);?></p>
                <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $bayi['id'];?>)">
                  Details</button>
              </div>
            <?php endwhile; ?>
        </div>
      </div>
  </div>
