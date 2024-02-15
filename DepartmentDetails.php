<html>
    <head>
    <title>Department Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        include ("index.php");
        $dName=$_GET["dName"];
        $dName = str_replace('-',' ',  $dName);

        //Head and building
        $query="Select I.iname  , D.headSsn , D.buildingName  From department D , instructor I Where  D.dName = '$dName' and I.ssn = D.headSsn";
        $result = mysqli_query($conn, $query);

        echo '<br>';
        echo 'Selected Department Details<br>';
        echo "<table border='1' width='200px'>";
        echo "<tr>";
        echo "<th>Head Instructor Name</th>";
        echo"<th>headSsn</th>";
        echo "<th>Building Name</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
        $iname=$row['iname'];
        $ssn= $row['headSsn'];
        $buildingName= $row['buildingName'];
        echo "<tr>";
        echo "<td><a href=Instructor.php?ssn=$ssn><strong>$iname</a></strong></td>";
        echo "<td><a href=Instructor.php?ssn=$ssn><strong>$ssn</a></strong></td>";
        echo "<td>$buildingName</td>";
        echo "</tr>";
        }
        echo "</table>";
        
        //Instructors and courses
       // echo $dName;
        $query="Select Distinct I.iname  ,  I.ssn ,  E.courseCode From  instructor I ,  enrollment E , department D  where   E.issn = I.ssn and  I.dName = '$dName'";
        $result = mysqli_query($conn, $query);

        echo '<br>';
        echo 'Selected Department Details<br>';
        echo "<table border='1' width='200px'>";
        echo "<tr>";
        echo "<th>Instructor Name</th>";
        echo"<th>Instructor Ssn</th>";
        echo "<th>Course Name</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
        $iname=$row['iname'];
        $ssn= $row['ssn'];
        $courseCode= $row['courseCode'];
        echo "<tr>";
        echo "<td><a href=Instructor.php?ssn=$ssn><strong>$iname</a></strong></td>";
        echo "<td><a href=Instructor.php?ssn=$ssn><strong>$ssn</a></strong></td>";
        echo "<td>$courseCode</td>";
        echo "</tr>";
        }
        echo "</table>";
        ?>
        <br><a href="LoginPage.html">Return Login Screen</a><br>
    </body>
</html>
