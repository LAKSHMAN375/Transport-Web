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
<p class="p1">Painting Cost</p>
<form action="" method="post">    
<p class="p2"><label>Enter Bus Id: </label><input type="text" name="busid" /> 
<p class="p2"><label>Select Category Of Bus:</label>  
<select name="category" id="bus">
  <option value="vvit">vvit</option>
  <option value="viva">viva</option>
</select>
<div class="p3">
<lable for="from" >from date: </label>
<input type="date" name="from"  min="2007-01-01" max="2050-12-31">  
<label for="to">to date:</label><input type="date" name="to"  min="2007-01-01" max="2050-12-31" ></div><br>
<div class="p2">
<label>
        <input type="radio" name="exampleRadio" value="Full Paint" onclick="onRadioButtonClick()" >
        Full Paint
      </label>
      <label>
        <input type="radio" name="exampleRadio" value="Part Paint" onclick="onRadioButtonClick()">
        Part Paint
      </label>

      <div id="data1" style="display: none;">
<p>-------------------------------------------------------------------------------------------------------------------------------------------------------</p>


Painter name:  <input type="text" name="PainterName" id="painter"/></br>
Company:  <input type="text" name="Company" id="company"/></br>
Paint Cost:  <input type="text"  name="PainterCost" id="cost"/></br>
 Total Value:<input type="text" id="totval" name="TotalValue" />
  </div>
      <div id="data2" style="display: none;">
<p>-------------------------------------------------------------------------------------------------------------------------------------------------------</p>

 Painter name:  <input type="text" name="PainterName" id="painter"/></br>
Company:  <input type="text"  name="Company" id="company"/></br>
Paint Cost:  <input type="text"  name="PainterCost" id="cost"/></br>
 Total Value:</label><input type="text" id="totval" name="TotalValue"/>
      </div>
</div>
<div class="p1">
<button type="submit" id="sub" value="Submit" class="p5 btn" name="insert"/>Submit</button>
<button type="submit" id="dis" value="Display" name="display" class="btn"/>Display</button>
</div>
</div>
</form>
<script>
      function onRadioButtonClick() {
        var selectedValue = document.querySelector('input[name="exampleRadio"]:checked').value;

        if (selectedValue === "Full Paint") {
          var data1 = document.getElementById("data2");
          data1.style.display = "block";
          var data2 = document.getElementById("data1");
          data2.style.display = "none";
        } else if (selectedValue === "Part Paint") {
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

    <?php
    if(isset($_POST['insert'])){
        echo "ok";
        $_selected=$_POST['exampleRadio'];
        $_s=$_POST["category"];
        $busid=$_POST["busid"];
        $category=$_s;
        $from=$_POST["from"];
        $to=$_POST["to"];
        $type=$_selected;
        $PainterName=$_POST["PainterName"];
        echo $PainterName;
        $Company=$_POST["Company"];
        $PainterCost=$_POST["PainterCost"];
        $TotalValue=$_POST["TotalValue"];

        $conn=new mysqli("localhost","root","","transport");
if($conn->connect_error)
{
  die("Connection Failed:".$conn->connect_error);
}
else{
  $query="INSERT INTO paints  VALUES ('$busid','$category','$from','$to','$type','$PainterName','$Company','$PainterCost','$TotalValue')";
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
            $query=mysqli_query($conn,"select * from paints");
            echo "<table border='1'>
         <tr>
         <th>busid</th>
         <th>category</th>
         <th>from</th>
         <th>to</th>
         <th>type</th>
         <th>PainterName</th>
         <th>Company</th>
         <th>PainterCost</th>
         <th>TotalValue</th> 
         </tr>
         ";
         while($row= mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td>" . $row['busid'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['from'] . "</td>";
            echo "<td>" . $row['to'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['PainterName'] . "</td>";
            echo "<td>" . $row['Company'] . "</td>";
            echo "<td>" . $row['PainterCost'] . "</td>";
            echo "<td>" . $row['TotalValue'] . "</td>"; 
            echo "</tr>";
            }
            echo "</table>";
       }
  }
        ?>
</body>
</html>