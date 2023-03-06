<?php
session_start();
include '../config/dbcon.php';
$sr_no=1;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = $con->query("delete from category where id='$id'");
    if ($sql) {
        $_SESSION['delete_success'] = "Category Delete Successfully";
        echo " <script>
        function autoRefresh() {
            window.location = 'view_category.php';
        }
        setInterval('autoRefresh()', 4000);
    </script> ";
    }
}

?>








<?php
include 'includes/header.php';
?>

<div class="container">
    <!-- Add Order -->

    <!-- row -->
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <?php
                if (isset($_SESSION['success'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show text-light" role="alert">
                        <strong>Hey!</strong> &nbsp;&nbsp; <?php echo $_SESSION['success'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['delete_success'])) {
                ?>
                    <h4 class="alert alert-success"><?php echo $_SESSION['delete_success'] ?></h4>
                <?php
                    unset($_SESSION['delete_success']);
                }
                ?>
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">View Category</h4>
                    <a href="category.php">
                        <div class="btn btn-primary">Add Category</div>
                    </a>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">id</th>
                                <th scope="col">image</th>
                                <th scope="col">name</th>
                                <th scope="col">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM category";
                            $run_sql = mysqli_query($con, $sql);
                            if (mysqli_num_rows($run_sql) > 0) {
                                while ($row = mysqli_fetch_assoc($run_sql)) {
                            ?>

                                    <tr class="text-center">
                                        <th scope="row"><?php echo $sr_no ?></th>
                                        <td><img alt="Image" style="width:80px; height:80px; border-radius:30px" src="../pics/uploads/<?php echo $row['image'] ?>" class="img-fluid"></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td>
                                            <a href="manage-cat.php?id=<?php echo $row['id'] ?>">
                                                <div class="btn btn-primary">edit</div>
                                            </a>
                                            <a href="?id=<?php echo $row['id'] ?>">
                                                <div class="btn btn-danger">delete</div>
                                            </a>
                                        </td>
                                    </tr>

                            <?php

                                    $sr_no++;
                                }
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>


<?php include 'includes/footer.php' ?>