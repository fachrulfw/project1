    <?php
      $sql = "SELECT * FROM produk WHERE featured=1";
      $featured = $db->query($sql);
    ?>
    <!-- Main Side Bar-->
    <section class="container-main content-hotlist-container col-md-10">
      <div class="row">
        <h2 class="text-center">Feature Products</h2>
        <!-- Bayi -->
          <div class="row-fluid mt-50 bg-info">
            <div class="span12 mb-20"><hr>
              <p class="pull-left mb-20" style="margin-left:10px;">
                <span class="font-bold fs-20 ">Bayi</span>
              </p>
              <a href="bayi.php" target="_blank" class="btn btn-small pull-right fs-12 hotlist-view-all">Lihat Semua</a>
            </div><br><br><hr>
            <?php $produk = mysqli_fetch_assoc($featured); ?>
            <?php
              $sqlbayi_6 = "SELECT * FROM produk WHERE categories = 6 AND featured = 1 OR categories = 7 AND featured = 1";
              $byquery_6 = $db->query($sqlbayi_6);
              $i = 0;
            ?>
            <div class="row-fluid mb-20">
                <?php while ( $i<4 && $bayi = mysqli_fetch_assoc($byquery_6)) : ?>
                  <div class="col-md-3  hotlist-item mt-20">
                    <h4><?= $bayi['title'];?></h4>
                    <img src="<?= $bayi['image'];?>" alt="<?= $bayi['title'];?>" class="img-tumb"/>
                    <p class="list-price text-danger">List Price: <s><?= rp($bayi['list_price']);?></s></p>
                    <p class="price">Our Price: Rp <?= rp($bayi['price']);?></p>
                    <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $bayi['id'];?>)">
                      Details</button>
                  </div>
                <?php $i=$i+1;endwhile; ?>
            </div>
          </div>
      </div>
      <!-- Batita -->
      <div class="row">
          <div class="row-fluid mt-50 bg-info"><hr>
            <div class="span12 mb-20">
              <p class="pull-left" style="margin-left:10px;">
                <span class="font-bold fs-20 ">Batita</span>
              </p>
              <a href="Batita.php" target="_blank" class="btn btn-small pull-right fs-12 hotlist-view-all">Lihat Semua</a>
            </div><br><br><hr>
            <?php $produk = mysqli_fetch_assoc($featured); ?>
            <?php
              $sqlbtt = "SELECT * FROM produk WHERE categories = 2 AND featured = 1";
              $bttquery = $db->query($sqlbtt);
              $i=0;
            ?>
            <div class="row-fluid mb-20">
              <?php while($i < 4 && $batita = mysqli_fetch_assoc($bttquery)): ?>
              <div class="col-md-3  hotlist-item mt-20">
                <h4><?= $batita['title'];?></h4>
                <img src="<?= $batita['image'];?>" alt="<?= $batita['title'];?>" class="img-tumb" />
                <p class="list-price text-danger">List Price: <s><?= rp($batita['list_price']);?></s></p>
                <p class="price">Our Price: <?= rp($batita['price']);?></p>
                <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $batita['id'];?>)">
                  Details</button>
              </div>
              <?php  $i=$i+1;endwhile;?>
            </div>
      </div>
    </div>
      <!-- Balita -->
      <div class="row">
          <div class="row-fluid mt-50 bg-info"><hr>
            <div class="span12 mb-20 ">
              <p class="pull-left" style="margin-left:10px;">
                <span class="font-bold fs-20 ">Balita</span>
              </p>
              <a href="Balita.php" target="_blank" class="btn btn-small pull-right fs-12 hotlist-view-all">
                Lihat Semua</a>
            </div><br><br><hr>
            <?php $produk = mysqli_fetch_assoc($featured); ?>
            <?php
              $sqlblt = "SELECT * FROM produk WHERE categories = 3 AND featured = 1";
              $bltquery = $db->query($sqlblt);
              $i=0;
            ?>
            <div class="row-fluid mb-20">
              <?php while ( $i < 4 && $balita = mysqli_fetch_assoc($bltquery)) : ?>
              <div class="col-md-3  hotlist-item mt-20">
                <h4><?= $balita['title'];?></h4>
                <img src="<?= $balita['image'];?>" alt="<?= $balita['title'];?>" class="img-tumb" />
                <p class="list-price text-danger">List Price: <s><?= rp($balita['list_price']);?></s></p>
                <p class="price">Our Price: Rp <?= rp($balita['price']);?></p>
                <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $balita['id'];?>)">
                  Details</button>
              </div>
              <?php $i=$i+1; endwhile; ?>
          </div>
      </div>
    </div>
      <!-- Anak -->
      <div class="row">
          <div class="row-fluid mt-50 bg-info"><hr>
            <div class="span12 mb-20 ">
              <p class="pull-left" style="margin-left:10px;">
                <span class="font-bold fs-20 ">Anak</span>
              </p>
              <a href="Anak.php" target="_blank" class="btn btn-small pull-right fs-12 hotlist-view-all">
                Lihat Semua</a>
            </div><br><br><hr>
            <?php $produk = mysqli_fetch_assoc($featured); ?>
            <?php
              $sqlank = "SELECT * FROM produk WHERE categories = 4 AND featured = 1";
              $ankquery = $db->query($sqlank);
              $i = 0;
            ?>
            <div class="row-fluid mb-20">
              <?php while ( $i<4 && $anak = mysqli_fetch_assoc($ankquery)) : ?>
              <div class="col-md-3  hotlist-item mt-20">
                <h4><?= $anak['title'];?></h4>
                <img src="<?= $anak['image'];?>" alt="<?= $anak['title'];?>" class="img-tumb" />
                <p class="list-price text-danger">List Price: <s><?= rp($anak['list_price']);?></s></p>
                <p class="price">Our Price: <?= rp($anak['price']);?></p>
                <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $anak['id'];?>)">
                  Details</button>
              </div>
              <?php $i=$i+1; endwhile; ?>
          </div>
      </div>
    </div>
      <!-- Remaja -->
      <div class="row ">
        <div class="row-fluid mt-50 bg-info"><hr>
            <div class="span12 mb-20">
              <p class="pull-left" style="margin-left:10px;">
                <span class="font-bold fs-20 ">Remaja</span>
              </p>
              <a href="Remaja.php" target="_blank" class="btn btn-small pull-right fs-12 hotlist-view-all">
                Lihat Semua</a>
            </div><br><br><hr>
            <?php $produk = mysqli_fetch_assoc($featured); ?>
            <?php
              $sqlrmj = "SELECT * FROM produk WHERE categories = 5 AND featured = 1";
              $rmjquery = $db->query($sqlrmj);
              $i=0;
            ?>
            <div class="row-fluid mb-20">
              <?php while ( $i < 4 && $remaja = mysqli_fetch_assoc($rmjquery)) : ?>
              <div class="col-md-3  hotlist-item mt-20">
                <h4><?= $remaja['title'];?></h4>
                <img src="<?= $remaja['image'];?>" alt="<?= $remaja['title'];?>" class="img-tumb" />
                <p class="list-price text-danger">List Price: <s><?= rp($remaja['list_price']);?></s></p>
                <p class="price">Our Price: <?= rp($remaja['price']);?></p>
                <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $remaja['id'];?>)">
                  Details</button>
              </div>
              <?php $i=$i+1; endwhile; ?>
            </div>
        </div>
      </div>
