<html>
<head>
    <title>INSURANCE CERTIFICATE</title>
    <link rel="apple-touch-icon" sizes="180x180" href="faviconio/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="faviconio/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="faviconio/favicon-16x16.png">
    <link rel="manifest" href="faviconio/site.webmanifest">
    <link rel="stylesheet" href="VehicleInfo.css">
    <style>
        label{
            display:inline-block;
            
        }
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
            <input type="text" id="txt" name = "id"><br> <br>
            <label id="l1" name="bus_id" for="bus">Enter EIB number </label>
            <input type="text" id="txt" name = "id">
            <label id="l1" name="bus_id" for="bus">Registration Mark</label>
            <input type="text" id="txt" name = "id">
            <label id="l1" name="bus_id" for="bus">Markers Name</label>
            <input type="text" id="txt" name = "id"> <br>
            <label for="bus"> Validity from : </label>
                <input type="date" name="from_date" id="from_date"> <br>
                <label for="bus"> Validity to : </label>
                <input type="date" name="from_date" id="from_date">
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
        </main>
</body>
</html>