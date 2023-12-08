<?php include('required/config.php'); ?>
<?php include('required/checklog.php'); ?>

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
    
    if (isset($_POST['modifyID']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['contact'])) {
        $id = secure($_POST['modifyID']);
        $fname = secure($_POST['fname']);
        $lname = secure($_POST['lname']);
        $email = secure($_POST['email']);
        $contact = secure($_POST['contact']);
        $password = Encrypt(secure($_POST['password']));
    
        if (empty($id)) {
            $sql = "INSERT INTO `users` (`fname`, `lname`, `email`, `contact`,`password`) VALUES('$fname','$lname','$email','$contact','$password')";
            if ($mysqli->query($sql)) {
                $_SESSION['success'] = "User Added Successfully";
                header("Location: users.php");
                exit();
            } else {
                $_SESSION['error'] = "Something Went Wrong";
            }
        } else {
            if (empty($password)) {
                $sql = "UPDATE `users` SET `fname`='$fname',`lname`='$lname',`email`='$email',`contact`='$contact' WHERE `srno`='$id'";
            } else {
                $sql = "UPDATE `users` SET `fname`='$fname',`lname`='$lname',`email`='$email',`contact`='$contact',`password`='$password' WHERE `srno`='$id'";
            }
            if ($mysqli->query($sql)) {
                $_SESSION['success'] = "User Updated Successfully";
                header("Location: users.php");
                exit();
            } else {
                $_SESSION['error'] = "Something Went Wrong";
            }
        }
    }

    if (isset($_POST['deleteId'])) {
        $id = secure($_POST['deleteId']);
        $sql = "DELETE FROM `users` WHERE `srno`='$id'";
        if ($mysqli->query($sql)) {
            $_SESSION['success'] = "User Deleted Successfully";
        } else {
            $_SESSION['error'] = "Something Went Wrong";
        }
        header("Location: users.php");
                exit();
    }


    ?>

    <div class="container-fluid">
        <div class="row main-container">
            <?php include('required/sidebar.php'); ?>
            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 p-4 bg-light">
                <h1 class='display-5'>Users</h1>
                <div class="card shadow p-3">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>List of Users</h5>
                            </div>
                            <div class="col-sm-6 text-end">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="fa-solid fa-plus"></i> Add User</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-striped table-responsive" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM `users`";
                                    $result = $mysqli->query($sql);
                                    $sr=0;
                                    while($row = $result->fetch_object()) {
                                        $sr++;
                                    ?>
                                <tr>   
                                    <td><?= $sr ?></td>
                                    <td><?= $row->fname ?></td>
                                    <td><?= $row->lname ?></td>
                                    <td><?= $row->email ?></td>
                                    <td><?= $row->contact ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal" data-id='<?= $row->srno ?>' data-fname='<?= $row->fname ?>' data-lname='<?= $row->lname ?>' data-email='<?= $row->email ?>' data-contact='<?= $row->contact ?>'><i class="fa-solid fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDataModal" data-id='<?= $row->srno ?>' data-title='<?= $row->fname . " " . $row->lname ?>'><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr><?php } ?>
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
                    <h5 class="modal-title" id="modalTitleId">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="hidden" name="modifyID" id="modifyID" value='0'>
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="fname" aria-describedby="helpId" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="lname" aria-describedby="helpId" placeholder="Enter Last Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Contact</label>
                                    <input type="text" class="form-control" name="contact" id="contact" aria-describedby="helpId" placeholder="Enter Contact">
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
                    <h5 class="modal-title" id="modalTitleId">Confirm Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        Are you sure you want to delete <b><span id='title'>John Doe</span></b>?
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
            var fname = button.data('fname')
            var lname = button.data('lname')
            var email = button.data('email')
            var contact = button.data('contact')
            var password = button.data('password')
            var modal = $(this)

            modal.find('.modal-title').text((id == 0 || id == undefined) ? 'Add User' : "Edit User")
            modal.find('.modal-body #modifyID').val(id)
            modal.find('.modal-body #fname').val(fname)
            modal.find('.modal-body #lname').val(lname)
            modal.find('.modal-body #email').val(email)
            modal.find('.modal-body #contact').val(contact)
            modal.find('.modal-body #password').val(password)
            modal.find('.modal-footer button[name=submit]').text((id == 0 || id == undefined) ? 'Save' : "Update")
        })
        // On Delete Button Click
        $('#deleteDataModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var title = button.data('title')
            var modal = $(this)

            modal.find('.modal-body #title').text(title)
            modal.find('.modal-body input[name=deleteId]').val(id)
        })

        //form validation
    function validateForm() {
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var contact = $('#contact').val();

        // Regular expression for validation with first letter capitalization
        var nameRegex = /^[A-Z][a-z]*$/;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var contactRegex = /^\d{10}$/;

        if (!nameRegex.test(fname)) {
            alert('Please enter a valid first name with the first letter being capital but any illegal characters');
            return false;
        }

        if (!nameRegex.test(lname)) {
            alert('Please enter a valid last name with the first letter being capital but any illegal characters');
            return false;
        }

        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }

        if(password!=""){
            var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                alert('Password should be at least 8 characters long and contain at least one letter and one digit but any illegal characters.');
                return false;
            }
        }

        if (!contactRegex.test(contact)) {
            alert('Please enter a valid 10-digit contact number.');
            return false;
        }

        return true;
    }
    </script>
</body>

</html>