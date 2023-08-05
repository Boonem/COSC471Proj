<?php
    session_start();?>

<?php
        $con = mysqli_connect('localhost',"root","","GAMELIST");
        if ($_POST['newusername'] != '' && $_POST['newpassword'] != '' && isset($_POST['signup'])) {
            $username = $_POST['newusername'];
            $password = $_POST['newpassword'];
            $phash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO `USER`(Password, Username) VALUES ('$phash','$username')";
            $result = mysqli_query($con, $query);
            if ($result) {
                echo "<h2>Registration Successful</h2>";
            }
            else {
                echo "<h2>Registration Failed</h2>";
            }
        }
        elseif ($_POST['username'] != '' && $_POST['password'] != '' && isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = "SELECT * FROM `USER` WHERE Username='$username'";

            $result = mysqli_query($con, $query);

            $rows = mysqli_num_rows($result);
            if ($rows == 1 && password_verify($password, $result['Password'])) {
                $_SESSION['username'] = $username;
                header("Location: mylist.php");
            } 
            else {
                echo "<h2>Incorrect Username/password.</h2>";
            }
        }
        elseif (isset($_POST['login']) || isset($_POST['signup'])) {
            echo "<h2>Incorrect Input</h2>";
        }
    ?>
<!doctype html>
<head>
    <link rel="stylesheet" href="styles.css">
    
</head>



<?php
print_r($_SESSION);
?>

<h1>Create Review</h1>
<?php if(isset($_SESSION['username'])){ echo "<h2>Logged in as: " + $_SESSION['username'] + "</h2>";}?>
<body>

    <div class="vert-center">
        <form class="container-small" action="mylist.php" method="post">
            <p>
            <label>Username:</label>
            <input type="text" name="sername"></input><br>
            <label>Password:</label>
            <input type="password" name="password"></input><br>
            <input type="submit" name="submit" value="login">
            </p>
        </form>

        <br>

        <form class="container-small" action="" method="post">
            <p>
            <label>Username:</label>
            <input type="text" name="newusername"></input><br>
            <label>Password:</label>
            <input type="password" name="newpassword"></input><br>
            <input type="submit" name="signup" value="Sign Up">
            </p>
        </form>
    </div>
</body>