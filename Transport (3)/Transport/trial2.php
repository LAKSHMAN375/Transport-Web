
<html>  
<body>
<form action="" method="post" >
  
    <?php  
 $host = "localhost";
 $user = "root";
 $password = "";
 $database = "transport";
 $conn = mysqli_connect($host, $user, $password, $database);
 $sql = "SELECT busid from masterdemo ";
$qry=mysqli_query($conn,$sql);

echo "<input type='text' list='category' name='in'> ";
echo "<datalist id='category'> ";
while($row =mysqli_fetch_array($qry)){
    echo '<option>' .$row['busid']. '</option>';
}

echo "</datalist>";
 ?>
</datlist>


<button type="submit" name="New" style="border-radius:50%" >+</button>
</form>

<?php
if(isset($_POST['New'])){
    
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "transport";
    $conn = mysqli_connect($host, $user, $password, $database);

    $in=$_POST['in'];
    $sql = "INSERT INTO `masterdemo` values('$in') ";
   $qry=mysqli_query($conn,$sql);
   header("Refresh:0");
    
}
mysqli_close($conn);
?>
</body>
</html>