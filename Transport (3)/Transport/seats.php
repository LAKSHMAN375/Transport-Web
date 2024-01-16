<?php
if(isset($_POST['submit']))
{
$host = "localhost";
$user = "root";
$password = "";
$database = "transport";
$conn = mysqli_connect($host, $user, $password, $database);
$busid=$_POST['busid'];
$cate=$_POST['cate'];
$date=$_POST['date'];
$desc=$_POST['desc'];
$cost=$_POST['cost'];
$sql = "INSERT INTO `seats` VALUES ('$busid','$cate','$date','$desc','$cost')";
 $qry = mysqli_query($conn, $sql);
if ($qry) {
    echo '<script type="text/javascript"> alert("Details Submitted")</script>';
}
}
?>
<html>
<head>
<title>VVIT Transportation</title>
    <link rel="apple-touch-icon" sizes="180x180" href="faviconio/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="faviconio/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="faviconio/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <link rel="stylesheet" href="fitness.css">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
<a href="transport.html" class="previous">&laquo;</a>
<div style="text-align:center;">
<label for="heading" class="p1">Seats Repairs</label>

<p class="p2">Enter Bus Id: <input type="text" name="busid" class="btn1"/> 
<p class="p2"><label>Select Category Of Bus:</label> <select name="cate">
<option value="VVIT" > VVIT</option>
<option value="VIVA">VIVA</option>
</select>
<div class="p3">
<lable for="from" >Date: </label>
<input type="date" name="date"  min="2007-01-01" max="2050-12-31"/><br><br>
<label>Description</label><textarea name="desc" ></textarea><br><br>
<label for="tcost">Cost:</label> <input type="text" name="cost"/><br><br>
<div class="p1">
<button type="submit" id="sub" value="Submit" class="p5 btn" name="insert"/>Submit</button>
<button type="submit" id="dis" value="Display" name="display" class="btn"/>Display</button>
</div>
</div>
</div>
<section style="padding:10px;">
<?php
if(isset($_POST['display'])){
$host = "localhost";
$user = "root";
$password = "";
$database = "transport";
$date=$_POST['date'];
$conn = mysqli_connect($host, $user, $password, $database);
$sql = "SELECT * FROM seats";
$qry=mysqli_query($conn,$sql);
echo "<table border='5' style='border: 5px solid black; color:black; padding:3px; margin-left:38%;background-color:white;border-radius:10px;'>
<tr>
<th>BUS_ID</th>
<th>CATEGORY</th>
<th>DATE</th>
<th>Description</th>
<th>COST</th>
</tr>";

    while($row = mysqli_fetch_assoc($qry)) {
        echo "<tr><td>".$row["busid"]."</td><td>".$row["category"]."</td><td>".$row["fromdate"]."</td><td>".$row["description"]."</td><td>".$row["cost"]."</td></tr>";
    }
echo "</table>";
}
?>
</section>
</form>
</body>
</html>