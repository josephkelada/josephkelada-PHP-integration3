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
    $query3 = "select title from courses";
    $query2 = "delete from student_courses where ID = '$user_id'";
    mysqli_query($dbc,$query2);
    $query = "INSERT INTO student_courses VALUES($user_id,";
    $data = mysqli_query($dbc,$query3);
    while ($row = mysqli_fetch_array($data))
    {
       if (!empty($_POST[$row['title']]))//we get the title of the course from the db because it is the same name for our cb
       {
           $query .= "'1',";//for true
       }
        else 
        {
            $query .= "'0',";//for false
        }
    }
    $query = rtrim($query,",");
    $query .= ")";
    
    mysqli_query($dbc,$query);
    
    echo '<p>You have successfully registered for this semester!.Would you like to register another course? <a href="student.php">Go Back</a>.</p>';
    echo '<p>You can also view your courses  <a href="viewcourses.php">Here</a>.</p>';
    echo '<p id ="logout" > Logout Here ! <a href="logout.php">logout</a></p>';
    mysqli_close($dbc);
}//closing our if statement
?>