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
} else {
    echo "Email is missing.";
}

$query2 = "SELECT * FROM tbl_221_milestones INNER JOIN tbl_221_badges USING (badge_id);";

if (!empty($_GET['cat'])) {
    $cat = $_GET['cat'];
    $query2 = "SELECT * FROM tbl_221_milestones INNER JOIN tbl_221_badges USING (badge_id) ORDER BY $cat DESC;";
}
$result2 = mysqli_query($connection, $query2);
if (!$result2) {
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
    <script src="js/list.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cycle-form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://use.fontawesome.com/2491eb7d5e.js"></script>
    <title>Milestomes</title>
</head>
<body>
<header class="d-flex align-items-center ">
        <a href="list_page.php" id="logo" class="me-auto ms-5"></a>
        <a href="user-profile.php" class="me-5 d-none d-md-inline" id="user">
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
                        <a href="user-profile.php" id="profile" class="d-flex align-items-center"><img src="<?php echo $row['users_picture'];?>" alt="<?php echo $row['name'];?>">
                            <p class = "ms-3">profile</p>
                        </a>
                    </li>
                    <li><a href="<?php if($_SESSION['user_type']=='student'){
                        echo "student_home_page.php";
                    }else{echo "list_page.php";}
                    ?> "><i class="bi bi-house-door-fill fa-xl me-3"></i>Home</a></li>
                    <li><a href="list_page.php" ><i class="bi bi-trophy-fill selected fa-xl me-3 "></i>Milestones</a></li>
                   <?php
                   if($_SESSION['user_type']=="student"){
                       echo '<li><a href="cycle_list"><i class="bi bi-recycle fa-xl me-3"></i>Cycles</a></li>';
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
                    }else{echo "list_page.php";}
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
        <div id="wrapper" class="container">

            <section class="bread d-none d-md-block  mt-3 mb-3">
                <a href="#" class="selected">Home</a>
                <label>/ Milestones</label>
            </section>

            <h1 class="text-center container-fluid mt-5 mb-5">Milestones</h1>
            <section class=" container-fluid d-md-flex mb-5 ms-3 ">
               <section class = "container-fluid d-flex flex-wrap mr-auto">
                   <?php
                if ($row['user_type'] == "admin") {
                    echo
                    ' 
                    <a href="cycle-form.php" id="new-milestone" class=" mt-3 d-flex align-items-center">
                    <i class="bi bi-plus-lg me-1 ms-3"></i>
                    <label class=" col-2 me-3">New Milestone</label>
                    </a>
                    <button class="d-flex align-items-center mt-3  ms-2" id="edit">
                    <i class="bi bi-pencil-square ms-3 me-2"></i>
                    <label class="me-3">Edit</label>
                    </button>
                    <button  class="d-flex align-items-center mt-3 ms-2" id="delete">&nbsp
                    <i class="bi bi-x-circle ms-2"></i>
                    <label class="me-3"> &nbspDelete</label>
                    </button>
                    <button class="d-flex align-items-center d-none mt-3 ms-2" id="info">&nbsp
                    <i class="bi bi-info-circle ms-2"></i>
                    <label class="me-3"> &nbspDeselect</label>
                    </button>';
                }
                ?>
                </section>
                <button class="dropdown-toggle col-4  ps-4 pe-4 me-4 ms-3 ms-md-0 mt-3 mt-md-0" id="sort" type="button" data-bs-toggle="dropdown"
                aria-expanded="false"><?php if(!empty($cat)){
                    echo  $cat;
                }else{echo "Sort";}
                ?> </button>
                <ul class="dropdown-menu col-1 " id="drop">
                    <li><a class="dropdown-item" href="list_page.php">default</a></li>
                </ul>
            </section>



            <article class="container">

    
    <?php
     while($rows1 = mysqli_fetch_assoc($result2)){ 
        echo'
        <section class="d-flex justify-content-evenly align-items-center milestone-rectangle container instance">
            <section class="col-md-3 left-list">
                <a href="milestone.php?milestone_id='.$rows1["milestone_id"].'" id="milestone_link">
                    <i class="bi bi-info-circle replaceable_icon"></i>
                </a><br>
                <h5>'.$rows1["milestone_name"].'</h5>
                <h5 class="d-none d-md-block">  '.$rows1["end_date"].'</h5>
            </section>
            <ul class="middle-list d-flex align-items-center justify-content-evenly col-6">
                <li>
                    <i class="fa-solid fa-database"></i>
                    <span class="text">'.$rows1["cans"].'</span>
                </li>
                <li>
                    <i class="fa-solid fa-bottle-water"></i>
                    <span class="text">'.$rows1["bottles"].'</span>
                </li>
                <li>
                    <i class="fa-solid fa-box-open"></i>
                    <span class="text">'.$rows1["boxes"].'</span>
                </li>
            </ul>
            <section id="badge-section" class="col-3 d-none right-list d-md-flex flex-column align-items-center">
                <label class="badge" for="bottles up!">Badge</label>
                <img src="'.$rows1["badge_photo_path"].'" alt="milestone photo">
            </section>
        </section>
            ';}
    ?>

            </article>
        </div>
    </main>
    
    <footer class="container-fluid fixed-bottom d-flex d-md-none">
        <ul id="footer-links" class="mt-3 d-flex align-items-center justify-content-evenly">
            <li><a href="<?php if($_SESSION['user_type']=='student'){
                        echo "student_home_page.php";
                    }else{echo "list_page.php";}
                    ?>"><i class="bi bi-house-door-fill fa-xl"></i> </a></li>
            <li><a href="list_page.php" ><i class="bi bi-trophy-fill selected fa-xl"></i></a></li>
            <?php
                   if($_SESSION['user_type']=="student"){
                       echo '<li><a href="cycle_list.php" ><i class="bi bi-recycle  fa-xl"></i></a></li>';
                    }
                       ?>
            <li><a href="#"><i class="bi bi-people-fill fa-xl"></i></a></li>
            <li><a href="#"> <i class="bi bi-chat-left-text-fill fa-xl"></i></a></li>
        </ul>
    </footer>
</body>
</html>
<?php
mysqli_close($connection);
?>

