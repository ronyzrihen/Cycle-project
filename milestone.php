<?php 
   include 'db.php';
   include 'config.php';
   session_start();
   
   if(!isset($_SESSION["user_id"])) {
       header('Location: '.URL.'index.php');
   }

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $query2 = "SELECT * FROM tbl_221_users WHERE email = '" . $email . "'";
        $result2 = mysqli_query($connection, $query2);
        if ($result2) {
            $row2 = mysqli_fetch_assoc($result2);
        } else {
            echo "Failed to retrieve data from the database.";
        }
    }

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if(mysqli_connect_errno()) {
        die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")" );
    }
    $milestone_id = $_GET["milestone_id"];
    $query  = "SELECT * FROM tbl_221_milestones inner join tbl_221_badges using(badge_id) WHERE milestone_id=" . $milestone_id;
    $result = mysqli_query($connection, $query);
    if($result) {
        $row = mysqli_fetch_assoc($result);
    }
    else die("DB query failed.");

    $query3 = "SELECT * FROM tbl_221_statistics where milestone_id=" . $milestone_id;
    $result3 = mysqli_query($connection, $query3);

    $yValues = [];
    if($result3){
        $row3 = mysqli_fetch_assoc($result3);
        $yValues[0] = $row3['finished'];
        $yValues[1] = $row3['did_not_finish'];
        $yValues[2] = $row3['did_not_participate'];
    }
    else die("DB query failed.");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <script src="https://use.fontawesome.com/2491eb7d5e.js"></script>
    <title><?php echo $row["milestone_name"];?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="js/diagram.js"></script>
</head>

<body>
<header class="d-flex align-items-center ">
        <a href="list_page.php" id="logo" class="me-auto ms-5"></a>
        <a href="#" class="me-5 d-none d-md-inline" id="user">
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
                        <a href="#" id="profile" class="d-flex align-items-center"><img src="<?php echo $row['users_picture'];?>" alt="<?php echo $row['name'];?>">
                            <p class = "ms-3">profile</p>
                        </a>
                    </li>
                    <li><a href="<?php if($_SESSION['user_type']=='student'){
                        echo "student_home_page.php";
                    }else{echo "#";}
                    ?> "><i class="bi bi-house-door-fill fa-xl me-3"></i>Home</a></li>
                    <li><a href="list_page.php" ><i class="bi bi-trophy-fill selected fa-xl me-3 "></i>Milestones</a></li>
                   <?php
                   if($_SESSION['user_type']=="student"){
                       echo '<li><a href="cycle_list.php" ><i class="bi bi-recycle fa-xl me-3"></i>Cycles</a></li>';
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
                <li><a href="list_page.php" ><i class="bi bi-trophy-fill selected fa-xl"></i></a></li>
                
                <?php
                   if($_SESSION['user_type']=="student"){
                       echo '<li><a href="cycle_list.php" ><i class="bi bi-recycle  fa-xl"></i></a></li>';
                    }
                       ?>
                
                <li><a href="#"><i class="bi bi-people-fill fa-xl"></i></a></li>
                <li>
                    <a href="#"> <i class="bi bi-chat-left-text-fill fa-xl"></i> </a>
                </li>
            </ul>
        </aside>
        <div id="wrapper" class="container-fluid">
            <section class="bread d-none d-md-block  mt-3 mb-3">
                <a href="#" class="selected">Home</a>
                <a href="list_page.php" class="selected">/ Milestones</a>
                <label>/ <?php echo $row['milestone_name']; ?></label>
            </section>
            <h1 class="text-center container-fluid mt-5 mb-5">It's all the same</h1><br><br>
            <section class="d-md-flex ">
                <section>
                    <div class="p-3 mb-2 col-12 bg-white text-dark text-center text-md-start">Milestones name:
                        <span class="color"> &nbsp <?php echo $row['milestone_name']; ?></span>
                    </div>
                    <div class="p-3 mb-2 col bg-white text-dark text-center text-md-start">End date:
                        <label class="color"> &nbsp <?php echo $row['end_date']; ?></label>
                    </div>
                    <div class="p-3 mb-2 col bg-white text-dark text-center text-md-start">Cans:
                        <label class="color">&nbsp <?php echo $row['cans']; ?> <i class="fa-solid fa-database"></i></label>
                    </div>
                    <div class="p-3 mb-2 col bg-white text-dark text-center text-md-start">Bottles:
                        <label class="color">&nbsp <?php echo $row['bottles']; ?><i class="fa-solid fa-bottle-water"></i></label>
                    </div>
                    <div class="p-3 mb-2 col bg-white text-dark text-center text-md-start">Cardboards:
                        <label class="color">&nbsp <?php echo $row['boxes']; ?> <i class="fa-solid fa-box-open"></i></label>
                    </div>
                    <div class="p-3 mb-2 col bg-white text-dark text-center text-md-start">Badge: &nbsp
                        <img id="imgsizes" src="<?php echo $row['badge_photo_path']; ?>" alt="spiderman">
                    </div>
                </section>
                <section class="container col-md-8 col-12">
                    <canvas id="myChart"></canvas>
                </section>
            </section>
        </div>
    </main>
    <footer class="container-fluid fixed-bottom d-flex d-md-none">
        <ul id="footer-links" class="mt-3 d-flex align-items-center justify-content-evenly">
            <li><a href="<?php if($_SESSION['user_type']=='student'){
                        echo "student_home_page.php";
                    }else{echo "#";}
                    ?>"><i class="bi bi-house-door-fill fa-xl"></i> </a></li>
            <li><a href="list_page.php" ><i class="bi bi-trophy-fill selected fa-xl"></i></a></li>
            <?php
                   if($_SESSION['user_type']=="student"){
                       echo '<li><a href="cycle_list.php" ><i class="bi bi-recycle  fa-xl"></i></a></li>';
                    }
                       ?>
            <li><a href="#"><i class="bi bi-people-fill fa-xl"></i></a></li>
            <li>
                <a href="#"> <i class="bi bi-chat-left-text-fill fa-xl"></i> </a>
            </li>
        </ul>
    </footer>
    <script>
        diagram(<?php echo json_encode($yValues); ?>);
    </script>
</body>
</html>
<?php
    mysqli_close($connection);
?>
