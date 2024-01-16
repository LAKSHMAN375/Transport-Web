<html>
<head>
<title>VVIT Transportation</title>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
<link rel="stylesheet" href="fitness.css">
<style>
  
body {
  
background-image:linear-gradient(powderblue,peachpuff);
  /*
  background-image: url('imagine.jpg');
background-repeat: no-repeat;
 background-attachment: fixed;
  background-size: 100% 100%;
   */
}
 

label{
    display: inline-block;
    width:240px;
    text-align: left;
}

input{
    width:180px;
    height:25px;
}
  </style>

</head>
<body>
<a href="transport.html" class="previous">&laquo;</a>
 <div style="text-align:center">
<lable for="heading" class="p1">Springs Repair Expenditure</lable>
<div>
<form action="springs.php" method="post">
<p class="p2"><label for="bus">Select Category:</label>
<select name="category" id="bus">
  <option value="vvit">vvit</option>
  <option value="viva">viva</option>
</select></p>
<p class="p2"><label>Enter Bus Id: </label><input type="text" name="busid" /> 
<div class="p3">
<label for="from" >from date: </label> 
<input type="date" name="fromdate"  min="2007-01-01" max="2050-12-31">  <br><br>
<label for="to">to date:</label><input type="date" name="todate"  min="2007-01-01" max="2050-12-31" ></div><br>
<div  class="p2">
 <label>Mechanic  name: </label> <input type="text" name="mechanic" id="mech"/></br>
<label>Company:  </label><input type="text"  name="company" id="comp"/></br>
<label>Springs  Cost:  </label><input type="number" name="sprcost" id="cost" oninput="calculate()" style="width: 180px;"/></br>
<label>quantity :</label><input type="number" max="20" min="0" name="sprquantity" id="qt"  oninput="calculate()" style="width: 180px;"/></br>       
<label for="totalval"> Total Value:</label><input type="text" id="totval" name="totval"/>
      </div></br>
 <div class="c" >
<button type="submit" id="sub" value="Submit" class="p5 btn" name="insert"/>Submit</button>
<button type="submit" id="dis" value="Display" name="display" class="btn"/>Display</button>
<div>
</form>
</div>
</div>
<script>
function calculate()
{
 var cost=document.getElementById("cost").value;
var qty=document.getElementById("qt").value;
var total=parseInt(cost)*parseInt(qty);
document.getElementById("totval").value=total;
}
</script>
</body>
</html>

<?php
if(isset($_POST['insert'])){
echo "ok";
$category=$_POST["category"];
$busid=$_POST["busid"];
$fromdate=$_POST["fromdate"];
$todate=$_POST["todate"];
$mechanic=$_POST["mechanic"];
$company=$_POST["company"];
$sprcost=$_POST["sprcost"];
$sprquantity=$_POST["sprquantity"];
$totvalue=$_POST["totval"];
if(!empty($category)&&!empty($busid)&&!empty($fromdate)&&!empty($todate)&&!empty($mechanic)&&!empty($company)&&!empty($sprcost)&&!empty($sprquantity)&&!empty($totvalue)){
$conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
echo $busid;

   $query="INSERT INTO springs  VALUES ('$category','$busid','$fromdate','$todate','$mechanic','$company','$sprcost','$sprquantity','$totvalue')";
   $rs=mysqli_query($conn,$query);  
   if($rs){
      echo '<script> alert("data Inserted");  </script>';
   }
}
}
else{
  echo '<script> alert("Please insert all the fields");  </script>';
}
}
if(isset($_POST['display'])){
  $busid=$_POST["busid"];
  $fromdate=$_POST["fromdate"];
  $todate=$_POST["todate"];
  if(!empty($busid)&&!empty($todate)&&!empty($fromdate)){
  $conn=new mysqli("localhost","root","","transport");
  if($conn->connect_error){
      die("connection failed");
  }
      else{
          $query=mysqli_query($conn,"select * from springs");
          echo "<table border='1'>
       <tr>
       <th>category</th>
       <th>busid</th>
       <th>fromdate</th>
       <th>todate</th>
       <th>mechanic</th>
       <th>company</th>
       <th>spring cost</th>
       <th>springs qty</th>
       <th>total</th>
       </tr>
       ";
 while($row= mysqli_fetch_array($query)){
          echo "<tr>";
          echo "<td>" . $row['category'] . "</td>";
          echo "<td>" . $row['busid'] . "</td>";
          echo "<td>" . $row['fromdate'] . "</td>";
          echo "<td>" . $row['todate'] . "</td>";
          echo "<td>" . $row['mechanic'] . "</td>";
          echo "<td>" . $row['company'] . "</td>";
          echo "<td>" . $row['sprcost'] . "</td>";
          echo "<td>" . $row['sprquantity'] . "</td>";
          echo "<td>" . $row['totvalue'] . "</td>";
          echo "</tr>";
          }
          echo "</table>";
     }
}
else{
  echo '<script> alert("Data cannot be displayed\nplease fill the fields\nBusid, From Date, and To Date"); </script>';

}
}
 
?>
    
