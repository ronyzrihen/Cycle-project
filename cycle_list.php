<?php
include 'db.php';
include 'config.php';
session_start();
if(!isset($_SESSION["user_id"])) {
    header('Location: ' . URL . 'index.php');
}
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT * FROM tbl_221_users WHERE email = '" . $email . "'";
    $result = mysqli_query($connection, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Failed to get data from the database.";
    }
    $query2 = "SELECT * FROM dbShnkr23stud2.tbl_221_cycles WHERE userID ='".$_SESSION['user_id']."';";
} else {
    echo "Email is missing.";
}

$result2 = mysqli_query($connection, $query2);
if ($result2) {
    $row2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
} else {
    echo "Failed to retrieve data from the database.";
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
    <title>cycles</title>
</head>

<body>
    <header class="d-flex align-items-center ">
        <a href="list_page.php" id="logo" class="me-auto ms-5"></a>
        <a href="user_profile.php" class="me-5 d-none d-md-inline" id="user">
            <label>
                <?php echo $row['name']; ?>
            </label>
            <img src=<?php echo $row['users_picture']; ?> alt="<?php echo $row['name'];?>">
        </a>
        <button class="navbar-toggler fa-solid fa-bars fa-xl navbar-toggler-icon me-4" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"></button>
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
            id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="  d-flex flex-column justify-content-evenly">
                    <li>
                        <a href="user_profile.php" id="profile" class="d-flex align-items-center"><img src="<?php echo $row['users_picture'];?>" alt="<?php echo $row['name'];?>">
                            <p class = "ms-3">profile</p>
                        </a>
                    </li>
                    <li><a href="<?php if($_SESSION['user_type']=='student'){
                        echo "student_home_page.php";
                    }else{echo "#";}
                    ?> "><i class="bi bi-house-door-fill fa-xl me-3"></i>Home</a></li>
                    <li><a href="list_page.php" ><i class="bi bi-trophy-fill fa-xl me-3 "></i>Milestones</a></li>
                   <?php
                   if($_SESSION['user_type']=="student"){
                       echo '<li><a href="#" class="selected"><i class="bi bi-recycle fa-xl me-3"></i>Cycles</a></li>';
                    }
                       ?>
                    <li><a href="#"><i class="bi bi-people-fill fa-xl me-3"></i>Users</a></li>
                    <li><a href="#"> <i class="bi bi-chat-left-text-fill fa-xl me-3"></i>Friend zone</a> </li>
                </ul>

                <ul id="aside-utils" class="d-flex flex-column justify-content-evenly ">
                    <li><a href="#"><i class="bi bi-gear-fill fa-xl me-3"></i>Settings</a></li>
                    <li><a href="index.php"> <i class="bi bi-box-arrow-in-right fa-xl me-3"></i>Exit</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main class="d-flex flex-row-reverse">
        <aside class="d-md-flex d-none d-md-inline d-flex flex-column  ">
            <ul id="aside-links" class="d-flex  flex-column justify-content-around">
                <li><a href="<?php if($_SESSION['user_type']=='student'){
                        echo "student_home_page.php";
                    }else{echo "#";}
                    ?>"><i class="bi bi-house-door-fill fa-xl"></i> </a></li>
                <li><a href="list_page.php" ><i class="bi bi-trophy-fill fa-xl"></i></a></li>
                
                <?php
                   if($_SESSION['user_type']=="student"){
                       echo '<li><a href="cycle_list.php" ><i class="bi bi-recycle selected fa-xl"></i></a></li>';
                    }
                       ?>
                
                <li><a href="#"><i class="bi bi-people-fill fa-xl"></i></a></li>
                <li>
                    <a href="#"> <i class="bi bi-chat-left-text-fill fa-xl"></i> </a>
                </li>
            </ul>
        </aside>

        <div id="wrapper" class="container">

            <section class="bread d-none d-md-block  mt-3 mb-3">
                <a href="student_home_page.php" class="selected">Home</a>
                <label>/ Cycles</label>
            </section>

            <h1 class="text-center container-fluid mt-5 mb-5">Cycles</h1>
        

            <article class="container">
                <?php
                foreach ($row2 as $rows2) {
                    echo '<section class="d-flex justify-content-evenly align-items-center milestone-rectangle container instance">';
                    echo    '<section class="col-md-3 left-list col-4">';
                    echo        '<section class= "d-flex mb-4" >';
                    echo        '<a href="manual_insertion.php?instanceId=' . $rows2["cycleID"] . '" class = "me-3"><i class="bi bi-pencil-square"></i></a><br>';
                    echo        '<a href="save_instance.php?instanceId=' . $rows2["cycleID"] . '&del=1"><i class="bi bi-x-circle"></i></a><br>';
                    echo        '</section>';
                    echo        '<h5>"' . $rows2["cycle_name"] . '"</h5>';
                    echo        '<h5 class = "d-none d-md-block" >Date: ' . $rows2["cycleDate"] . '</h5>';
                    echo    '</section>';
                    echo    '<ul class="middle-list d-flex align-items-center justify-content-evenly col-6 col-md-8">';
                    echo        '<li class="d-flex flex-column align-items-center">';
                    echo            '<i class="fa-solid fa-database"></i>';
                    echo            '<span class="text-center">' . $rows2["cans"] . '</span>';
                    echo        '</li>';
                    echo        '<li class="d-flex flex-column align-items-center">';
                    echo            '<i class="fa-solid fa-bottle-water"></i>';
                    echo            '<span class="text-center">' . $rows2["bottles"] . '</span>';
                    echo        '</li>';
                    echo        '<li class="d-flex flex-column align-items-center">';
                    echo            '<i class="fa-solid fa-box-open"></i>';
                    echo            '<span class="text-center">' . $rows2["boxes"] . '</span>';
                    echo        '</li>';
                    echo    '</ul>';
                    echo '</section>';
                }
                ?>
            </article>
        </div>
    </main>
    <footer class="container-fluid fixed-bottom d-flex d-md-none">
        <ul id="footer-links" class="mt-3 d-flex align-items-center justify-content-evenly">
            <li><a href="<?php if($_SESSION['user_type']=='student'){
                        echo "student_home_page.php";
                    }else{echo "#";}
                    ?>"><i class="bi bi-house-door-fill fa-xl"></i> </a></li>
            <li><a href="list_page.php" ><i class="bi bi-trophy-fill fa-xl"></i></a></li>
            <?php
                   if($_SESSION['user_type']=="student"){
                       echo '<li><a href="cycle_list.php" ><i class="bi bi-recycle selected fa-xl"></i></a></li>';
                    }
                       ?>
            <li><a href="#"><i class="bi bi-people-fill fa-xl"></i></a></li>
            <li>
                <a href="#"> <i class="bi bi-chat-left-text-fill fa-xl"></i> </a>
            </li>
        </ul>
    </footer>
</body>
</html>
<?php
mysqli_close($connection);
?>

