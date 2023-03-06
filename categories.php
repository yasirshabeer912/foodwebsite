<?php include 'config/dbcon.php'; ?>
<?php include 'header.php' ?>

<section id="home" class="text-center text-light food-search mb-5">
    <div class="container">
       <h1 class="">All Categories</h1>
    </div>
</section>

<div class="heading text-center mb-4  text-dark">
        <h2> <span style="color:red">Categories</span></h2>
        <hr class="mx-auto" width="80px" style="height:3px; color:red; background-color:red">
    </div>

<div class="container my-5">
        <div class="row">

            <?php
            $sql = "SELECT * FROM category";
            $sql_run = mysqli_query($con, $sql);
            if (mysqli_num_rows($sql_run)) {
                while ($row = mysqli_fetch_assoc($sql_run)) {

            ?>
                    <div class="col-lg-4 col-md-6 mb-5">
                        <a href="food-by-cat.php?id=<?php echo $row['id'] ?>">
                            <div class="card">
                                <div class="card-image w-100">
                                    <img style="height: 450px; width: 100%;" src="pics/uploads/<?php echo $row['image']?>" alt="" class="img-fluid">
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





<?php include 'footer.php' ?>