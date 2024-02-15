<html>
    <head>
    <title>Project Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
 include ("index.php");
    $pName = $_GET["pName"];
    
    //student works project_has_gradstudent
    $query = "select Distinct PHG.workingHour, PHG.Gradssn, S.studentname , I.iname , P.endDate ,P.leadSsn,P.pName,P.subject,P.budget,P.startDate,P.controllingDName "
            . "FROM project P , instructor I, student S, project_has_gradstudent PHG "
            . "where P.leadSsn=I.ssn and  P.pName='$pName' and PHG.Gradssn=S.ssn and P.leadSsn=PHG.leadSsn";
    $result = mysqli_query($conn, $query);

    echo '<br><br>';
    echo 'Project Details<br>';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>Lead Instructor</th>";
    echo "<th>Project Name</th>";
    echo "<th>Subject</th>";
    echo "<th>Grad Student Name</th>";
    echo "<th>Grad Student SSN</th>";
    echo "<th>Working Hour</th>";
    echo "<th>Budget</th>";
    echo "<th>Start Date</th>";
    echo "<th>End Date</th>";
    echo "<th>Controlling Department</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $ssn = $row['leadSsn'];
        $leadInstructor=$row['iname'];
        $Gradssn = $row['Gradssn'];
        $studentname = $row['studentname'];
        $pName = $row['pName'];
        $workingHour = $row['workingHour'];
        $subject = $row['subject'];
        $budget = $row['budget'];
        $startDate = $row['startDate'];
        $endDate = $row['endDate'];
        $controllingDName = $row['controllingDName'];
        
        
        echo "<tr>";
        //echo "<td>$leadSsn</td>";
        echo "<td><a href=Instructor.php?ssn=$ssn><strong>$leadInstructor</a></strong></td>";
        echo "<td>$pName</td>";
        echo "<td>$subject</td>";
        echo "<td><a href=Student.php?ssn=$Gradssn><strong>$studentname</a></strong></td>";
        echo "<td><a href=Student.php?ssn=$Gradssn><strong>$Gradssn</a></strong></td>";
        echo "<td>$workingHour</td>";
        echo "<td>$budget</td>";
        echo "<td>$startDate</td>";
        echo "<td>$endDate</td>";$controllingDName = str_replace(' ', '-', $controllingDName);
        echo "<td><a href=DepartmentDetails.php?dName=$controllingDName><strong>$controllingDName</a></strong></td>";
        
        echo "</tr>";
    }
    echo "</table><br>";
    
//student works project_has_instructor
    
    $query = "Select distinct PHI.leadSsn , PHI.pName , P.subject , I.iname , PHI.issn , PHI.workingHour "
            . "From project P , instructor I, project_has_instructor PHI "
            . "Where  P.pName='$pName' and PHI.pName='$pName' and PHI.issn = I.ssn  ";
    $result = mysqli_query($conn, $query);

    echo '<br><br>';
    echo ' Instructor Project Details<br>';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>Lead Instructor</th>";
    echo "<th>Project Name</th>";
    echo "<th>Subject</th>";
    echo "<th>Instructor Name</th>";
    echo "<th>Instructor SSN</th>";
    echo "<th>Working Hour</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $LeadSsn = $row['leadSsn'];
        $leadInstructor=$row['iname'];
        $pName = $row['pName'];
        $subject = $row['subject'];
        $issn = $row['issn'];
        $iname = $row['iname'];
        $workingHour = $row['workingHour'];
        echo "<tr>";
        echo "<td><a href=Instructor.php?ssn=$LeadSsn><strong>$LeadSsn</a></strong></td>";
        echo "<td>$pName</td>";
        echo "<td>$subject</td>";
        echo "<td><a href=Instructor.php?ssn=$issn><strong>$iname</a></strong></td>";
        echo "<td><a href=Instructor.php?ssn=$issn><strong>$issn</a></strong></td>";
        echo "<td>$workingHour</td>";
        
        
        echo "</tr>";
    }
    echo "</table><br>";
   ?>
    
<br><a href="LoginPage.html">Return Login Screen</a><br>

    
    
    
    
</body>
</html>