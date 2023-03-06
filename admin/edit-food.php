<?php
session_start();
include '../config/dbcon.php';
if (isset($_POST['food_update'])) {
    $id = $_POST['food_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    if ($image == "") {
        $sql = $con->query("UPDATE food set title='$title',description='$description',price='$price', category='$category_id' where id='$id'");
        if ($sql) {
            $_SESSION['success'] = "Food Update Successfully";
            header("location:view-food.php");
        } else {
            $_SESSION['error'] = "Please Try Again";
        }
    } else {
        move_uploaded_file($image_tmp, "../pics/uploads" . $image);
        $sql = $con->query("UPDATE food set title='$title',description='$description',image='$image',price='$price', category='$category_id' where id='$id'");
        if ($sql) {
            $_SESSION['success'] = "Food Update Successfully";
            header("location:view-food.php");
        } else {
            $_SESSION['error'] = "Please Try Again";
        }
    }
}
?>



<?php include 'includes/header.php' ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Food</h4>
                </div>
                <div class="card-body">
                    <?php
                    $f_id = $_GET['id'];

                    // fetch food details from database
                    $query1 = "SELECT * FROM food WHERE id = $f_id";
                    $result1 = $con->query($query1);
                    if ($result1->num_rows == 1) {
                        // get the details of the food item
                        $row = $result1->fetch_assoc();
                        $id_c = $row['category'];
                        $category = $con->query("select * from category where id='$id_c'")->fetch_assoc();
                    ?>

                        <form method="POST" enctype="multipart/form-data">
                            <h2>Edit  Details</h2>
                            <?php
                            if (isset($_SESSION['error'])) {
                            ?>
                                <h4 class="alert alert-success"><?php echo $_SESSION['error'] ?></h4>
                            <?php
                                unset($_SESSION['error']);
                            }
                            ?>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="hidden" name="food_id" value="<?php echo $row['id']; ?>">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control border border-2 px-3" placeholder="Title" value="<?php echo $row['title']; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Select Category</label>
                                    <select required name="category_id" class="form-control form-control border border-2 px-3">
                                        <?php
                                        $sql_c = $con->query("Select * from category");
                                        while ($row_c = $sql_c->fetch_assoc()) {
                                            $selected = "";
                                            if ($row_c['id'] == $category['id']) {
                                                $selected = "selected";
                                            }
                                        ?>
                                            <option value="<?php echo $row_c['id'] ?>" <?php echo $selected ?>><?php echo $row_c['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control border border-2 px-3" placeholder="Select image" value="<?php echo $row['image']; ?>">

                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price</label>
                                    <input type="number" name="price" class="form-control border border-2 px-3" placeholder="Price" value="<?php echo $row['price']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control border border-2 px-3"><?php echo $row['description']; ?></textarea>
                                </div>
                            </div>
                            <button type="submit" name="food_update" class="btn btn-primary mt-3">Update</button>
                        </form>

                    <?php
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>