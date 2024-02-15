<!DOCTYPE html>
<html>
    <head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>


       <?php
    include ("index.php");
    $SSN = $_POST["ssn"];
    

    if ($SSN == "" ) {
        echo 'Please fill all fields';

    }
    $query = "Select S.ssn from Student S where S.ssn='$SSN'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if(mb_substr($SSN, 0, 1)=='s'){
     echo "&bull;<a href=Student.php?ssn=$SSN><strong>Go to Student Page</a></strong><br>";
    } else {
        echo "&bull;<a href=Instructor.php?ssn=$SSN><strong>Go to Instructor Page</a></strong><br>";
    }
   
    ?>


<br><a href="LoginPage.html">Return Login Screen</a><br>
 




</body>
</html>