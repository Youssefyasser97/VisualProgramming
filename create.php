
<html>
<body>
 <p>Creating Table..</p>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yussef";
$tablename=$_POST['tablename'];
$field1=$_POST['field1'];
$field2=$_POST['field2'];
$field3=$_POST['field3'];
$field4=$_POST['field4'];
$field5=$_POST['field5'];
$field6=$_POST['field6'];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection : " . mysqli_connect_error());
}

if($field1 != '' && $field2 == ''){
$sql = "CREATE TABLE $tablename
(
$field1 int
);";
}

if($field2 != '' && $field3 == ''){
$sql = "CREATE TABLE $tablename
(
$field1 int,
$field2 varchar(255)
);";
}

if($field3 != '' && $field4 == ''){
$sql = "CREATE TABLE $tablename
(
$field1 int,
$field2 varchar(255),
$field3 varchar(255)
);";
}

if($field4 != '' && $field5 == ''){
$sql = "CREATE TABLE $tablename
(
$field1 int,
$field2 varchar(255),
$field3 varchar(255),
$field4 varchar(255)
);";
}

if($field5 != ''){
$sql = "CREATE TABLE $tablename
(
$field1 int,
$field2 varchar(255),
$field3 varchar(255),
$field4 varchar(255),
$field5 varchar(255)
);";
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
