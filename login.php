<?php
session_start(); require 'config.php';
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: index.php');exit;}
$username=strtolower(trim($_POST['username']??''));$password=$_POST['password']??'';
$stmt=$pdo->prepare('SELECT id,name,username,password_hash,role FROM users WHERE username=? LIMIT 1');$stmt->execute([$username]);$user=$stmt->fetch();
if(!$user||!password_verify($password,$user['password_hash'])){$_SESSION['flash_error']='Incorrect username or password.';header('Location: index.php');exit;}
session_regenerate_id(true);$_SESSION['user_id']=(int)$user['id'];$_SESSION['name']=$user['name'];$_SESSION['role']=$user['role'];header('Location: dashboard.php');exit;
