<?php
$dbc = mysqli_connect('localhost','root','','school');

$query = "SELECT title FROM courses";
$query1 = "";
$data = mysqli_query($dbc,$query);
while($row = mysqli_fetch_array($data))
{
    if (!empty($_POST[$row['title']]))//means checkbox has been checked so we need to delete this column
    {
        $query = "";
        $query1 = "";
        $course = $row['title'];
        $query = "delete from courses where title = '$course'";
        $query1 = "ALTER TABLE student_courses DROP COLUMN $course";
        mysqli_query($dbc,$query);
        mysqli_query($dbc,$query1);
        echo'<p>Course has been Removed. Would you like to Manage Another <a href ="teacher.php">Course</a></p>';
    }
}
mysqli_close($dbc);

?>