<?php
require_once('global.php');

if(count($_POST) > 0){
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if(query('SELECT * FROM users WHERE username = ?', [$username])->fetch()){
            echo 'username already exists';
        } elseif(query('SELECT * FROM users WHERE email = ?', [$email])->fetch()){
            echo 'email already exists';
        } else{
            query('INSERT INTO users (username, email, password) VALUES (?, ?, ?)', [$username, $email, $password]);

            function_alert('User created successfully');
            header('Location: index.php');
        }
    } else echo 'Not all fields are filled out';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>EcoTrack</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Google fonts-->
    <link
        href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <header>
        <h1 class="site-heading text-center text-faded d-none d-lg-block">
            <span class="site-heading-upper text-primary mb-3">Protecting the environment together</span>
            <span class="site-heading-lower">EcoTrack</span>
        </h1>
    </header>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
        <div class="container">
            <div class="d-flex align-items-center">
                <ul class="navbar-nav">
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="index.php">Home</a></li>
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="posts.php">Posts</a></li>
                </ul>
            </div>

            <?php if(isset($_SESSION['id'])){
                echo '
                <div class="justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="account/index.php?id='.$_SESSION['id'].'">Account</a></li>
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="signout.php">Sign Out</a></li>
                    ';
                if($_SESSION['admin'] == true) echo '<li class="nav-item mb-2"><a class="nav-link text-uppercase" href="admin/index.php">Admin</a></li>';
                echo '</ul>
                </div>';
            } else {
                echo '
            <div class="justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="signin.php">Sign In</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="register.php">Register</a></li>
            </ul>
            </div>';
            }
            ?>
        </div>
    </nav>

    <!-- Middle Section-->
    <section class="page-section cta" id="createUser">
        <div class="container">
            <div class="intro cta-inner bg-faded text-center rounded">
                <h2 class="section-heading text-center mb-4">
                    <span class="section-heading-upper">Join Us!</span>
                    <span class="section-heading-lower"><strong>Create Your Profile</strong></span>
                </h2>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-xl"><strong>Create a
                                        User</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright &copy; EcoTrack 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>