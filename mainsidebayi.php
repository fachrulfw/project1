<?php
  $sql = "SELECT * FROM produk WHERE featured=1";
  $featured = $db->query($sql);
?>
<!-- Main Side Bar-->
<section class="container-main content-hotlist-container col-md-10">
  <div class="row">
    <!-- Bayi 6 - 12 Bulan -->
      <div class="row-fluid mt-50 bg-info">
        <div class="span12 mb-20">
          <p class="pull-left mb-20">
            <span class="font-bold fs-20 ">Bayi 0 - 6 Bulan</span>
          </p>
          <a href="0-6.php" target="_blank" class="btn btn-small pull-right fs-12 hotlist-view-all">Lihat Semua</a>
        </div><br><br><hr>
        <?php $produk = mysqli_fetch_assoc($featured); ?>
        <?php
          $sqlbayi_6 = "SELECT * FROM produk WHERE categories = 6 AND featured = 1";
          $byquery_6 = $db->query($sqlbayi_6);
          $i = 0;
        ?>
        <div class="row-fluid mb-20">
            <?php while ($i<8 && $bayi = mysqli_fetch_assoc($byquery_6)) : ?>
              <div class="col-md-3  hotlist-item mt-20">
                <h4><?= $bayi['title'];?></h4>
                <img src="<?= $bayi['image'];?>" alt="<?= $bayi['title'];?>" class="img-tumb" />
                <p class="list-price text-danger">List Price: <s><?= rp($bayi['list_price']);?></s></p>
                <p class="price">Our Price: Rp <?= rp($bayi['price']);?></p>
                <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $bayi['id'];?>)">
                  Details</button>
              </div>
            <?php $i=$i+1; endwhile; ?>
        </div>
      </div>
  </div>
  <div class="row">
    <!-- Bayi 0 - 6 Bulan-->
      <div class="row-fluid mt-50 bg-info">
        <div class="span12 mb-20">
          <p class="pull-left mb-20">
            <span class="font-bold fs-20 ">Bayi 0 - 6 Bulan</span>
          </p>
          <a href="6-12.php" target="_blank" class="btn btn-small pull-right fs-12 hotlist-view-all">Lihat Semua</a>
        </div><br><br><hr>
        <?php $produk = mysqli_fetch_assoc($featured); ?>
        <?php
          $sqlbayi_6 = "SELECT * FROM produk WHERE categories = 7 AND featured = 1";
          $byquery_6 = $db->query($sqlbayi_6);
          $i = 0;
        ?>
        <div class="row-fluid mb-20">
            <?php while ($i<8 && $bayi = mysqli_fetch_assoc($byquery_6)) : ?>
              <div class="col-md-3  hotlist-item mt-20">
                <h4><?= $bayi['title'];?></h4>
                <img src="<?= $bayi['image'];?>" alt="<?= $bayi['title'];?>" class="img-tumb" />
                <p class="list-price text-danger">List Price: <s><?= rp($bayi['list_price']);?></s></p>
                <p class="price">Our Price: Rp <?= rp($bayi['price']);?></p>
                <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $bayi['id'];?>)">
                  Details</button>
              </div>
            <?php $i=$i+1; endwhile; ?>
        </div>
      </div>
  </div>
