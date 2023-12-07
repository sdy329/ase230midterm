<?php
require_once('posts.php');
require_once('../../global.php');
$posts = getPosts();
echo '<table style="border: 1px solid black; border-collapse: collapse;">
<tr style="border: 1px solid black; border-collapse: collapse;">
<th style="border: 1px solid black; border-collapse: collapse;">Post Name</th>
<th style="border: 1px solid black; border-collapse: collapse;">Details</th>
</tr>';
tableRowPosts($posts);
echo '</table><br />
<a href="create.php">Create New Post</a><br />
<a href="../index.php">Back to Admin Portal</a>';

?>