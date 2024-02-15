<html>
    <head>
    <title>Exams</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    include ("index.php");
    //$link = $courseCode+$examname;
    $link = $_GET["linkexam"];
    $courseCode="";$examname="";
    $parts = explode("-", $link);
    $courseCode=$parts[0];
    $examname=$parts[1];
    //print_r($parts);
    //$examname= $_GET["examname"];
   // echo $courseCode;echo $examname;
    $query = "Select S.studentname ,STE.sssn, STE.examname, sum(GPQ.pointsEarned) as sum
from student S ,studenttakingexam STE  NATURAL JOIN gradesperquestion GPQ
where  STE.examname='$examname' and S.ssn= STE.sssn and  GPQ.courseCode='$courseCode'
GROUP by STE.examname, STE.yearr,STE.semester ,STE.sssn";
$result = mysqli_query($conn, $query);

echo '<br>';
echo $courseCode . ' '.$examname .' '. 'Details<br>';
echo "<table border='1' width='200px'>";
echo "<tr>";
echo "<th>sssn</th>";
echo"<th>Student Name</th>";
echo "<th>examname</th>";
echo "<th>pointsEarned</th>";
echo "</tr>";
while ($row = mysqli_fetch_assoc($result)) {
    $sssn = $row['sssn'];
    $studentname = $row['studentname'];
    $examname = $row['examname'];
    $sum = $row['sum'];
    $ssn=$row['sssn'];
    echo "<tr>";
    echo "<td><a href=Student.php?ssn=$ssn><strong>$sssn</a></strong></td>";
    echo "<td><a href=Student.php?ssn=$ssn><strong>$studentname</a></strong></td>";
    echo "<td>$examname</td>";
    echo "<td>$sum</td>";
    echo "</tr>";
}
echo "</table>";
?>
    <br><a href="LoginPage.html">Return Login Screen</a><br>
</body>
</html>