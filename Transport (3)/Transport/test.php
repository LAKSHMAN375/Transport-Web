<html>
    <head>
    <link rel="stylesheet" href="periodicaltaxes.css">
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
        </style>
</head>
    <body>
        <h1>Body Repairs Report </h1>
    <form action="" method="post">
    <div class="myDiv" style="margin-top:0px;"> 
    <br><br><br>
<label for="from" >from date: </label><input type="date" name="fromdate"  min="2007-01-01" max="2050-12-31">  <br><br>
<label for="to">to date:</label><input type="date" name="todate"  min="2007-01-01" max="2050-12-31" ><br><br>
<input type="submit" id="dis" value="Display" name="display"/>
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
</body>
</html>