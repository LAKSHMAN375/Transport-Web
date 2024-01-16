<?php

    if (isset($_POST['insurancefile'])) {
        $conn = mysqli_connect("localhost", "root", "", "uploadfile");
        $file = $_FILES['uploadfile']['name'];
        $busid = $_POST['id'];
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $filetmpname = $_FILES['uploadfile']['tmp_name'];
        $folder = 'insuranceimage/';

        move_uploaded_file($filetmpname, $folder.$file);


$sql = "INSERT INTO `insurance`(`id`, `image`, `fromdate`, `todate`) VALUES ('$busid','$file','$from_date','$to_date')";
$qry = mysqli_query($conn, $sql);
if ($qry) {
    echo '<script type="text/javascript"> alert("Image uploaded")</script>';
}
}

?>
<html>
<head>
    <title>INSURANCE CERTIFICATE</title>
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
        <marquee direction="left" scrollamount="22" class="marq"><img src="bus.jpg" id="img3"/> INSURANCE CERTIFICATE <img src="bus.jpg" id="img3"/></marquee>
    </header>
    <main>
        <form action="" method="post" enctype="multipart/form-data">
            <label id="l1" name="bus_id" for="bus">Enter Bus ID : </label>
            <input type="text" id="txt" name = "id">
            <input id="btn1" type="submit" name="submit" value="Display"> <br> <br> <br>
            <div>
                <label>from : </label>
                <input type="date" name="from_date" id="from_date"> &nbsp;
                <label>to : </label>
                <input type="date" name="to_date" id="to_date"> &nbsp;
                <input type="submit" value="Submit" name="sub" id="sub">
            </div> <br> <br>
            <input type="file" name="uploadfile" id="f1">
            <input type="submit" id="btn2" name="insurancefile" value="Uplaod">
        </form>
        <section>
            <?php
            if(isset($_POST['submit'])){
            $image_id = $_POST['id'];
            $image_name = $image_id . ".jpg";
            $image_path = "insuranceimage/".$image_name;
  
            if(file_exists($image_path)){
            echo "<img src='".$image_path."' width='500' height='500' alt='Image'>";
            } else {
            echo '<script type="text/javascript"> alert("Image not found")</script>';
            }
            }
            if(isset($_POST['sub'])){
                $conn = mysqli_connect("localhost", "root", "", "uploadfile");
                $from_date = $_POST['from_date'];
                $to_date = $_POST['to_date'];

                $sql = "SELECT `id`,`fromdate`, `todate` FROM `insurance` WHERE fromdate and todate BETWEEN '$from_date' AND '$to_date'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "The insurance certificates found are : <br><br>";
                    echo "<table border='2' style='border: 2px solid black; color:black; padding:3px; margin-left:20%;background-color:white;'>";
                    echo "<tr><th>ID</th><th>FROM DATE</th><th>TILL DATE</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["fromdate"]. "</td><td>" . $row["todate"]. "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No results found.";
                }
            }
            ?>
        </section>
    </main>
</body>
</html>