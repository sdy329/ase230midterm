<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>EcoTrack - Make a Post</title>
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

    <!-- Make a Post Section -->
    <section class="page-section clearfix" id="makePost">
        <div class="container">
            <div class="intro">
                <h2 class="section-heading text-center mb-4">
                    <span class="section-heading-upper">Share Your Thoughts!</span>
                    <span class="section-heading-lower"><strong>Make a Post</strong></span>
                </h2>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <form action="process_post.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="postTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="postTitle" name="postTitle" required>
                            </div>
                            <div class="mb-3">
                                <label for="postContent" class="form-label">Content</label>
                                <textarea class="form-control" id="postContent" name="postContent" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="postImage" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" id="postImage" name="postImage">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-xl"><strong>Post</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer text-faded text-center py-5">
        <div class="container"><p class="m-0 small">Copyright &copy; EcoTrack 2023</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>