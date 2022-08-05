<?php include('db/server.php') ?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container-fluid">
            
                <div
                    class="row-sm-6 position-absolute top-0 start-50 translate-middle mt-5"
                >
                    <h1 class="mt-5 p-2 border border-dark border-3 rounded">
                        Online News Portal
                    </h1>
                </div>
           
            <div
                class="row-sm-6 position-absolute top-50 start-50 translate-middle border border-dark border-3 border-bottom-0 border-start-0 rounded p-3"
            >
                <h3
                    class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded"
                >
                    Login
                </h3>
                <form action="login.php" method="post">
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-3 col-form-label"
                            >Username</label
                        >
                        <div class="col-sm-9">
                            <input
                                type="name"
                                class="form-control"
                                id="inputEmail"
                                placeholder="Your username"
                                required
                                name="username"
                            />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label
                            for="inputPassword"
                            class="col-sm-3 col-form-label"
                            >Password</label
                        >
                        <div class="col-sm-9">
                            <input
                                type="password"
                                class="form-control"
                                id="inputPassword3"
                                placeholder="********"
                                required
                                name="password"
                            />
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="login_user" class="btn btn-primary px-2">
                            Sign in
                        </button>
                    </div>
                </form>
                <?php include('db/errors.php'); ?>
               <p class="h4 mt-5">Don't have an account? <a href="registration.php"><strong>Register</strong></a></p> 
            </div>
        </div>
        
    </body><script src="js/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
</html>
