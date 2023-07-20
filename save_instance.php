<?php
include 'db.php';
include 'config.php';
session_start();

if(!isset($_SESSION["user_id"])) {
    header('Location: '.URL.'index.php');
}

if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $query = "SELECT * FROM tbl_221_users WHERE email = '" . $email . "'";
    $result = mysqli_query($connection, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Failed to get data from the database.";
    }
}

if (!empty($_POST["Name"])) {
    $instanceName = $_POST['Name'];
    $cycleDate = $_POST['Date'];
    $bottles = $_POST['bottles'];
    $cans = $_POST['cans'];
    $boxes = $_POST['boxes'];
    


   
    if (!empty($_POST['instanceId']) && empty($_GET["del"])) {
        $query = "UPDATE dbShnkr23stud2.tbl_221_cycles SET milestoneID = '".$_POST['instanceId']."', cans = '".$cans."', bottles = '".$bottles."', boxes = '".$boxes."' ,cycleDate ='".$cycleDate."' WHERE cycleID = '" . $_POST['instanceId'] . "';";
        echo $query;
    } else {
            $query = "INSERT INTO dbShnkr23stud2.tbl_221_cycles (userID,milestoneID,cycle_name, cans, bottles, boxes, cycleDate) VALUES 
                ('".$_SESSION['user_id']."', '".$_POST['instanceId']."','$instanceName', '$cans', '$bottles', '$boxes', '$cycleDate')";
        echo $query;
    }
    
    
    
} else {
    if (!empty($_GET['instanceId']) && !empty($_GET["del"])) {
        
        $query = 'DELETE FROM tbl_221_cycles WHERE cycleID = ' . $_GET['instanceId'] . ';';
    
        }
    }
    if (!mysqli_query($connection, $query)) {
        echo "Error inserting data: " . mysqli_error($connection);
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
        <title>saved!</title>
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
    
    
    <section id="save_card" class=" container d-flex flex-column  align-items-center  justify-content-evenly  ">
        
    <?php
           

                
           if (isset($_POST['instance'])) {
               echo "<h1 class='text-center'>Cycle was updated succesfuly!</h1>";
           } elseif (!empty($_GET['instanceId']) && !empty($_GET["del"])) {
               echo " <h1 class='text-center'>Cycle was deleted succesfuly!</h1>";
           } else {
               echo "<h1 class='text-center'>Cycle was added succesfuly!</h1>";
       }
   
   
       ?>

<section id="save_card" class=" container d-flex flex-column  align-items-center  justify-content-evenly  ">
    <h2>details updated !</h2>
    <section class="text-center">
        <a href="cycle_list.php"><h3  id="button_rect" class ="p-4 d-flex justify-contant-center align-items-center">Go back to Cycles</h3></a>
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
    </div>
</section>
</main>
<footer class="container-fluid fixed-bottom d-flex d-md-none">
        <ul id="footer-links" class="mt-3 d-flex align-items-center justify-content-evenly">
            <li><a href="<?php if($_SESSION['user_type']=='student'){
                        echo "student_home_page.php";
                    }else{echo "#";}
                    ?>"><i class="bi bi-house-door-fill fa-xl"></i> </a></li>
            <li><a href="list_page.php" ><i class="bi bi-trophy-fill  fa-xl"></i></a></li>
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


<?php

        mysqli_close($connection);
        ?>
</body>

</html>
