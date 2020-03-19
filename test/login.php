<?php

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) 
  {
    if (isset($_POST['submit'])) 
    {
      // Connect to the database
      $dbc = mysqli_connect('localhost', 'root', '', 'School');

      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));//making sure the user doesnt enter any illegal chararacters
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        
      if ($user_username == 'magister' && $user_password == 'signum')//checking if the user is a teacher
      {
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/teacher.php';
          header('Location: ' . $home_url);
          $_SESSION['user_id'] = 'magister';
          setcookie('user_id', 'magister', time() + (60 * 60 * 24 * 30));
          exit();
      }
      if (!empty($user_username) && !empty($user_password)) 
      {
        // Look up the username and password in the database
        $query = "SELECT student_id, username FROM students WHERE username = '$user_username' AND password = '$user_password'";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) 
        {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['student_id'];
          $_SESSION['username'] = $row['username'];
          setcookie('user_id', $row['student_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          if ($_SESSION['user_id'] != 'magister')//if the login is from a student
          {
              $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/student.php';
              header('Location: ' . $home_url);
          }
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in <a href="index.php">Go Back</a>.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in <a href="index.php">Go Back</a>.';
      }
    }
  }

  // Insert the page header
  $page_title = 'Log In';

  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) 
  {
    echo '<p class="error">' . $error_msg . '</p>';
  }
  else 
  {
      
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '<a href="index.php">Go Back</a>.</p>');
  }
?>
