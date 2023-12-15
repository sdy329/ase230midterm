<?php
require_once('../global.php');

$postID = $_GET['id'];
$postData = getPost($postID);

function generateCommentsCards(){
    $comments = query('SELECT * FROM comments WHERE postID = ?', [$_GET['id']])->fetchAll();

    foreach($comments as $comment){
        echo '<div class="row row-cols-1 g-3">
        <div class="col mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">'.$comment['comment'].'</h5>
                <p class="card-text"><small class="text-muted">Posted By: '.getAuthor($comment['userID']).'</small><br/>
                <small class="text-muted">Posted At: '.$comment['postedDateTime'].' EST</small></p>
                ';
                if(isset($_SESSION['id'])) {
                    if($_SESSION['id'] == $comment['userID'] || $_SESSION['admin'] == true){
                        echo '<a href="../comment/delete.php?id='.$comment['ID'].'"><button class="btn btn-primary">Delete</button></a>';
                    } 
                }
            echo '</div>
        </div>
    </div>
    </div>';
    }
}

if(count($_POST) > 0){
    if(isset($_POST['comment']) && isset($_SESSION['id'])){
        $comment = $_POST['comment'];
        $userID = $_SESSION['id'];
        $dateTime = date('Y-m-d H:i:s');
            
        query('INSERT INTO comments (postID, userID, comment, postedDateTime) VALUES (?, ?, ?, ?)', [$postID, $userID, $comment, $dateTime]);

        header('Location: index.php?id='.$postID);

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
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
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
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../index.php">Home</a></li>
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../posts.php">Posts</a></li>
                </ul>
            </div>

            <?php if(isset($_SESSION['id'])){
                echo '
                <div class="justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../account.php">Account</a></li>
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../signout.php">Sign Out</a></li>
                    ';
                if($_SESSION['admin'] == true) echo '<li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../admin/index.php">Admin</a></li>';
                echo '</ul>
                </div>';
            } else {
                echo '
            <div class="justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../signin.php">Sign In</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../register.php">Register</a></li>
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
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-lower"><?= $postData['title'] ?></span>
                                <span class="section-heading-upper">Posted by: <?= getAuthor($postData['userID']) ?></span>
                                <span class="section-heading-upper">Posted at: <?= $postData['postedDateTime'] ?> EST</span>
                                <?php if(isset($_SESSION['id'])) {
                                    if($_SESSION['id'] == $postData['userID'] || $_SESSION['admin'] == true){
                                        echo '<a href="edit.php?id=' . $postData['ID'] . '"><button class="btn btn-primary">Edit</button></a>
                                        <a href="delete.php?id=' . $postData['ID'] . '"><button class="btn btn-primary">Delete</button></a>';
                                    } 
                                }?>
                            </h2>
                            <?= $postData['content'] ?>
                            <br/><br/>
                            <?php if(isset($_SESSION['id'])){
                                echo '
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Comment</label>
                                        <textarea class="form-control" id="comment" name="comment" required></textarea>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Post Comment</button>
                                    </div>
                                </form>';
                            } else {
                                echo '<a href="../signin.php"><strong>Sign In</strong></a> or <a href="../register.php"><strong>Register</strong></a> to post a comment.';
                            } ?>
                            <br/><br/>
                            <?= generateCommentsCards();?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="../posts.php" class="text-center"><button class="btn btn-primary">Back to posts</button></a>
                <br/><br/>
            </div>
        </section>
        
        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">Copyright &copy; EcoTrack 2023</p></div>
        </footer>
    </body>
</html>