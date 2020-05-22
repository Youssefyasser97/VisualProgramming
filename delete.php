
<html>
<body>
 <p>Deleting From Database..</p>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yussef";
$where=$_POST['where'];

$tablename=$_POST['tablename7'];

$deletefield0=$_POST['deletefield0'];
$deletefield1=$_POST['deletefield1'];
$deletefield2=$_POST['deletefield2'];
$deletefield3=$_POST['deletefield3'];
$deletefield4=$_POST['deletefield4'];
$deletefield5=$_POST['deletefield5'];



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

$sql11 = "DELETE FROM $tablename ";
$i = 0;
$fieldscount = 0;
$firsttime = 1;
while($i < $columnscount){
    $currentfield = "${'deletefield'.$i}";
    if($currentfield != ''){
        if($firsttime == 1){
            $sql11 = $sql11." WHERE ";
            $firsttime = 0;
        }
        $sql12 =  $sql12.$columns[$i]." = "."'${'deletefield' . $i}'";
        if($i<$columnscount AND $fieldscount > 1){
            $sql12=$sql12." AND ";
            }
        }
        $i = $i + 1;
    }

$sql1 = $sql11.$sql12;





if (mysqli_query($conn, $sql1)) {
  echo '<script>window.location.href = "index.php";</script>';
} else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


?>
</body>
</html>
