<?php
$connect = mysqli_connect("localhost","root",'',"mypro_crud");

//check connection
if($connect === false){
    die("ERROR: Cloud not connect." .mysqli_connect_error());
}
if(isset($_REQUEST["term"])){
    //prepare a select statement
   $sql ="SELECT * FROM student WHERE name LIKE ?";


  if($stmt = mysqli_prepare($connect, $sql)) {
      //bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_term);

      //set parameters
      $param_term = $_REQUEST["term"] . '%';
      //Attemp to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
          $result = mysqli_stmt_get_result($stmt);
          //check number of rows in the result set
          if (mysqli_num_rows($result) > 0) {
              //fetch result rows as an associative array
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                  echo "<p>" . $row["name"] . "</p>";

              }
          } else {
              echo "<p>No matches found</p>";
          }
      } else {
          $link="";
          echo "ERROR: Could not able to execute $sql." . mysqli_error($link);

      }
  }
    //close statement
    mysqli_stmt_close($stmt);
}

//close connection
mysqli_close($connect);
?>

