<?php

session_start();

$dbc = mysqli_connect('localhost','root','','school');

if (empty($_SESSION['user_id']))
{
    echo 'You must login Before accessing this page <a href="index.php"> login</a>';
}
else
{
    

if ($_SESSION['user_id'] != 'magister')//if the user hasn't logged in yet 
{
    echo '<p>You must be a teacher to access this page. <a href="index.php">Go Back</a>.</p>';
}
else 
{
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Canadian School Of Sciences</title>
  <meta name="description" content="Description of your site goes here">
  <meta name="keywords" content="keyword1, keyword2, keyword3">
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="main">
        <div class="page">
            <div class="header">
                <div class="banner"><h1>Sciences School Of Canada</h1></div>
            </div>
            <div class="content">
                <a target="_blank" href="http://www.htmltemplates.net"><img src="images/copyright.gif" class="copyright" alt="html templates"></a>
                <div class="content-in">
                        <div class="left-panel">
                            <h2>Helping Eachother !</h2>
                            <div class="left-content"> <img class="Sideimg" src="images/img1.jfif" /> </div>
                            <div class="gap"></div>
                            <h2>Small Classes!</h2>
                            <div class="left-content"> <img class="Sideimg" src="images/img2.jfif" /></div>
                        </div>
                    <div class="right-panel">
                        <div class="right-panel-in">
                            <div class="row">
                                <h2 class="title"><span>Welcome to The Sciences School Of Canada</span></h2>
                                <div class="row2">
                                    <p>Welcome Students and Teachers! This is our new and improved website to keep track of courses for students and to also manage them , please Add A course below!</p>
                                </div>
                            </div>
                            <div class="vline">
                                <div class="section1">
                                    <h2 class="title"><span>Course Modification!</span></h2>
                                    <div class="row">
                                        <p>&nbsp;</p>
                                        <p></p>
                                        <p>&nbsp;</p>
                                        <p></p>
                                        <p>&nbsp;</p>
                                        <p>Please Type in the course you would like to add</p>
                                        <?php
                                         echo '<form method="post" action="addcourse.php">';
                                         echo   '<fieldset>';
                                         echo     '<legend>Registration Info</legend>';
                                         echo       '<label for="NewCourse">Course Name:</label>';
                                         echo       '<input type="text" name="NewCourse" /><br />';
                                         echo       '<label for="duration">Duration(hrs):</label>';
                                         echo       '<input type="text" name="duration" /><br />';
                                         echo   '</fieldset>';
                                         echo   '<input type="submit" value="Add Course" name="submit" />';
                                         echo '</form>'
                                        ?>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p id ="logout" > Logout Here ! <a href="logout.php">logout</a></p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                                <div class="section2">
                                    <h2 class="title"><span>Remove Course !</span></h2>
                                    <div class="row">
                                        <p>&nbsp;</p>
                                        <p></p>
                                        <p>&nbsp;</p>
                                        <p></p>
                                        <p>&nbsp;</p>
                                        <p>Please select the desired courses you would like to remove</p>
                                        <?php
                                            $query = "SELECT title from courses";
                                            $data = mysqli_query($dbc,$query) ;
                                            echo '<h4>Here Are All the courses in our system !</h4>';
                                            echo '<form method="post" action="removescore.php">';
                                            echo '<table>';
                                            echo '<tr>';
                                            while ($row = mysqli_fetch_array($data)) 
                                            {
                                                echo '<input type ="checkbox" name = "'. $row['title'] .'"';
                                                echo '<td><label for = "' . $row['title'] . '">'. $row['title'] .'</label></td>';
                                                echo '<p>&nbsp;</p>';
                                            }
                                            echo '</tr></table>';
                                            echo '<input type="submit" value="remove" name="submit"/>';
                                            echo '</form>';
                                        ?>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
<p>&copy; Copyright 2020.</p>
</div>
</div>
</div>

</body></html>
<?php
}
}
?>