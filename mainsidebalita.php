<?php
  $sql = "SELECT * FROM produk WHERE featured=1";
  $featured = $db->query($sql);
?>
<!-- Main Side Bar-->
<section class="container-main content-hotlist-container col-md-10">
  <div class="row">
    <h2 class="text-center">Balita</h2>
    <!-- Balita -->
    <div class="row-fluid mt-50">
      <div class="span12 mb-20">
      </div><br><br>
      <?php $produk = mysqli_fetch_assoc($featured); ?>
      <?php
        $sqlblt = "SELECT * FROM produk WHERE categories = 3 AND featured = 1";
        $bltquery = $db->query($sqlblt);
      ?>
      <div class="row-fluid mb-20">
        <?php while ($balita = mysqli_fetch_assoc($bltquery)) : ?>
        <div class="col-md-3  hotlist-item mt-20">
          <h4><?= $balita['title'];?></h4>
          <img src="<?= $balita['image'];?>" alt="<?= $balita['title'];?>" class="img-tumb" />
          <p class="list-price text-danger">List Price: <s><?= rp($balita['list_price']);?></s></p>
          <p class="price">Our Price: Rp <?= rp($balita['price']);?></p>
          <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $balita['id'];?>)">
            Details</button>
        </div>
        <?php endwhile; ?>
    </div>
  </div>
</div>
