<?php include('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>
<?php include('inc/connection.php'); ?>

<br>
<div class="container">
<?php
    $id = $_GET['pid'];
    $sql = "SELECT * FROM `product_var` WHERE `id` = $id";
    $res = mysqli_query($db,$sql);
    while($row = mysqli_fetch_assoc($res)) {
        extract($row);

        $sql1 = "SELECT * FROM `product_tb` WHERE `id`='$product_id'";
        $res1 = mysqli_query($db,$sql1);

        while($row1 = mysqli_fetch_assoc($res1)) {
            $nm = $row1['product_nm'];
            $cm = $row1['product_cm'];
            echo '
                <h4>PRODUCT NAME : '.$nm.'</h4>
                <h4>COMPANY NAME : '.$cm.'</h4>
                <h4>VAR NAME 1 : '.$type_name_1.'</h4>
                <h4>VAR VALUE 1 : '.$type_qty_1.'</h4>
                <h4>VAR NAME 2 : '.$type_name_2.'</h4>
                <h4>VAR VALUE 2 : '.$type_qty_2.'</h4>
                <h4>PRICE : <del>'.$fprice.'</del> , '.$price.' Rs.</h4>
                <h4>SKU : '.$sku.'</h4>
            ';
        }

        $sql2 = "SELECT * FROM `images_tb` WHERE `pid`='$id'";
        $res2 = mysqli_query($db,$sql2);

        while($row2 = mysqli_fetch_assoc($res2)) {
            $inm = $row2['image_name'];
            echo '
                <img src="API/images/'.$inm.'">
            ';
        }
    }

?>
</div>

<?php include('inc/footer.php'); ?>