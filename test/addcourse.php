<?php
$dbc = mysqli_connect('localhost','root','','school');

$Ncourse = mysqli_real_escape_string($dbc, trim($_POST['NewCourse']));//making sure the teacher doesnt enter any illegal chararacters
$duration = mysqli_real_escape_string($dbc, trim($_POST['duration']));
if (empty($Ncourse)|| empty($duration))
{
    echo 'Field is empty please enter correct data <a href ="teacher.php">Go Back</a>';
}
else
{
    

$query = "insert into courses (title,duration) VALUES ('$Ncourse','$duration')";

mysqli_query($dbc,$query);

$query = "ALTER TABLE student_courses ADD COLUMN $Ncourse INT(2)";
mysqli_query($dbc,$query);
mysqli_close($dbc);
echo'<p>Course has been added . Would you like to Manage another <a href ="teacher.php">Course</a></p>';
}
?>