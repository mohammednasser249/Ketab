<?php

$conn =mysqli_connect('localhost','root','','ketab');


    $name = isset($_GET["name"]) ? $_GET["name"] : "";
    $email = isset($_GET["email"]) ? $_GET["email"] : "";
    $password = isset($_GET["password"]) ? $_GET["password"] : "";



$check = 1; // to make sure that we do not have any error during inputing the fileds 

 $nameError= $emailError = $passwordError ="";

 // Validations 
if (isset($_GET["submit"])) { // once the submit button is clicked then we check for the fields 
    // Validations
    if (empty($name)) {
        $nameError = "Name is required.";
        $check=0;

    }
    
    //

    $query = "SELECT email
    From users ";

    $r= $conn->query($query); 
    
  
    //


    if (empty($email)) {
        $emailError = "Email is required.";
        $check=0;

    } elseif (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email)) {
        $emailError = "Invalid email format.";
        $check=0;
    }else{
        while($row=mysqli_fetch_array($r)) // here we check with the emails in the database to make sure it is not registered
        {
            if($email==$row["email"] )
            {
               $emailError="Email is already registered ";
               $check=0;
               
            }
    
        }
    }

    if (empty($password)) {
        $passwordError = "Password is required";
        $check=0;
    } else if (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
        $check=0;
        $passwordError= "Password must contain only letters and numbers";
    } else if (strlen($password) < 10) {
        $check=0;
        $passwordError= "Password must be at least 10 characters long";
    }
    

}

$seed = substr($name,0,2);
$cryptedpassword = crypt($password,$seed);

// Inserting into database 

if(isset($_GET["submit"])&& $check==1) // if submit is clicked and and check is 1 then here we can insert into database
{
$sql=" INSERT INTO users(name,email,password) VALUES ('$name','$email','$cryptedpassword')";

mysqli_query($conn,$sql);
}
mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="regestration.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&family=Work+Sans:ital,wght@0,600;1,500&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>

    <section>

        <nav>
          <div class="leftside">
            
            <img src="./pngtree-book-clipart-vector-png-image_6653535.png" alt="">
            <a href="index.html" style="color: inherit; text-decoration: none;"><h1>KETAB</h1></a>
          </div>
            <ul>
            <a href="login.php" style="color: inherit; text-decoration: none;"><li>Login</li></a>
                <a href="regestration.php" style="color: inherit; text-decoration: none;"><span><li>Signup</li></span></a>
                <li>About us</li>
            </ul>

        </nav>

    </section>

    <div class="loginform">

        <h1>What are you wating for ?! </h1>
        <form action="" method="get">
            <p class="login">Register Now!</p>
            <input type="text" placeholder="Name" name="name">
            <span style="color: red;"><?php echo $nameError; ?></span><br>
            <input type="text" placeholder="Email"name="email">
            <span style="color: red;"><?php echo $emailError; ?></span><br>
            <input type="password" placeholder="password" name="password">
            <span style="color: red;"><?php echo $passwordError; ?></span><br>

                <p class="ff">Forget password?</p>

            <input class="btn" type="submit" name="submit" value="Create an account">

        </form>



    </div>



</body>
</html>

