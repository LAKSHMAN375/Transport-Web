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

$query = mysqli_query($db,"INSERT INTO `enginerepairreport`  select m.busid,e.category,e.description,e.cost from `masterdemo` m left OUTER JOIN `enginerepairs` e on m.busid=e.busid and e.fromdate BETWEEN '$fromdate' and '$todate'; ");  

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
$fields = array('Bus Id','category','description','Cost' ); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = mysqli_query($db,"select * from enginerepairreport;"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){  
        $lineData = array($row['busid'], $row['category'], $row['description'], $row['Cost'] ); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
}  
echo $excelData;
// Headers for download 
// Render excel data 
$query = mysqli_query($db,"delete from enginerepairreport;");
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
        <a id="toalign"><button onclick="return location.href='transport.html'" class="btn">Home</button> <h1 style="margin-left:29%;">Engine Repairs Report </h1></a>
        
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
//  fromdate between '$fromdate' and '$todate'
else{
    $query=mysqli_query($conn,"select m.busid,e.category,e.description,e.cost from `masterdemo` m left OUTER JOIN `enginerepairs` e on m.busid=e.busid and e.fromdate BETWEEN '$fromdate' and '$todate'; ");
    echo "<table border='2' style='border: 2px solid black; color:black; background-color:white;'>
    <tr>
    <th colspan=5>Engine Repairs</th></tr>
    <tr>
    <th>BUS_ID</th>
    <th>CATEGORY</th> 
    <th>Description</th>
    <th>COST</th>
    </tr>";
    
        while($row = mysqli_fetch_assoc($query)) {
            echo "<tr><td>".$row["busid"]."</td><td>".$row["category"]."</td> <td>".$row["description"]."</td><td>".$row["cost"]."</td></tr>";
        }
    echo "</table>";
}
}

?>
</body>
</html>