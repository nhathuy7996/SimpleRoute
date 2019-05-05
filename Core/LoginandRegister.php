<?php

  // initializing variables
  $username = "";
  $email    = "";
  $errors = array(); 

  // Register
  if (isset($_POST['reg_user'])) {
   
    $username = $DB->Security( $_POST['username']);
    $email = $DB->Security( $_POST['email']);
    $password_1 = $DB->Security( $_POST['password_1']);
    $password_2 = $DB->Security( $_POST['password_2']);

    
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
    }

    
    $user_check_query = "SELECT * FROM users WHERE user_name='$username' OR user_email='$email' LIMIT 1";
    
    $user = $DB->fetch_assoc($user_check_query,1);
    
    if (!empty($user)) { // if user exists
      if ($user['user_name'] === $username) {
        array_push($errors, "Username already exists");
      }

      if ($user['user_email'] === $email) {
        array_push($errors, "email already exists");
      }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
      $password = md5($password_1);//encrypt the password before saving in the database

      $query = "INSERT INTO users (user_name, user_email, user_password) 
            VALUES('$username', '$email', '$password')";
      $DB->query( $query);
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: '.BASE_URL);
    }
  }
  // End register

  // Login
  if (isset($_POST['login_user'])) {
    $email = $DB->Security( $_POST['email']);
    $password = $DB->Security($_POST['password']);

    if (empty($email)) {
      array_push($errors, "Email is required");
    }
    if (empty($password)) {
      array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
      $password = md5($password);
      $query = "SELECT * FROM users WHERE user_email='$email' AND user_password='$password'";
      //$results = mysqli_query($conn, $query);
      $user = $DB->fetch_assoc($query,1);
      if ($DB->num_rows($query) == 1) {
        $username = $user["user_name"];
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location:'.BASE_URL);
        die();
      }else {
        array_push($errors, "Wrong username/password combination");
      }
    }
  }
  // End login
?>