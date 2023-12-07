<?php
require_once('posts.php');
$postID = $_GET['id'];
$postData = getPost($postID);
$postContent = getPostContent($postID);
?>

<h1>Post Details</h1>
Post ID: <?= $postID ?>
<h2>Title: <span style="font-weight:normal"><?= $postData['title'] ?></span></h2>
<h2>Date + Time: <span style="font-weight:normal"><?= $postData['datetime'] ?></span></h2>
<h2>Cover Image: <img  src="../../<?= $postData['img'] ?>" alt="<?php echo $postID; ?> Image" style="max-width: 200px; max-height: 200px"/></h2>
<textarea name="postContent" readonly><?= $postContent ?></textarea>
<br /> <br />

<a href="edit.php?id=<?php echo $postID; ?>"><button>Edit</button></a> &nbsp;
<a href="delete.php?id=<?php echo $postID; ?>"><button>Delete</button></a>

<footer>
    <br /><a href="index.php">Back to List</a>
</footer>