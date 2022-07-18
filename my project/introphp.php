<?php
    //comment
    #comment
    /*
     line
     hi
    */
//php phân biệt chữ viết hoa viết thường
//ki hiệu là ko phân biệt viết hoa hay viết thường
    $myData = "php code";//string
    $myVar = 200;//integer
    $nameOfVar = 34.5; //float
    $content = "MyShop";
    echo $content . "<br>";
    $myNumber = 1000;
    echo $myNumber . "<br>";

    echo "The data of variable is" . $myData . "<br>";

    echo gettype($myData) . "<br>";
    echo gettype($myVar) . "<br>";
    echo GETTYPE($myData) . "<br>";

    //display with html
    echo "<h1> This is content of H1 </h1>";
    echo "<h1 style ='color:blue;'> this is blue </h1>";

    //display with variable and array
    $students = array("Thao","Bac","Duc","Son");
    echo $students[3] . "<br>";
    echo $students[0] . "<br>";
    //in ra danh sách toàn bộ
    print_r($students);
    // thẻ print in thuộc tính kiểu string
    print "<h1 style ='color:blue;'> this is blue </h1>";

    //c1
    $marks = array("Thao"=>10, "Bac"=>12);
    print_r($marks) . "<br>";
    //c2
    $marks1["Thao"] = 10;
    $marks1["Bac"] = 12;
    print_r($marks1) . "<br>";

    //sort in array : sắp xếp
    $numbers = array(3,5,663,24,67,3244,677,23);
    sort($numbers);//tăng dần
    rsort($numbers);//giảm dần
    print_r($numbers);
    //loops: for, while, do{}while();
    for($i=0; $i<=10; $i++){
        echo "The result is " .$i . "<br>";

    }
    //for each
    $employees = array("Trung","Canh","Hiep");
    foreach ($employees as $emp){
        echo $emp ."<br>";

    }
    sort($employees);
    print_r($employees);
    //do while
    $i = 5;
    do{
        $i++;
        echo "the number is" .$i ."<br>";

    }while($i<=10);






?>
