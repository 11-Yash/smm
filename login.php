
<?php 


include('required/config.php');
if (isset($_SESSION['admin_name'])) {
    header('location: index.php');
    exit();
}
if (isset($_POST['login'])) {
    $email = secure($_POST['email']);
    $password = Encrypt(secure($_POST['password']));
    $remember = isset($_POST['remember']) ? 1 : 0;
    $sql = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['fname'] . ' ' . $row['lname'];
        $_SESSION['admin_email'] = $row['email'];
        $_SESSION['admin_role'] = $row['role'];
        if ($remember == 1) {
            setcookie('admin_id', $row['id'], time() + (86400 * 30), "/");
            setcookie('admin_name', $row['fname'] . ' ' . $row['lname'], time() + (86400 * 30), "/");
            setcookie('admin_email', $row['email'], time() + (86400 * 30), "/");
            setcookie('admin_role', $row['role'], time() + (86400 * 30), "/");
        }
        header('location: index.php');
        exit();
    } else {
        echo "<script>alert('Invalid email or password')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login @ Social Media Manager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include('required/cssLinks.php'); ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row main-container">
            <div class="col-lg-4 col-md-6 col-sm-8 col-10 mx-auto my-auto">
                <div class="card shadow p-3">
                    <div class="card-header bg-white">
                        <h5 class="text-center">Login</h5>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                                    <button type="button" class="btn btn-outline-secondary" id="showPassword"><i class="fa-solid fa-eye"></i></button>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">Remember me</label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-5">All Rights Reserved &copy; <?= Date("Y") ?></p>
            </div>
        </div>
    </div>

    <?php include('required/footer.php'); ?>
    <script>
        $(document).ready(function() {
            $('#showPassword').click(function() {
                if ($('#password').attr('type') == 'password') {
                    $('#password').attr('type', 'text');
                    $('#showPassword').html('<i class="fa-solid fa-eye-slash"></i>');
                } else {
                    $('#password').attr('type', 'password');
                    $('#showPassword').html('<i class="fa-solid fa-eye"></i>');
                }
            });
        });
    </script>
</body>

</html>