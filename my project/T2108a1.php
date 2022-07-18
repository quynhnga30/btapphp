<?php
 require "Student.php";
 $objStudent = new Student();
 //set
 $objStudent->id =1;
 $objStudent->studentName="Minh";

 //get
echo $objStudent->id;
echo $objStudent->studentName;

//call method : gọi hàm
echo $objStudent->getStudentInfo();




?>
