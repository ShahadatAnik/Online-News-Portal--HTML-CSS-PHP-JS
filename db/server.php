<?php

session_start();

$username = "";
$email = "";
$errors = [];

$serverName = "localhost";
$serverUsername = "root";
$serverPassword = "";
$dbname = "onlinenewsportal";

$db = mysqli_connect($serverName, $serverUsername, $serverPassword, $dbname);

if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

// REGISTER USER
if (isset($_POST["reg_user"])) {
  $username = mysqli_real_escape_string($db, $_POST["username"]);
  $email = mysqli_real_escape_string($db, $_POST["email"]);
  $password_1 = mysqli_real_escape_string($db, $_POST["password_1"]);
  $password_2 = mysqli_real_escape_string($db, $_POST["password_2"]);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password_1)) {
    array_push($errors, "Password is required");
  }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if ($user["username"] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user["email"] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  if (count($errors) == 0) {
    $passwordToInsert = md5($password_1);
    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT INTO users (username, email, password, create_datetime) 
  			  VALUES('$username', '$email', '$passwordToInsert', '$create_datetime')";
    mysqli_query($db, $query);

    $_SESSION['reg_success_msg'] = "The Registration is Successful";
    header("location: login.php");
  }
}

// LOGIN USER
if (isset($_POST["login_user"])) {
  $username = mysqli_real_escape_string($db, $_POST["username"]);
  $password = mysqli_real_escape_string($db, $_POST["password"]);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION["username"] = $username;
      $_SESSION["success"] = "You are now logged in";
      header("location: index.php");
    }
    else {
      array_push($errors, "Wrong email/password combination");
    }
  }
}
mysqli_close($db);

?>
