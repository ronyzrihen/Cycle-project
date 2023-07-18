<?php
include 'db.php';
include 'config.php';
session_start();
if (!empty($_POST["loginMail"])) {
    $query = "SELECT * FROM tbl_221_users WHERE email='"
        . $_POST["loginMail"]
        . "' and password = '"
        . $_POST["loginPass"]
        . "'";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Can't connect to the database");
    }
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
        $_SESSION["user_id"] = $row['id'];
        $_SESSION["user_type"] = $row['user_type'];
        $_SESSION["email"] = $_POST["loginMail"];
        header('Location: list_page.php');
        exit();
    } else {
        $message = "Invalid Username or Password!";
    }
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
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cycle-form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://use.fontawesome.com/2491eb7d5e.js"></script>
    <script src="js/script.js"></script>
    <title>Login to Cycle</title>
</head>

<body>
    <div id="wrapper" class="container-fluid d-flex flex-column align-items-center">
        <section id = "login-logo-icon">
            <img class="login-logo" src="./images/cycle-logo.png" alt="Logo">
        </section>
        <section id="login" class="d-flex flex-column container  col-md-6 justify-content-evenly">
            <form action="" method="post" id="frm" class ="d-flex flex-column align-items-center container-fluid">
                <div class="mb-3 container col-lg-6 col-12">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="loginMail" class="form-control col-12 " id="exampleInputEmail1" placeholder="Please enter your email address"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 container col-lg-6">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="loginPass" class="form-control col-12 mb-3" id="exampleInputPassword1" placeholder="Please enter your password"> 
                </div>
                <button type="submit" class="btn btn-outline-success col-4 fix">Log me in!</button>
                <div class="error-message">
                    <?php if (isset($message)) {
                        echo $message;
                    } ?>
                </div>
            </form>
            <div class="container-log ">
                <ul class="icon-list d-flex align-items-center justify-content-evenly">
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
            </div>
        </section>
    </div>
</body>

</html>
<?php
mysqli_close($connection);
?>

