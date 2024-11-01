<?php
require_once('../global.php');

$userID = $_GET['id'];

function generatePostsCards(){
    $posts = query('SELECT * FROM posts WHERE userID = ?', [$_GET['id']])->fetchAll();
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
                    <a href="../post/index.php?id='.$post['ID'].'"><button class="btn btn-primary">View</button></a>
                </div>
            </div>
        </div>
    </div>';
        $counter++;

        if ($counter % 3 == 0) echo '</div>';
    }
    if ($counter % 3 != 0) echo '</div>';
}

function generateCommentsCards(){
    $comments = query('SELECT * FROM comments WHERE userID = ?', [$_GET['id']])->fetchAll();
    $counter = 0;

    foreach($comments as $comment){
        $post = getPost($comment['postID']);
        if ($counter % 3 == 0) echo '<div class="row row-cols-1 row-cols-md-3 g-3">';

        echo '<div class="col mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">'.$post['title'].'</h5>
                <p class="card-text"><strong>Comment: </strong>'.$comment['comment'].'</p>
                <p class="card-text"><small class="text-muted">Posted By: '.getAuthor($comment['userID']).'</small><br/>
                <small class="text-muted">Posted At: '.$comment['postedDateTime'].' EST</small></p>
                <div class="btn-group mb-2" role="group" aria-label="Post Actions">
                    <a href="../post/index.php?id='.$comment['postID'].'"><button class="btn btn-primary">View</button></a>
                </div>
            </div>
        </div>
    </div>';
        $counter++;

        if ($counter % 3 == 0) echo '</div>';
    }
    if ($counter % 3 != 0) echo '</div>';
}

if($_SESSION['id'] != $_GET['id'] && $_SESSION['admin'] != true){
    header('Location: ../index.php');
}

$userData = query('SELECT * FROM users WHERE ID = ?', [$_GET['id']])->fetch();

if(count($_POST) > 0){
    if(isset($_POST['username']) && isset($_POST['email']) && password_verify($_POST['password'], $userData['password'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        if($_POST['newpassword'] != '') $password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
        else $password = $userData['password'];

        if(query('SELECT * FROM users WHERE username = ?', [$username])->fetch() && $username != $userData['username']){
            echo 'username already exists';
        } elseif(query('SELECT * FROM users WHERE email = ?', [$email])->fetch() && $email != $userData['email']){
            echo 'email already exists';
        } else{
            query('UPDATE users SET username = ?, email = ?, password = ? WHERE ID = ?', [$username, $email, $password, $_GET['id']]);

            $ID = $_GET['id'];
            header('Location: index.php?id='.$ID);
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
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Google fonts-->
    <link
        href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
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
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="index.php?id='.$_SESSION['id'].'">Account</a></li>
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
                        <h2 class="section-heading mb-4"><span class="section-heading-upper">Account</span></h2>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="<?= $userData['username'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= $userData['email'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newpassword" name="newpassword">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-xl"><strong>Update</strong></button>
                            </div>
                        </form>
                        <h2 class="section-heading mb-4"><span class="section-heading-upper">Posts</span></h2>
                        <div class="container-fluid">
                            <?= generatePostsCards(); ?>
                        </div>
                        <h2 class="section-heading mb-4"><span class="section-heading-upper">Commented Posts</span></h2>
                        <div class="container-fluid">
                            <?= generateCommentsCards(); ?>
                        </div>
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
</body>

</html>