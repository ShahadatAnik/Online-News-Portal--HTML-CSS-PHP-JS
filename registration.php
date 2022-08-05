<?php include('db/server.php') ?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container-fluid">
            <div>
                <div
                    class="position-absolute top-0 start-50 translate-middle mt-5"
                >
                    <h1 class="mt-5 p-2 border border-dark border-3 rounded">
                        Online News Portal
                    </h1>
                </div>
            </div>
            <div
                class="position-absolute top-50 start-50 translate-middle border border-dark border-3 border-bottom-0 border-start-0 rounded p-3"
            >
                <h3
                    class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded"
                >
                Registration
                </h3>
                <form action="registration.php" method="post">
                    <div class="row mb-3">
                        <label for="inputUsername" class="col-sm-3 col-form-label"
                            >Username</label
                        >
                        <div class="col-sm-9">
                            <input
                                type="name"
                                class="form-control"
                                id="inputUsername"
                                required
                                name="username"
                                value="<?= $username; ?>"
                            />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-3 col-form-label"
                            >Email</label
                        >
                        <div class="col-sm-9">
                            <input
                                type="email"
                                class="form-control"
                                id="inputEmail"
                                placeholder="example@mail.com"
                                required
                                name="email"
                                value="<?= $email; ?>"
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
                                placeholder="Must be 6-20 characters long"
                                required
                                name="password_1"
                                value="<?php $password_1; ?>"
                            />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label
                            for="inputPassword"
                            class="col-sm-3 col-form-label"
                            >Confirm Password</label
                        >
                        <div class="col-sm-9 align-self-center">
                            <input
                                type="password"
                                class="form-control"
                                id="inputPassword3"
                                required
                                name="password_2"
                                value="<?php $password_2; ?>"
                            />
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button 
                            type="submit" 
                            class="btn btn-primary px-2"
                            name="reg_user"
                            >
                            Sign up
                        </button>
                    </div>
                </form>
                <?php include('db/errors.php'); ?>
               <p class="h4 mt-5">Already have an account? <a href="login.php"><strong>Login</strong></a></p> 
            </div>
        </div>
    </body>
    <script src="jquery-3.5.1.slim.min.js"/>
		<script src="popper.min.js"/>
		<script src="js/bootstrap.min.js"/>
</html>
