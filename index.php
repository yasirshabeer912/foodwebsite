<?php

include 'config/dbcon.php';
include 'header.php';
?>

<section id="home" class="text-center food-search ">
    <div class="container">
        <form action="search.php" method="post">
            <input type="search" name="search" placeholder="Search Food" required>
            <button type="submit" class="btn btn-success">Search Food</button>
        </form>
    </div>
</section>

<?php
if (isset($_SESSION['success'])) {
?>
    <h4 class="alert alert-success w-50 text-center m-auto mt-3"><?php echo $_SESSION['success'] ?></h4>
<?php
    unset($_SESSION['success']);
}
?>

<?php
if (isset($_SESSION['error'])) {
?>
    <h4 class="alert alert-danger w-50 text-center m-auto mt-3"><?php echo $_SESSION['error'] ?></h4>
<?php
    unset($_SESSION['error']);
}
?>



<section id="categories" class="text-center mb-5">
<div class="heading text-center mb-4 pt-5 text-dark">
        <h2>Explore <span style="color:red">Categories</span></h2>
        <hr class="mx-auto" width="80px" style="height:3px; color:red; background-color:red">
    </div>
    <div class="container">
        <div class="row">

            <?php
            $sql = "SELECT * FROM category LIMIT 3";
            $sql_run = mysqli_query($con, $sql);
            if (mysqli_num_rows($sql_run)) {
                while ($row = mysqli_fetch_assoc($sql_run)) {

            ?>
                    <div class="col-lg-4 col-md-6 mb-5">
                        <a href="food-by-cat.php?id=<?php echo $row['id'] ?>">
                            <div class="card">
                                <div class="card-image w-100">
                                    <img style="height: 450px; width: 100%;" src="pics/uploads/<?php echo $row['image'] ?>" alt="" class="img-fluid">
                                </div>
                                <div class="card-text text-light position-absolute">
                                    <h1><?php echo $row['name'] ?></h1>
                                </div>
                            </div>
                        </a>
                    </div>

            <?php
                }
            }

            ?>

        </div>
    </div>
</section>




<section id="foods" class="container-fluid " style="background-color: rgb(240, 240, 240);">
<div class="heading text-center mb-4 pt-5 text-dark">
        <h2>Food <span style="color:red">Menu</span></h2>
        <hr class="mx-auto" width="80px" style="height:3px; color:red; background-color:red">
    </div>
    <div class="container">

        <div class="row">
            <?php
            $sql1 = "SELECT * FROM food LIMIT 6";
            $sql_run1 = mysqli_query($con, $sql1);
            if (mysqli_num_rows($sql_run)) {
                while ($row1 = mysqli_fetch_assoc($sql_run1)) {

            ?>

                    <div class="col-md-6 mb-4 ">
                        <div class="card p-3">
                            <form action="insert_cart.php" method="POST">
                                <div class="row">
                                    <div class="col-lg-4 p-lg-3 ">
                                        <div class="image-container" style="padding-top: 75%; position: relative;">
                                            <img src="pics/uploads<?php echo $row1['image'] ?>" style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; object-fit: cover; border-radius: 30px;" alt="...">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card-body">
                                            <h4><?php echo $row1['title'] ?></h4>
                                            <h6><?php echo $row1['price'] ?></h6>
                                            <p class="text-secondary"><?php echo $row1['description'] ?></p>

                                            <?php
                                            if (isset($_SESSION['user_id'])) {
                                            ?>
                                                <a href="cart.php?id=<?php echo $row1['id'] ?>">
                                                    <button type="submit" name="add-to-cart" class="btn btn-success">Add to Cart</button>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                            <a href="">
                                                <div class="btn btn-success">Order Now</div>
                                            </a>

                                            <input type="hidden" name="title" value="<?php echo $row1['title'] ?>">
                                            <input type="hidden" name="price" value="<?php echo $row1['price'] ?>">
                                            <input type="hidden" name="image" value="<?php echo $row1['image'] ?>">
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

            <?php
                }
            }
            ?>
        <a href="" class="text-center  text-danger">See All Foods</a>
        </div>


    </div>

</section>







<?php include 'footer.php' ?>