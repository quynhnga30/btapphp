<?php
   include_once("config.php");

   $result = mysqli_query($mysqli,"SELECT * FROM Student ORDER BY id DESC ");

?>
<html>
<head>Student management</head>
<br/><br/>
   <body>
   <a href="create.php">Add new Student</a><br/><br>
       <table width=90%" border="1">
          <tr>
             <th>Name</th> <th>Email</th> <th>Mobile</th> <th>Options</th>
          </tr>
          <?php

          while($stu_data = mysqli_fetch_array($result))
          {
             echo "<tr>";
             echo "<td>". $stu_data['name'] . "</td>";
             echo "<td>". $stu_data['email'] . "</td>";
             echo "<td>". $stu_data['mobile'] . "</td>";
             echo "<td> <a href ='edit.php?id=$stu_data[id]'>Edit</a> |
             <a href='delete.php?id=$stu_data[id]'>Delete</a></td>";

             echo "</tr>";

   }


          ?>

       </table>
   </body>
</html>

