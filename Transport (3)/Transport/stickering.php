<html>
<head>
<title>SOCIAL TRANSPORT</title>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
<link rel="stylesheet" href="fitness.css">
</head>
<body>
<a href="transport.html" class="previous">&laquo;</a>
<div style="text-align:center;">
<p class="p1">Stickering Cost</p>
<form action="" method="post">
<p class="p2">
<label>Enter Bus Id:</label> <input type="text" name="busid" class="btn1"/> 
<p class="p2"><p class="p2"><label for="bus">Select Category:</label>
<select name="category" id="bus">
  <option value="vvit">vvit</option>
  <option value="viva">viva</option>

</select></p></p>
<br>
<div class="p2">
<label for="from" class="p2" >Date: </label>
<input type="date" name="date"  min="2007-01-01" max="2050-12-31"/><br><br>
<label>
        <input type="radio" name="type" class="rd" value="manual paint" onclick="onRadioButtonClick()">
         Manual Paint
      </label>
      <label>
        <input type="radio" name="type" class="rd" value="sticker" onclick="onRadioButtonClick()">
        Stickering
      </label>
</div>
      <div id="data1" style="display: none;" class="p2">
<p>---------------------------------------------------------------------------------------------------------------------------</p>
        <label for="Company Name" >Worker Name: </label>
	 <input type="text" id="companyname" class="btn1" name="workername"/><br><br>
	<label for="costofbattery">Stcikering Cost:</label> <input type="text" id="costb" name="cost"/><br><br>
	
      </div>
      <div id="data2" style="display: none;" class="p2">
<p>----------------------------------------------------------------------------------------------------------------------------</p>

          <label for="Company Name">Worker Name: </label>
	<input type="text" id="companyname" class="btn1" name="workernamE"/><br><br>
 <label for="totalval">Stickering Cost:</label><input type="text" id="totval" class="btn1" name="total"/><br><br>
      </div>
<div class="p1">
<button type="submit" id="sub" value="Submit" class="p5 btn" name="insert"/>Submit</button>
<button type="submit" id="dis" value="Display" name="display" class="btn"/>Display</button>
<button type="submit" id="excel" name="export" value="Export" class="btn">Export</button>
</div>
</div>
</form>
<script>
      function onRadioButtonClick() {
        var selectedValue = document.querySelector('input[name="type"]:checked').value;

        if (selectedValue === "manual paint") {
          var data1 = document.getElementById("data1");
          data1.style.display = "block";
          var data2 = document.getElementById("data2");
          data2.style.display = "none";
        } else if (selectedValue === "sticker") {
          var data2 = document.getElementById("data2");
          data2.style.display = "block";
          var data1 = document.getElementById("data1");
          data1.style.display = "none";
        }
      }
 </script>
</body>
</html>
<?php
    if(isset($_POST['insert'])){
        echo "ok";
       if($_POST['type']=="manual paint")
{

        $_s=$_POST["category"];
        $busid=$_POST["busid"];
        $date=$_POST["date"];
        $category=$_s;
        $type=$_POST["type"];
        $workername=$_POST["workername"];
        $cost=$_POST["cost"];
      

        $conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
  $query="INSERT INTO stickering VALUES ('$busid','$category','$date','$type','$workername','$cost')";
$rs=mysqli_query($conn,$query);  
   if($rs){
      echo '<script> alert("data Inserted");  </script>';
   }
    }
  
}
else
{
 $_s=$_POST["category"];
        $busid=$_POST["busid"];
        $category=$_s;
        $date=$_POST["date"];
        $type=$_POST["type"];
        $workername=$_POST["workernamE"];
        $cost=$_POST["total"];
        $conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
  $query="INSERT INTO stickering VALUES ('$busid','$category','$date','$type','$workername','$cost')";
$rs=mysqli_query($conn,$query);  
   if($rs){
      echo '<script> alert("data Inserted");  </script>';
   }
    }
  
}
  }
if(isset($_POST['display'])){
    $conn=new mysqli("localhost","root","","transport");
    if($conn->connect_error){
        die("connection failed");
    }
        else{
            $query=mysqli_query($conn,"select * from stickering");
            echo "<table border='1'>
         <tr>
         <th>busid</th>
         <th>category</th>
         <th>Date</th>
         <th>type</th>
         <th>worker name</th>
         <th>cost</th> 
         </tr>
         ";
         while($row= mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td>" . $row['busid'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['fromdate'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['workername'] . "</td>";
           echo "<td>" . $row['cost'] . "</td>"; 
            echo "</tr>";
            }
            echo "</table>";
       }
  } 
?>