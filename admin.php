<?php
$page_title = 'Admin Home Page';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
?>
<?php
$c_categorie = count_by_id('categories');
$c_product = count_by_id('products');
$c_sale = count_by_id('sales');
$c_user = count_by_id('users');
$products_sold = find_higest_selling_product('10');
$recent_products = find_recent_product_added('5');
$recent_sales = find_recent_sale_added('5')
  ?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_user['total']; ?> </h2>
          <p class="text-muted">Users</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-list"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_categorie['total']; ?> </h2>
          <p class="text-muted">Categories</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_product['total']; ?> </h2>
          <p class="text-muted">Products</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
         <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="white" class="bi bi-currency-rupee" viewBox="0 0 16 16">
  <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4v1.06Z"/>
</svg>
          
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_sale['total']; ?></h2>
          <p class="text-muted">Sales</p>
        </div>
       </div>
    </div>
</div>
  <div class="row">
   <div class="col-md-12">
      <div class="panel">
        <div class="jumbotron text-center">
           <h1><b>Meet Shivraj Parth</b></h1>
           <p> <strong>DBMS mini-project</strong>
          </p>

        </div>
      </div>
   </div>
  </div>
  <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Highest selling Products</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th>Title</th>
             <th>Total Sold</th>
             <th>Total Quantity</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($products_sold as $product_sold): ?>
                <tr>
                  <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                  <td><?php echo (int) $product_sold['totalSold']; ?></td>
                  <td><?php echo (int) $product_sold['totalQty']; ?></td>
                </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
   <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>LATEST SALES</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           <th class="text-center" style="width: 50px;">#</th>
           <th>Product Name</th>
           <th>Date</th>
           <th>Total Sale</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($recent_sales as $recent_sale): ?>
           <tr>
             <td class="text-center"><?php echo count_id(); ?></td>
             <td>
              <a href="edit_sale.php?id=<?php echo (int) $recent_sale['id']; ?>">
               <?php echo remove_junk(first_character($recent_sale['name'])); ?>
             </a>
             </td>
             <td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
             <td>₹<?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
          </tr>

       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Recently Added Products</span>
        </strong>
      </div>
      <div class="panel-body">

        <div class="list-group">
      <?php foreach ($recent_products as $recent_product): ?>
              <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo (int) $recent_product['id']; ?>">
                  <h4 class="list-group-item-heading">
                   <?php if ($recent_product['media_id'] === '0'): ?>
                        <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                    <?php else: ?>
                      <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image']; ?>" alt="" />
                  <?php endif; ?>
                  <?php echo remove_junk(first_character($recent_product['name'])); ?>
                    <span class="label label-warning pull-right">
                    ₹<?php echo (int) $recent_product['sale_price']; ?>
                    </span>
                  </h4>
                  <span class="list-group-item-text pull-right">
                  <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
                </span>
            </a>
      <?php endforeach; ?>
    </div>
  </div>
 </div>
</div>
 </div>
  <div class="row">

  </div>



<?php include_once('layouts/footer.php'); ?>
