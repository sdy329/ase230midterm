<?php
require_once('../../global.php');
$users = getUsers();

if($_SESSION['admin'] != true){
    header('Location: ../../index.php');
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
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../css/styles.css" rel="stylesheet" />
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
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../../index.php">Home</a></li>
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../../posts.php">Posts</a></li>
                </ul>
            </div>

            <?php if(isset($_SESSION['id'])){
                echo '
                <div class="justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../../account.php">Account</a></li>
                    <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../../signout.php">Sign Out</a></li>
                    ';
                if($_SESSION['admin'] == true) echo '<li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../index.php">Admin</a></li>';
                echo '</ul>
                </div>';
            } else {
                echo '
            <div class="justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../../signin.php">Sign In</a></li>
                <li class="nav-item mb-2"><a class="nav-link text-uppercase" href="../../register.php">Register</a></li>
            </ul>
            </div>';
            }
            ?>
        </div>
    </nav>

    <section class="bg-faded">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <br/>
                    <h1>Admin Panel</h1>
                    <hr/>
                    <table class="mb-4 table table-primary">
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Details</th>
                        </tr>
                        <?php foreach($users as $user) { 

                            echo '<tr>
                                <td>' . $user['ID'] . '</td>
                                <td>' . $user['username'] . '</td>
                                <td><a href="detail.php?id='.$user['ID'].'">Click Here</a></td>
                            </tr>';
                        }?>
                    </table>
                    <br/>
                    <a href="../index.php"><button class="btn btn-primary">Back</button></a>
                    <br/><br/>
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
