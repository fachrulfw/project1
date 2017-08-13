<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/project/data/init.php';
  if(!is_logged_in()){
    login_error_redirect();
  }
  include 'include/head.php';
  include 'include/navigator.php';

  // delete produk
  if (isset($_GET['delete'])) {
    $delete_id = sanitize($_GET['delete']);
    $db->query("UPDATE produk SET deleted = 1 WHERE id='$delete_id'");
    header('Location: products.php');
  }

  $dbpath = '';
  if (isset($_GET['add']) || isset($_GET['edit'])) {
    $brand_query = $db->query("SELECT * FROM brand ORDER BY brand");
    $parent_query = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
    $child_query = $db->query("SELECT * FROM categories WHERE parent = 1 ORDER BY category");
    $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
    $brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
    $price = ((isset($_POST['price']) && !empty($_POST['price']))?sanitize($_POST['price']):'');
    $list_price = ((isset($_POST['list_price']) && !empty($_POST['list_price']))?sanitize($_POST['list_price']):'');
    $description = ((isset($_POST['description']) && !empty($_POST['description']))?sanitize($_POST['description']):'');
    $quantity = ((isset($_POST['quantity']) && !empty($_POST['quantity']))?sanitize($_POST['quantity']):'');
    $saved_photo = '';$cat='';
    if((isset($_GET['edit']))){
      $edit_id = (int)$_GET['edit'];
      $productresult = $db->query("SELECT * FROM produk WHERE id ='$edit_id'");
      $produk_edit = mysqli_fetch_assoc($productresult);
      if (isset($_GET['delete_photo'])) {
        $photo_url= $_SERVER['DOCUMENT_ROOT'].$produk_edit['image'];echo $photo_url;
        unlink($photo_url);
        $db->query("UPDATE produk SET image ='' WHERE id = '$edit_id'");
        header('Location: products.php?edit='.$edit_id);
      }
      $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):$produk_edit['title']);
      $brand = ((isset($_POST['brand']) && $_POST['brand'] != '')?sanitize($_POST['brand']):$produk_edit['brand']);
      $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):$produk_edit['price']);
      $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):$produk_edit['list_price']);
      $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$produk_edit['description']);
      $quantity = ((isset($_POST['quantity']) && $_POST['quantity'] != '')?sanitize($_POST['quantity']):$produk_edit['quantity']);
      $saved_photo = (($produk_edit['image'] != '')?$produk_edit['image']:'');
      $dbpath = $saved_photo;
    }
    if ($_POST) {
      $parent = (int)sanitize($_POST['parent']);
      $child = (int)sanitize($_POST['child']);
      $errors = array();
      $required = array('title','brand', 'parent', 'price', 'quantity');
      foreach ($required as $field) {
        if ($_POST[$field] == '') {
          $errors[] = 'All fields with an asterisk are required.';
          break;
        }
      }
      if (!empty($_FILES)) {
        $photo = $_FILES['photo'];
        $name = $photo['name'];
        $name_array = explode('.',$name);
        $file_name = $name_array[0];
        $file_ext = $name_array[1];
        $mime = explode('/',$photo['type']);
        $mime_type = $mime[0];
        $mime_ext = $mime[1];
        $tmp_loc = $photo['tmp_name'];
        $file_size = $photo['size'];
        $allowed = array('png','jpg','jpeg');
        $upload_name = md5(microtime()).'.'.$file_ext;
        $upload_path = BASEURL.'/image/susu/'.$upload_name;
        $dbpath = '/project/image/susu/'.$upload_name;
        if ($mime_type != 'image') {
          $errors[] = 'The file must be an image.';
        }
        if (!in_array($file_ext, $allowed)) {
          $errors[] = 'The photo extension must be a png, jpg, or jpeg';
        }
        if ($file_size > 15000000) {
          $errors[] = 'The file size must be under 15MB';
        }
      }
      if (!empty($errors)) {
        echo display_errors($errors);
      }else{
        // upload file and insert into database
        if($parent > $child){$chat = (int)$parent;}else{$cat=(int)$child;}
        if(!empty($_FILES)){move_uploaded_file($tmp_loc,$upload_path);}
        $insert_sql = "INSERT INTO produk (`title`,`price`,`list_price`,`brand`,`categories`,`quantity`,`image`,`description`)
        VALUES ('$title','$price','$list_price','$brand', '$cat','$quantity','$dbpath','$description')";
        if ($_GET['edit']) {
          $insert_sql = "UPDATE produk SET `title`='$title', `price`='$price', `list_price`='$list_price',
          `brand`='$brand', `categories`='$cat', `quantity`='$quantity', `description`='$description', `image`='$dbpath'
          WHERE id ='$edit_id'";
        }
        $db->query($insert_sql);
        header('Location: products.php');
      }
    }
    ?>
    <h2 class="text-center"><?=((isset($_GET['edit']))?'Edit':'Add a New');?> Product</h2><hr>
    <form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data">
      <div class = "form-group col-md-3">
        <label for="title">Title*:</label>
        <input type="text" name="title" class="form-control" id="title" value="<?=$title;?>">
      </div>
      <div class="form-group col-md-3">
        <label for="brand">Brand*:</label>
        <select class="form-control" id="brand" name="brand">
          <option value=""<?= (($brand == '')?' selected':'');?>></option>
          <?php while($b = mysqli_fetch_assoc($brand_query)): ?>
            <option value="<?=$b['id']?>" <?=(($brand == $b['id'])?' selected':'');?>><?= $b['brand']; ?></option>
          <?php endwhile;?>
        </select>
      </div>
      <div class="form-group col-md-3">
        <label for="parent">Parent Category*:</label>
        <select class="form-control" id="parent" name="parent">
          <option value=""<?= ((isset($_POST['parent']) && $_POST['parent'] == '')?' selected':''); ?>></option>
          <?php while($parent = mysqli_fetch_assoc($parent_query)): ?>
            <option value="<?= $parent['id'];?>"<?= ((isset($_POST['parent']) && $_POST['parent'] == $parent['id'])?' selected':''); ?>><?= $parent['category']; ?></option>
          <?php endwhile;?>
        </select>
      </div>
      <div class="form-group col-md-3">
        <label for="child">Child Category*:</label>
        <select id="child" class="form-control" name="child">
          <option value=""<?= ((isset($_POST['child']) && $_POST['child'] == '')?' selected':''); ?>></option>
          <?php while($child = mysqli_fetch_assoc($child_query)): ?>
            <option value="<?= $child['id'];?>"<?= ((isset($_POST['child']) && $_POST['child'] == $child['id'])?' selected':''); ?>><?= $child['category']; ?></option>
          <?php endwhile;?>
        </select>
      </div>
      <div class="form-group col-md-3">
        <label for="price">Price*:</label>
        <input type="text" id="price" placeholder="Enter your price with number" name="price" class="form-control" value="<?= $price; ?>">
      </div>
      <div class="form-group col-md-3">
        <label for="price">List Price:</label>
        <input type="text" id="list_price" placeholder="Enter your list price with number" name="list_price" class="form-control" value="<?= $list_price; ?>">
      </div>
      <div class="form-group col-md-1">
        <label for="quantity">Quantity*:</label>
        <input type="number" name="quantity" id="quantity" value="<?=$quantity;?>" min="0" class="form-control">
      </div>
      <div class="form-group col-md-6">
        <?php if($saved_photo != ''): ?>
          <div class="saved-photo">
            <img height="auto" width="200px" src="<?=$saved_photo;?>" alt="saved photo"><br>
            <a href="products.php?delete_photo=1&edit=<?=$edit_id;?>" class="text-danger">Delete Photo</a>
          </div>
        <?php else: ?>
          <label for="photo">Product Photo*:</label>
          <input type="file" name="photo" id="photo" class="form-control" value="">
        <?php endif;?>
      </div>
      <div class="form-group col-md-6">
        <label for="description">Description:</label>
        <textarea name="description" id="description" class="form-control" rows="6"><?= $description; ?></textarea>
      </div>
      <div class = "form-group pull-right">
        <a href="products.php" class="btn btn-default">Cancel</a>
        <input type="submit" class="btn btn-success" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Product">
      </div><div class="clearfix"></div>
    </form>

  <?php }else{
  $sql = "SELECT * FROM produk WHERE deleted = 0";
  $produk_result = $db->query($sql);
  if(isset($_GET['featured'])){
    $id = (int)$_GET['id'];
    $featured = (int)$_GET['featured'];
    $featured_sql = "UPDATE produk SET featured = '$featured' WHERE  id = '$id'";
    $db->query($featured_sql);
    header('Location: products.php');
  }
?>
<h2 class="text-center">Products</h2>
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add Product</a><div class="clearfix"></div>
<hr>
<table class="table table-bordered table-condensed table-striped">
  <thead><th></th><th>Product</th><th>Price</th><th>Category</th><th>Feature</th><th>Sold</th></thead>
  <tbody>
    <?php while($product = mysqli_fetch_assoc($produk_result)):
        $child_id = $product['categories'];
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
        <td>
          <a href="products.php?edit=<?= $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
          <a href="products.php?delete=<?= $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
        </td>
        <td><?= $product['title'];?></td>
        <td><?= rp($product['price']);?></td>
        <td><?= $category;?></td>
        <td><a href="products.php?featured=<?=(($product['featured'] == 0)?'1':'0');?>&id=<?= $product['id'];?>" class="btn btn-xs btn-default">
          <span class="glyphicon glyphicon-<?=(($product['featured'] == 1)?'minus':'plus');?>"></span>
        </a>&nbsp <?= (($product['featured']==1)?'Featured Product':''); ?></td>
        <td>0</td>
      </tr>
    <?php endwhile; ?>
    <p>*If you want to add tittle don't forget to bring the size of product*</p>
  </tbody>
</table>

<?php } include 'include/footer.php';?>
