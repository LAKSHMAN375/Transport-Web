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

$query = mysqli_query($db,"INSERT INTO `bodyrepairreport`  select m.busid,COALESCE(s.totvalue,0) SpringCost, COALESCE(p.TotalValue,0) PaintCost,COALESCE(g.cost,0) GlassWork ,COALESCE(se.cost,0) SeatCost, COALESCE(t.TotalValue,0)TyreCost , COALESCE(st.cost,0) StickeringCost   , sum(COALESCE(s.totvalue,0)+ COALESCE(p.TotalValue,0)+COALESCE(t.TotalValue,0)+COALESCE(g.cost,0)+COALESCE(st.cost,0)+COALESCE(se.cost,0)) Total
from `masterdemo` m left outer join `springs` s on m.busid=s.busid and s.fromdate BETWEEN '$fromdate' and '$todate'
left OUTER join `paints` p on m.busid=p.busid and p.from BETWEEN '$fromdate' and '$todate' 
left OUTER JOIN `tyres` t on m.busid=t.busid   and t.fromdate BETWEEN '$fromdate' and '$todate'
left outer join `glasswork` g on m.busid=g.busid and g.fromdate BETWEEN '$fromdate' and '$todate'
left outer join `stickering` st on m.busid=st.busid and st.fromdate BETWEEN '$fromdate' and '$todate'
left outer join `seats` se on m.busid=se.busid and se.fromdate BETWEEN '$fromdate' and '$todate'
group by busid; ");  

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
$fields = array('Bus Id','Springs cost','Paint cost','Glass work cost','Seats Cost','Tyres cost','Stickering Cost','Total'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = mysqli_query($db,"select * from bodyrepairreport;"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){  
        $lineData = array($row['busid'], $row['SpringCost'], $row['PaintCost'], $row['GlassworkCost'], $row['SeatsCost'], $row['TyresCost'], $row['StickeringCost'], $row['Total']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
}  
echo $excelData;
// Headers for download 
// Render excel data 
$query = mysqli_query($db,"delete from bodyrepairreport;");
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
    <a id="toalign"><button onclick="return location.href='transport.html'" class="btn">Home</button> <h1 style="margin-left:29%;">Body Repairs Report </h1></a>
    <form action="" method="post">
    <div class="myDiv" style="margin-top:0px;"> 
    <br><br><br>
<label for="from" >from date: </label><input type="date" name="fromdate"  min="2007-01-01" max="2050-12-31">  <br><br>
<label for="to">to date:</label><input type="date" name="todate"  min="2007-01-01" max="2050-12-31" ><br><br>
<input type="submit" id="dis" value="Display" name="display"/>
<input type="submit" name="export" value="Export">
</div>
</form>
<section>
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
        $query=mysqli_query($conn,"select m.busid,COALESCE(s.totvalue,0) SpringCost, COALESCE(p.TotalValue,0) PaintCost,COALESCE(g.cost,0) GlassWork ,COALESCE(se.cost,0) SeatCost, COALESCE(t.TotalValue,0)TyreCost , COALESCE(st.cost,0) StickeringCost   , sum(COALESCE(s.totvalue,0)+ COALESCE(p.TotalValue,0)+COALESCE(t.TotalValue,0)+COALESCE(g.cost,0)+COALESCE(st.cost,0)+COALESCE(se.cost,0)) Total
        from `masterdemo` m left outer join `springs` s on m.busid=s.busid and s.fromdate BETWEEN '$fromdate' and '$todate'
        left OUTER join `paints` p on m.busid=p.busid and p.from BETWEEN '$fromdate' and '$todate' 
        left OUTER JOIN `tyres` t on m.busid=t.busid   and t.fromdate BETWEEN '$fromdate' and '$todate'
        left outer join `glasswork` g on m.busid=g.busid and g.fromdate BETWEEN '$fromdate' and '$todate'
        left outer join `stickering` st on m.busid=st.busid and st.fromdate BETWEEN '$fromdate' and '$todate'
        left outer join `seats` se on m.busid=se.busid and se.fromdate BETWEEN '$fromdate' and '$todate'
        group by busid; ");
        echo "<table border='2' style='border: 2px solid black; color:black; background-color:white;'>
        <tr>
        <th colspan=8>Body Repairs</th></tr>
        <tr>
        <th>busid</th>
        <th>Spring Cost</th>
        <th>Paint Cost</th>
        <th>Glass Work Cost</th>
        <th>Seats Cost</th>
        <th>Tyres Cost</th>
        <th>Stickering Cost</th>
        <th>total</th>
        </tr> ";
    
        while($row= mysqli_fetch_array($query)){
            echo "<tr>";
              echo "<td>" . $row['busid'] . "</td>";
              echo "<td>" . $row['SpringCost'] . "</td>";
              echo "<td>" . $row['PaintCost'] . "</td>";
              echo "<td>" . $row['GlassWork'] . "</td>";
              echo "<td>" . $row['SeatCost'] . "</td>";
              echo "<td>" . $row['TyreCost'] . "</td>";
              echo "<td>" . $row['StickeringCost'] . "</td>";
              echo "<td>" . $row['Total'] . "</td>";
              echo "</tr>";
        }
        echo "</table>";
    }
    }
    ?>
</section>
</body>
</html>
