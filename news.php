<?php 
session_start();
require 'db/db.php';
$status ="";
if(isset($_POST['cmnt_submit'])){
    if(!isset($_SESSION['username'])){
        $status = "You must be logged in to comment";
    }
    else{
        $comment = $_POST['comment'];
        $news_id = $_REQUEST['id'];
        $user = $_SESSION['username'];
        $date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO comments (newsId, personName, cmnt, created_on) VALUES ('$news_id', '$user', '$comment', '$date')";
        $result = mysqli_query($db, $sql);
        if($result){
            $status = "Comment posted";
        }
        else{
            $status = "Comment not posted";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <!-- <div class="col-md-3"></div>
        <div class="col-md-6 well">
            <?php
            require 'db/db.php';
            if(ISSET($_REQUEST['id'])){
                $query = mysqli_query($db, "SELECT * FROM `news` WHERE `id` = '$_REQUEST[id]'") or die(mysqli_error());
                $row = mysqli_fetch_array($query);
        ?>
            <h3><?php echo $row['headline']?></h3>
            <p><?php echo nl2br($row['content'])?></p>
            <?php
            }
        ?>
            <a href="index.php" class="btn btn-success">Back</a>
        </div> -->

        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid ">
                    <a class="navbar-brand border border-dark border-3 rounded px-2" href="index.php"><b>Online News Portal</b></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ml-auto">
                            <!-- <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                                    </li> -->
                            <?php
    if (isset($_SESSION["username"])) {
        if ($_SESSION["username"] == "admin") { ?>
                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dashboard
                                </a>
                                <ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="admin/newsDashboard.php">View News</a></li>
                                    <li><a class="dropdown-item" href="admin/insertData.php">Insert News</a></li>
                                </ul>
                            </li>
                            <?php
        }
    }
    if (isset($_SESSION["username"])) { ?>
    
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Welcome <strong class="text-black"><?php echo $_SESSION["username"]; ?></strong>
                                </a>
                                <ul class="dropdown-menu bg-danger" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item bg-danger text-white fw-bold text-center" href="index.php?logout='1'">logout</a></li>
                                </ul>
                            </li>
                            <?php
    }
    else { ?>
                            <li class="nav-item">
                                <a class="btn btn-outline-primary fw-bold" class="nav-link text-primary" href="login.php">Login</a>
                            </li>
    
                            <?php
    }
    ?>
    
                    </div>
                </div>
            </nav>
            <div class="row mt-3">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?php require "db/db.php"; 
                        $news_query = "select * from news where id='".$_REQUEST['id']."'";
                        $result = mysqli_query($db, $news_query);
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="row-md-12 fs-6 px-3">
                        <div class="col-12 align-self-center">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
                                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                </svg> <?= substr($row['create_datetime'],0, 10); ?>
                            </span>
                            <span>&nbsp;&nbsp;</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                  </svg> <?= substr($row['create_datetime'],11, 8); ?>
                            </span>
                            <span>&nbsp;&nbsp;</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
                                    <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                    <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043-7.457-7.457z"/>
                                  </svg> <?= $row['category']; ?>
                            </span>
                        </div>
                    </div>
                    <div class="row-md-12 mt-2 text-uppercase text-capitalize text-justify">
                        <h1 class="col-12 align-self-center shadow p-3 bg-body rounded">
                            <?= $row['headline']; ?>
                        </>
                    </div>
                    <div class="row-md-12 mt-2">
                            <img 
							src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['headIMG']); ?>" 
							class="card-img-top" 
							alt="..."
							style="
								object-fit: none; 
								object-position: center; 
								max-width: 100%;
								max-height: 300px;
								margin-bottom: 1rem;"
							/>
                    </div>
                    <?php
                        if($row['create_datetime'] != $row['updated_datetime']){                   
                    ?>
                    <div class="row-md-12 fs-6 px-3 fst-italic fw-light">
                        <div class="col-12 align-self-center">
                            <span>Updated:</span>
                            <span>&nbsp;&nbsp;</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
                                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                </svg> <?= substr($row['updated_datetime'],0, 10); ?>
                            </span>
                            <span>&nbsp;&nbsp;</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                  </svg> <?= substr($row['updated_datetime'],11, 8); ?>
                            </span>
                        </div>
                    </div>
                    <?php
                        }                 
                    ?>
                    <div class="row-md-12 mt-2 open-sans-font pb-2 text-justify shadow-lg p-3 mb-5 bg-body rounded">
                        <?= $row['content']; ?>
                    </div>
                    <div class="row-md-12 mt-4 text-justify">
                        <div class="col-12">
                            <div class="row-md-12 fs-2 mb-4 border border-dark border-3 rounded px-2 text-center text-uppercase text-capitalize fw-bold">Comments</div>
                            <?php
                            require "db/db.php";
                            ($query = mysqli_query($db,
                            "Select * from comments where newsId='".$_REQUEST['id']."' "
	                        )) or die(mysqli_error());
                            while($comment = mysqli_fetch_assoc($query)){
                                ?>
                                <figure class="shadow-sm p-3 mb-4 bg-body rounded">
                                    <blockquote class="blockquote fs-4">
                                      <p><?= $comment['cmnt'] ?></p>
                                    </blockquote>
                                    <figcaption class="blockquote-footer">
                                        <cite title="Source Title">
                                            <span>
                                                 <?= $comment['personName'] ?>
                                            </span>
                                            <span>&nbsp;&nbsp;</span>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
                                                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                                </svg> <?= substr($comment['created_on'],0, 10); ?>
                                            </span>
                                            <span>&nbsp;&nbsp;</span>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                                </svg> <?= substr($comment['created_on'],11, 8); ?>
                                            </span>
                                        </cite> <span>&nbsp;&nbsp;</span>
                                        <?php if(isset($_SESSION['username']) && $comment['personName'] == $_SESSION['username']){ ?>
                                        <span>
                                              <a class="btn btn-danger btn-sm" href="deleteComment.php?id=<?= $_REQUEST['id']; ?>&cmnt_id=<?= $comment['id']; ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                              </svg></a>
                                        </span>
                                        <?php } ?>
                                    </figcaption>

                                  </figure>
                            <?php
                            }
                            ?>
                            <div class="row-md-12 mb-3 shadow-lg p-3 mb-5 bg-body rounded">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="comment" class="fw-bold fs-4">Comment</label>
                                        <textarea class="form-control mb-3" id="comment" rows="3" name="comment" placeholder="Enter your comment" required></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" name="cmnt_submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="row-md-12 p-3 text-center">
                                <h3><?= $status ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
        <script
            src="js/jquery-3.5.1.slim.min.js"
            type="text/javascript"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
