<?php
include 'db.php';
include 'config.php';
session_start();

if(!isset($_SESSION["user_id"])) {
    header('Location: '.URL.'index.php');
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
    <script src ="js/validation.js"></script>
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
        <a href="#" class="me-5 d-none d-md-inline" id="user">
            <label>
                <?php echo $row['name']; ?>
            </label>
            <img src=<?php echo $row['users_picture']; ?> alt="user photo">
        </a>
        <button class="navbar-toggler fa-solid fa-bars fa-2xl navbar-toggler-icon me-4" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"></button>
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
            id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
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
                    <li><a href="#"><i class="bi bi-house-door-fill fa-2xl me-3"></i>Home</a></li>
                    <li><a href="list_page.php" class="selected"><i class="bi bi-trophy-fill fa-2xl me-3 "></i>Milestones</a></li>
                    <li><a href="#"><i class="bi bi-people-fill fa-2xl me-3"></i>Users</a></li>
                    <li><a href="#"> <i class="bi bi-chat-left-text-fill fa-2xl me-3"></i>Friend zone</a> </li>
                </ul>

                <ul id="aside-utils" class="d-flex flex-column justify-content-evenly ">
                    <li><a href="#"><i class="bi bi-gear-fill fa-2xl me-3"></i>Settings</a></li>
                    <li><a href="#"> <i class="bi bi-box-arrow-in-right fa-2xl me-3"></i>Exit</a></li>
                </ul>
            </div>
        </div>

    </header>
    <main class="d-flex flex-row-reverse">
        <aside class="d-md-flex d-none d-md-inline d-flex flex-column  ">
            <ul id="aside-links" class="d-flex  flex-column justify-content-around">
                <li><a href="#"><i class="bi bi-house-door-fill fa-2xl"></i> </a></li>
                <li><a href="list_page.php" class="selected"><i class="bi bi-trophy-fill fa-2xl "></i></a></li>
                <li><a href="#"><i class="bi bi-people-fill fa-2xl"></i></a></li>
                <li>
                    <a href="#"> <i class="bi bi-chat-left-text-fill fa-2xl"></i> </a>
                </li>
            </ul>
        </aside>

        <div id="wrapper" class="container">

            <section class="bread d-none d-md-block  mt-3 mb-3">
                <a href="student_home_page.php" class="selected">Home</a>
                <label>/ Manual Insertion</label>
            </section>
            <form action="" method="POST" >
            <div class="form-floating mb-3 col-12">
                            <input type="text" class="form-control required" id="milestoneName" <?php if (isset($flag)) {
                                echo 'value ="' . $row3["milestone_name"] . '"';
                            } ?> name="milestoneName"
                                placeholder="Milestone Name"><label for="milstoneName">Milestone Name</label>
                        </div>
            <div class="item-goal mt-5 ">
                            <h3 class = "text-center">Items Collected</h3>
                            <label id="warning-label" class="mb-3 d-flex justify-content-center">*Must have at least one item</label>
                            <section class="row container-fluid d-flex justify-content-center mb-5 ">
                                <div class="col-12 col-md-8 ">
                                    <div class="input-group ">
                                        <input type="number" name="bottles" class="form-control " id="numOfPlastics"
                                            placeholder="Number of plastics " <?php if (isset($flag)) {
                                                echo 'value ="' . $row3["bottles"] . '"';
                                            } ?> aria-label="Input group example "
                                            aria-describedby="bottles " min=0>
                                        <span class="input-group-text " id="bottles ">
                                            <i class="fa-solid fa-bottle-water fa-lg "></i>
                                        </span>
                                    </div>
                                </div>
                            </section>
                            <section class="row mb-5 container-fluid d-flex justify-content-center ">
                                <div class="col-12 col-md-8 ">
                                    <div class="input-group ">
                                        <input type="number" name="cans" class="form-control" id="numOfCans"
                                            placeholder="Number of cans " <?php if (isset($flag)) {
                                                echo 'value ="' . $row3["cans"] . '"';
                                            } ?> aria-label="Input group example "
                                            aria-describedby="cans " min=0>
                                        <span class="input-group-text " id="cans ">
                                            <i class="bi bi-database-fill fa-lg "></i>
                                        </span>
                                    </div>
                                </div>
                            </section>
                            <section class="row mb-5 container-fluid d-flex justify-content-center ">
                                <div class="col-12 col-md-8 ">
                                    <div class="input-group ">
                                        <input type="number" name="boxes" class="form-control" id="numOfBoxes"
                                            placeholder="Number of cardboards " <?php if (isset($flag)) {
                                                echo 'value ="' . $row3["boxes"] . '"';
                                            } ?> aria-label="Input group example "
                                            aria-describedby="boxes " min=0>
                                        <span class="input-group-text " id="boxes ">
                                            <i class="fa-solid fa-box-open fa-lg "></i>
                                        </span>
                                    </div>
                                </div>
                            </section>
                            <div class="input-group d-flex row justify-content-center mb-3" id="datepicker">
                                <section class = "col-4">

                                    <input type="date" class="form-control " id="Date" name="Date" <?php if (isset($flag)) {
                                        echo 'value = ' . date($row3["end_date"]);
                                    } ?>
                                            placeholder="End date" aria-label="Input group example"
                                            aria-describedby="datepicker">
                                        </div>
                                    </section>
                        </div>
                        <section class ="d-flex row justify-content-center">

                        <button id="share-btn" type="button" class="btn btn-success mt-5 col-8 col-md-4 align-self-center"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">Submit</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span>Just to make sure...</span>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span> Are you sure you your milestone is ready to be submtted?</span>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" id="btnform" name="submit" value="submit"
                                    class="btn btn-success">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
                        </section>
            </form>



        </div>
    </main>
    <footer class="container-fluid fixed-bottom d-flex d-md-none">
        <ul id="footer-links" class="mt-3 d-flex align-items-center justify-content-evenly">
            <li><a href="#"><i class="bi bi-house-door-fill fa-2xl"></i> </a></li>
            <li><a href="list_page.php" ><i class="bi bi-trophy-fill fa-2xl selected"></i></a></li>
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

