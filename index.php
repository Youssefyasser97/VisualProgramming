<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yussef";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection : " . mysqli_connect_error());
}


$sql3 = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.tables
        WHERE TABLE_TYPE = 'BASE TABLE' AND table_schema = 'yussef'";

$query3 = mysqli_query($conn, $sql3);

if (!$query3) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html>
<title>VP Team</title>
<head>

    <!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css"  href="../css/style.css">
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<ul>
  <li><a href="#tables"><i class="fa fa-fw fa-table"></i> Tables </a></li>
  <li><a href="#delete"><i class="fa fa-fw fa-remove"></i> Delete</a></li>
  <li><a href="#modify"><i class="fa fa-fw fa-edit"></i> Modify</a></li>
  <li><a href="#insert"><i class="fa fa-fw fa-plus"></i> Insert</a></li>
  <li><a href="#create"><i class="fa fa-fw fa-key"></i> Create</a></li>
</ul>


<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
			background-color: grey;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			/* text-transform: uppercase; */
			font-size: 20px;
			color: white;
		}
		h3{
		    color: #a7c44c;
		    font-size: 28px;
		}

        label{
            color:white;
            font-size: 16px;
        }
		table td {
			transition: all .5s;
		}

		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th,
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;

		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #a7c44c;
			color: #FFFFFF;
			border-color: #e0eabf !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #ecf2d9;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
		.middle{
		    text-align: center;
            position: relative;
            left:40%;
		}

    div.ex1 {
        width:100%;
        margin: auto;
        border: 3px solid #73AD21;
    }

    input[type=text] {
          margin: auto;
      border-radius: 4px;
      /*font-size: 12px;*/
      padding: 5px 0px 5px 10px;
      margin-top: -5px;
      margin-bottom: 7px;
      margin-left: 2%;
    }

    .righty {
        margin:10px;
        background-color: #494949;
        padding: 16px;
        font-size: 16px;
        border: none;
          margin-left: auto;
          margin-right: auto;
    }
</style>

<style>
body {margin:0;}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #49494998;
  position: fixed;
  top: 0;
  width: 100%;
}

li {
  float: right;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  /*margin-right: 20px;*/
  font-size: 18px;
}

li a:hover:not(.active) {
  background-color: #a7c44c;
}

.active {
  background-color: #4CAF50;
}
</style>

<!-- Header -->
<header id="header">
 <br><br>
 <h1><font size="6">DATABASE OPERATIONS</font></h1>
<br><br>
</header>

<hr>

<section id="create">
<div class="righty">
<h3>Creation</h3><br>
<form action="/vp2/create.php" id="createform"  method="post" name="myform1" accept-charset="utf-8">
  <label for="tablename">Create Table: </label>
  <input type="text" id="tablename" name="tablename" required placeholder="Table Name"><br>
  <label for="colname">With Columns: </label>
  <input type="text" id="field1" name="field1" required placeholder="field 1">
  <div id="creatediv"></div><br>
  <input type="button" style="background-color:#a7c44c;color:white; padding:10px 20px 10px 20px;border-radius:12px;" onclick="myFunction()" id="addcolumns" name="addcolumn" value="Add Column">
  <input type="submit" style="background-color:#a7c44c;color:white; padding:10px 20px 10px 20px;border-radius:12px;" value="Create">
</form>
</div>
</section>
<hr>

<section id="insert">

<div class="righty">
<h3>Insertion</h3><br>

		<?php
    $inserttable = "";
    if(isset($_GET['w1'])){
      $inserttable = $_GET["w1"];
    }
            $sql4 = "SELECT COLUMN_NAME
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_NAME = '$inserttable'
            ORDER BY ORDINAL_POSITION;";

            $query4 = mysqli_query($conn, $sql4);

            $insertcolumns = array();
		    while($row4 = mysqli_fetch_array($query4)){
    		$c = $row4['COLUMN_NAME'];
            array_push($insertcolumns,$c);
		    }

		    $inserttablecount = count($insertcolumns);

		    echo '<form action="/vp2/insert.php" id="insertform" method="post" name="myform" accept-charset="utf-8" onsubmit="return submit();">';

		    echo '<label for="tablename2">Insert into Table: </label>
        <input type="text" id="tablename2" name="tablename2" required placeholder="Table Name" value='.$inserttable.'>
        <br>';
        		    echo '<button style="background-color:#a7c44c;color:white; padding:8px 16px 8px 16px;border-radius:12px; margin-bottom: 20px; marin-top:10px;"  id="tablenamebtn" name="tabnenamebtn"
        onclick="gettablename()" type="button">Get Columns</button><br>';

		    $j = 0;
		    while($j < $inserttablecount){
		        $name = "insertfield".$j;
		        echo '		    <label for='.$name.'>'.$insertcolumns[$j].'</label>
            <input type="text" id='.$name.' name='.$name.' required placeholder='.$insertcolumns[$j].'><br>';

            if($j==$inserttablecount-1){
                echo '<input type="submit" style="background-color:#a7c44c;color:white; padding:10px 20px 10px 20px;border-radius:12px;"  value="Insert"><br>';
            }
		        $j = $j + 1;
		    }


		    echo'</form>';

        ?>
</div>
</section>
<hr>

<script>
    function submit(){
            var firstfield = document.getElementById('insertfield1').value;
            if(firstfield != ''){
                alert("ok");
                return true;
           }
           else{
               document.myform.action ="insert.html";
               alert("Enter value for insertion")
               return false;
           }
    }
</script>

<section id="modify">
<div class="righty">
<h3>Modification</h3><br>
<?php
    $modifytable = "";
    if(isset($_GET['w8'])){
      $modifytable = $_GET["w8"];
    }
        $sql6 = "SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME = '$modifytable'
        ORDER BY ORDINAL_POSITION;";

        $query6 = mysqli_query($conn, $sql6);

        $modifycolumns = array();
        while($row6 = mysqli_fetch_array($query6)){
		        $e = $row6['COLUMN_NAME'];
            array_push($modifycolumns,$e);
		    }
		    $modifytablecount = count($modifycolumns);
		    echo '<form action="/vp2/modify.php" id="modifyform" method="post" name="myform5" accept-charset="utf-8">';
		    echo '        <label for="tablename8">Modify Table : </label>
        <input type="text" id="tablename8" name="tablename8" placeholder="Table Name" value='.$modifytable.'>
        <br>';
        echo '<button style="background-color:#a7c44c;color:white; padding:8px 16px 8px 16px;border-radius:12px; margin-bottom: 20px; marin-top:10px;"  id="tablenamebtn2" name="tabnenamebtn2"
        onclick="gettablename3()" type="button">Get Columns</button><br>';

		    $j = 0;
		    while($j < $modifytablecount){
		        $name = "setfield".$j;
		        echo '<label for='.$name.'>'.$modifycolumns[$j].'</label>
            <input type="text" id='.$name.' name='.$name.' placeholder='.$modifycolumns[$j].'><br>';

            if($j==$modifytablecount-1){
              // echo '<button style="background-color:#a7c44c;color:white; padding:8px 16px 8px 16px;border-radius:12px; margin-bottom: 20px; marin-top:10px;"  id="tablenamebtn2" name="tabnenamebtn2"
              // type="button">Set columns</button><br>';
              echo '<br><label style="font-size: 22px;">Where:</label><br><br>';
            }
		        $j = $j + 1;
		    }


        $j1 = 0;
		    while($j1 < $modifytablecount){
		        $name = "wherefield".$j1;
		        echo '<label for='.$name.'>'.$modifycolumns[$j1].'</label>
            <input type="text" id='.$name.' name='.$name.' placeholder='.$modifycolumns[$j1].'><br>';

            if($j1==$modifytablecount-1){
                echo '<input type="submit" style="background-color:#a7c44c;color:white; padding:10px 20px 10px 20px;border-radius:12px;"  value="Update"><br>';
            }
		        $j1 = $j1 + 1;
        }
        echo '<br>';
        // echo '<button style="background-color:#a7c44c;color:white; padding:8px 16px 8px 16px;border-radius:12px; margin-bottom: 20px; marin-top:10px;"  id="tablenamebtn2" name="tabnenamebtn2"
        //  type="button">Submit</button><br>';
        echo'</form>';

        ?>
</div>
</section>
<hr>

<section id="delete">
<div class="righty">
<h3>Deletion</h3><br>
<?php
    $deletetable = "";
    if(isset($_GET['w7'])){
      $deletetable = $_GET["w7"];
    }
            $sql5 = "SELECT COLUMN_NAME
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_NAME = '$deletetable'
            ORDER BY ORDINAL_POSITION;";

            $query5 = mysqli_query($conn, $sql5);

            $deletecolumns = array();
		    while($row5 = mysqli_fetch_array($query5)){
    		$d = $row5['COLUMN_NAME'];
            array_push($deletecolumns,$d);
		    }

		    $deletetablecount = count($deletecolumns);

		    echo '<form action="/vp2/delete.php" id="deleteform" method="post" name="myform4" accept-charset="utf-8" onsubmit="return submit();">';

		    echo '        <label for="tablename7">Delete from Table: </label>
        <input type="text" id="tablename7" name="tablename7" placeholder="Table Name" value='.$deletetable.'>
        <br>';
        		    echo '<button style="background-color:#a7c44c;color:white; padding:8px 16px 8px 16px;border-radius:12px; margin-bottom: 20px; marin-top:10px;"  id="tablenamebtn2" name="tabnenamebtn2"
        onclick="gettablename2()" type="button">Get Columns</button><br>';

		    $j = 0;
		    while($j < $deletetablecount){
		        $name = "deletefield".$j;
		        echo '		    <label for='.$name.'>'.$deletecolumns[$j].'</label>
            <input type="text" id='.$name.' name='.$name.' placeholder='.$deletecolumns[$j].'><br>';

            if($j==$deletetablecount-1){
                echo '<input type="submit" style="background-color:#a7c44c;color:white; padding:10px 20px 10px 20px;border-radius:12px;"  value="Delete"><br>';
            }
		        $j = $j + 1;
		    }


		    echo'</form>';

        ?>
</div>
</section>
<hr>

<script>

function gettablename(){
    var tablename = document.getElementById('tablename2').value;
    if(tablename == ''){
        alert("Please Enter Table Name");
    }
    else{
    window.location.href = "index.php?w1=" + tablename + "#insert";
    }
}
function gettablename2(){
    var tablename = document.getElementById('tablename7').value;
    if(tablename == ''){
        alert("Please Enter Table Name");
    }
    else{
    window.location.href = "index.php?w7=" + tablename + "#delete";
    }
}
function gettablename3(){
    var tablename = document.getElementById('tablename8').value;
    if(tablename == ''){
        alert("Please Enter Table Name");
    }
    else{
    window.location.href = "index.php?w8=" + tablename + "#modify";
    }
}
function gettablename4(){
    var tablename = document.getElementById('tablename8').value;
    if(tablename == ''){
        alert("Please Enter Table Name");
    }
    else{
    window.location.href = "index.php?w8=" + tablename + "#modify";
    }
}

</script>

		<?php

		$tables = array();
		while($row3 = mysqli_fetch_array($query3)){
    		$table = $row3['TABLE_NAME'];
            array_push($tables,$table);
		}

		$i 	= 0;
		while($i < count($tables)){
            $sql= "SELECT * FROM $tables[$i]";
            $query = mysqli_query($conn, $sql);

            $sql2 = "SELECT COLUMN_NAME
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_NAME = '$tables[$i]'
            ORDER BY ORDINAL_POSITION;";

            $query2 = mysqli_query($conn, $sql2);

    		$a=array();
    		echo '<section id="tables">';
    		while($row2 = mysqli_fetch_array($query2)){
    		$variable = $row2['COLUMN_NAME'];
            array_push($a,$variable);
    		}
    		$row2 = mysqli_fetch_array($query2);
    		echo '<h1>'.$tables[$i].'</h1>
    	<table id="myTable" class="data-table">
    		<thead>
    		  <tr>';

    		  $numberofcols = count($a);
    		  $index = 0;
    		  while($index < $numberofcols){
        		echo            '<th>'.$a[$index].'</th>';
        		$index = $index + 1;
            }
             echo '</tr>
    		</thead>
    		<tbody>';


		while ($row = mysqli_fetch_array($query))
		{
    		$index2 = 0;
        $columndata = "";
        if(isset($row[$a[$index2]])){
          $columndata = $row[$a[$index2]];
        }
			echo '<tr>';
			while($index2 < count($a)){
        if(isset($row[$a[$index2]])){
          $columndata = $row[$a[$index2]];
        }
				echo 	'<td>'.$columndata.'</td>';
					$index2 ++;
			}

			echo '</tr>';
		}

    		echo '</tbody>
		<tfoot>
			<tr>

			</tr>
		</tfoot>
	</table>

	<br><br>';

    		$i = $i + 1;
		}
		echo '</section>';
		?>


<script>
var y = 1;
function myFunction() {
  if(y<7){
    y = y + 1;
  }
  var x = document.createElement("INPUT");
  x.setAttribute("type", "text");
  x.setAttribute("id" , "field" + y);
  x.setAttribute("name" , "field" + y);
  x.required = true;
  if(y<7){
    document.getElementById("creatediv").appendChild(x);
    document.getElementById("field"+y).placeholder = "field " + y;
  }
  else{
    alert("You can only create table with maximum of 6 columns");
  }
}
</script>
</body>
</html>
