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
        <h1>Engine Repairs Report </h1>
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
    $query=mysqli_query($conn,"SELECT * FROM enginerepairs where fromdate between '$fromdate' and '$todate' ");
    echo "<table border='2' style='border: 2px solid black; color:black; background-color:white;'>
    <tr>
    <th colspan=5>Engine Repairs</th></tr>
    <tr>
    <th>BUS_ID</th>
    <th>CATEGORY</th>
    <th>DATE</th>
    <th>Description</th>
    <th>COST</th>
    </tr>";
    
        while($row = mysqli_fetch_assoc($query)) {
            echo "<tr><td>".$row["busid"]."</td><td>".$row["category"]."</td><td>".$row["fromdate"]."</td><td>".$row["description"]."</td><td>".$row["cost"]."</td></tr>";
        }
    echo "</table>";
}
}

?>
</body>
</html>