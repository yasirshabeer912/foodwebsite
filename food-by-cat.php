<?php include 'config/dbcon.php'; 

?>


<?php include 'header.php' ?>

<section id="home" class="text-center text-light food-search ">
    <?php 
     if(isset($_GET['id'])){
        $id = $_GET['id'];
        
    }
   $sql=$con->query("SELECT name FROM category WHERE id= '$id'");
   while($row = $sql->fetch_assoc()){
    
    ?>
     <div class="container">
       <h1 class=""><?php echo $row['name'] ?></h1>
    </div>
    <?php
   }
    ?>
   
</section>


<section id="foods" class="container-fluid " style="background-color: rgb(240, 240, 240);">
<div class="heading text-center mb-4 pt-5 text-dark">
        <h2>Food <span style="color:red">Menu</span></h2>
        <hr class="mx-auto" width="80px" style="height:3px; color:red; background-color:red">
    </div>
    <div class="container">

        <div class="row">
        <?php
            $sql1 = "SELECT * FROM food WHERE category= '$id'";
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
                                <h6>6$</h6>
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








<?php include 'footer.php' ?>