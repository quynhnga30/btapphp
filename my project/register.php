<?php
//include config file
require_once "config.php";
//define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
//processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    //validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letter, numbers, and underscores.";
    } else {
        //Please a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            //Bind variable to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            //set parameters
            $param_username = trim($_POST["username"]);
            //attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                //store result
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            //close statement
            mysqli_stmt_close($stmt);
        }
    }
    //validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    //validate confirm password
    if (empty(trim($_POST["password"]))) {
        $confirm_password_err = "Please confirm password.";

    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";

        }
    }
    //check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        //prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            //bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            //set parameters
            $param_username = $username;
            //creates a password hash
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            //attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                //redirect to login page
                header("location : login.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";

            }
            //Close statement
            mysqli_stmt_close($stmt);

        }
    }

    //Close statement
    mysqli_close($mysqli);
}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UFT-8">
    <title>Sign Up</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }

    </style>

</head>
<body>
<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
        " method = "post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control
                   <?php echo (!empty($username_err)) ? 'is-invalid' : '' ?>
                   "value="<?php echo $username; ?>" >

            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control
                   <?php echo (!empty($password_err)) ? 'is-invalid' : '' ?>
                   "value="<?php echo $password; ?>" >

            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm password</label>
            <input type="password" name="confirm_password" class="form-control
                   <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : '' ?>
                   "value="<?php echo $confirm_password; ?>" >

            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">

        </div>
        <p>Already have an account? <a href="login.php">Login here </a>.</p>
    </form>
</div>
</body>
</html>

