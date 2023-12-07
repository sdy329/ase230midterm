<?php
require_once('posts.php');
if(count($_POST)>0){
    createPost($_POST);
    header('Location: index.php');
} else {
?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <div>
        <label>Post Title</label><br />
        <input type="text" name="title" required="required"/> <br />
    </div>
    <br />
    <div>
        <label>Post Contents</label><br />
        <textarea name="postContent" required="required"></textarea><br />
    </div>
    <br />
    <div>
        <label>Image</label><br />
    <input type="file" name="img" accept="image/*">
    <input type="hidden" name="postID" value="<?= $postID ?>">
    </div>
    <br />
    <div>
        <button type="submit">Create Post</button>
</div>
</form>

<footer>
    <br /><a href="index.php">Back to List</a>
</footer>

<?php
}