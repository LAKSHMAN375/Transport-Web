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
<form action="" method="post">
<p class="p1">Accident Details</p><br><br>
<p class="p2">
Enter Bus Id: <input type="text" name="busid" class="btn1"/> <br>
Driver name :<input type="text" name="driver" id="dri"/><br>
Driver Phno: <input type="text" name="phno" id="phnum"/><br>
Date : <input type="date" name="date" id="dt"/><br>
<p class="p2"><p class="p2"><label for="bus">Select Category:</label><input type="text" list="k" name="category"/>
<datalist id="k">
  <option value="vvit">vvit</option>
  <option value="viva">viva</option>
</datalist><br>
<div class="p2">
<label>
        <input type="radio" name="type" class="rd" value="Accident" onclick="onRadioButtonClick()">
         Accident
      </label>
      <label>
        <input type="radio" name="type" class="rd" value="Death" onclick="onRadioButtonClick()">
        Death
      </label>
</div>
      <div id="data1" style="display: none;" class="p2">
<p>---------------------------------------------------------------------------------------------------------------------------</p>
       <p class="p2"><p class="p2"><label for="bus">victim</label>
<select name="victim" id="bus">
  <option value="Four Wheeler">Four wheeler</option>
  <option value="Two Wheeler">Two Wheeler</option>
  <option value="Six Wheeler">Six Wheeler</option>
</select></p></p>
        Our Repair Cost:<input type="text" id="rcost" name="repaircost"/><br>
      </div>
      <div id="data2" style="display: none;" class="p2">
<p>----------------------------------------------------------------------------------------------------------------------------</p>

          <label for="Amount">Excrasia:</label>
	          <input type="text" id="amut" class="btn1" name="excrasia"/><br><br>
            Description: <textarea id="detls" name="description"></textarea><br><br>
      </div>
<div class="p1">
<button type="submit" id="sub" value="Submit" class="p5 btn" name="insert"/>Submit</button>
<button type="submit" id="dis" value="Display" name="display" class="btn"/>Display</button>
</div>
</form>
<script>
      function onRadioButtonClick() {
        var selectedValue = document.querySelector('input[name="type"]:checked').value;

        if (selectedValue === "Accident") {
          var data1 = document.getElementById("data1");
          data1.style.display = "block";
          var data2 = document.getElementById("data2");
          data2.style.display = "none";
        } else if (selectedValue === "Death") {
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
       if($_POST["type"]=="Accident")
{
        $busid=$_POST["busid"];
        $driver=$_POST["driver"];
        $phnum=$_POST["phno"];
        $date=$_POST["date"];
        $category=$_POST["category"];
        $type=$_POST["type"];
        $victim=$_POST["victim"];
        $repair=$_POST["repaircost"];

        $conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
  $query="INSERT INTO accidents VALUES ('$busid','$driver','$phnum','$date','$category','$type','$victim','$repair',' ',' ')";
$rs=mysqli_query($conn,$query);  
   if($rs){
      echo '<script> alert("data Inserted");  </script>';
   }
}    
}
else
{
$busid=$_POST["busid"];
        $driver=$_POST["driver"];
        $phnum=$_POST["phno"];
        $date=$_POST["date"];
        $category=$_POST["category"];
        $type=$_POST["type"];
        $excras=$_POST["excrasia"];
        $descri=$_POST["description"];
      

        $conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
  $query="INSERT INTO accidents VALUES ('$busid','$driver','$phnum','$date','$category','$type',' ',' ','$excras','$descri')";
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
            $query=mysqli_query($conn,"select * from accidents");
            echo "<table border='1'>
         <tr>
         <th>busid</th>
         <th> Driver Name</th>
         <th> Driver Phnumber</th>
         <th> Date </th>       
         <th>Category</th>
         <th>Type</th>
         <th>Victim</th>
        <th>Repairs cost</th>
       <th>Excrasia</th>
       <th>Description</th> 
         </tr>
         ";
         while($row= mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td>" . $row['busid'] . "</td>";
            echo "<td>" . $row['driver'] . "</td>";
            echo "<td>" . $row['phno'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
           echo "<td>" . $row['category'] . "</td>"; 
           echo "<td>" . $row['type'] . "</td>";
           echo "<td>" . $row['victim'] . "</td>";
           echo "<td>" . $row['repaircost'] . "</td>";
          echo "<td>" . $row['excrasia'] . "</td>";
          echo "<td>" . $row['description'] . "</td>";
          
            echo "</tr>";
            }
            echo "</table>";
       }
  } 
?>