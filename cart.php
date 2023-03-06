<?php 
 include 'config/dbcon.php'; ?>
<?php include 'header.php' ?>

<div class="container" style="padding-top: 10%;">
<?php
if(isset($_POST['checkout'])) {
  // check if there are items in the cart
  $sql = $con->query("SELECT * from cart");
  if (mysqli_num_rows($sql) > 0) {
    // if there are items, redirect to checkout page
    header("Location: checkout.php");
    
  }
  else{
    $_SESSION['remove']="There Should Be One item in the Cart";
    header("Location: cart.php");
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["update-q-id"]) && isset($_POST["quantity"])) {
    $id = $_POST["update-q-id"];
    $quantity = $_POST["quantity"];
    $sql = $con->query("SELECT * from cart WHERE id = $id");
    if (mysqli_num_rows($sql) > 0) {
      $row = mysqli_fetch_assoc($sql);
      $new_quantity = $quantity;
      $sql = $con->query("UPDATE cart SET quantity = $new_quantity WHERE id = $id");
      if ($sql) {
        header("Location: cart.php");
        exit;
      }
    }
  } elseif (isset($_POST["remove-id"])) {
    $id = $_POST["remove-id"];
    $sql = $con->query("DELETE FROM cart WHERE id = $id");
    if ($sql) {
      $_SESSION['remove']="Item Removed Successfully";
      header("Location: cart.php");
      exit;
    }
  } 

}
?>
<div class="table-responsive">
<?php
if (isset($_SESSION['remove'])) {
?>
    <h4 class="alert alert-danger w-50 text-center m-auto mt-3"><?php echo $_SESSION['remove'] ?></h4>
<?php
    unset($_SESSION['remove']);
}
?>
  <table class="table table-striped border mt-4">
    <thead>
      <tr class="bg-dark">
        <th>Image</th>
        <th>Title</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = $con->query("SELECT * from cart");
      $total = 0;
      if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
          $quantity = $row['quantity'];
          $price = $row['price'];
          $subtotal = $quantity * $price;
          $total += $subtotal;
          ?>
          <tr>
            <td><img src="pics/uploads/<?php echo $row['image'] ?>" class="img-fluid" style="height:100px; width:100px" alt="<?php echo $row['title'] ?>"></td>
            <td><?php echo $row['title'] ?></td>
            <td>$<?php echo number_format($price); ?>/-</td>
            <td class="w-25">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="update-q-id" value="<?php echo $row['id'] ?>">
                <input style="width:50px" type="number" min="1" name="quantity" value="<?php echo $quantity ?>">
                <button type="submit" class="btn btn-warning">Update</button>
              </form>
            </td>
            <td>$<?php echo number_format($subtotal); ?>/-</td>
           <td>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="remove-id" value="<?php echo $row['id'] ?>">
                <button type="submit" class="btn btn-danger">Remove</button>
              </form>
            </td>
          </tr>
          <?php
        }
      }
      ?>
      <tr>
        <td colspan="4" class="text-end"><strong>Total:</strong></td>
        <td>$<?php echo number_format($total); ?>/-</td>
      </tr>
      <tr></tr>
      <tr class="text-center"><form action=""  method="post">
      <td colspan="6" class="text-center" >
        <a href=""> <button name="checkout" type="submit" class="btn btn-primary p-3">Proceed To Checkout</button></a>
      </td>
      </form></tr>
    </tbody>
  </table>
</div>




</div>

<style>
  /* Style the table header */
  table thead th {
    background-color: #333;
    color: #fff;
  }

  /* Style the table rows */
  table tbody tr {
    border-bottom: 1px solid #ddd;
  }

  /* Style the table images */
  table tbody tr img {
    max-width: 100%;
    height: auto;
  }
</style>

<?php include 'footer.php'; ?>
