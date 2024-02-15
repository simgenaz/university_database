<html>
    <head>
    <title>Department Names Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    include ("index.php");
    
    $query="Select D.dName from department D ";
    $result = mysqli_query($conn, $query);
    echo "Department Names <br>";
    while ($row = mysqli_fetch_assoc($result)) {
    $dName= $row['dName'];
    $dName = str_replace(' ', '-', $dName);
    echo "<tr>";
    echo "<td><a href=DepartmentDetails.php?dName=$dName><strong>$dName</a></strong></td><br>";
    echo "</tr>";
}
    ?>
    <br><a href="LoginPage.html">Return Login Screen</a><br>
</body>
</html>