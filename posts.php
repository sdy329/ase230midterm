<?php
require_once('global.php');

function generateCards(){
    $posts = getPosts();
    $counter = 0;

    foreach($posts as $post){
        if ($counter % 3 == 0) echo '<div class="row row-cols-1 row-cols-md-3 g-3">';

        echo '<div class="col mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">'.$post['title'].'</h5>
                <p class="card-text"><small class="text-muted">Posted By: '.getAuthor($post['userID']).'</small><br/>
                <small class="text-muted">Posted At: '.$post['postedDateTime'].' EST</small></p>
                <div class="btn-group mb-2" role="group" aria-label="Post Actions">
                    <a href="post/index.php?id='.$post['ID'].'"><button class="btn btn-primary">View</button></a>
                </div>
            </div>
        </div>
    </div>';
        $counter++;

        if ($counter % 3 == 0) echo '</div>';
    }
    if ($counter % 3 != 0) echo '</div>';
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
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
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

    <br>

    <?php if(isset($_SESSION['id'])){
        echo'
    <div class="text-center">
        <a href="post/create.php"><button class="btn btn-primary">Create Post</button></a>
    </div>';
    }?>

    <section class="page-section clearfix">
        <div class="container-fluid">
            <?php generateCards(); ?>
        </div>
    </section>

    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright &copy; EcoTrack 2023</p>
        </div>
    </footer>
</body>
</html>
