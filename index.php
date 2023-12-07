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
    <?php
    $sql = "SELECT COUNT(*) AS userCount FROM `users`";
    $result = $mysqli->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        $userCount = $row['userCount'];
    } else {
        echo "Error: " . $mysqli->error;
    }?>

    <?php
    $sql = "SELECT COUNT(*) AS adminCount FROM `admins`";
    $result = $mysqli->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        $adminCount = $row['adminCount'];
    } else {
        echo "Error: " . $mysqli->error;
    }?>

    <?php
    $sql = "SELECT COUNT(*) AS supportCount FROM `support`";
    $result = $mysqli->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        $supportCount = $row['supportCount'];
    } else {
        echo "Error: " . $mysqli->error;
    }?>

    <div class="container-fluid">
        <div class="row main-container">
            <?php include('required/sidebar.php'); ?>
            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 p-4 bg-light">
                <h1 class='display-5 mb-3'>Dashboard</h1>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="card m-1 my-2 shadow dashboard-card">
                            <div class="card-body">
                                <i class="fa-solid fa-3x mt-2 fa-users float-end"></i>
                                <h1><?php echo $userCount ?></h1>
                                <p>Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card m-1 my-2 shadow dashboard-card">
                            <div class="card-body">
                                <i class="fa-solid fa-3x mt-2 fa-images float-end"></i>
                                <h1>NO DB</h1>
                                <p>Social Media Posts</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card m-1 my-2 shadow dashboard-card">
                            <div class="card-body">
                                <i class="fa-solid fa-3x mt-2 fa-user-tie float-end"></i>
                                <h1><?php echo $adminCount ?></h1>
                                <p>Admins</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card m-1 my-2 shadow dashboard-card">
                            <div class="card-body">
                                <i class="fa-solid fa-3x mt-2 fa-hashtag float-end"></i>
                                <h1>NO DB</h1>
                                <p>Hashtags</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card m-1 my-2 shadow dashboard-card">
                            <div class="card-body">
                                <i class="fa-solid fa-3x mt-2 fa-circle-info float-end"></i>
                                <h1><?php echo $supportCount ?></h1>
                                <p>Support</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card m-1 my-2 shadow dashboard-card">
                            <div class="card-body">
                                <i class="fa-solid fa-3x mt-2 fa-pen-nib float-end"></i>
                                <h1>NO DB</h1>
                                <p>Doodles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('required/footer.php'); ?>
</body>

</html>