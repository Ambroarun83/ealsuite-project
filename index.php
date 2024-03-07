<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>

    <?php include './src/headers.php'; ?>

</head>

<body>
    <?php if (isset($_SESSION['user_id'])) {
        include './src/views/home.php';
    } else { ?>
        <form action="" method="post">
            <div class="container login_page">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row justify-content-md-center">
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6 ">
                                    <div class="form-group ">
                                        <p class="head-text"><b>LOGIN</b></p>
                                        <label for="username">User Name</label>
                                        <input class="form-control" type="text" name="username" id="username" placeholder="Enter User Name" autocomplete="off" required>
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Enter Password" autocomplete="off" required>
                                        <input type="button" id="login" class="btn btn-outline-secondary" value="Login">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php
    }
    ?>
    <?php include './src/footers.php'; ?>
</body>

</html>