<?php
ob_start();
if(isset($_POST['export']))
{
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "transport"; 
$fromdate=$_POST["fromdate"];
$todate=$_POST["todate"];
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 

$query = mysqli_query($db,"INSERT INTO `electricalrepairreport`SELECT m.busid busid,COALESCE(b.total,0) Battery,COALESCE(s.cost,0) SelfMotorAndDinamo ,sum(COALESCE(b.total,0)+COALESCE(s.cost,0)) Total
FROM `masterdemo` m left outer join `battery` b on m.busid=b.busid and b.from BETWEEN '$fromdate' and '$todate' 
left OUTER join `selfmotoranddinamo` s on m.busid=s.busid and s.fromdate BETWEEN '$fromdate' and '$todate' GROUP by busid; ");  

header("Content-Type: application/octet-stream"); 
header("Content-Disposition: attachment; filename=\"exam.xls\"");
header("Pragma:no-cache");
header("Expires:0"); 

 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
//$fileName = "members_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('Bus Id','Battery','SelfMotorAndDinamo', 'Total'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = mysqli_query($db,"select * from electricalrepairreport;"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){  
        $lineData = array($row['busid'], $row['Battery'], $row['SelfMotorAndDinamo'],  $row['Total']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
}  
echo $excelData;
// Headers for download 
// Render excel data 
$query = mysqli_query($db,"delete from electricalrepairreport;");
exit;

ob_end_flush(); 

}
?>

<html>
    <head>
    <link rel="stylesheet" href="fitness.css">
    <style>
.myDiv { 
  border: 2px outset red;
  background-color: white;
  text-align: center;
  width:600px;
  height:200px;
  margin:-50px 50px 75px 250px;
 border-width:medium;
box-shadow:6px 6px;
}
#toalign{
    display:flex;
}
        </style>
</head>
    <body>
    <a id="toalign"><button onclick="return location.href='transport.html'" class="btn">Home</button> <h1 style="margin-left:29%;">Electrical Repairs Report </h1></a>
    <form action="" method="post">
    <div class="myDiv" style="margin-top:0px;"> 
    <br><br><br>
<label for="from" >from date: </label><input type="date" name="fromdate"  min="2007-01-01" max="2050-12-31">  <br><br>
<label for="to">to date:</label><input type="date" name="todate"  min="2007-01-01" max="2050-12-31" ><br><br>
<input type="submit" id="dis" value="Display" name="display"/>
<input type="submit" name="export" value="Export">
</div>
</form>

<?php
if(isset($_POST['display']))
{
$fromdate=$_POST["fromdate"];
$todate=$_POST["todate"];

$conn=new mysqli("localhost","root","","transport");
  if($conn->connect_error){
      die("connection failed");
  }

else{
    $query=mysqli_query($conn,"SELECT m.busid busid,COALESCE(b.total,0) Battery,COALESCE(s.cost,0) SelfMotorAndDinamo ,sum(COALESCE(b.total,0)+COALESCE(s.cost,0)) Total
    FROM `masterdemo` m left outer join `battery` b on m.busid=b.busid and b.from BETWEEN '$fromdate' and '$todate' 
    left OUTER join `selfmotoranddinamo` s on m.busid=s.busid and s.fromdate BETWEEN '$fromdate' and '$todate' GROUP by busid; ");
    echo "<table border='2' style='border: 2px solid black; color:black; background-color:white;'>
    <tr>
    <th colspan=5>Electrical Repairs</th></tr>
    <tr>
    <th>busid</th>
    <th>Battery</th>
    <th>SelfMotorAndDinamo</th> 
    <th>Total</th>
    </tr> ";

    while($row= mysqli_fetch_array($query)){
        echo "<tr>";
          echo "<td>" . $row['busid'] . "</td>";
          echo "<td>" . $row['Battery'] . "</td>";
          echo "<td>" . $row['SelfMotorAndDinamo'] . "</td>"; 
          echo "<td>" . $row['Total'] . "</td>";
          echo "</tr>";
    }
    echo "</table>";
}
}

?>
</body>
</html>