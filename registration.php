<?php include('db/server.php') ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container-fluid p-5" style="height: 100vh">
            <div class="row mb-5 text-center">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h1 class="mt-5 p-2 border border-dark border-3 rounded">
                        Online News Portal
                    </h1>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4"></div>
                <div
                    class="col-md-4 border border-dark border-3 border-bottom-0 border-start-0 rounded p-3"
                >
                    <h3
                        class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded"
                    >
                        Registration
                    </h3>
                    <form action="registration.php" method="post">
                        <div class="row mb-3">
                            <label
                                for="inputUsername"
                                class="col-sm-3 col-form-label"
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
                            <label
                                for="inputEmail"
                                class="col-sm-3 col-form-label"
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
                    <p class="h4 mt-5 text-center">
                        Already have an account?
                        <a href="login.php"><strong>Login</strong></a>
                    </p>
                </div>
                <div class="col-md-4"></div>
            </div>
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
