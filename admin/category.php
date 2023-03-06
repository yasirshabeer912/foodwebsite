<?php
session_start();
include '../config/dbcon.php';
$name = '';
$image = '';
if(isset($_POST['add-category'])){
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_tmp, "../pics/uploads/".$image);

    $sql ="INSERT INTO `category`(`name`, `image`) VALUES (' $name','$image')";
    $run_sql = mysqli_query($con,$sql);
    if($run_sql){
        $_SESSION['success'] = "Category Added Successfully";
        echo " <script>
        function autoRefresh() {
            window.location = 'view_category.php';
        }
        setInterval('autoRefresh()', 4000);
    </script> ";
    }
    else{
        echo "something worng";
        exit;
    }
}

include 'includes/header.php';

?>

<div class="container">
    <!-- Add Order -->

    <!-- row -->
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Category</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label>Name</label>
                                    <input type="text" required name="name" class="form-control border border-2 px-3" value="<?php echo $name; ?>" placeholder="Name">
                                </div>
                                <div class="form-group col-md-6  mb-3">
                                    <label>Image</label>
                                    <input type="file" required name="image" class="form-control border border-2 px-3" value="<?php echo $image; ?>">
                                </div>
                            </div>
                            <button type="submit" name="add-category" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>
