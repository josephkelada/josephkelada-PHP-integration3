<?php
  // Insert the page header
  $page_title = 'Sign Up';

  // Connect to the database
  $dbc = mysqli_connect('localhost', 'root', '', 'School');

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $name = $_POST['name1'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    if (!empty($username) && !empty($password1)) 
    {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM students WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO students (username, password,name,phone,email) VALUES ('$username', '$password1','$name','$phone','$email')";
        mysqli_query($dbc, $query);

        // Confirm success with the user
        echo '<p>Your new account has been successfully created. You\'re now ready to <a href="index.php">log in</a>.</p>';

        mysqli_close($dbc);
        exit();
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password.</p>';
    }
  }

  mysqli_close($dbc);
?>
