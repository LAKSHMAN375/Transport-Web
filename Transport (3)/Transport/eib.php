<?php

    if (isset($_POST['eibfile'])) {
        $conn = mysqli_connect("localhost", "root", "", "uploadfile");
        $file = $_FILES['uploadfile']['name'];
        $busid = $_POST['id'];
        $filetmpname = $_FILES['uploadfile']['tmp_name'];
        $folder = 'eibimage/';

        move_uploaded_file($filetmpname, $folder.$file);


$sql = "INSERT INTO `eib`(`id`, `image`) VALUES ('$busid','$file')";
$qry = mysqli_query($conn, $sql);
if ($qry) {
    echo '<script type="text/javascript"> alert("Image uploaded")</script>';
}
}

?>
<html>
<head>
    <title>EIB CERTIFICATE</title>
    <link rel="apple-touch-icon" sizes="180x180" href="faviconio/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="faviconio/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="faviconio/favicon-16x16.png">
    <link rel="manifest" href="faviconio/site.webmanifest">
    <link rel="stylesheet" href="VehicleInfo.css">
    <style>
    #image {
        margin-left: 40%;
        font-size: medium;
    }
    #img3 {
    width: 60px;
    height: 30px;
    border-radius: 90px;
}
#f1{
    margin-left: 39%;
    font-size: medium;
}

    </style>
</head>

<body>
    <a href="transport.html" class="previous">&laquo;</a>
    <header>
        <marquee direction="left"  scrollamount= "20" class="marq"><img src="bus.jpg" id="img3"/> EIB CERTIFICATE <img src="bus.jpg" id="img3"/></marquee>
    </header>
    <main>
        <form action="" method="post" enctype="multipart/form-data">
            <label id="l1" name="bus_id" for="bus">Enter Bus ID : </label>
            <input type="text" id="txt" name = "id">
            <input id="btn1" type="submit" name="submit" value="Display"> <br> <br>
            <input type="file" name="uploadfile" id="f1">
            <input type="submit" id="btn2" name="eibfile" value="Uplaod">
        </form>
        <section>
            <?php
            if(isset($_POST['submit'])){
            $image_id = $_POST['id'];
            $image_name = $image_id . ".jpg";
            $image_path = "eibimage/".$image_name;
  
            if(file_exists($image_path)){
            echo "<img src='".$image_path."' width='500' height='500' alt='Image'>";
            } else {
            echo '<script type="text/javascript"> alert("Image not found")</script>';
            }
            }
            ?>
        </section>
    </main>
</body>
</html>