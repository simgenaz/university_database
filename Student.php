<html>
    <head>
    <title>Student</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php

 include ("index.php");
 //Grad or not
    //$SSN = $_POST["ssn"];
    $SSN = $_GET["ssn"];
    /*if ($SSN == "") {
        echo 'Please fill all fields';

    }*/
    $query = "Select S.studentname , S.ssn , S.gradorUgrad From Student S Where S.ssn = '$SSN' ";
    $result = mysqli_query($conn, $query);

    echo '<br><br>';
    echo 'Graduation Situation<br>';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>Student Name</th>";
    echo "<th>Ssn</th>";
    echo "<th>Grad or UGrad</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $studentname = $row['studentname'];
        $ssn = $row['ssn'];
        $gradorUgrad = $row['gradorUgrad'];
        if($gradorUgrad=='0'){
            $or="Ugrad";
        }else
        $or="Grad";
        echo "<tr>";
        echo "<td>$studentname</td>";
        echo "<td>$ssn</td>";
        echo "<td>$or</td>";
        echo "</tr>";
    }
    echo "</table><br>";
    
    // Students taking course
    $query = "Select Distinct S.studentname , C.courseName , C.courseCode From Student S , Course C , Enrollment E Where C.courseCode = E.courseCode AND S.ssn = '$SSN'";
    $result = mysqli_query($conn, $query);
    
    echo '<br><br>';
    echo 'Taking Courses<br>';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>Student Name</th>";
    echo "<th>Course Code</th>";
    echo "<th>Course Name</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $studentname = $row['studentname'];
        $courseCode = $row['courseCode'];
        $courseName = $row['courseName'];
        echo "<tr>";
        echo "<td>$studentname</td>";
        echo "<td>$courseCode</td>";
        echo "<td>$courseName</td>";
        echo "</tr>";
    }
    echo "</table><br>";
    
    if($gradorUgrad=='0'){
    //grade report
    $query = "select E.courseCode, E.yearr, E.semester, E.grade from enrollment E where E.sssn = '$SSN' ";
    $result = mysqli_query($conn, $query);

    echo '<br><br>';
    echo 'Grade Report<br>';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>Course Code</th>";
    echo "<th>Year</th>";
    echo "<th>Semester</th>";
    echo "<th>Grade</th>";
    
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $courseCode = $row['courseCode'];
        $yearr = $row['yearr'];
        $semester = $row['semester'];
        $grade = $row['grade'];
        echo "<tr>";
        echo "<td>$courseCode</td>";
        echo "<td>$yearr</td>";
        echo "<td>$semester</td>";
        echo "<td>$grade</td>";
        
        echo "</tr>";
    }
    }else{
        //Mezun Bölüm car curt
    $query = "Select PD.college , PD.degree , PD.yearr , PD.Gradssn From prevdegree PD Where PD.gradssn = '$SSN '";
    $result = mysqli_query($conn, $query);

    echo '<br><br>';
    echo 'Degree Report<br>';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>College</th>";
    echo "<th>Degree</th>";
    echo "<th>Year</th>";
    echo "<th>Gradssn</th>";
    
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $college = $row['college'];
        $degree = $row['degree'];
        $yearr  = $row['yearr'];
        $Gradssn = $row['Gradssn'];
        echo "<tr>";
        echo "<td>$college</td>";
        echo "<td>$degree</td>";
        echo "<td>$yearr</td>";
        echo "<td>$Gradssn</td>";
        
        echo "</tr>";
    }
    
    }
    echo "</table><br>";
    
    //weekly schedule
    $query = " Select  Distinct W.courseCode,W.dayy,W.hourr from enrollment E,weeklyschedule W where  E.sssn  = '$SSN' and W.courseCode=E.courseCode and W.issn = E.issn";
    $result = mysqli_query($conn, $query);
    $query1 = "SELECT T.dayy FROM timeslot T group by dayy  ";
        $result1 = mysqli_query($conn, $query1);
        $query2 = "SELECT T.hourr FROM timeslot T group by hourr  ";
        $result2 = mysqli_query($conn, $query2);
    echo '<br><br>';
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
     echo "</table><br>";
    //advisor
    $query = "Select I.iname ,I.ssn, I.rankk , I.dName From instructor I , student S Where I.ssn = S.advisorSsn AND S.ssn = '$SSN'";
    $result = mysqli_query($conn, $query);

    echo '<br><br>';
    echo 'Advisor<br>';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>Advisor Name</th>";
    echo "<th>Rank</th>";
    echo "<th>Department</th>";
    
    
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $iname = $row['iname'];
        $rankk = $row['rankk'];
        $dName = $row['dName'];
        $ssn = $row['ssn'];
        echo "<tr>";
        echo "<td><a href=Instructor.php?ssn=$ssn><strong>$iname</a></strong></td>";
        echo "<td> $rankk</td>";
        $dName = str_replace(' ', '-', $dName);
        echo "<td><a href=DepartmentDetails.php?dName=$dName><strong>$dName</a></strong></td>";
        
        echo "</tr>";
    }
    echo "</table><br>";
    
    // supposed to list of courses 
    echo "</table><br>";

    $query = " select c.courseCode, c.courseName, c.ects from course c where c.courseCode in (select cu.courseCode
                        from  curriculacourses CU, student S
                        where S.ssn = '$SSN' and S.currCode = CU.currCode and s.dName =CU.dName )";
    $result = mysqli_query($conn, $query);
    echo 'Curricula Courses';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>Course Code</th>";
    echo "<th>Course Name</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $courseCode = $row['courseCode'];
        $courseName = $row['courseName'];
        echo "<tr>";
        echo "<td>$courseCode</td>";
        echo "<td>$courseName</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<br>";
//Studying department
    $query = "Select S.ssn ,S.studentname , S.dName From Student S where S.ssn ='$SSN'";
    $result = mysqli_query($conn, $query);

    echo '<br><br>';
    echo 'Department<br>';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>Student Name</th>";
    echo "<th>Department</th>";


    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $studentname = $row['studentname'];
        $dName = $row['dName'];
        $ssn = $row['ssn'];
        echo "<tr>";
       // echo "<td> $studentname</td>";
        echo "<td><a href=Student.php?ssn=$ssn><strong>$studentname</a></strong></td>";
        //echo "<td>$dName</td>";
        $dName = str_replace(' ', '-', $dName);
        echo "<td><a href=DepartmentDetails.php?dName=$dName><strong>$dName</a></strong></td>";

        echo "</tr>";
    }
    echo "</table><br>";
    //Grad or Ungrad
    if ($gradorUgrad == 1) {
    $query = "Select  I.ssn,I.iname,S.pName from project_has_gradstudent S,instructor I where  S.Gradssn  = '$SSN'  and I.ssn = S.leadSsn";
    $result = mysqli_query($conn, $query);
    echo '<br><br>';
    echo 'Supervisor The List of Projects<br>';
    echo "<table border='1' width='230px'>";
    echo "<tr>";
    echo "<th>Instructor Name</th>";
    echo "<th>Project Name</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $iname = $row['iname'];
        $ssn = $row['ssn'];
        $pName = $row['pName'];
        echo "<tr>";
        echo "<td><a href=Instructor.php?ssn=$ssn><strong>$iname</a></strong></td>";
        echo "<td><a href=ProjectsDetails.php?pName=$pName><strong>$pName</a></strong></td>";
        echo "</tr>";
    }
    echo "</table>";
}
   ?>
    
<br><a href="LoginPage.html">Return Login Screen</a><br>

    
    
    
    
</body>
</html>
