<?php 
    include "db.php";
    include 'config.php';
    session_start();
    if (!isset($_SESSION["user_id"])) {
        header('Location: index.php');
        exit();
    }

    include 'db.php';

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $query = "SELECT * FROM tbl_221_users WHERE email = '" . $email . "'";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Failed to retrieve data from the database.";
        }
    }

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if(mysqli_connect_errno()) {
        die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" );
    }
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
    <title>edit user</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <header class="d-flex align-items-center ">
        <a href="list_page.php" id="logo" class="me-auto ms-5"></a>
        <a href="user-profile.php" class="me-5 d-none d-md-inline" id="user">
            <label><?php echo $row['name']; ?></label>
            <img src=<?php echo $row['users_picture']; ?> alt="user photo">
        </a>
        <button class="navbar-toggler fa-solid fa-bars fa-2xl navbar-toggler-icon me-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"></button>
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="  d-flex flex-column justify-content-evenly">
                    <li>
                        <a href="user-profile.php" id="profile"><img src=<?php echo $row['users_picture']; ?> alt="user photo">
                            <p>profile</p>
                        </a>
                    </li>
                    <li><a href="<?php if($_SESSION['user_type']=='student'){
                        echo "student_home_page.php";
                    }else{echo "list_page.php";}
                    ?>"><i class="bi bi-house-door-fill fa-2xl"></i><p>Home</p></a></li>
                    <li><a href="list_page.php"><i class="bi bi-trophy-fill fa-2xl"></i><p>Milestones</p></a></li>
                    <li><a href="#"><i class="bi bi-people-fill fa-2xl"></i><p>Users</p></a></li>
                    <li>
                        <a href="#"> <i class="bi bi-chat-left-text-fill fa-2xl"></i>
                            <P>Friend zone</P>
                        </a>
                    </li>
                </ul>
                <ul id="aside-utils" class="d-flex flex-column justify-content-evenly ">
                    <li><a href="#"><i class="bi bi-gear-fill fa-2xl"></i><p>Settings</p></a></li>
                    <li>
                        <a href="index.php"> <i class="bi bi-box-arrow-in-right fa-2xl"></i>
                            <p>Exit</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
   
    <main class="d-flex flex-row-reverse">
        <aside class="d-md-flex d-none d-md-inline d-flex flex-column  ">
            <ul id="aside-links" class="d-flex  flex-column justify-content-around">
                <li><a href="#"><i class="bi bi-house-door-fill fa-2xl"></i> </a></li>
                <li><a href="list_page.php" id="aside-selected"><i class="bi bi-trophy-fill fa-2xl"></i></a></li>
                <li><a href="#"><i class="bi bi-people-fill fa-2xl"></i></a></li>
                <li>
                    <a href="#"> <i class="bi bi-chat-left-text-fill fa-2xl"></i> </a>
                </li>
            </ul>
        </aside>

        <div id="wrapper" class="container">

            <section class="bread d-none d-md-block  mt-3 mb-3">
                <a href="#" class="selected">Home</a>
                <label>/ Edit profile details</label>
            </section>


            <form action="save-changes-user.php" method="post">
                <div class="form-floating mb-3 col-12">
                    <input type="text" class="form-control required" pattern="[A-Za-z]+\s[A-Za-z]+*"  <?php echo 'value ="'.$row["name"].'"';?> name="username" placeholder="username" for="name" required><label required>username</label>
                </div>
                <div class="form-floating mb-3 col-12">
                    <input type="email" class="form-control required"  <?php echo 'value ="'.$row["email"].'"';?> name="email" placeholder="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" for="email" required><label>email</label>
                </div>
                <div class="form-floating mb-3 col-12">
                    <input type="tel" class="form-control required"  <?php echo 'value ="'.$row["phone"].'"';?> name="phone" placeholder="phone"  pattern = "[0-9]{10}"  for="phone" required><label>phone number</label>
                </div>
                <section class="container-fluid d-flex justify-content-center">
                    <button id="share-btn" type="submit" class="btn btn-success mt-5 col-8 col-md-4 align-self-center" data-bs-toggle="modal" data-bs-target="#exampleModal">submit changes</button>
                </section>
            </form>
        </div> 
    </main>
    <footer class="container-fluid fixed-bottom d-flex d-md-none">
        <ul id="footer-links" class="mt-3 d-flex align-items-center justify-content-evenly">
            <li><a href="<?php if($_SESSION['user_type']=='student'){
                        echo "student_home_page.php";
                    }else{echo "list_page.php";}
                    ?>"><i class="bi bi-house-door-fill fa-2xl"></i> </a></li>
            <li><a href="list_page.php" id="aside-selected"><i class="bi bi-trophy-fill fa-2xl"></i></a></li>
            <li><a href="#"><i class="bi bi-people-fill fa-2xl"></i></a></li>
            <li>
                <a href="#"> <i class="bi bi-chat-left-text-fill fa-2xl"></i> </a>
            </li>
        </ul>
    </footer>
</body>
</html>