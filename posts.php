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
    <?php include('required/navbar.php'); ?>

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
                                <tr>
                                    <td>1</td>
                                    <td>Hello World </td>
                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, ducimus?</td>
                                    <td>
                                        <div class="">
                                            <a data-fancybox="post" href="assets/img/cat.png">
                                                <img src="assets/img/cat.png" class="img-fluid rounded" alt="Image 1" width="50" />
                                            </a>
                                        </div>
                                    </td>
                                    <td class="">
                                        <ul class="list-unstyled d-flex justify-content-around m-0">
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
                                        </ul>
                                    </td>
                                    <td>01 Jan 2024</td>
                                    <td>12:00 pm</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal" data-id='1' data-fname='Saqib' data-lname='Ghatte' data-email='saqibghatte@gmail.com' data-contact='9876543210'><i class="fa-solid fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDataModal" data-id='1' data-title='Saqib Ghatte'><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
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
                <form method="POST">
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
                                    <input type="file" class="form-control" name="post" id="post" aria-describedby="helpId">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="3"></textarea>
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
                                    <label for="platforms" class="form-label">Platforms</label>
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
                        <button type="button" class="btn btn-primary" name="submit">Save</button>
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
                <form method="POST">
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
        // $('#addDataModal').on('show.bs.modal', function(event) {
        //     var button = $(event.relatedTarget)
        //     var id = button.data('id')
        //     var fname = button.data('fname')
        //     var lname = button.data('lname')
        //     var email = button.data('email')
        //     var contact = button.data('contact')
        //     var modal = $(this)

        //     modal.find('.modal-title').text((id == 0 || id == undefined) ? 'Add Post' : "Edit Post")
        //     modal.find('.modal-body #modifyID').val(id)
        //     modal.find('.modal-body #fname').val(fname)
        //     modal.find('.modal-body #lname').val(lname)
        //     modal.find('.modal-body #email').val(email)
        //     modal.find('.modal-body #contact').val(contact)
        //     modal.find('.modal-footer button[name=submit]').text((id == 0 || id == undefined) ? 'Save' : "Update")
        // })

        $('#platforms').select2({
            theme: 'bootstrap-5'
        });
    </script>
</body>

</html>