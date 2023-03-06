<?php
session_start();
include '../config/dbcon.php';
include 'includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">View Food</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Title</th>
                                    <!-- <th>Description</th> -->
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>


                            <?php
                                if(isset($_SESSION['error'])){
                                    ?>
                                    		<h4 class="alert alert-success"><?php echo $_SESSION['error'] ?></h4>
                                    <?php
                                    unset($_SESSION['error']);
                                }
                                ?>

                                <?php
                                $query = "SELECT food.id, food.title, food.description, food.price, category.name AS category, food.date, food.image 
                                FROM food 
                                JOIN category ON food.category=category.id
                                ORDER BY food.id ASC";
                                $result = $con->query($query);
                                $sr_no = 1;
                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr class="align-middle">
                                            <td><?php echo $sr_no ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo $row['category']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><img src="../pics/uploads/<?php echo $row['image']; ?>" alt="" style="width: 100px; height:100px"></td>
                                            <td>
                                                <a href="edit-food.php?id=<?php echo $row['id']; ?>"><div class="btn btn-primary">Edit</div></a>
                                                <div class="btn btn-secondary">Delete</div>
                                            </td>
                                        </tr>
                                <?php
                                        $sr_no++;
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>0 results</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>