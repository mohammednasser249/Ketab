<?php

session_start();
$conn = mysqli_connect('localhost', 'root', '', 'ketab');

$query = "SELECT * FROM books";

$result = $conn->query($query);

$qr = "SELECT name,email ,password
From users ";

$r = $conn->query($qr);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="books.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&family=Work+Sans:ital,wght@0,600;1,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <section>
        <nav>
            <div class="leftside">
                <img src="./pngtree-book-clipart-vector-png-image_6653535.png" alt="">
                <a href="index.html" style="color: inherit; text-decoration: none;"><h1>KETAB</h1></a>
            </div>
            <ul>
                <li ><small>Welcome back <span style='color:red;'></span></small><?=$_SESSION["username"]?></li>
                <a href="logout.php" style="color: inherit; text-decoration: none;"><span><li>Sign out</li></span></a>
                <li>About us</li>
            </ul>
        </nav>
    </section>

    <h1 style="display: flex; justify-content: center; margin-bottom: 20px;">Available books</h1>

    <div class="books">
        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="book">
                <div class="card mb-3" style="max-width: 1000px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="./glasses-1052010_640.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['booktitle']; ?></h5>
                                <p class="card-text"><?php echo $row['bookdescription']; ?></p>
                                <small class="text-body-secondary"><?php echo $row['bookauthor']; ?></small>
                                <p class="card-text"><small class="text-body-secondary"><?php echo $row['bookpublishdate']; ?></small></p>
                                <button>Buy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        mysqli_close($conn);
        ?>
    </div>

</body>
</html>
