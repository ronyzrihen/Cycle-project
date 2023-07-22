<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cycle-form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://use.fontawesome.com/2491eb7d5e.js"></script>
    <title>create user</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <section id = "login-logo-icon" class="d-flex justify-contant-center  container-fluid">
        <img class="login-logo" src="./images/cycle-logo.png" alt="Logo">
    </section>
    <main class="d-flex flex-row-reverse mt-5">

        <div id="wrapper" class="container mt-5">

            <form action="save-create-user.php" method="post">
                <div class="form-floating mb-3 col-12">
                    <input type="text" class="form-control required" name="id" pattern = "[0-9]+" for="id" required><label>ID number</label>
                </div>
                <div class="form-floating mb-3 col-12">
                    <input type="text" class="form-control required" name="username"  for="name" pattern="[A-Za-z]+\s[A-Za-z]+*" required><label>username</label>
                </div>
                <div>
                <div class="form-floating mb-3 col-12">
                    <input type="password" name="pass" for="pass" class="form-control" pattern=".{8,}" required><label>password - at least 8 characters</label>
                </div>
                <div class="form-floating mb-3 col-12">
                    <input type="email" class="form-control required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" for="email" required><label>email - example@...</label>
                </div>
                <div class="form-floating mb-3 col-12">
                    <input type="tel" class="form-control required" name="phone" pattern = "[0-9]{9,10}" for="phone" required><label>phone number</label>
                </div>
                <div class="form-floating mb-3 col-12">
                    <input type="text" class="form-control required" name="address"  for="name" pattern="[A-Za-z]+\s[A-Za-z]+*" required><label>address</label>
                </div>
                <section class="container-fluid d-flex justify-content-center">
                    <button id="share-btn" type="submit" class="btn btn-success mt-5 col-8 col-md-4 align-self-center" data-bs-toggle="modal" data-bs-target="#exampleModal">submit changes</button>
                </section>
            </form>
        </div> 
    </main>
</body>
</html>