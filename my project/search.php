<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <title>Student Lives search</title>
    <style>
        body{
            font-family: Arial, sans-serif;
        }
        /* formatting search box */
        .search-box{
          width: 300px;
          position: relative;
          display: inline-block;
          font-size: 14px;
        }
        .search-box input[type="text"]{
            height: 32px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px;
        }
        .result{
            position: absolute;
            z-index: 999;
            top: 100%;
            left: 0;
        }
        .search-box input[type="text"],.result{
            width: 100%;
            box-sizing: border-box;
        }
        /* formatting result items */
        .result p{
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }
        .result p:hover{
            background: #f2f2f2;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.search-box input[type="text"]').on("keyup input", function(){
                /*get input values on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("backend.php", {term: inputVal}).done(function(data){
                        //display the return data in browser
                        resultDropdown.html(data);
                    });
                }else {
                    resultDropdown.empty();
                }
            });

            //set search input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();

            })
        })
    </script>
</head>
<body>
    <div class="search-box">
         <label for="search">Search</label>
         <input type="text" autocomplete="off" id="search" placeholder="Search student..."/>
         <div class="result"></div>
    </div>
</body>

</html>
