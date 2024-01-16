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

$query = mysqli_query($db,"INSERT INTO `monthlyreport` select id, Diesel ,Lubricants , ElectricalRepairs ,EngineRepairs,BodyRepairs, Others , Lubricants+ElectricalRepairs+EngineRepairs+BodyRepairs+Others Total from(
    select m1.busid id,
    (SELECT  COALESCE(sum(price),0) price from masterdemo m LEFT OUTER JOIN diesel d on m.busid=d.busid and d.date between '$fromdate' and '$todate' where m.busid=m1.busid group by m.busid) Diesel,
        (SELECT sum(COALESCE(c.tcost,0)+COALESCE(go.tcost,0)+COALESCE(s.tcost,0)+COALESCE(g.tcost,0)) LubricantCost
                from masterdemo m left OUTER JOIN `coolent` c on m.busid=c.id and c.dates BETWEEN '$fromdate' and '$todate'
                left OUTER join `gearoil` go on m.busid=go.id and go.dates BETWEEN '$fromdate' and '$todate'
                left OUTER join `stearingoil` s on m.busid=s.id and s.dates BETWEEN '$fromdate' and '$todate'
                left OUTER join `greasing` g on m.busid=g.id and g.dates BETWEEN '$fromdate' and '$todate'  where m.busid=m1.busid group by m.busid) Lubricants ,
        (SELECT sum(COALESCE(b.total,0)+COALESCE(s.cost,0)) Total
        FROM `masterdemo` m left outer join `battery` b on m.busid=b.busid and b.from BETWEEN '$fromdate' and '$todate' 
        left OUTER join `selfmotoranddinamo` s on m.busid=s.busid and s.fromdate BETWEEN '$fromdate' and '$todate' where m.busid=m1.busid GROUP by m.busid) ElectricalRepairs ,
        
        ( select sum(COALESCE(e.cost,0)) from `masterdemo` m LEFT OUTER join `enginerepairs` e on m.busid=e.busid and e.fromdate BETWEEN '$fromdate' and '$todate' where m.busid=m1.busid group by m.busid) EngineRepairs , 
        (select  sum(COALESCE(s.totvalue,0)+ COALESCE(p.TotalValue,0)+COALESCE(t.TotalValue,0)+COALESCE(g.cost,0)+COALESCE(st.cost,0)+COALESCE(se.cost,0)) Total
                    from `masterdemo` m left outer join `springs` s on m.busid=s.busid
                  left OUTER join `paints` p on m.busid=p.busid and p.from BETWEEN '$fromdate' and '$todate' 
        left OUTER JOIN `tyres` t on m.busid=t.busid   and t.fromdate BETWEEN '$fromdate' and '$todate'
        left outer join `glasswork` g on m.busid=g.busid and g.fromdate BETWEEN '$fromdate' and '$todate'
        left outer join `stickering` st on m.busid=st.busid and st.fromdate BETWEEN '$fromdate' and '$todate'
        left outer join `seats` se on m.busid=se.busid and se.fromdate BETWEEN '$fromdate' and '$todate' where m.busid=m1.busid
        group by m.busid) BodyRepairs , 
        ( select sum(COALESCE(o.cost,0)) from `masterdemo` m LEFT OUTER join `others` o on m.busid=o.busid and o.fromdate BETWEEN '$fromdate' and '$todate' where m.busid=m1.busid group by m.busid) Others
        FROM `masterdemo` m1     
    ) as q1; ");  

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
$fields = array('Bus Id','Diesel','Lubricants','Electrical Repairs','Engine Repairs','Body Repairs','Others', 'Total'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = mysqli_query($db,"select * from monthlyreport;"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){  
        $lineData = array($row['busid'], $row['Diesel'],$row['Lubricants'], $row['ElectricalRepairs'], $row['EngineRepairs'],$row['BodyRepairs'], $row['Others'],  $row['Total']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
}  
echo $excelData;
// Headers for download 
// Render excel data 
$query = mysqli_query($db,"delete from monthlyreport;");
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
    <a id="toalign"><button onclick="return location.href='transport.html'" class="btn">Home</button> <h1 style="margin-left:29%;">Monthly Report </h1></a>
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
    $query=mysqli_query($conn,"select id, Diesel ,Lubricants , ElectricalRepairs ,EngineRepairs,BodyRepairs, Others , Lubricants+ElectricalRepairs+EngineRepairs+BodyRepairs+Others Total from(
        select m1.busid id,
        (SELECT  COALESCE(sum(price),0) price from masterdemo m LEFT OUTER JOIN diesel d on m.busid=d.busid and d.date between '$fromdate' and '$todate' where m.busid=m1.busid group by m.busid) Diesel,
            (SELECT sum(COALESCE(c.tcost,0)+COALESCE(go.tcost,0)+COALESCE(s.tcost,0)+COALESCE(g.tcost,0)) LubricantCost
                    from masterdemo m left OUTER JOIN `coolent` c on m.busid=c.id and c.dates BETWEEN '$fromdate' and '$todate'
                    left OUTER join `gearoil` go on m.busid=go.id and go.dates BETWEEN '$fromdate' and '$todate'
                    left OUTER join `stearingoil` s on m.busid=s.id and s.dates BETWEEN '$fromdate' and '$todate'
                    left OUTER join `greasing` g on m.busid=g.id and g.dates BETWEEN '$fromdate' and '$todate'  where m.busid=m1.busid group by m.busid) Lubricants ,
            (SELECT sum(COALESCE(b.total,0)+COALESCE(s.cost,0)) Total
            FROM `masterdemo` m left outer join `battery` b on m.busid=b.busid and b.from BETWEEN '$fromdate' and '$todate' 
            left OUTER join `selfmotoranddinamo` s on m.busid=s.busid and s.fromdate BETWEEN '$fromdate' and '$todate' where m.busid=m1.busid GROUP by m.busid) ElectricalRepairs ,
            
            ( select sum(COALESCE(e.cost,0)) from `masterdemo` m LEFT OUTER join `enginerepairs` e on m.busid=e.busid and e.fromdate BETWEEN '$fromdate' and '$todate' where m.busid=m1.busid group by m.busid) EngineRepairs , 
            (select  sum(COALESCE(s.totvalue,0)+ COALESCE(p.TotalValue,0)+COALESCE(t.TotalValue,0)+COALESCE(g.cost,0)+COALESCE(st.cost,0)+COALESCE(se.cost,0)) Total
                        from `masterdemo` m left outer join `springs` s on m.busid=s.busid
                      left OUTER join `paints` p on m.busid=p.busid and p.from BETWEEN '$fromdate' and '$todate' 
            left OUTER JOIN `tyres` t on m.busid=t.busid   and t.fromdate BETWEEN '$fromdate' and '$todate'
            left outer join `glasswork` g on m.busid=g.busid and g.fromdate BETWEEN '$fromdate' and '$todate'
            left outer join `stickering` st on m.busid=st.busid and st.fromdate BETWEEN '$fromdate' and '$todate'
            left outer join `seats` se on m.busid=se.busid and se.fromdate BETWEEN '$fromdate' and '$todate' where m.busid=m1.busid
            group by m.busid) BodyRepairs , 
            ( select sum(COALESCE(o.cost,0)) from `masterdemo` m LEFT OUTER join `others` o on m.busid=o.busid and o.fromdate BETWEEN '$fromdate' and '$todate' where m.busid=m1.busid group by m.busid) Others
            FROM `masterdemo` m1     
        ) as q1;
    ");
    echo "<table border='2' style='border: 2px solid black; color:black; background-color:white;'>
    <tr>
    <th colspan=8>Monthly Report</th></tr>
    <tr>
    <th>busid</th>
    <th>Diesel</th>
    <th>Lubricants</th>
    <th>ElectricalRepairs</th>
    <th>EngineRepairs</th>
    <th>BodyRepairs</th> 
    <th>Others</th>
    <th>TOTAL</th>
    </tr> ";

    while($row= mysqli_fetch_array($query)){
        echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['Diesel'] . "</td>";
          echo "<td>" . $row['Lubricants'] . "</td>";
          echo "<td>" . $row['ElectricalRepairs'] . "</td>"; 
          echo "<td>" . $row['EngineRepairs'] . "</td>"; 
          echo "<td>" . $row['BodyRepairs'] . "</td>"; 
          echo "<td>" . $row['Others'] . "</td>"; 
          echo "<td>" . $row['Total'] . "</td>";
          echo "</tr>";
    }
    echo "</table>";
}
}

?>
</body>
</html>