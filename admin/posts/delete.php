<?php 
require_once('posts.php');
if(count($_POST)>0){
    deletePost($_POST['id']);
    header('Location: index.php');
} else {
$postID = $_GET['id'];
$postData = getPost($postID);
?>

<h1>Delete Post</h1>
<h2>Are you sure you want to delete <?= $postID?> AKA "<?= $postData['title']?>"?</h2>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <input type="hidden" name="id" value="<?= $postID ?>">
    <button type="submit">Yes</button>
    <a href="detail.php?id=<?php echo $postID; ?>"><button type="button">No</button></a>
</form>


<?php
}