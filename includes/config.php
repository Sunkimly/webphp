<?php
$host = 'localhost';
$db   = 'notes_app';
$user = 'root'; // or your DB username
$pass = '';     // your DB password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>