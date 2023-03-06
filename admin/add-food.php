<?php
include '../config/dbcon.php';
if(isset($_POST['food_upload'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $date = date("D-m-Y");

    // Check if required fields are not empty
    if (!empty($title) && !empty($description) && !empty($price) && !empty($category_id) && !empty($image)) {
        // Move uploaded image to a folder on the server
        $target_dir = "../pics/uploads";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($image_tmp, $target_file);

        // Insert the food details into the database
        $query = "INSERT INTO food (title, description, price, image, category, date) 
                  VALUES ('$title', '$description', '$price', '$image', '$category_id' , '$date')";
        $result = $con->query($query);

        if ($result) {
            // Food added successfully
            $_SESSION['success'] = 'Food added successfully';
            header('Location: add-food.php');
        } else {
            // Failed to add food
            $_SESSION['error'] = 'Failed to add food';
            header('Location: add-food.php');
        }
    } else {
        // Required fields are empty
        $_SESSION['error'] = 'Please fill all required fields';
        header('Location: add-food.php');
    }
}
?>


<?php include 'includes/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Food</h4>
                    <?php
                    if(isset($_SESSION['error'])){
                        ?>
                        <h4 class="alert alert-danger"><?php echo $_SESSION['error']; ?></h4>
                        <?php
                        unset($_SESSION['error']);
                    } elseif (isset($_SESSION['success'])) {
                        ?>
                        <h4 class="alert alert-success"><?php echo $_SESSION['success']; ?></h4>
                        <?php
                        unset($_SESSION['success']);
                    }
                    ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form method="POST" enctype="multipart/form-data">
                            <h2>Food Details</h2>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Title</label>
                                    <input type="text"  name="title" class="form-control border border-2 px-3" placeholder="Title">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Select Category</label>
                                    <select  name="category_id" class="form-control border border-2 px-3">
                                        <option disabled="" selected="">Choose...</option>
                                        <?php
                                        $sql_c = $con->query("Select * from category");
                                        while ($row_c = $sql_c->fetch_assoc()) {

                                        ?>
                                            <option value="<?php echo $row_c['id'] ?>"><?php echo $row_c['name'] ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Image</label>
                                    <input type="file"  name="image" class="form-control border border-2 px-3" placeholder="Select image">

                                </div>
                                <div class="form-group col-md-6">
                                    <label>Price</label>
                                    <input type="number"  name="price" class="form-control border border-2 px-3" placeholder="Price">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Discription</label>
                                    <textarea name="description" class="form-control border border-2 px-3" id="" cols="50" rows="5"> </textarea>
                                </div>
                            </div>
                            <button type="submit" name="food_upload" class="btn btn-primary mt-3">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>