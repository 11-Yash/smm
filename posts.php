<?php include('required/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Social Media Manager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include('required/cssLinks.php'); ?>
</head>

<body>
    <?php include('required/navbar.php');
        if (isset($_FILES['post']) && isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['scheduleDate']) && isset($_POST['scheduleTime']) && isset($_POST['platform'])) {
            $id = secure($_POST['modifyID']);
            $title = secure($_POST['title']);
            $desc = secure($_POST['desc']);
            $scheduleDate = secure($_POST['scheduleDate']);
            $scheduleTime = secure($_POST['scheduleTime']);
            $platform = secure($_POST['platform']);
            $image_tmp = $_FILES['post']['tmp_name']; // Temporary file name
            $image_name = $_FILES['post']['name']; // Original file name
        
            $image_path = "assets/post/" . uniqid() ."_". $image_name; // Destination path + original file name
        
            if (empty($id)) {
                $sql = "INSERT INTO socialmediaposts(title, description, post, schdate, schtime, platform) VALUES ('$title','$desc','$imagepath','$scheduleDate','$scheduleTime','$platform')";
                
            } else {
                if (empty($image_name)){
                    $sql = "UPDATE socialmediaposts SET title='$tile', description='$desc', schdate='$scheduleDate', schtime='$scheduleTime', platform='$platform' WHERE srno='$id'";
                }
                else{
                $sql = "SELECT post FROM socialmediaposts WHERE srno='$id'";
                $result = $mysqli->query($sql);
                if ($result) {
                    $row = $result->fetch_assoc();
                    $old_image = $row['post'];
                
                    if (file_exists($old_image)) {
                        if (unlink($old_image)) {
                            echo 'File deleted successfully.';
                        } else {
                            echo 'Unable to delete the file.';
                        }
                    } else {
                        echo 'File does not exist.';
                    }
                } else {
                    echo "Error executing query: " . $mysqli->error;
                }

                $sql = "UPDATE socialmediaposts SET title='$tile', description='$desc', schdate='$scheduleDate', schtime='$scheduleTime', platform='$platform' ,post='$image_path' WHERE srno='$id'";
                }
            }
            if ($mysqli->query($sql)) {
                $_SESSION['success'] = "Successfully";
                
            } else {
                $_SESSION['error'] = "Something Went Wrong";
            }
            
           }
           if(isset($image_path)){
           if (move_uploaded_file($image_tmp, $image_path)) {
            header("Location: posts.php");
                exit();
            
        }}
            if (isset($_POST['deleteId'])) {
            $id = secure($_POST['deleteId']);
            //deletion of image starts here
            $sql = "SELECT post FROM socialmediaposts WHERE srno = '$id'";
            $result = $mysqli->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                $imagePath = $row['post'];
            
                if (file_exists($imagePath)) {
                    if (unlink($imagePath)) {
                        echo 'File deleted successfully.';
                    } else {
                        echo 'Unable to delete the file.';
                    }
                } else {
                    echo 'File does not exist.';
                }
            } else {
                echo "Error executing query: " . $mysqli->error;
            }
            //ends here            
            $sql = "DELETE FROM socialmediaposts WHERE srno='$id'";
            if ($mysqli->query($sql)) {
                $_SESSION['success'] = "post Deleted Successfully";
                header("Location: post.php");
                exit();
            } else {
                $_SESSION['error'] = "Something Went Wrong";
            }
        }
    ?>

    <div class="container-fluid">
        <div class="row main-container">
            <?php include('required/sidebar.php'); ?>
            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 p-4 bg-light">
                <h1 class='display-5'>Posts</h1>
                <div class="card shadow p-3">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>List of Posts</h5>
                            </div>
                            <div class="col-sm-6 text-end">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="fa-solid fa-plus"></i> Add Post</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-striped table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Post</th>
                                    <th>Platforms</th>
                                    <th>Schedule Date</th>
                                    <th>Schedule Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $sql = "SELECT * FROM socialmediaposts";
                                    $result = $mysqli->query($sql);
                                    $sr = 0;
                                    while ($row = $result->fetch_object()){
                                        $sr++;
                                ?>

                                <tr>
                                    <td><?= $sr ?></td>
                                    <td> <?= $row->title ?> </td>
                                    <td><?= $row->description ?> </td>
                                    <td>
                                    <div class="">
                                            <a data-fancybox="post" href="<?= $row->post ?> ">
                                                <img src=<?= $row->post ?>  class="img-fluid rounded" onerror="this.onerror=null; this.src='assets/img/image_not_found.png';" width="50" />
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- <div class="">
                                            <a data-fancybox="post" href="assets/img/cat.png">
                                                <img src="assets/img/cat.png" class="img-fluid rounded" alt="Image 1" width="50" />
                                            </a>
                                        </div> -->
                                        <?= $row->platform ?>
                                    </td>
                                    <td class="">
                                        <!-- <ul class="list-unstyled d-flex justify-content-around m-0">
                                            <li class="">
                                                <a href="" class="text-decoration-none">
                                                    <i class="fab fa-facebook text-primary"></i>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-decoration-none">
                                                    <i class="fab fa-instagram text-danger"></i>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-decoration-none">
                                                    <i class="fab fa-whatsapp text-success"></i>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="" class="text-decoration-none">
                                                    <i class="fa-brands fa-x-twitter text-dark"></i>
                                                </a>
                                            </li>
                                        </ul> -->
                                        <?= $row->schdate ?>
                                    </td>
                                    <td><?= $row->schtime ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal" data-id='<?= $row-> srno ?>' data-title='<?= $row-> title ?>' data-description='<?= $row-> description ?>' data-scheduledate='<?= $row-> schdate ?>' data-scheduletime='<?= $row-> schtime ?>' data-platforms='<?= $row-> platform ?>'><i class="fa-solid fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDataModal" data-id='<?= $row-> srno ?>'data-title='<?= $row-> title ?>'><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="text-center mt-5">All Rights Reserved &copy; <?= Date("Y") ?></p>
            </div>
        </div>
    </div>

    <!-- ============= Modals Code Being Here ============= -->

    <!-- Add / Edit Modal -->
    <div class="modal fade" id="addDataModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Add Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="hidden" name="modifyID" id="modifyID" value='0'>
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Enter Title">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="post" class="form-label">Post</label>
                                    <input type="file" class="form-control" name="post" id="post" aria-describedby="helpId" value="">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="desc" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="scheduleDate" class="form-label">Schedule Date</label>
                                    <input type="date" class="form-control" name="scheduleDate" id="scheduleDate" aria-describedby="helpId">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="scheduleTime" class="form-label">Schedule Time</label>
                                    <input type="time" class="form-control" name="scheduleTime" id="scheduleTime" aria-describedby="helpId">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="platforms" class="form-label" name="platform">Platforms</label>
                                    <select id="platforms" multiple>
                                        <option value="option1">Whatsapp</option>
                                        <option value="option2">Facebook</option>
                                        <option value="option3">Instagram</option>
                                        <option value="option3">Twitter X</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteDataModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Confirm Delete Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        Are you sure you want to delete <b><span id='title'>Post Name</span></b>?
                        <input type="hidden" name='deleteId'>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('required/footer.php'); ?>
    <script>
        // On Edit Button Click
        $('#addDataModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var title = button.data('title')
            var description = button.data('description')
            var scheduledate = button.data('scheduledate')
            var scheduletime = button.data('scheduletime')
            var platforms = button.data('platforms')
            var modal = $(this)

            modal.find('.modal-title').text((id == 0 || id == undefined) ? 'Add Post' : "Edit Post")
            modal.find('.modal-body #modifyID').val(id)
            modal.find('.modal-body #title').val(title)
            modal.find('.modal-body #description').val(description)
            modal.find('.modal-body #scheduledate').val(scheduledate)
            modal.find('.modal-body #scheduletime').val(scheduletime)
            modal.find('.modal-body #platforms').val(platforms)
            modal.find('.modal-footer button[name=submit]').text((id == 0 || id == undefined) ? 'Save' : "Update")
        })

        //on delete
        $('#deleteDataModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var title = button.data('title')
            var modal = $(this)
            modal.find('.modal-body #title').text(title)
            modal.find('.modal-body input[name=deleteId]').val(id)
        })

        $('#platforms').select2({
            theme: 'bootstrap-5'
        });
    </script>
</body>

</html>