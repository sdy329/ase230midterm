<?php 
require_once('posts.php');
if(count($_POST)>0){
    updatePost($_POST);
    header('Location: detail.php?id='.$_POST['postID']);
} else {
    $postID = $_GET['id'];
    $postData = getPost($postID);
    $postContent = getPostContent($postID);

?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <div>
        <label>Post Title</label><br />
        <input type="text" name="title" value="<?= $postData['title'] ?>"/> <br />
    </div>
    <br />
    <div>
        <label>Post Contents</label><br />
        <textarea name="postContent"><?= $postContent ?></textarea><br />
    </div>
    <br />
    <div>
        <label>Image</label><br />
    <input type="file" name="img" accept="image/*">
    <input type="hidden" name="oldImg" value="<?= $postData['img'] ?>">
    <input type="hidden" name="postID" value="<?= $postID ?>">
    </div>
    <br />
    <div>
        <button type="submit">Edit Item</button>
</div>
</form>

<footer>
    <br /><a href="detail.php?id=<?= $postID ?>">Back to Details</a>
</footer>

<?php
}