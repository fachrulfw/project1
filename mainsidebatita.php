<?php
  $sql = "SELECT * FROM produk WHERE featured=1";
  $featured = $db->query($sql);
?>
<!-- Main Side Bar-->
<section class="container-main content-hotlist-container col-md-10">
  <div class="row">
    <h2 class="text-center">Batita</h2>
    <!-- Batita -->
    <div class="row-fluid mt-50">
      <div class="span12 mb-20">
      </div><br><br>
      <?php $produk = mysqli_fetch_assoc($featured); ?>
      <?php
        $sqlbtt = "SELECT * FROM produk WHERE categories = 2 AND featured = 1";
        $bttquery = $db->query($sqlbtt);
      ?>
      <div class="row-fluid mb-20">
        <?php while ($batita = mysqli_fetch_assoc($bttquery)) : ?>
        <div class="col-md-3  hotlist-item mt-20">
          <h4><?= $batita['title'];?></h4>
          <img src="<?= $batita['image'];?>" alt="<?= $batita['title'];?>" class="img-tumb" />
          <p class="list-price text-danger">List Price: <s><?= rp($batita['list_price']);?></s></p>
          <p class="price">Our Price: <?= rp($batita['price']);?></p>
          <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $batita['id'];?>)">
            Details</button>
        </div>
        <?php endwhile; ?>
      </div>
    </div>
</div>
