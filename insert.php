
<html>
<body>
 <p>Inserting into Database..</p>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yussef";

$tablename=$_POST['tablename2'];

$insertfield0=$_POST['insertfield0'];
$insertfield1=$_POST['insertfield1'];
$insertfield2=$_POST['insertfield2'];
$insertfield3=$_POST['insertfield3'];
$insertfield4=$_POST['insertfield4'];
$insertfield5=$_POST['insertfield5'];



// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection : " . mysqli_connect_error());
}

$sql2 = "SELECT COLUMN_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = '$tablename'
ORDER BY ORDINAL_POSITION;";

$query2 = mysqli_query($conn, $sql2);

$columns = array();

while ($row2 = mysqli_fetch_array($query2)){
	$column = $row2['COLUMN_NAME'];
    array_push($columns,$column);
}
$columnscount = count($columns);

$i = 0;
while($i < $columnscount){
    $mycolumns = $mycolumns.$columns[$i];
    $insertfields = $insertfields."$"."insertfield".$i;
    if($i >= 0 & $i < $columnscount - 1){
        $mycolumns = $mycolumns.',';
        $insertfields = $insertfields.',';
    }
    $i = $i + 1;
    }

if($columnscount == 3){
$sql = "INSERT INTO $tablename ($mycolumns)
VALUES ('$insertfield0','$insertfield1','$insertfield2');";
}
if($columnscount == 4){
$sql = "INSERT INTO $tablename ($mycolumns)
VALUES ('$insertfield0','$insertfield1','$insertfield2','$insertfield3');";
}
if($columnscount == 5){
$sql = "INSERT INTO $tablename ($mycolumns)
VALUES ('$insertfield0','$insertfield1','$insertfield2','$insertfield3','$insertfield4');";
}
if($columnscount == 6){
$sql = "INSERT INTO $tablename ($mycolumns)
VALUES ('$insertfield0','$insertfield1','$insertfield2','$insertfield3','$insertfield4','$insertfield5');";
}


if (mysqli_query($conn, $sql)) {
    echo '<script>window.location.href = "index.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


?>
</body>
</html>
