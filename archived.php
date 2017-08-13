<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/project/data/init.php';
  if(!is_logged_in()){
    login_error_redirect();
  }
  include 'include/head.php';
  include 'include/navigator.php';
  $sql = "SELECT * FROM produk WHERE deleted=1";
  $produk_deleted = $db->query($sql);
  // restore produk
  if (isset($_GET['restore'])) {
    $restore_id = sanitize($_GET['restore']);
    $db->query("UPDATE produk SET deleted = 0 WHERE id='$restore_id'");
    header('Location: archived.php');
  }
?>
<h2 class="text-center">Archived</h2>
<table class="table table-bordered table-condensed table-striped">
  <thead><th></th><th>Product</th><th>Price</th><th>Category</th><th>Sold</th></thead>
  <tbody>
    <?php
      while ($restore = mysqli_fetch_assoc($produk_deleted)):
        $child_id = $restore['categories'];
        $category_sql = "SELECT * FROM categories WHERE id = '$child_id'";
        $result = $db->query($category_sql);
        $child_categories = mysqli_fetch_assoc($result);
        $parent_id = $child_categories['parent'];
        $parent_sql = "SELECT * FROM categories WHERE id = '$parent_id'";
        $parent_result = $db->query($parent_sql);
        $parent = mysqli_fetch_assoc($parent_result);
        $category = $child_categories['category'].' - '.$parent['category'];
    ?>
    <tr>
      <td><a href="archived.php?restore=<?=$restore['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-refresh"></span></a></td>
      <td><?=$restore['title'];?></td>
      <td><?=rp($restore['price']);?></td>
      <td><?= $category;?></td>
      <td>0</td>
    </tr>
    <?php endwhile;?>
  </tbody>
</table>
<?php include 'include/footer.php';?>
