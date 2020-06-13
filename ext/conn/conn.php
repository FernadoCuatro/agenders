<?php
$conn = new mysqli('localhost', 'root', '', 'agenders');
if($conn->connect_error)
{
echo $error = $conn->connect_error;
}
?>