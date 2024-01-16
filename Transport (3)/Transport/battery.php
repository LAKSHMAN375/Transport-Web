
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
<a href="transport.html" class="previous">&laquo;</a>
<p for="heading" class="p1">Battery Cost</p>
<form action="" method="post">
<p class="p2">
<b>Enter Bus Id:</b> <input type="text" name="busid" class="btn1"/> 
<p class="p2"><p class="p2"><label for="bus">Select Category:</label>
<select name="category" id="bus">
  <option value="vvit">vvit</option>
  <option value="viva">viva</option>
</select></p></p>
<div class="p3">
<lable for="from" > From Date: </label>
<input type="date" name="from"  min="2007-01-01" max="2050-12-31"> <lable for="from" > To Date: </label>
<input type="date" name="to"  min="2007-01-01" max="2050-12-31">  
 
</div><br>
<div class="p2">
<label>
        <input type="radio" name="type" class="rd" value="New Battery" onclick="onRadioButtonClick()">
        New Battery
      </label>
      <label>
        <input type="radio" name="type" class="rd" value="Old Battery" onclick="onRadioButtonClick()">
        Old Battery
      </label>
</div>
      <div id="data1" style="display: none;" class="p2">
<p>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
<label for="Company Name">Battery Distributor </label>
	<input type="text" id="companyname" class="btn1" name="distributor1"/><br><br>
	<label for="modelofbattery">Model of Battery</label><textarea id="description" 	name="model1" style="width: 300px; height: 50px;"></textarea><br><br>
	<label for="batcap">Battery Capacity</label><input type="number" id="batcap" name="capacity1" /><br><br>
	<label for="costofbattery">Battery Cost:</label> <input type="text" id="costb" name="cost"/><br><br>
	
      </div>
      <div id="data2" style="display: none;" class="p2">
<p>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>

          <label for="Company Name">Battery Distributor </label>
	<input type="text" id="companyname" class="btn1" name="distributor"/><br><br>
	<label for="modelofbattery">Model of Battery</label><textarea id="description" 	name="model" style="width: 300px; height: 50px;"></textarea><br><br>
	<label for="batcap">Battery Capacity</label><input type="number" id="batcap" name="capacity" /><br><br>
<label for="newbat">New Battery Price:</label><input type="number" id="newbat" name="newcost" oninput="calculate()"/> <label for="oldbat">Old Battery Price:</label><input type="number" id="oldbat" name="oldcost" oninput="calculate()"/> <label for="totalval"> Total Value:</label><input type="text" id="totval" class="btn1" name="total"/><br><br>
      </div>
<div class="p1">
<button type="submit" id="sub" value="Submit" class="p5 btn" name="insert"/>Submit</button>
<button type="submit" id="dis" value="Display" name="display" class="btn"/>Display</button>
</div>
</form>
<script>
      function onRadioButtonClick() {
        var selectedValue = document.querySelector('input[name="type"]:checked').value;

        if (selectedValue === "New Battery") {
          var data1 = document.getElementById("data1");
          data1.style.display = "block";
          var data2 = document.getElementById("data2");
          data2.style.display = "none";
        } else if (selectedValue === "Old Battery") {
          var data2 = document.getElementById("data2");
          data2.style.display = "block";
          var data1 = document.getElementById("data1");
          data1.style.display = "none";
        }
      }
function calculate() {
    
    var input1 = document.getElementById("newbat").value;
    var input2 = document.getElementById("oldbat").value;
    var result = parseInt(input1) - parseInt(input2);
    document.getElementById("totval").value = result;
  }
 </script>
</body>
</html>
  <?php
    if(isset($_POST['insert'])){
        echo "ok";
       if($_POST['type']=="New Battery")
{

        $_s=$_POST["category"];
        $busid=$_POST["busid"];
        $category=$_s;
        $from=$_POST["from"];
        $to=$_POST["to"];
        $type=$_POST['type'];
        $distributor1=$_POST["distributor1"];
        echo $distributor1;
        $model1=$_POST["model1"];
        $capacity1=$_POST["capacity1"];
        $cost=$_POST["cost"];

        $conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
  $query="INSERT INTO battery VALUES ('$busid','$category','$from','$to','$type','$distributor1','$model1','$capacity1','','','$cost')";
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
        $from=$_POST["from"];
        $to=$_POST["to"];
        $type=$_POST['type'];
        $distributor=$_POST["distributor"];
        echo $distributor;
        $model=$_POST["model"];
        $capacity=$_POST["capacity"]; 
        $newcost=$_POST["newcost"];
        $oldcost=$_POST["oldcost"];
        $total=$_POST["total"];

        $conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
  $query="INSERT INTO battery VALUES ('$busid','$category','$from','$to','$type','$distributor','$model','$capacity','$newcost','$oldcost ', '$total')";
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
            $query=mysqli_query($conn,"select * from battery");
            echo "<table border='1'>
         <tr>
         <th>busid</th>
         <th>category</th>
         <th>from</th>
         <th>to</th>
         <th>type</th>
         <th>distributor</th>
         <th>model</th>
         <th>capacity</th>
        <th> new cost</th>
       <th> old cost</th>
        <th> total </th>
         </tr>
         ";
         while($row= mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td>" . $row['busid'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['from'] . "</td>";
            echo "<td>" . $row['to'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['distributor'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['capacity'] . "</td>"; 
           echo "<td>" . $row['newcost'] . "</td>"; 
          echo "<td>" . $row['oldcost'] . "</td>"; 
          echo "<td>" . $row['total'] . "</td>"; 
            echo "</tr>";
            }
            echo "</table>";
       }
  }
 ?>