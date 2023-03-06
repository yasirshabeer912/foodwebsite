<?php include 'config/dbcon.php'; ?>



<?php include 'header.php'; ?>

<section id="home" class="text-center text-light food-search ">
    <div class="container">
    <?php
    
    $search = $_POST['search'];
    ?>
    <style>
        span{
            cursor: pointer;
        }
        h3 span:hover{
color: red !important;
        }
    </style>
       <h3 class="text-dark">Food On Your Search : <span class="text-light" ><?php echo $search ?></span></h3>
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
            $sql1 = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search %'";
            $sql_run1 = mysqli_query($con, $sql1);
            if (mysqli_num_rows($sql_run1)) {
                while ($row1 = mysqli_fetch_assoc($sql_run1)) {

            ?>
            <div class="col-md-6 mb-4 ">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-4 ">
                            <img src="pics/menu-momo.jpg" style="border-radius: 30px; " class="img-fluid  p-3" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4><?php echo $row1['title'] ?></h4>
                                <h6>$<?php echo $row1['price'] ?>/-</h6>
                                <p class="text-secondary"><?php echo $row1['description'] ?></p>
                                <a href="cart.php?id=<?php echo $row1['id'] ?>">
                                    <div class="btn btn-success">Add to Cart</div>
                                </a>
                                <a href="">
                                    <div class="btn btn-success">Order Now</div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
        <?php
                }
            } 
            else{
                echo '<h1 class="text-center text-danger">No Record Found</h1>';
            }
        ?>
        <a href="" class="text-center  text-danger">See All Foods</a>
        </div>


    </div>

</section>




<?php include 'footer.php'; ?>