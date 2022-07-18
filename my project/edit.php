<?php
include_once("config.php");
//trả về người dùng nhấn submit
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile =$_POST['mobile'];


    //update database
    $result = mysqli_query($mysqli,"UPDATE Student SET name ='$name',
        email='$email', mobile='$mobile'
         WHERE id =$id");

    //Quay lai trang index.php sau khi update thanh cong
    header("Location: index.php");
}


?>

<?php
//lấy id từ url
$id = $_GET['id'];
echo $id;
$result = mysqli_query($mysqli,"SELECT * FROM Student WHERE id =$id");
while($stu_data = mysqli_fetch_array($result)){
    $name = $stu_data['name'];
    $email = $stu_data['email'];
    $mobile = $stu_data['mobile'];
}?>
<html>
<head>
<Title>Edit student information</title>
</head>
<body>
<a href="index.php">Home</a>
  <br/><br/>
<form name="update_student" method ="post" action="edit.php">
    <table border="0">
        <tr>
            <td>Name</td>
            <td><input type="text" name ="name" value=<?php echo $name; ?>></td></tr>
        <tr>

        <tr>
            <td>Email</td>
            <td><input type="text" name ="email" value=<?php echo $email; ?>></td></tr>
        <tr>

        <tr>
            <td>Mobile</td>
            <td><input type="text" name ="mobile" value=<?php echo $mobile; ?>></td></tr>
        <tr>
            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
            <td><input type="submit" name="update" value="update"></td>
        </tr>
    </table>
</form>
</body>
</html>