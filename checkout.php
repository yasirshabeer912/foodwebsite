<?php
 include 'config/dbcon.php';

 if(isset($_POST['order-btn'])){
    $fname =$_POST['fname'];
    $lname =$_POST['lname'];
    $email =$_POST['email'];
    $address =$_POST['address'];
    $province =$_POST['province'];
    $distric =$_POST['distric'];
    $phone =$_POST['phone'];
    $payment =$_POST['payment'];
    $city =$_POST['city'];
    $date = date("D-m-Y");



    $sql = $con->query("SELECT * from cart");
    $count = mysqli_num_rows($sql);
    $total = 0;
    if (mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $item_name = $row['title'] .'('. $row['quantity'].')';
            $quantity = $row['quantity'];
            $price = $row['price'];
            $subtotal = $quantity * $price;
            $total += $subtotal;
        };
    };
    $total_item = $count;

    $sql1=$con->query("INSERT INTO `order`(`fname`, `lname`, `email`, `phone`, `city`, `address`, `province`, `distric`, `payment`, `total_price`, `total_item`, `date`, `item_name`)
    VALUES ('$fname','$lname','$email','$phone','$city','$address','$province','$distric','$payment','$total', '$total_item','$date', '$item_name')");
   
     if($sql1){
        $delete_cart_sql = "DELETE FROM cart";
        $con->query($delete_cart_sql);
       $_SESSION['order-success']="Your items has been ordered succesfully";
        header('location: order.php');
    } else {
        echo "Error: " . $sql1 . "<br>" . $con->error;
    }
 }
 ?>






<?php include 'header.php'; ?>
<section style="padding-top: 9%;">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Checkout</h2>
        </div>
        <div class="row">
        <?php
        $sql = $con->query("SELECT * FROM cart") or die("Qesry Faild");
                    $count = mysqli_num_rows($sql);
                    ?>

            <div class="col-md-4 text-end order-md-last">
                <h4 class="d-flex justify-content-between align-items-center">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill"><?php echo $count ?></span>
                </h4>
                <div class=" container d-flex justify-content-between align-items-center text-danger">
                    <strong>name</strong>
                    <strong>price</strong>
                </div>
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
                        <ul class="list-group mb-3 ">
                            <li class="list-group-item d-flex justify-content-between lh-sm " style="margin-top: 14px;">
                                <div>
                                    <h6 class="my-0"><?php echo $row['title'] ?></h6>
                                </div>
                                <span class="text-muted">$<?php echo $row['price'] ?>/-</span>
                            </li>
                        </ul>
                <?php
                    }
                }
                ?>
                <span>Total: $<?php echo number_format($total); ?>/-</span>
            </div>

            <div class="col-md-8">
                <h4 class="mb-3 text-primary">Billing address</h4>
                <form  method="post">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" name="fname" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="firstName" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="lname" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="username" class="form-label">Email</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="username" name="email" placeholder="email" required>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="firstName" class="form-label">Phone</label>
                            <input type="number" class="form-control" name="phone" placeholder="Phone Number" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="firstName" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" placeholder="City Name" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St" name="address" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">Province</label>
                            <select class="form-select" id="state" name="province" required>
                                <option selected>Choose Province...</option>
                                <option value="punjab">Punjab</option>
                                <option value="sindh">sindh</option>
                                <option value="kp">KPK</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">Distric</label>
                            <select class="form-select" id="state" name="distric" required>
                                <option selected>Choose Distric...</option>
                                <option value="punjab">Muzaffargarh</option>
                                <option value="sindh">Multan</option>
                                <option value="kp">Layyah</option>
                            </select>
                        </div>
                        <hr class="my-4">
                        <h4 class="mb-3">Payment</h4>

                     <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">payment</label>
                            <select class="form-select" id="state" name="payment" required>
                                <option selected>Choose Payment Method...</option>
                                <option value="ondelivery">Cash On Delivery</option>
                                <option value="jazzcash">Jazzcash</option>
                                <option value="easypaisa">Easypaisa</option>
                            </select>
                        </div>

                        <hr class="my-4">

                    </div>
                    <button class="w-100 btn btn-primary btn-lg " name="order-btn" type="submit">Order Now</button>
                </form>
            </div>

        </div>
    </div>

    </div>
</section>




<?php include 'footer.php'; ?>