<?php
include('required/config.php');

?>
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
        if (isset($_POST['modifyID']) && isset($_POST['name']) && isset($_POST['image_path'])) {
            $id = secure($_POST['modifyID']);
            $name = secure($_POST['name']);
            $image_path = secure($_POST['image_path']);
    
            if (empty($id)) {
                $sql = "INSERT INTO `doodle`(`name`, `image_path`) VALUES ('$name','$image_path')";
                if ($mysqli->query($sql)) {

                    $_SESSION['success'] = "Admin Added Successfully";
                } else {
                    $_SESSION['error'] = "Something Went Wrong";
                }
            } else {
                $sql = "UPDATE `doodle` SET `name`='$name',`image_path`='$image_path' WHERE `srno`='$id'";
            }
            if ($mysqli->query($sql)) {
                $_SESSION['success'] = "Admin Updated Successfully";
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
                <h1 class='display-5'>Doodle</h1>
                <div class="card shadow p-3">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>List of Doodle</h5>
                            </div>
                            <div class="col-sm-6 text-end">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="fa-solid fa-plus"></i> Add Doodle</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-striped table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM `doodle`";
                                    $result = $mysqli->query($sql);
                                    $sr = 0;
                                    while ($row = $result->fetch_object()){
                                        $sr++;
                                ?>
                                <tr>

                                    <td> <?= $sr ?> </td>
                                    <td> <?= $row->name ?> </td>
                                    <td>
                                        <div class="">
                                            <a data-fancybox="post" href="<?= $row->image_path ?> ">
                                                <img src=<?= $row->image_path ?>  class="img-fluid rounded" alt="Image 1" width="50" />
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal" data-id='<?= $row-> srno ?>' data-name='<?= $row->name ?>' data-lname='<?= $row->image_path ?>' data-email='saqibghatte@gmail.com' data-contact='9876543210'><i class="fa-solid fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDataModal" data-id='<?= $row->srno ?>' data-title='<?= $row->name ?>'><i class="fa-solid fa-trash"></i></button>
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
                    <h5 class="modal-title" id="modalTitleId">Add Doodle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="doodle" class="form-label">doodle</label>
                                    <input type="file" class="form-control" name="doodle" id="doodle" aria-describedby="helpId">
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
                    <h5 class="modal-title" id="modalTitleId">Confirm Delete Doodle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="Doodle" action="doodle.php">
                    <div class="modal-body">
                        Are you sure you want to delete <b><span id='title'>Doodle Name</span></b>?
                        <input type="hidden" name='deleteId'>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
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
            var name = button.data('name')
            var image_path = button.data('image_path')
            var modal = $(this)
            modal.find('.modal-title').text((id == 0 || id == undefined) ? 'Add Doodle' : "Edit Doodle")
            modal.find('.modal-body #modifyID').val(id)
            modal.find('.modal-body #name').val(name)
            modal.find('.modal-body #image_path').val(image_path)
            modal.find('.modal-footer button[name=submit]').text((id == 0 || id == undefined) ? 'Save' : "Update")
        })
    </script>
</body>

</html>
