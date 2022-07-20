<?php
//initialize the session
/*session_start();
//check if the user is already logged in, if yes then redirect him to index page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: login.php");
    exit;
}*/

require_once "config.php";
//define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err ="";
//processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";

    }else{
        $username = trim($_POST["username"]);
    }
    //check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";

    }else{
        $password = trim($_POST["password"]);
    }
    //validate credentials
    if(empty($username_err) && empty($password_err)){
        //prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($mysqli, $sql)){
            //bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s",$param_username);
            //set parameters
            $param_username = $username;
            //attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //store result
                mysqli_stmt_store_result($stmt);
                //check if username exits, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    //bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            //password is correct, so start a new session
                            session_start();
                            //store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            //redirect user to index page
                            header("location: index.php");

                        }else{
                            //password is not valid, display generic error message
                            $login_err = "Invalid username or password.";

                        }
                    }
                }else{
                    //username doesnt exits, display a generic error message
                    $login_err = "Invalid username or password.";

                }
            }else{
                echo "Oops! Something went wrong. Please try again later.";

            }
            //close statement
            mysqli_stmt_close($stmt);
        }
    }
    //close connection
    mysqli_close($mysqli);
}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet"
          href = "http://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }

        .wrapper{ width: 360px; padding: 20px; }

    </style>
</head>
<body>
<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>

    <?php
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">'.$login_err . '</div>';
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
    method="post"
    <div class="from-group">
        <label>Username</label>
        <input type="text" name="username" class="from-control
            <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
               value="<?php echo $username; ?>">
        <span class="invalid-feedback"><?php echo $password_err; ?></span>
    </div>
    <div class="from-group" style="font: 14px sans-serif; ">
        <label>Password</label>
        <input type="password" name="password" class="from-control
            <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
               value="<?php echo $password; ?>">
        <span class="invalid-feedback"><?php echo $password_err; ?></span>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="login">
    </div>
    <p>Don't have an account? <a href="register.php">Sign up now</a>. </p>

    </form>
</div>
</body>

</html>
