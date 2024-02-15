<!DOCTYPE html>
<html>
    <head>
        <title>Instructor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        include ("index.php");
        $SSN = $_GET["ssn"];
        //AllCourses
        $query = "Select Distinct C.courseCode, C.courseName From Course C  , enrollment E where C.courseCode= E.courseCode and E.issn= '$SSN' ";
        $result = mysqli_query($conn, $query);
        echo 'All courses';
        echo "<table border='1' width='200px'>";
        echo "<tr>";
        //echo "<th>iname</th>";
        echo "<th>courseCode</th>";
        echo "<th>courseName</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            // $iname = $row['iname'];
            $courseCode = $row['courseCode'];
            $courseName = $row['courseName'];
            echo "<tr>";
            //   echo "<td> $iname</td>";
            echo "<td> $courseCode</td>";
            echo "<td>$courseName</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>

        <?php
        //Weekly Schedule
        $query = "Select  W.courseCode,W.dayy,W.hourr from weeklyschedule W where  W.issn = '$SSN'";
        $result = mysqli_query($conn, $query);
        $query1 = "SELECT T.dayy FROM timeslot T group by dayy  ";
        $result1 = mysqli_query($conn, $query1);
        $query2 = "SELECT T.hourr FROM timeslot T group by hourr  ";
        $result2 = mysqli_query($conn, $query2);

        echo '<br>';
        echo 'Weekly Schedule';
        echo "<table border='1' width='100px'>";
        echo "<tr>";
        echo "<th>dayy</th>";
        echo "<th>1</th>";
        echo "<th>2</th>";
        echo "<th>3</th>";
        echo "<th>4</th>";
        echo "<th>5</th>";
        echo "<th>6</th>";
        echo "<th>7</th>";
        echo "<th>8</th>";
        echo "<th>9</th>";
        echo "<th>10</th>";
        echo "<th>11</th>";
        echo "<th>12</th>";
        echo "<th>13</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result1)) {
    $dayy = $row['dayy'];
    echo "<tr>";
    echo "<td>$dayy</td>";

    for ($i = 1; $i <= 13; $i++) {
        $found = false;
        mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
        while ($row2 = mysqli_fetch_assoc($result)) {
            $courseCode = $row2['courseCode'];
            $hourr1 = $row2['hourr'];
            $dayy1 = $row2['dayy'];
            if ($dayy1 == $dayy && $hourr1 == $i) {
                echo "<td >$courseCode</td>";
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "<td></td>";
        }
    }
    echo "</tr>";
}
        echo "</table>";

// Studens of each course
        $query = "Select Distinct S.studentName, S.ssn , e.courseCode From Student S , Enrollment e Where e.issn = '$SSN'";
        $result = mysqli_query($conn, $query);

        echo '<br>';
        echo 'Students of each course';
        echo "<table border='1' width='200px'>";
        echo "<tr>";
        echo "<th>Student Name</th>";
        echo "<th>Course Name</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $studentname = $row['studentName'];
            $courseCode = $row['courseCode'];
            $ssn = $row['ssn'];
            echo "<tr>";
            echo "<td><a href=Student.php?ssn=$ssn><strong>$studentname</a></strong></td>";
            echo "<td>$courseCode</td>";
            echo "</tr>";
        }
        echo "</table>";

// leading
        $query = "Select Distinct I.iname , P.leadssn , P.pName  From instructor I , project P ,project_has_instructor PHI  where PHI.leadSsn = '$SSN' and P.leadSsn = '$SSN' and PHI.issn=I.ssn";
        $result = mysqli_query($conn, $query);

        echo '<br>';

        echo 'The projects s/he is leading';
        echo "<table border='1' width='200px'>";
        echo "<tr>";
        echo "<th>Instructor Name</th>";
        echo "<th>LeadSSN</th>";
        echo "<th>Project Name</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $iname = $row['iname'];
            $leadssn = $row['leadssn'];
            $pName = $row['pName'];
            echo "<tr>";
            echo "<td><a href=Instructor.php?ssn=$leadssn><strong>$iname </a></strong></td>";
            echo "<td><a href=Instructor.php?ssn=$leadssn><strong>$leadssn </a></strong></td>";
            echo "<td><a href=ProjectsDetails.php?pName=$pName><strong>$pName</a></strong></td>";
            echo "</tr>";
        }
        echo "</table>";

//working
        $query = "Select I.ssn,I.iname , P.leadssn , P.pName , P.workinghour  From instructor I , project_has_instructor P where I.ssn = P.leadssn and P.issn= '$SSN'";
        $result = mysqli_query($conn, $query);

        echo '<br>';

        echo 'The projects s/he is working<br>';
        echo "<table border='1' width='200px'>";
        echo "<tr>";
        echo "<th>Lead Instructor Name</th>";
        echo "<th>LeadSSN</th>";
        echo "<th>Project Name</th>";
        echo "<th>Working Hour</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $iname = $row['iname'];
            $ssn = $row['ssn'];
            $leadssn = $row['leadssn'];
            $pName = $row['pName'];
            $workinghour = $row['workinghour'];
            echo "<tr>";
            echo "<td><a href=Instructor.php?ssn=$leadssn><strong>$iname </a></strong></td>";
            echo "<td><a href=Instructor.php?ssn=$leadssn><strong>$leadssn </a></strong></td>";
            echo "<td><a href=ProjectsDetails.php?pName=$pName><strong>$pName</a></strong></td>";
            echo "<td>$workinghour </td>";
            echo "</tr>";
        }
        echo "</table>";

//advising
   $query = "Select S.studentname ,S.ssn, I.iname  From Student S , instructor I Where S.advisorSsn = I.ssn and I.ssn ='$SSN'";
    $result = mysqli_query($conn, $query);

    echo '<br>';
    echo 'Student advising';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>Student Name</th>";
    echo "<th>Advisor Name</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $studentname = $row['studentname'];
        $iname= $row['iname'];
        $ssn= $row['ssn'];
        echo "<tr>";
        echo "<td><a href=Student.php?ssn=$ssn><strong>$studentname</a></strong></td>";
        echo "<td>$iname</td>";
        echo "</tr>";
    }
echo "</table>";

//Supervising
$query = "Select S.studentname ,S.ssn, I.iname From gradstudent G , Student S , instructor I Where G.ssn = S.ssn AND I.ssn = G.supervisorSsn and I.ssn= '$SSN'";
$result = mysqli_query($conn, $query);

echo '<br>';
echo 'Graduate Student Supervising';
echo "<table border='1' width='200px'>";
echo "<tr>";
echo "<th>Student Name</th>";
echo "<th>Supervisor Name</th>";
echo "</tr>";
while ($row = mysqli_fetch_assoc($result)) {
    $studentname = $row['studentname'];
    $ssn = $row['ssn'];
    $iname = $row['iname'];
    echo "<tr>";
    echo "<td><a href=Student.php?ssn=$ssn><strong>$studentname</a></strong></td>";
    echo "<td>$iname</td>";
    echo "</tr>";
}
echo "</table>";

//Free

$query = "Select  W.courseCode,W.dayy,W.hourr from weeklyschedule W where  W.issn = '$SSN'";
        $result = mysqli_query($conn, $query);
        $query1 = "SELECT T.dayy FROM timeslot T group by dayy  ";
        $result1 = mysqli_query($conn, $query1);
        $query2 = "SELECT T.hourr FROM timeslot T group by hourr  ";
        $result2 = mysqli_query($conn, $query2);

echo '<br>';
echo 'Free Hours<br>';
echo "<table border='3' width='300px'>";
echo "<tr>";
echo "<th>dayy</th>";
echo "<th>1</th>";
echo "<th>2</th>";
echo "<th>3</th>";
echo "<th>4</th>";
echo "<th>5</th>";
echo "<th>6</th>";
echo "<th>7</th>";
echo "<th>8</th>";
echo "<th>9</th>";
echo "<th>10</th>";
echo "<th>11</th>";
echo "<th>12</th>";
echo "<th>13</th>";
echo "</tr>";
while ($row = mysqli_fetch_assoc($result1)) {
    $dayy = $row['dayy'];
    echo "<tr>";
    echo "<td>$dayy</td>";

    for ($i = 1; $i <= 13; $i++) {
        $found = false;
        mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
        while ($row2 = mysqli_fetch_assoc($result)) {
            $courseCode = $row2['courseCode'];
            $hourr1 = $row2['hourr'];
            $dayy1 = $row2['dayy'];
            if ($dayy1 == $dayy && $hourr1 == $i) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo "<td>Free</td>";
        } else {
            echo "<td></td>";
        }
    }
    echo "</tr>";
}

echo "</table>";


// Exam delivered
$query = "Select DISTINCT  I.iname, S.examname, S.courseCode , S.yearr FROM studenttakingexam S , instructor I WHERE S.issn = I.ssn and I.ssn='$SSN'";
$result = mysqli_query($conn, $query);

echo '  <br>';
echo 'Exam<br>';
echo "<table border='1' width='200px'>";
echo "<tr>";
echo "<th>Instructor Name</th>";
echo "<th>examname</th>";
echo "<th>Course Code</th>";
echo "<th>Year</th>";
echo "</tr>";
while ($row = mysqli_fetch_assoc($result)) {
    $iname = $row['iname'];
    $examname = $row['examname'];
    $courseCode = $row['courseCode'];
    $yearr = $row['yearr'];
    echo "<tr>";
    echo "<td>$iname</td>";
    //echo "<td>$examname</td>";
    $link = $courseCode."-".$examname;
    echo "<td><a href=Exam.php?linkexam=$link><strong>$examname</a></strong></td>";
    echo "<td>$courseCode</td>";
    echo "<td>$yearr</td>";
    echo "</tr>";
}
echo "</table>";
/*
// REsult List bunu linkle yapcaz !!!!

$query = "Select STE.sssn, STE.examname, sum(GPQ.pointsEarned) as sum
from studenttakingexam STE NATURAL JOIN gradesperquestion GPQ
where  GPQ.issn='$SSN'
GROUP by STE.examname, STE.yearr,STE.semester ,STE.sssn";
$result = mysqli_query($conn, $query);

echo '<br><br>';
echo 'Exam<br>';
echo "<table border='1' width='200px'>";
echo "<tr>";
echo "<th>sssn</th>";
echo "<th>examname</th>";
echo "<th>pointsEarned</th>";
echo "</tr>";
while ($row = mysqli_fetch_assoc($result)) {
    $sssn = $row['sssn'];
    $examname = $row['examname'];
    $sum = $row['sum'];
    $ssn=$row['sssn'];
    echo "<tr>";
    echo "<td><a href=Student.php?ssn=$ssn><strong>$sssn</a></strong></td><br>";
    echo "<td>$examname</td>";
    echo "<td>$sum</td>";
    echo "</tr>";
}
echo "</table><br>";*/
?>
<br><a href="LoginPage.html">Return Login Screen</a><br>
    </body>
</html>
