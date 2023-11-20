<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'ketab');

$email = isset($_GET["email"]) ? $_GET["email"] : "";
$password = isset($_GET["password"]) ? $_GET["password"] : "";

$check = 0;
$query = "SELECT name, email, password
    FROM users ";

$result = $conn->query($query);
$emailError = $passwordError = "";

if (isset($_GET["submit"])) {
    while ($row = mysqli_fetch_array($result)) {

        $seed = substr($row["name"], 0, 2);
        $cryptedpassword = crypt($password, $seed);

        if ($email == $row["email"] && $cryptedpassword == $row["password"]) {
            // Store user information in the session
            $_SESSION["username"] = $row["name"];
            $_SESSION["user_email"] = $row["email"];

            header("Location: books.php");
            exit();
        } else {
            $emailError = "Check email and password again";
        }
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&family=Work+Sans:ital,wght@0,600;1,500&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>

    <section>

        <nav>
          <div class="leftside">
            
            <img src="./pngtree-book-clipart-vector-png-image_6653535.png" alt="">
            <a href="index.html"><h1>KETAB</h1></a>
          </div>
            <ul>
            <a href="login.php"><li>Login</li></a> 
                <a href="regestration.php"><span><li>Signup</li></span></a>
                <li>About us</li>
            </ul>

        </nav>

    </section>

    <div class="loginform">

        <h1>Nice to see you again!</h1>
        <form action="" method="GET">

            <p class="login">LOGIN</p>

            <input type="text" placeholder="email" name="email">

            <input type="password" placeholder="password" name="password">

            <p class="ff">Forget password?</p>
            <span style="color: red;"><?php echo $emailError; ?></span><br>


            <input class="btn" type="submit" value="Login" name="submit">

        </form>


    </div>



</body>
</html>