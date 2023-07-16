<?php
    include 'db.php';
    session_start();
    if (!isset($_SESSION["user_id"])) {
        header('Location: index.php');
        exit();
    }
    if (!empty($_POST["milestoneName"])) {
        $milestoneName = $_POST['milestoneName'];
        $endDate = $_POST['endDate'];
        $bottles = $_POST['bottles'];
        $cans = $_POST['cans'];
        $boxes = $_POST['boxes'];
        $galleryBadge = $_POST['galleryBadge'];

        $query = "INSERT INTO tbl_221_milestones (milestone_name, end_date, bottles, cans, boxes, milestone_photo) 
                  VALUES ('$milestoneName', '$endDate', '$bottles', '$cans', '$boxes', '$galleryBadge')";
        
        if (!mysqli_query($connection, $query)) {
            echo "Error inserting data: " . mysqli_error($connection);
        }
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
        $query2 = "SELECT * FROM tbl_221_milestones";
        $result2 = mysqli_query($connection, $query2);
        if ($result2) {
            $row2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        } else {
            echo "Failed to retrieve data from the database.";
        }
    } else {
        echo "Email is missing.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cycle-form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <script src="https://use.fontawesome.com/2491eb7d5e.js"></script>
    <title>Milestomes</title>
</head>
<body>
    <header class="d-flex align-items-center ">
        <a href="list_page.html" id="logo" class="me-auto ms-5"></a>
        <a href="#" class="me-5 d-none d-md-inline" id="user">
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
                        <a href="#" id="profile"><img src="images/Dovrat.jpeg" alt="dovrat">
                            <p>profile</p>
                        </a>
                    </li>
                    <li><a href="#"><i class="bi bi-house-door-fill fa-2xl"></i>
                            <p>Home</p>
                        </a></li>
                    <li><a href="list_page.html" id="humburger-selected"><i class="bi bi-trophy-fill fa-2xl"></i>
                            <p>Milestones</p>
                        </a></li>
                    <li><a href="#"><i class="bi bi-people-fill fa-2xl"></i>
                            <p>Users</p>
                        </a></li>
                    <li>
                        <a href="#"> <i class="bi bi-chat-left-text-fill fa-2xl"></i>
                            <P>Friend zone</P>
                        </a>
                    </li>
                </ul>
                <ul id="aside-utils" class="d-flex flex-column justify-content-evenly ">
                    <li><a href="#"><i class="bi bi-gear-fill fa-2xl"></i>
                            <p>Settings</p>
                        </a></li>
                    <li>
                        <a href="#"> <i class="bi bi-box-arrow-in-right fa-2xl"></i>
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
                <li><a href="list_page.html" id="aside-selected"><i class="bi bi-trophy-fill fa-2xl"></i></a></li>
                <li><a href="#"><i class="bi bi-people-fill fa-2xl"></i></a></li>
                <li>
                    <a href="#"> <i class="bi bi-chat-left-text-fill fa-2xl"></i> </a>
                </li>
            </ul>
        </aside>

        <div id="wrapper" class="container">

            <section class="bread d-none d-md-block  mt-3 mb-3">
                <a href="#" class="selected">Home</a>
                <label>/ Milestones</label>
            </section>

            <h1 class="text-center container-fluid mt-5 mb-5">Milestones</h1>
            <?php
            if($row['user_type'] == "admin"){
                echo
                '<section class=" container.fluid d-flex mb-5 ms-3 ">
                    <a href="cycle-form.php" id="new-milestone" class=" d-flex align-items-center">
                        <i class="bi bi-plus-lg me-1 ms-3"></i>
                        <label class=" col-2 me-3">New Milestone</label>
                    </a>
                    <a href="#" class="d-flex align-items-center ms-2" id="edit">
                        <i class="bi bi-pencil-square ms-3 me-2"></i>
                        <label class="me-3">Edit</label>
                    </a>
                    <a href="#" class="d-flex align-items-center ms-2" id="edit">&nbsp
                        <i class="bi bi-x-circle ms-2"></i>
                        <label class="me-3"> &nbspDelete</label>
                    </a>
                </section>';
            }
            ?>

            <article class="container">
                <?php
                    foreach($row2 as $rows2){
                        echo '<section class="d-flex justify-content-evenly align-items-center milestone-rectangle container">';
                        echo '<section class="col-md-3 left-list">';
                        echo '<a href="milestone.php?milestone_id='.$rows2["milestone_id"].'"><i class="bi bi-info-circle"></i></a><br>';
                        echo        '<h5>"'.$rows2["milestone_name"].'"</h5>';
                        echo        '<h5>Until: '.$rows2["end_date"]. '</h5>';
                        echo    '</section>';
                        echo     '<ul class="middle-list d-flex align-items-center justify-content-evenly col-6">';
                        echo         '<li>';
                        echo             '<i class="fa-solid fa-database"></i>';
                        echo             '<span class="text">'.$rows2["cans"].'</span>';
                        echo         '</li>';
                        echo         '<li>';
                        echo             '<i class="fa-solid fa-bottle-water"></i>';
                        echo             '<span class="text">'.$rows2["bottles"].'</span>';
                        echo         '</li>';
                        echo         '<li>';
                        echo             '<i class="fa-solid fa-box-open"></i>';
                        echo             '<span class="text">'.$rows2["boxes"].'</span>';
                        echo         '</li>';
                        echo     '</ul>';
                        echo     '<section class="col-3 d-none right-list d-md-flex flex-column align-items-center">';
                        echo         '<label class="badge" for="buttles up!">Badge</label>';
                        echo         '<img src="'.$rows2["milestone_photo"].'" alt="milestone photo">';
                        echo     '</section>';
                        echo     '</section>';
                    }
                ?>
            </article>
        </div>
    </main>
    <footer class="container-fluid fixed-bottom d-flex d-md-none">
        <ul id="footer-links" class="mt-3 d-flex align-items-center justify-content-evenly">
            <li><a href="#"><i class="bi bi-house-door-fill fa-2xl"></i> </a></li>
            <li><a href="list_page.html" id="aside-selected"><i class="bi bi-trophy-fill fa-2xl"></i></a></li>
            <li><a href="#"><i class="bi bi-people-fill fa-2xl"></i></a></li>
            <li>
                <a href="#"> <i class="bi bi-chat-left-text-fill fa-2xl"></i> </a>
            </li>
        </ul>
    </footer>
</body>
</html>
<?php
    mysqli_close($connection);
?>