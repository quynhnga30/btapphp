<?php
include_once ("config.php");
$id = $_GET['id'];

$result = mysqli_query($mysqli,"delete from student where id=$id");
header("Location:index.php");
