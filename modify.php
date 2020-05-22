<html>
<body>
 <p>Updating Database..</p>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yussef";

$tablename=$_POST['tablename8'];

// fields to be set
$setfield0=$_POST['setfield0'];
$setfield1=$_POST['setfield1'];
$setfield2=$_POST['setfield2'];
$setfield3=$_POST['setfield3'];
$setfield4=$_POST['setfield4'];
$setfield5=$_POST['setfield5'];

// fields for where clause
$wherefield0=$_POST['wherefield0'];
$wherefield1=$_POST['wherefield1'];
$wherefield2=$_POST['wherefield2'];
$wherefield3=$_POST['wherefield3'];
$wherefield4=$_POST['wherefield4'];
$wherefield5=$_POST['wherefield5'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection : " . mysqli_connect_error());
}

$sql0 = "SELECT COLUMN_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = '$tablename'
ORDER BY ORDINAL_POSITION;";
$query0 = mysqli_query($conn, $sql0);
$columns = array();

while ($row0 = mysqli_fetch_array($query0)){
    $column = $row0['COLUMN_NAME'];
    array_push($columns,$column);
}
$columnscount = count($columns);

$sql1 = "UPDATE $tablename SET ";
$i = 0;
$fieldscount = 0;
while($i < $columnscount){
  $currentfield = "${'setfield'.$i}";
  if($currentfield != ''){
    $fieldscount ++;
    $sql21 = $sql21.$columns[$i].' = '."'${'setfield' . $i}'";
    if($i<$columnscount - 1 AND $fieldscount > 1){
        $sql21 = $sql21.',';
    }
  }
    $i ++;
    }

$sql22 = " WHERE ";
$j = 0;
$fieldscount = 0;
while($j < $columnscount){
  $currentfield = "${'wherefield'.$j}";
  if($currentfield != ''){
    $fieldscount ++;
    $sql22 = $sql22.$columns[$j]." = "."'${'wherefield'.$j}'";
    if($j < $columnscount - 1 AND $fieldscount > 1){
        $sql22 = $sql22." AND ";
    }
  }
    $j ++;
}


$sql2 = $sql21.$sql22;
$sql = $sql1.$sql2;

$query = mysqli_query($conn, $sql);

// -------Auther: Ahmed Amr-------
// $query = "UPDATE $tablename SET";
// $comma = " ";
//
// foreach($_POST as $key => $val) {
//     if( ! empty($val)) {
//         $query .= $comma . $key . " = '" . mysql_real_escape_string(trim($val)) . "'";
//         $comma = ", ";
//     }
// }
// $query = $query . "WHERE id = '".$modifyfield0."' ";
//------End of insertion by Ahmed Amr-------

if (mysqli_query($conn, $sql)) {
    echo '<script>window.location.href = "index.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
</body>
</html>
