
<html>  
<body>
<form action="" method="post" >
<select name="category" >
    <?php 
 echo "ok";
 $host = "localhost";
 $user = "root";
 $password = "";
 $database = "transport";
 $conn = mysqli_connect($host, $user, $password, $database);
 $sql = "SELECT opt from options ";
$qry=mysqli_query($conn,$sql);
while($row =mysqli_fetch_array($qry)){
    echo '<option>' .$row['opt']. '</option>';
}
 ?>
</select>


<button type="submit" name="New" style="border-radius:50%" >+</button>
</form>

<?php
if(isset($_POST['New'])){
    echo '<script> let m= prompt("Enter new Value:") </script> ';
    if (m){
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "transport";
    $conn = mysqli_connect($host, $user, $password, $database);
    $sql = "INSERT INTO options values('purple') ";
   $qry=mysqli_query($conn,$sql);
   header("Refresh:0");
    }
}
?>
</body>
</html>