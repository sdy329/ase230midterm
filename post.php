<?php
require_once('global.php');
function getPosts(){
    $postsJson = file_get_contents('./data/posts.json');
    $posts = json_decode($postsJson, true);
    return $posts;
}

function getPostContent($postID){
    $postContent=file_get_contents('./data/posts/'.$postID.'.txt');

    return $postContent;
}

$postID = $_GET['id'];
$posts = getPosts();
$postData = $posts[$postID];
$postContent = getPostContent($postID);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title']; // Retrieve the post title from the form
    $content = $_POST['content']; // Retrieve the post content from the form
    $imagePath = $_POST['image']; // Retrieve the image path from the form

    createPost($title, $content, $imagePath);
    // Redirect to the posts page or do any necessary actions after creating the post
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
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="account.php">Account</a></li>
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

        <section class="bg-faded">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="bg-faded p-5 rounded">
                        <img class="img-fluid rounded" style="width: 100%; max-height: 300px;" src="<?= $postData['img'] ?>" alt="<?= $postData['title'] ?>" />
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-lower"><?= $postData['title'] ?></span>
                                <span class="section-heading-upper">Posted at: <?= $postData['datetime'] ?> EST</span>
                            </h2>
                            <?= $postContent ?>
                            <?php if(isset($_SESSION['id'])){
                echo 'Make a comment goes here';
            } else {
                echo 'Sign in or Register to make a comment goes here';
            }?>
            <br/>

            <h2> Comments Here </h2> <br/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="posts.php" class="text-center"><button class="btn btn-primary">Back to posts</button></a>
                <br/><br/>
            </div>
        </section>
        
        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">Copyright &copy; EcoTrack 2023</p></div>
        </footer>
    </body>
</html>