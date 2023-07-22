<?php
include 'db.php';
include 'config.php';
session_start();

if (!empty($_POST["username"])) {
    $userId = $_POST['id'];
    $userName = $_POST['username'];
    $userPass = $_POST['pass'];
    $userEmail = $_POST['email'];
    $userPhone = $_POST['phone'];
    $userAdd = $_POST['address'];

    
    if (!empty($userId)) {
        $query = 'SELECT * FROM  tbl_221_users WHERE id = "' . $userId . '" OR email = "' . $userEmail . '"';
        $result = mysqli_query($connection, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Failed to retrieve data from the database.";
        }
        if(!($row)) {
            $query2 = 'INSERT INTO tbl_221_users(id, name, email, address, phone, password) VALUES("'.$userId.'", "'.$userName.'", "'.$userEmail.'", "'.$userAdd.'", "'.$userPhone.'", "'.$userPass.'");'; 
            $result2 = mysqli_query($connection, $query2);
        }
    }

    
    if (!mysqli_query($connection, $query)) {
        echo "Error inserting data: " . mysqli_error($connection);
    }
    
}
else {
    echo 'could not connect to database!';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
        <script src="js/animation.js"></script>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="css/cycle-form.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://use.fontawesome.com/2491eb7d5e.js"></script>
        <title>create user result</title>
    </head>
    <body>
        <main class="d-flex flex-row-reverse">
        <section id="save_card" class=" container d-flex flex-column  align-items-center  justify-content-evenly  ">
            <?php if(!empty($userId)){
                if($row){ echo
                    '<h2>ID or email already exists!</h2>
                    <section class="text-center">
                        <a href="index.php"><h3  id="button_rect" class ="p-4 d-flex justify-contant-center align-items-center">back to to sign in page</h3></a>
                    </section>
                    <div class="container-log col-12 ">
                        <ul class="icon-list d-flex align-items-center  justify-content-evenly">
                            <li>
                                <i class="fa-solid fa-database"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-bottle-water"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-box-open"></i>
                            </li>
                        </ul>
                    </div>';
                }

                if((!$row) && $result2){ echo
                    '<h2>Welcome to cycle !</h2>
                    <section class="text-center">
                        <a href="index.php"><h3  id="button_rect" class ="p-4 d-flex justify-contant-center align-items-center">back to sign in page to sign in and start cycling!</h3></a>
                    </section>
                    <div class="container-log col-12 ">
                        <ul class="icon-list d-flex align-items-center  justify-content-evenly">
                            <li>
                                <i class="fa-solid fa-database"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-bottle-water"></i>
                            </li>
                            <li>
                                <i class="fa-solid fa-box-open"></i>
                            </li>
                        </ul>
                    </div>';
                }
                }
                ?>
        </section>
        </main>
    </body>
</html>
<?php

        mysqli_close($connection);
?>