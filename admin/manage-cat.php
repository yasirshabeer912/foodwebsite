 <?php
    session_start();
    include '../config/dbcon.php';
// Update category

    if (isset($_POST['update_category'])) {
        $id = $_POST['cat_id'];
        $name = $_POST['name'];
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];


        if ($image == "") {

            $sql = $con->query("update  category set name='$name' where id='$id'");
            if ($sql) {
                $_SESSION['success'] = "Category Successfully Updated";
                header("location:view_category.php");
            } else {
                $_SESSION['error'] = "Please Try Againxx";
            }
        } else {
            move_uploaded_file($image_tmp, "../pics/uploads/" . $image);

            $sql = $con->query("update  category set name='$name',image='$image' where id='$id'");
            if ($sql) {
                $_SESSION['success'] = "Category Successfully Updated";
                header("location:view_category.php");
            } else {
                $_SESSION['error'] = "Please Try Again";
            }
        }
    }
// update category end



    include 'includes/header.php';

    ?>

 <div class="container">
     <div class="row">

         <div class="col-xl-12 col-lg-12">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title">Category Update</h4>
                     <?php
                        if (isset($_SESSION['error'])) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show text-light" role="alert">
                                <strong>Hey!</strong> <?php echo $_SESSION['error'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            unset($_SESSION['error']);
                        }
                        ?>
                 </div>
                 <div class="card-body">
                     <div class="basic-form">
                         <?php
                            $id = $_GET['id'];
                            $sql = $con->query("Select * from category where id='$id'")->fetch_assoc();

                            ?>
                         <form method="POST" enctype="multipart/form-data">
                             <div class="row">
                                 <div class="form-group col-md-6 ">
                                    <input type="hidden" name="cat_id" value="<?php echo $sql['id'] ?>">
                                     <label>Name</label>
                                     <input type="text" value="<?php echo $sql['name'] ?>" name="name" class="form-control border border-2 p-3" placeholder="Name">
                                 </div>
                                  <div class="form-group col-md-6">
                                     <label>Image</label>
                                     <input type="file" name="image" class="form-control border border-2 p-3" placeholder="Select image">
                                    </div>
                             </div>
                             <button type="submit" name="update_category" class="btn btn-primary mt-4">Update</button>
                         </form>
                     </div>
                 </div>
             </div>
         </div>

     </div>
 </div>

 <?php include 'includes/footer.php'; ?>