<html>
<head>
<title>VVIT Transportation</title>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
<link rel="stylesheet" href="fitness.css">
</head>
<body>
<a href="transport.html" class="previous">&laquo;</a>
<div style="text-align:center;">
<p class="p1">Status</p>
<form action="" method="post">
<label class="p2">Enter Bus Id:</label> <input type="text" name="busid" class="btn1"/><br>
<label class="p2"> Enter Route No:</label> <input type="number" name="routeno" class="btn1"/><br>
<label class="p2"> Engine Number:</label> <input type="text" name="enginenumber" class="btn1"/><br>
<label class="p2"> Chassis Number: </label><input type="text" name="chassis" class="btn1"/><br><br><br><br>
<button type="submit" name="create" value="insert" class="btn"/>Insert</button>
<button type="submit" name="remove" value="remove" class="btn"/>Remove</button>
<button type="submit" name="display" value="active" class="btn"/>Active</button>
<button type="submit" name="Display" value="inactive" class="btn"/>Inactive</button><br>
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['create']))
{
 echo "ok";
 $bus=$_POST['busid'];
 $route=$_POST['routeno'];
 $eng=$_POST['enginenumber'];
 $cha=$_POST['chassis'];
 $status='active';
$conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
$query="INSERT INTO status  VALUES ('$bus','$route','$eng','$cha','$status')";
   $rs=mysqli_query($conn,$query);  
   if($rs){
      echo '<script> alert("data Inserted");  </script>';
   }
}
}
if(isset($_POST['remove']))
{
echo "okk";
 $conn=new mysqli("localhost","root","","transport");
 if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
 $bus=$_POST['busid'];
 $sql="INSERT INTO scrap SELECT busid,routeno,enginenumber,chassis, IF(status='active','inactive','inactive') status FROM status s WHERE s.busid='$bus';DELETE FROM status WHERE busid = '$bus';";
 $rs=mysqli_multi_query($conn,$sql);  
   if($rs){
 echo '<script> alert("data removed"); </script>';
} 
} 
}
if(isset($_POST['display']))
{
 $conn=new mysqli("localhost","root","","transport");
 if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else
{
 $query=mysqli_query($conn,"select * from status");
 echo "<table border='1'>
 <tr>
 <th> busid </th>
 <th> route </th>
 <th> engine number </th>
 <th> chassi number </th>
 <th> status </th>
 </tr>
 ";
 while($row=mysqli_fetch_array($query))
{
 echo "<tr>";
 echo "<td>" . $row['busid'] . "</td>";
 echo "<td>" . $row['routeno'] ."</td>";
 echo "<td>" . $row['enginenumber'] ."</td>";
 echo "<td>" . $row['chassis'] ."</td>";
 echo "<td>" .$row['status'] ."</td>";
 echo "</tr>";
}
 echo "</table>";
 }
}
if(isset($_POST['Display']))
{
 $conn=new mysqli("localhost","root","","transport");
 if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else
{
 $query=mysqli_query($conn,"select * from scrap");
 echo "<table border='1'>
 <tr>
 <th> busid </th>
 <th> route </th>
 <th> engine number </th>
 <th> chassi number </th>
 <th> status </th>
 </tr>
 ";
 while($row=mysqli_fetch_array($query))
{
 echo "<tr>";
 echo "<td>" . $row['busid'] . "</td>";
 echo "<td>" . $row['routeno'] ."</td>";
 echo "<td>" . $row['engine'] ."</td>";
 echo "<td>" . $row['chassisnumber'] ."</td>";
 echo "<td>" .$row['status'] ."</td>";
 echo "</tr>";
}
 echo "</table>";
 }
}

?>