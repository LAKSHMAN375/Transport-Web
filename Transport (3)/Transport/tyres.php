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
<p class="p1">Tyres Cost</p>
<form action="" method="post">
<p class="p2">Enter Bus Id: <input type="text" name="busid" class="btn1"/> 
<p class="p2"><label>Select Category Of Bus:</label> 
<select name="category" id="bus">
  <option value="vvit">vvit</option>
  <option value="viva">viva</option>
</select>
<div class="p3">
<lable for="from" >from date: </label>
<input type="date" name="fromdate"  min="2007-01-01" max="2050-12-31">  
<label for="to">to date:</label><input type="date" name="todate"  min="2007-01-01" max="2050-12-31" ></div>
<br>
<div class="p2">
<label>
        <input type="radio" name="type" value="New tyre" onclick="onRadioButtonClick()">
        New Tyre
      </label>
      <label>
        <input type="radio" name="type" value="Old tyre" onclick="onRadioButtonClick()">
        Rebutton Tyre
      </label>
</div>
      <div id="data1" style="display: none;" class="p2">
<p>--------------------------------------------------------------------------------------------------</p>
        Distributor name:  <input type="text"  name="DistributorName" id="dis"/></br>
Tyre name:  <input type="text" name="TyreName" id="tname"/></br>
Company:  <input type="text" name="Company" id="company"/></br>
Tyre size: <input type="number"  id="size" name="TyreSize"/></br>
Tyre cost:  <input type="number" name="TyreCost" id="tcost" oninput="calculate()"/></br>
Quantity : <input type="number"  id="qty" name="Quantity" oninput="calculate()"/></br>
<label for="totalval"> Total Value:</label><input type="text" id="totval" name="TotalValue"/>
  </div>
      <div id="data2" style="display: none;" class="p2">
<p>--------------------------------------------------------------------------------------------------</p>
  Distributor name:  <input type="text"  name="DistributorName" id="dis"/></br>
Tyre name:  <input type="text" name="TyreName" id="tname"/></br>
Company:  <input type="text" name="Company" id="company"/></br>
Tyre size: <input type="number"  id="size" name="TyreSize"/></br>
Tyre cost:  <input type="number" name="TyreCost" id="tcost1" oninput="calculater()"/></br>
Quantity : <input type="number"  id="qty1" name="Quantity" oninput="calculater()"/></br>
<label for="totalval"> Total Value:</label><input type="text" id="totval1" name="TotalValue"/>
      </div>
<div class="p1">
<button type="submit" id="sub" value="Submit" class="p5 btn" name="insert"/>Submit</button>
<button type="submit" id="dis" value="Display" name="display" class="btn"/>Display</button>
</div>
</div>
</form>
<script>
      function onRadioButtonClick() {
        var selectedValue = document.querySelector('input[name="type"]:checked').value;

        if (selectedValue === "New tyre") {
          var data1 = document.getElementById("data2");
          data1.style.display = "block";
          var data2 = document.getElementById("data1");
          data2.style.display = "none";
        } else if (selectedValue === "Old tyre") {
          var data2 = document.getElementById("data2");
          data2.style.display = "block";
          var data1 = document.getElementById("data1");
          data1.style.display = "none";
        }
      }
function calculate()
{
 var cost=document.getElementById("tcost").value;
var q=document.getElementById("qty").value;
var total=parseInt(cost)*parseInt(q);
document.getElementById("totval").value=total;
}
function calculater()
{
 var cost=document.getElementById("tcost1").value;
var q=document.getElementById("qty1").value;
var total=parseInt(cost)*parseInt(q);
document.getElementById("totval1").value=total;
}

</script>
</body>
</html>

<?php
 if(isset($_POST['insert'])){
    echo "ok";
    $_selected=$_POST['type'];
    $_s=$_POST["category"];
    $busid=$_POST["busid"];
    $category=$_s;
    $from=$_POST["fromdate"];
    $to=$_POST["todate"];
    $type=$_selected;
    $DistributorName=$_POST["DistributorName"];
    
    $TyreName=$_POST["TyreName"];
    $Company=$_POST["Company"];
    $TyreSize=$_POST["TyreSize"];
    $TyreCost=$_POST["TyreCost"];
    $Quantity=$_POST["Quantity"];
    $TotalValue=$_POST["TotalValue"];

    $conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
die("Connection Failed:".$conn->connect_error);
}
else{
$query="INSERT INTO tyres  VALUES ('$busid','$category','$from','$to','$type','$DistributorName','$TyreName','$Company','$TyreSize','$TyreCost','$Quantity','$TotalValue')";
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
            $query=mysqli_query($conn,"select * from tyres");
            echo "<table border='1'>
         <tr>
         <th>busid</th>
         <th>category</th>
         <th>from</th>
         <th>to</th>
         <th>type</th>
         <th>DistributorName</th>
         <th>TyreName</th>
         <th>Company</th>
         <th>TyreSize</th> 
         <th>TyreCost</th> 
         <th>Quantity</th>
         <th>TotalValue</th> 
         </tr>
         ";
         while($row= mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td>" . $row['busid'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['fromdate'] . "</td>";
            echo "<td>" . $row['todate'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['DistributorName'] . "</td>";
            echo "<td>" . $row['TyreName'] . "</td>";
            echo "<td>" . $row['Company'] . "</td>";
            echo "<td>" . $row['TyreSize'] . "</td>";
            echo "<td>" . $row['TyreCost'] . "</td>";
            echo "<td>" . $row['Quantity'] . "</td>";
            echo "<td>" . $row['TotalValue'] . "</td>"; 
            echo "</tr>";
            }
            echo "</table>";
       }
  }
?>