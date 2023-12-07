<?php
require_once('../../global.php');

function getPosts(){
    $postsJson = file_get_contents('../../data/posts.json');
    $posts = json_decode($postsJson, true);
    return $posts;
}

function getPostContent($postID){
    $postContent=file_get_contents('../../data/posts/'.$postID.'.txt');

    return $postContent;
}

function getPost($postID){
    $posts = getPosts();
    return $posts[$postID];
}

function deletePost($postID){
    $posts = getPosts();
    if (strpos($posts[$postID]['img'], 'defaults') == false) {
        unlink('../../'.$posts[$postID]['img']);
    }
    unset($posts[$postID]);
    $postsJson = json_encode($posts, JSON_PRETTY_PRINT);
    file_put_contents('../../data/posts.json', $postsJson);
    unlink('../../data/posts/'.$postID.'.txt');
}

function updatePost($updatedPost){
    $posts = getPosts();
    date_default_timezone_set('America/New_York');
    if (!empty($_FILES['img']['name'])) {
        $newImagePath = 'data/posts/images/' . $updatedPost['postID'] . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['img']['tmp_name'], APP_ROOT . '/' . $newImagePath);
    } else {
        $newImagePath = $updatedPost['oldImg'];
    }
    $posts[$updatedPost['postID']] = [ 
        'title' => $updatedPost['title'],
        'postContent' => "./posts/".$updatedPost['postID'].".txt",
        'datetime' => date('m-d-Y H:i:s'),
        'img' => $newImagePath,
    ];    
    $postsJson = json_encode($posts, JSON_PRETTY_PRINT);
    file_put_contents('../../data/posts.json', $postsJson);
    file_put_contents('../../data/posts/'.$updatedPost['postID'].'.txt',$updatedPost['postContent']);
}

function createPost($newPost){
    $posts = getPosts();
    $postID = uniqid("post_");
    date_default_timezone_set('America/New_York');
    if (!empty($_FILES['img']['name'])) {
        $newImagePath = 'data/posts/images/' . $postID . '.' . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['img']['tmp_name'], APP_ROOT . '/' . $newImagePath);
    } else {
        $newImagePath = 'data/posts/images/defaults/'.rand(1,5).'.png';
    }
    $posts[$postID] = [ 
        'title' => $newPost['title'],
        'postContent' => "./posts/".$postID.".txt",
        'datetime' => date('m-d-Y H:i:s'),
        'img' => $newImagePath,
    ];    
    $postsJson = json_encode($posts, JSON_PRETTY_PRINT);
    file_put_contents('../../data/posts.json', $postsJson);
    file_put_contents('../../data/posts/'.$postID.'.txt',$newPost['postContent']);
}

function tableRowPosts($posts) {
    foreach($posts as $postID => $post){
        echo '<tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse;">' . $post['title'] . '</td>
            <td style="border: 1px solid black; border-collapse: collapse;"><a href="detail.php?id=' . $postID . '">Details</a></td>
            </tr>';
    }
}

?>
