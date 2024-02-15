<html>
    <head>
    <title>Projects</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
 include ("index.php");
    //$SSN = $_GET["ssn"];
    $query = "select I.iname , P.endDate ,P.leadSsn,P.pName,P.subject,P.budget,P.startDate,P.controllingDName FROM project P , instructor I where P.leadSsn=I.ssn";
    $result = mysqli_query($conn, $query);

    echo '<br><br>';
    echo 'Projects<br>';
    echo "<table border='1' width='200px'>";
    echo "<tr>";
    echo "<th>Lead Instructor</th>";
    echo "<th>Project Name</th>";
    echo "<th>Subject</th>";
    echo "<th>Budget</th>";
    echo "<th>Start Date</th>";
    echo "<th>End Date</th>";
    echo "<th>Controlling Department</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $ssn = $row['leadSsn'];
        $leadInstructor=$row['iname'];
        $pName = $row['pName'];
        $subject = $row['subject'];
        $budget = $row['budget'];
        $startDate = $row['startDate'];
        $endDate = $row['endDate'];
        $controllingDName = $row['controllingDName'];
        
        
        echo "<tr>";
        //echo "<td>$leadSsn</td>";
        echo "<td><a href=Instructor.php?ssn=$ssn><strong>$leadInstructor</a></strong></td>";
        echo "<td><a href=ProjectsDetails.php?pName=$pName><strong>$pName</a></strong></td>";
        echo "<td>$subject</td>";
        echo "<td>$budget</td>";
        echo "<td>$startDate</td>";
        echo "<td>$endDate</td>";
        $controllingDName = str_replace(' ', '-', $controllingDName);
        echo "<td><a href=DepartmentDetails.php?dName=$controllingDName><strong>$controllingDName</a></strong></td>";
        
        echo "</tr>";
    }
    echo "</table><br>";
   ?>
    
<br><a href="LoginPage.html">Return Login Screen</a><br>

    
    
    
    
</body>
</html>