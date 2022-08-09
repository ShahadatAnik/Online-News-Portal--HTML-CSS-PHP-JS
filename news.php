<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <div class="col-md-3"></div>
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
        </div>
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
