<?php
session_start();
define("APP_ROOT", __DIR__);
$host = 'localhost';
$db = 'ecotrack';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_EMULATE_PREPARES => false,
];
define('__DB__', new PDO($dsn, $user, $pass, $opt));

function query($query, $data){
    $stmt = __DB__->prepare($query);
    $stmt->execute($data);
    return $stmt;
}

function getPosts(){
    $posts = query('SELECT * FROM posts', [])->fetchAll();
    return $posts;
}

function getAuthor($id){
    $author = query('SELECT username FROM users WHERE ID = ?', [$id])->fetch()['username'];
    return $author;
}

function getPost($id){
    $post = query('SELECT * FROM posts WHERE ID = ?', [$id])->fetch();
    return $post;
}

function getAllComments(){
    $comments = query('SELECT * FROM comments', [])->fetchAll();
    return $comments;
}

function getComment($id){
    $comment = query('SELECT * FROM comments WHERE ID = ?', [$id])->fetch();
    return $comment;
}

function getUsers(){
    $users = query('SELECT * FROM users', [])->fetchAll();
    return $users;
}

function getUser($id){
    $user = query('SELECT * FROM users WHERE ID = ?', [$id])->fetch();
    return $user;
}

function getAdmins(){
    $admins = query('SELECT * FROM admins', [])->fetchAll();
    return $admins;
}