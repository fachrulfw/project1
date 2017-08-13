<!-- navigasi utama pada web ini -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
      <a href="../Admin/index.php" class="navbar-brand fs-20">Double D's Strore Admin</a>
      <!-- membuat list pada navigasi bar -->
      <ul class="nav navbar-nav fs-12 pull-left">
        <li><a href = "brands.php">Brands</a></li>
        <li><a href = "categories.php">Categories</a></li>
        <li><a href = "products.php">Products</a></li>
        <?php if(has_permission('admin')): ?>
          <li><a href="users.php">User</a></li>
          <li><a href="archived.php">Archived</a></li>
        <?php endif; ?>
        <li class="dropdown">
          <a href="#" class="ropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-user"></span>
            <?= $user_data['first'];?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu navigator" role="menu">
            <li><a href="change_password.php">Change Password</a></li>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
  </div>
</nav>
