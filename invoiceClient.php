<?php
session_start();
$user=$_SESSION['clientid'];
$client_name=$_SESSION['clientname'];
$client_addr=$_SESSION['clientaddr'];
$client_email=$_SESSION['clientemail'];
$client_city=$_SESSION['clientcity'];
$client_province=$_SESSION['clientprovince'];
$client_post=$_SESSION['clientpost'];
$client_mobile=$_SESSION['clientmobile'];
//$admin=$_SESSION['admin'];
?>
<?php
    include 'connection.php';
    $generate_quote="INSERT INTO `quote`(`client_id`, `amount`, `admin_name`) VALUES ('$user',6000,'admin')";
    $run=mysqli_query($dbcon,$generate_quote);
//    $dbcon.close();
    ?>
<?php
include 'connection.php';
$select_quote="select * from quote where client_id='$user'";
    $r=mysqli_query($dbcon,$select_quote);
    while($row=mysqli_fetch_array($r))//while look to fetch the result and store in a array $row.
        {
    $quote=$row[0];}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice-<?php echo $client_name?></title>
    <link rel="stylesheet" href="style.css" media="all" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

    <script src="js/script.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>

<header class="clearfix">
    <div id="logo">
        <img src="images/ssci.png">
    </div>
    <div id="company">
        <h2 class="name">SSCI</h2>
        <div>3105 Dundas St W Suite 202, Mississauga , Ontario,L5L 3R8</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">info@sscinc.ca</a></div>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to">INVOICE TO:</div>
            <h2 class="name"><?php echo $client_name?></h2>
            <div class="address"><?php echo $client_addr?>, <?php echo $client_city?> , <?php echo $client_province ?>,<?php echo $client_post?></div>
            <div class="mobile">Mobile:<?php echo $client_mobile ?></div>
            <div class="email"><a href="mailto:<?php echo $client_email?>"><?php echo $client_email?></a></div>
        </div>
        <div id="invoice">
            <h1>INVOICE # <?php echo $quote ?></h1>
            <div class="date">Date: <input type="date" id="datePicker" style="border: none"></div>

        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0" id="table" class="table table-striped table-bordered" width="100%">
        <thead>
        <tr >
            <th class="no">#</th>
            <th class="desc">Service Name</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
            <th class="">Action</th>
        </tr>
        </thead>
        <?php
        include("connection.php");
        $view_serv_query="select * from services";//select query for viewing users.
        $run=mysqli_query($dbcon,$view_serv_query);//here run the sql query.

        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
        {
            $serv_id=$row[0];
            $serv_name=$row[1];
            $desc=$row[2];
            $unit=$row[3]; ?>

            <tr class="item-row">
                <!--here showing results in the table -->
                <td class="no"><?php echo $serv_id;  ?></td>
                <td class="desc"><?php echo $serv_name;  ?></td>
                <td class="desc"><h3><?php echo $desc;  ?></h3></td>
                <td><textarea class="cost" style="resize: none;border: none;height:auto;width: 50px;color: #000;text-align: center; margin: 0px auto; display: block; background-color: #EEEEEE;">$<?php echo $unit?>.00</textarea></td>
                <td><input type="number" class="qty"></td>
                <td><span class="price">$0.00</span></td>
                <td><button class="btn btn-primary" onclick="myDelete(this)">X</button></td>

            </tr>

        <?php } ?>

        <tfoot style="display: table-row-group">
        <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td ><div id="subtotal">$00.00</div></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX 13%</td>
            <td id="tax">$00.00</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td id="total">$00.00</td>
            <button class="btn btn-primary btn-cons" onclick="window.print()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
        </tr>
        </tfoot>

    </table>

    <div id="thanks">Thank you!</div>
</main>
<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>
</html>
