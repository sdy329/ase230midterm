<?php
function getPosts(){
    $postsJson = file_get_contents('./data/posts.json');
    $posts = json_decode($postsJson, true);
    return $posts;
}

function generateCards(){
    $posts = getPosts();
    $counter = 0;

    foreach($posts as $postID => $post){
        if ($counter % 3 == 0) echo '<div class="row row-cols-1 row-cols-md-3 g-3">';

        echo '<div class="col mb-3">
                <div class="card">
                    <img class="card-img-top" style="width: 100%; max-height: 250px;" src="./'.$post['img'].'" alt="'.$post['title'].' Image">
                    <div class="card-body">
                        <h5 class="card-title">'.$post['title'].'</h5>
                        <p class="card-text"><small class="text-muted">Posted: '.$post['datetime'].' EST</small></p>
                        <a href="post.php?id='.$postID.'"><button class="btn btn-primary">View</button></a>
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
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="community.php">Community</a></li>
                </ul>
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.php">EcoTrack</a>
            </div>

            <!-- Navbar toggler for smaller screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Create User Button -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <li class="nav-item">
                <a class="btn btn-primary" href="create.php">Create a User</a>
                </li>
            </div>
        </div>
    </nav>
        <section class="page-section clearfix">
            <div class="container-fluid">
                <?php generateCards(); ?>
            </div>
        </section>
        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">Copyright &copy; EcoTrack 2023</p></div>
        </footer>
    </body>
</html>