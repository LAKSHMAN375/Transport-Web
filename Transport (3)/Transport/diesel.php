<html>
    <head>
<title>SOCIAL TRANSPORT</title>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
        <link rel="stylesheet" href="fitness.css">
    </head>
<style>
label{
    display: inline-block;
    width:240px;
    text-align: left;
}

input{
    width:180px;
}
</style>
<body>
<button onclick="back()" class="btn">Home</button>
<script>
function back()
{
 location.href="transport.html"
}
</script>
<div class="myDiv" style="margin-top:0px;text-align:center;"> 
<p class="p1">Diesel Details</p>
<form action="" method="post">
<label class="p2">Bus ID </label><input type="text" name="busid"> <br><br>
<label class="p2">Vendor:</label> <input type="text" name="vendor"><br><br>
<label class="p2">Present Meter Reading</label> <input type="text" name="pmeterreading"><br><br>
<label class="p2">Tank size </label><input type="text" name="tanksize"><br><br>
<label class="p2">Filled oil(litres)</label> <input type="text" name="filledoil"><br><br>
<label class="p2">date</label> <input type="date" name="date"><br><br>
<label class="p2">Bill No :</label><input type="text" name="billno"><br><br>
<label class="p2">Price:</label> <input type="text" name="price"><br><br>
<label class="p2">Address:</label> <textarea name="address"></textarea><br><br>
<button type="submit" id="sub" value="Submit" class="p5 btn" name="insert"/>Submit</button>
</div>
<button style="margin-left:0px 50px 0px 100px;" name="display" class="btn">display</button>
</form>

</body>
</html>
<?php
if(isset($_POST['insert'])){
echo "ok";
$busid=$_POST["busid"];
$vendor=$_POST["vendor"];
$pmr=$_POST["pmeterreading"];
$tank=$_POST["tanksize"];
$filledoil=$_POST["filledoil"];
$date=$_POST["date"];
$reciept=$_POST["billno"];
$price=$_POST["price"];
$addr=$_POST["address"];
$conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
   $query="INSERT INTO diesel  VALUES ('$busid','$vendor','$pmr','$tank','$filledoil','$date','$reciept','$price','$addr')";
   $rs=mysqli_query($conn,$query);  
   if($rs){
      echo '<script> alert("data Inserted");  </script>';
   }
}
}
if(isset($_POST['display'])){
  $conn=new mysqli("localhost","root","","transport");
  if($conn->connect_error){
      die("connection failed");
  }
      else{
          $query=mysqli_query($conn,"select * from diesel");
          echo "<table border='1'>
       <tr>
       <th>busno</th>
       <th>vendor</th>
       <th>Present Meter Reading</th>
       <th>Tank Size</th>
       <th>filled oil </th>
       <th>filled date</th>
       <th>reciept number</th>
       <th>price</th>
       <th>address</th>
       </tr>
       ";
 while($row= mysqli_fetch_array($query)){
          echo "<tr>";
          echo "<td>" . $row['busid'] . "</td>";
          echo "<td>" . $row['vendor'] . "</td>";
          echo "<td>" . $row['pmeterreading'] . "</td>";
          echo "<td>" . $row['tanksize'] . "</td>";
          echo "<td>" . $row['filledoil'] . "</td>";
          echo "<td>" . $row['date'] . "</td>";
          echo "<td>" . $row['billno'] . "</td>";
          echo "<td>" . $row['price'] . "</td>";
          echo "<td>" . $row['address']. "</td>";
          echo "</tr>";
          }
          echo "</table>";
     }
} 

?>