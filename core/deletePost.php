<?php
require('../config/config.php');

$postId = $_GET['id'];

// Checks if the id of the post is correct
if (!isset($postId)) {
	header('Location: login.php');
	exit;
}

// Checks if user is logged
if (!isset($_SESSION["user"])) {
	header('Location: login.php');
	exit;
}

// Delete the post at the correct id
delete_content($postId, 'posts');

header("Location: ../index.php");
exit;