<?php 
session_start();

$dbc = mysqli_connect('localhost','root','','school');

if (empty($_SESSION['user_id']))//if the user hasn't logged in yet 
{
    echo '<p>Make sure to login. <a href="index.php">log in</a>.</p>';
}
else 
{
   $user_id = $_SESSION['user_id'];
    
    $query = "";
    $query = "SELECT * FROM student_courses WHERE ID = '$user_id'";
    $query2 = "SELECT title from courses";
    $results = mysqli_query($dbc,$query);
    $data = mysqli_query($dbc,$query2);
  echo '<h4>Here Are Your Courses for this semester!</h4>';
  echo '<table>';
  while ($row = mysqli_fetch_array($results)) 
  {
    while($row2 = mysqli_fetch_array($data))
    {
    $title = $row2['title'];
    if ($row[$title] == '1') 
    {
      echo '<tr><td><strong style = "border: 1px solid green ;">'.$title.'</strong></td>';
    }
    }   
  }
  echo '</table>';
  echo '<p>Go Back to<a href="index.php"> Menu</a>.</p>';
  echo 'Change course? <a href="student.php">Go Back</a>' ;  
  echo '<p id ="logout" > Logout Here ! <a href="logout.php">logout</a></p>';
    mysqli_close($dbc);
}//closing our if statement
?>