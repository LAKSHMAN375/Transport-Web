<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="fitness.css">
    
</head>
<body class="bg-scroll bg-no-repeat bg-cover font-semibold" style="background-image: url('bg.jpg');">
<a href="./Transport.html" class="hbg-slate-500 hover:bg-black hover:text-white rounded-full bg-white px-4 py-2 m-2">&laquo;</a>
<div style="text-align:center;">
<p class="p1">GLASS WORK</p>

    <form action="" method="post" enctype="multipart/form-data" class="text-center my-24">
        <label for="" class="text-white p2">Bus ID : </label>
        <input type="text" class="border-solid border-2 my-2 p2" name="bus_id" id="id"> <br>
        <label for="" class="text-white p2">Category : </label>
        <select name="sele" id="" class="border-solid border-2 my-2 " id="category">
            <option value="Select">Select Category</option>
            <option value="VVIT">VVIT</option>
            <option value="VIVA">VIVA</option>
        </select> <br>
        <label for="" class="text-white p2">From : </label>
        <input type="date" class="border-solid border-2 my-2 " name="from_date" id=""> &emsp;
        <label for="" class="text-white p2">To : </label>
        <input type="date" class="border-solid border-2 my-2" name="to_date" id=""> <br>
        <label for="" class="text-white p2">Place : </label>
        <input type="text" class="border-solid border-2 my-2" name="place" id="pla"> <br>
        <label for="" class="text-white p2">Company Name : </label>
        <input type="text" class="border-solid border-2 my-2" name="company_name" id="comn"> <br>
        <div>
        <label for="" class="text-white p2">Quantity : </label>
        <input type="number" class="border-solid border-2 my-2" oninput = "Calc()" name="quan" id="qua"> <br>
        <label for="" class="text-white p2">Glass Cost : </label>
        <input type="number" class="border-solid border-2 my-2" oninput = "Calc()" name="glass_cost" id="gc"> <br>
        <label for="" class="text-white p2">Total Value : </label>
        <input type="text" class="border-solid border-2 my-2" name="total" id="t"> </br>
        </div>
        <button type="submit" id="sub" value="Submit" class="p5 btn" name="insert"/>Submit</button>
        <button type="submit" id="dis" value="Display" name="display" class="btn"/>Display</button><br>
        <button type="submit" value="Export to Excel" name="export_excel" class="border-solid border-2 bg-slate-500 hover:bg-green-900 hover:text-white p-1 rounded-md mt-2 btn">Export to Excel</button>
    </form>
</div>
    <section class="m-0 pt-0">
    <?php
    if(isset($_POST['display'])){
$conn = mysqli_connect("localhost", "root", "", "transport");
$id = $_POST['bus_id'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$sql = "SELECT *  FROM `glasswork`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
echo "<h3 class='text-center text-white'>The Details are : </h3><br><br>";
echo "<div class='flex justify-center pt-0'>";
echo "<table class='border-collapse border border-gray-400 text-center text-white my-4'>";
echo "<tr class='border border-gray-400 pt-2'><th class='border'>BUS ID</th><th class='border'>CATEGORY</th><th class='border'>PLACE</th><th class='border'>COMPANY NAME</th><th class='border'>QUANTITY</th><th class='border'>GLASS COST</th><th class='border'>TOTAL VALUE</th><th class='border'>FROM DATE</th><th class='border'>TO DATE</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr class='border border-gray-400 px-4 py-2 text-center'><td class='border'>" . $row["busid"]. "</td><td class='border'>" . $row["category"]. "</td><td class='border'>" . $row["place"]. "</td><td class='border'>" . $row["comname"]. "</td><td class='border'>" . $row["quant"]. "</td><td class='border'>" . $row["cost"]. "</td><td class='border'>" . $row["val"]. "</td><td class='border'>" . $row["fromdate"]. "</td><td class='border'>" . $row["todate"]. "</td></tr>";
}
echo "</table>";
echo "</div>";
} else {
    echo "No results found.";
}
}
if(isset($_POST['submit'])){
    $conn = mysqli_connect("localhost", "root", "", "transport");
    $id = $_POST['bus_id'];
    $cat = $_POST['sele'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $pla = $_POST['place'];
    $cname = $_POST['company_name'];
    $quant = $_POST['quan'];
    $cos = $_POST['glass_cost'];
    $total = $_POST['total'];


    $sql = "INSERT INTO `glasswork` VALUES ('$id','$cat','$pla','$cname','$quant','$cos','$total', '$from_date', '$to_date')";
    $qry = mysqli_query($conn, $sql);
    if ($qry) {
    echo '<script type="text/javascript"> alert("Details Submitted")</script>';
    }
}
?>
</section>
    <script>
        function Calc(){
            var a = document.getElementById('qua').value;
            var b = document.getElementById('gc').value;
            var res=0
            var res = parseInt(a) * parseInt(b);
            document.getElementById('t').value = res;
        }
    </script>
</body>
</html>